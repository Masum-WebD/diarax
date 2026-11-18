<?php

namespace Database\Seeders;

use App\Models\WelcomePopup;
use Illuminate\Database\Seeder;

class WelcomePopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (WelcomePopup::count() === 0) {
            WelcomePopup::create([
                'title' => 'Welcome to DIARAX Medical Systems',
                'badge' => 'South Korea Precision Engineering',
                'message' => 'DIARAX manufactures world-class medical equipment and surgical systems engineered in Seoul. Explore our latest ISO 13485 and CE certified devices for operating theatres, intensive care, and diagnostic medicine.',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80',
                'button_text' => 'Explore Equipment Catalog',
                'button_link' => '/products',
                'is_active' => true,
            ]);
        }
    }
}
