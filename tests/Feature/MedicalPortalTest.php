<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Solution;
use App\Models\Inquiry;
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
        $response->assertSee('About DIARAX Medical Systems');
        $response->assertSee('South Korea');
        $response->assertSee('ISO 13485:2016');
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
        $response->assertSee('South Korean Precision Medical Technology');
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
    }
}
