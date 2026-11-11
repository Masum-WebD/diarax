<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Solution;
use App\Models\Inquiry;
use Tests\TestCase;

class MedicalPortalTest extends TestCase
{
    public function test_homepage_loads_successfully_with_dixion_brand(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('DIXION');
        $response->assertSee('Medical Systems');
        $response->assertSee('Düsseldorf');
    }

    public function test_homepage_handles_entrance_splash_mode(): void
    {
        $response = $this->get('/?entrance=splash');

        $response->assertStatus(200);
        $response->assertSee('Enter Main Portal');
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

    public function test_product_detail_page_loads(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get('/products/' . $product->slug);

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->model_code);
    }

    public function test_turnkey_solutions_page_loads(): void
    {
        $response = $this->get('/turnkey-solutions');

        $response->assertStatus(200);
        $response->assertSee('Complex Hospital Equipping');

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
        $response->assertSee('About DIXION Healthcare Systems');
        $response->assertSee('ISO 13485:2016');
    }

    public function test_contact_and_quote_pages_load(): void
    {
        $contactResponse = $this->get('/contact');
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('Schiessstrasse 55');

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
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Hospital Inquiries');
        $response->assertSee('Inventory Overview');

        $inqResponse = $this->get('/admin/inquiries');
        $inqResponse->assertStatus(200);

        // Test status update
        $inquiry = Inquiry::first();
        if ($inquiry) {
            $updateResponse = $this->post("/admin/inquiries/{$inquiry->id}/status", [
                'status' => 'contacted',
            ]);
            $updateResponse->assertSessionHas('success');
            $this->assertDatabaseHas('inquiries', [
                'id' => $inquiry->id,
                'status' => 'contacted',
            ]);
        }
    }
}
