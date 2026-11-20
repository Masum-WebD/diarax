<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Solution;
use App\Models\Inquiry;
use App\Models\User;
use Tests\TestCase;

class MedicalPortalTest extends TestCase
{
    public function test_homepage_loads_successfully_with_diarax_brand(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('DIARAX');
        $response->assertSee('Medical Systems');
        $response->assertSee('South Korea');
    }

    public function test_products_catalog_loads_and_filters(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Medical Equipment & Systems');

        // Test category filter
        $category = Category::first();
        if ($category) {
            $catResponse = $this->get('/products?category=' . $category->slug);
            $catResponse->assertStatus(200);
            $catResponse->assertSee($category->name);
        }

        // Test search filter
        $searchResponse = $this->get('/products?q=Operamed');
        $searchResponse->assertStatus(200);
    }

    public function test_product_detail_and_datasheet_pages_load(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get('/products/' . $product->slug);

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->model_code);

        // Test printable datasheet
        $datasheetResponse = $this->get('/products/' . $product->slug . '/datasheet');
        $datasheetResponse->assertStatus(200);
        $datasheetResponse->assertSee('Official Technical Datasheet');

        // Test compare page
        $compareResponse = $this->get('/compare');
        $compareResponse->assertStatus(200);
        $compareResponse->assertSee('Side-by-Side Equipment Comparison');
    }

    public function test_turnkey_solutions_page_loads(): void
    {
        $response = $this->get('/turnkey-solutions');

        $response->assertStatus(200);
        $response->assertSee('Turnkey Hospital Equipping');

        $solution = Solution::first();
        if ($solution) {
            $detailResponse = $this->get('/turnkey-solutions/' . $solution->slug);
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($solution->title);
        }
    }

    public function test_about_page_loads(): void
    {
        $response = $this->get('/about-dixion');

        $response->assertStatus(200);
        $response->assertSee('About DIARAX Ltd.');
        $response->assertSee('South Korea');
        $response->assertSee('ISO');
    }

    public function test_contact_and_quote_pages_load(): void
    {
        $contactResponse = $this->get('/contact');
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('Seoul');
        $contactResponse->assertSee('South Korea');

        $quoteResponse = $this->get('/request-quote');
        $quoteResponse->assertStatus(200);
        $quoteResponse->assertSee('Request Medical Equipment Quotation');
    }

    public function test_inquiry_submission_stores_in_database(): void
    {
        $payload = [
            'full_name' => 'Prof. Dr. Hans Mueller',
            'email' => 'mueller@charite.de',
            'phone' => '+49 30 45050',
            'organization' => 'Charité University Hospital',
            'country' => 'Germany',
            'inquiry_type' => 'quote',
            'subject' => 'Operating Theatre Expansion Project',
            'message' => 'We request technical specifications and budgetary quotes for 3 units of Operamed 3000.',
        ];

        $response = $this->post('/inquiries', $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('inquiries', [
            'email' => 'mueller@charite.de',
            'full_name' => 'Prof. Dr. Hans Mueller',
        ]);
    }

    public function test_admin_dashboard_and_inquiries_management(): void
    {
        // Unauthenticated guest should be redirected to login
        $guestResponse = $this->get('/admin');
        $guestResponse->assertRedirect('/admin/login');

        // Login page loads successfully
        $loginResponse = $this->get('/admin/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('Medical Admin Portal');

        // Authenticated admin user access
        $admin = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Test Admin',
            'email' => 'testadmin@diarax.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Executive Dashboard');
        $response->assertSee('Purchases');
        $response->assertSee('Sales');

        $inqResponse = $this->actingAs($admin)->get('/admin/inquiries');
        $inqResponse->assertStatus(200);

        // Test status update
        $inquiry = Inquiry::first();
        if ($inquiry) {
            $updateResponse = $this->actingAs($admin)->post("/admin/inquiries/{$inquiry->id}/status", [
                'status' => 'contacted',
            ]);
            $updateResponse->assertSessionHas('success');
            $this->assertDatabaseHas('inquiries', [
                'id' => $inquiry->id,
                'status' => 'contacted',
            ]);
        }
    }

    public function test_admin_modules_accessible_to_authenticated_user(): void
    {
        $admin = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Test Admin',
            'email' => 'testadmin@diarax.com',
            'password' => bcrypt('password'),
        ]);

        // Banners Module
        $bannersResponse = $this->actingAs($admin)->get('/admin/banners');
        $bannersResponse->assertStatus(200);
        $bannersResponse->assertSee('Hero Banners');

        // Products Module
        $productsResponse = $this->actingAs($admin)->get('/admin/products');
        $productsResponse->assertStatus(200);
        $productsResponse->assertSee('Products Catalog');

        // Purchases Module
        $purchasesResponse = $this->actingAs($admin)->get('/admin/purchases');
        $purchasesResponse->assertStatus(200);
        $purchasesResponse->assertSee('Purchases');

        // Sales Module
        $salesResponse = $this->actingAs($admin)->get('/admin/sales');
        $salesResponse->assertStatus(200);
        $salesResponse->assertSee('Sales');

        // Test Banner Store, Update, and Delete
        $bannerCreate = $this->actingAs($admin)->post('/admin/banners', [
            'title' => 'Test Banner Slide',
            'subtitle' => 'Testing subtitle',
            'badge' => 'Test Badge',
            'image_url' => 'https://images.unsplash.com/test.jpg',
            'sort_order' => 5,
            'status' => 'active',
        ]);
        $bannerCreate->assertSessionHas('success');
        $this->assertDatabaseHas('banners', ['title' => 'Test Banner Slide']);

        $banner = \App\Models\Banner::where('title', 'Test Banner Slide')->first();
        $this->assertNotNull($banner);

        $bannerUpdate = $this->actingAs($admin)->put('/admin/banners/' . $banner->id, [
            'title' => 'Updated Banner Slide',
            'subtitle' => 'Updated subtitle',
            'badge' => 'Updated Badge',
            'image_url' => 'https://images.unsplash.com/updated.jpg',
            'sort_order' => 5,
            'status' => 'active',
        ]);
        $bannerUpdate->assertSessionHas('success');
        $this->assertDatabaseHas('banners', ['title' => 'Updated Banner Slide']);

        $bannerDelete = $this->actingAs($admin)->delete('/admin/banners/' . $banner->id);
        $bannerDelete->assertSessionHas('success');
        $this->assertDatabaseMissing('banners', ['title' => 'Updated Banner Slide']);

        // Categories Module Test
        $categoriesResponse = $this->actingAs($admin)->get('/admin/categories');
        $categoriesResponse->assertStatus(200);
        $categoriesResponse->assertSee('Medical Categories Catalog');

        $categoryStore = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Diagnostic MRI & Radiology',
            'slug' => 'diagnostic-mri-radiology',
            'sort_order' => 10,
            'short_description' => 'Advanced MRI scanners and radiological units',
            'image_url' => 'https://images.unsplash.com/photo-test-mri.jpg',
            'is_featured' => 1,
        ]);
        $categoryStore->assertSessionHas('success');
        $this->assertDatabaseHas('categories', ['slug' => 'diagnostic-mri-radiology']);

        $cat = Category::where('slug', 'diagnostic-mri-radiology')->first();
        $this->assertNotNull($cat);

        $categoryUpdate = $this->actingAs($admin)->put('/admin/categories/' . $cat->id, [
            'name' => 'Diagnostic Imaging & MRI',
            'slug' => 'diagnostic-imaging-mri',
            'sort_order' => 12,
            'short_description' => 'Updated MRI scanners and radiological units',
            'image_url' => 'https://images.unsplash.com/photo-test-mri-2.jpg',
            'is_featured' => 1,
        ]);
        $categoryUpdate->assertSessionHas('success');
        $this->assertDatabaseHas('categories', ['slug' => 'diagnostic-imaging-mri']);

        $catDelete = $this->actingAs($admin)->delete('/admin/categories/' . $cat->id);
        $catDelete->assertSessionHas('success');
        $this->assertDatabaseMissing('categories', ['slug' => 'diagnostic-imaging-mri']);

        // Welcome Popup Module Test
        $popupResponse = $this->actingAs($admin)->get('/admin/popup');
        $popupResponse->assertStatus(200);
        $popupResponse->assertSee('Website Welcome Popup');

        $popupUpdate = $this->actingAs($admin)->post('/admin/popup', [
            'title' => 'DIARAX Global Medical Expo 2026',
            'badge' => 'Seoul Healthcare Summit',
            'message' => 'Meet our engineers and view live demonstrations of DIARAX medical workstations.',
            'button_text' => 'Register for Demo',
            'button_link' => '/contact',
            'image_url' => 'https://images.unsplash.com/expo.jpg',
            'is_active' => 1,
        ]);
        $popupUpdate->assertSessionHas('success');
        $this->assertDatabaseHas('welcome_popups', [
            'title' => 'DIARAX Global Medical Expo 2026',
        ]);
    }

    public function test_footer_displays_diarax_ltd_and_dynamic_categories(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('DIARAX LTD.');
        $response->assertDontSee('Quality & Compliance');
    }

    public function test_product_detail_page_excludes_datasheet_compare_and_clinical_apps(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get('/products/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee('Request Official Quotation');
        $response->assertDontSee('Print Datasheet');
        $response->assertDontSee('Compare');
        $response->assertDontSee('Clinical Applications:');
        $response->assertSee('Certified Quality');
        $response->assertSee('Clinical Approved');
        $response->assertSee('Warranty');
    }

    public function test_contact_page_shows_korea_country_placeholder(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Send Us a Direct Message');
        $response->assertSee('placeholder="e.g. South Korea"', false);
        $response->assertDontSee('placeholder="e.g. Bangladesh"', false);
    }

    public function test_admin_can_update_product_badges_and_specifications(): void
    {
        $admin = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Test Admin',
            'email' => 'testadmin@diarax.com',
            'password' => bcrypt('password'),
        ]);

        $product = Product::first();
        $this->assertNotNull($product);

        $updateResponse = $this->actingAs($admin)->put('/admin/products/' . $product->id, [
            'name' => $product->name,
            'model_code' => $product->model_code,
            'category_id' => $product->category_id,
            'short_description' => $product->short_description,
            'description' => '<p>Updated technical specifications with rich description.</p>',
            'status' => 'active',
            'certified_quality' => 'ISO 13485:2026',
            'regulatory_standard' => 'Korea MFDS Class III',
            'warranty' => '36 Months Warranty',
            'features_text' => "Advanced Micro-Touch Controller\nCarbon Fibre Tabletop",
            'spec_keys' => ['Tabletop Elevation', 'Lateral Tilt'],
            'spec_values' => ['700 - 1100 mm', '±25°'],
        ]);

        $updateResponse->assertSessionHas('success');

        $freshProduct = $product->fresh();
        $this->assertEquals('ISO 13485:2026', $freshProduct->certified_quality);
        $this->assertEquals('Korea MFDS Class III', $freshProduct->regulatory_standard);
        $this->assertEquals('36 Months Warranty', $freshProduct->warranty);
        $this->assertContains('Carbon Fibre Tabletop', $freshProduct->features);
        $this->assertEquals('700 - 1100 mm', $freshProduct->specifications['Tabletop Elevation'] ?? null);

        // Verify public product page renders these dynamic fields
        $showResponse = $this->get('/products/' . $freshProduct->slug);
        $showResponse->assertStatus(200);
        $showResponse->assertSee('ISO 13485:2026');
        $showResponse->assertSee('Korea MFDS Class III');
        $showResponse->assertSee('36 Months Warranty');
        $showResponse->assertSee('Carbon Fibre Tabletop');
        $showResponse->assertSee('Tabletop Elevation');
        $showResponse->assertSee('700 - 1100 mm');
    }

    /**
     * Test subcategory admin creation, assignment to product, and header hover menu rendering.
     */
    public function test_subcategory_management_and_header_navigation(): void
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::factory()->create([
                'email' => 'admin@diarax.com',
                'password' => bcrypt('Admin@2026!'),
                'is_admin' => true,
            ]);
        }

        // 1. Create a parent category
        $parent = Category::create([
            'name' => 'Cardiovascular Systems',
            'slug' => 'cardiovascular-systems',
            'sort_order' => 50,
            'is_featured' => true,
        ]);

        // 2. Admin creates a subcategory via POST /admin/categories
        $subResponse = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Cardiac Defibrillators',
            'slug' => 'cardiac-defibrillators',
            'parent_id' => $parent->id,
            'sort_order' => 1,
            'is_featured' => 1,
        ]);
        $subResponse->assertSessionHas('success');
        $this->assertDatabaseHas('categories', [
            'slug' => 'cardiac-defibrillators',
            'parent_id' => $parent->id,
        ]);

        $subCat = Category::where('slug', 'cardiac-defibrillators')->first();
        $this->assertNotNull($subCat);
        $this->assertEquals($parent->id, $subCat->parent_id);

        // 3. Admin creates product with category and subcategory
        $prodResponse = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'DIARAX HeartPulse 900 Biphasic Defibrillator',
            'model_code' => 'HeartPulse 900',
            'category_id' => $parent->id,
            'subcategory_id' => $subCat->id,
            'short_description' => 'Automated external and manual biphasic cardiac defibrillator.',
            'description' => '<p>Hospital-grade biphasic 360J defibrillator with pacing.</p>',
            'status' => 'active',
        ]);
        $prodResponse->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'model_code' => 'HeartPulse 900',
            'category_id' => $parent->id,
            'subcategory_id' => $subCat->id,
        ]);

        // 4. Public home page displays category, subcategory, and product model in header mega menu
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Cardiovascular Systems');
        $homeResponse->assertSee('Cardiac Defibrillators');
        $homeResponse->assertSee('HeartPulse 900');

        // 5. Public catalog filtering by subcategory
        $filterResponse = $this->get('/products?subcategory=cardiac-defibrillators');
        $filterResponse->assertStatus(200);
        $filterResponse->assertSee('HeartPulse 900');

        // Cleanup
        Product::where('model_code', 'HeartPulse 900')->delete();
        $subCat->delete();
        $parent->delete();
    }
}
