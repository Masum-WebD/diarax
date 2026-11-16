<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'badge' => 'South Korean Technology • ISO 13485 • CE • MFDS Korea',
                'title' => 'South Korean Precision Engineering for Global Healthcare',
                'subtitle' => 'DIARAX manufactures over 250 advanced medical equipment models across 40 clinical categories — surgical suites, critical care, and anesthesia systems engineered in Seoul, South Korea.',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'badge' => 'Surgical Suites & Smart Operating Theatres',
                'title' => 'Next-Generation Robotic & Electro-Hydraulic Surgery',
                'subtitle' => 'Engineered for sub-millimeter surgical precision, ergonomic clinical control, and fail-safe patient support in state-of-the-art operating rooms worldwide.',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 2,
                'status' => 'active',
            ],
            [
                'badge' => 'Critical Care & Intelligent Life Support',
                'title' => 'Real-Time Multi-Parameter Monitoring & Anesthesia',
                'subtitle' => 'Continuous algorithmic patient monitoring and digital anesthesia delivery protecting vulnerable patients across intensive care and recovery units.',
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 3,
                'status' => 'active',
            ],
        ];

        foreach ($banners as $b) {
            Banner::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }
    }
}
