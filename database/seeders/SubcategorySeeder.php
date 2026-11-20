<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Surgery & Operating Theatres Subcategories
        $surgeryCat = Category::where('slug', 'surgery-operating-theatres')->first();
        if ($surgeryCat) {
            $tableSub = Category::firstOrCreate(
                ['slug' => 'surgical-tables'],
                [
                    'parent_id' => $surgeryCat->id,
                    'name' => 'Surgical Tables',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'Electro-hydraulic, mobile, and specialized orthopedic operating tables.',
                    'sort_order' => 1,
                    'is_featured' => true,
                ]
            );

            $lightSub = Category::firstOrCreate(
                ['slug' => 'surgical-lights'],
                [
                    'parent_id' => $surgeryCat->id,
                    'name' => 'Surgical Lights',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'High-intensity shadowless LED surgical ceiling and mobile lamps.',
                    'sort_order' => 2,
                    'is_featured' => true,
                ]
            );

            $diathermySub = Category::firstOrCreate(
                ['slug' => 'surgical-diathermy'],
                [
                    'parent_id' => $surgeryCat->id,
                    'name' => 'Surgical Diathermy',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'High-frequency electrosurgical cutting and coagulation generators.',
                    'sort_order' => 3,
                    'is_featured' => true,
                ]
            );

            // Assign products
            Product::where('slug', 'diarax-operamed-3000')->update(['subcategory_id' => $tableSub->id]);
            Product::where('slug', 'diarax-convelar-1675')->update(['subcategory_id' => $lightSub->id]);
            Product::where('slug', 'diarax-altair-100')->update(['subcategory_id' => $diathermySub->id]);
        }

        // 2. Anesthesia & Respiratory Subcategories
        $anesthesiaCat = Category::where('slug', 'anesthesia-respiratory')->first();
        if ($anesthesiaCat) {
            $anesthSub = Category::firstOrCreate(
                ['slug' => 'anesthesia-workstations'],
                [
                    'parent_id' => $anesthesiaCat->id,
                    'name' => 'Anesthesia Workstations',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'Multi-gas digital anesthesia machines with precision vaporizers.',
                    'sort_order' => 1,
                    'is_featured' => true,
                ]
            );

            $ventSub = Category::firstOrCreate(
                ['slug' => 'icu-ventilators'],
                [
                    'parent_id' => $anesthesiaCat->id,
                    'name' => 'ICU Ventilators',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'High-acuity invasive and non-invasive critical care mechanical ventilators.',
                    'sort_order' => 2,
                    'is_featured' => true,
                ]
            );

            Product::where('slug', 'diarax-aeros-4600')->update(['subcategory_id' => $anesthSub->id]);
            Product::where('slug', 'diarax-aeros-4300')->update(['subcategory_id' => $ventSub->id]);
        }

        // 3. Intensive Care & Neonatology Subcategories
        $icuCat = Category::where('slug', 'intensive-care-neonatology')->first();
        if ($icuCat) {
            $monitorSub = Category::firstOrCreate(
                ['slug' => 'patient-monitors'],
                [
                    'parent_id' => $icuCat->id,
                    'name' => 'Patient Monitors',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'Modular and compact multi-parameter vital signs patient monitors.',
                    'sort_order' => 1,
                    'is_featured' => true,
                ]
            );

            $incubatorSub = Category::firstOrCreate(
                ['slug' => 'infant-incubators'],
                [
                    'parent_id' => $icuCat->id,
                    'name' => 'Infant Incubators',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'Microprocessor neonatal intensive care incubators with phototherapy.',
                    'sort_order' => 2,
                    'is_featured' => true,
                ]
            );

            $pumpSub = Category::firstOrCreate(
                ['slug' => 'infusion-syringe-pumps'],
                [
                    'parent_id' => $icuCat->id,
                    'name' => 'Infusion & Syringe Pumps',
                    'icon' => 'heroicon-o-cube',
                    'short_description' => 'High precision volumetric infusion and multi-syringe micro-pumps.',
                    'sort_order' => 3,
                    'is_featured' => true,
                ]
            );

            Product::where('slug', 'diarax-storm-5900')->update(['subcategory_id' => $monitorSub->id]);
            Product::where('slug', 'diarax-babyguard-i-1107')->update(['subcategory_id' => $incubatorSub->id]);
            Product::where('slug', 'diarax-instilar-1488')->update(['subcategory_id' => $pumpSub->id]);
        }

        // 4. Laboratory Equipment (as detailed in Company Vision & PDF)
        $labCat = Category::firstOrCreate(
            ['slug' => 'laboratory-equipment'],
            [
                'parent_id' => null,
                'name' => 'Laboratory Equipment',
                'icon' => 'heroicon-o-beaker',
                'short_description' => 'Advanced in-vitro diagnostics, POCT hormone systems, and automated blood analyzers.',
                'image' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
                'is_featured' => true,
            ]
        );

        $labSubs = [
            [
                'name' => 'Hematology Analyzer',
                'slug' => 'hematology-analyzer',
                'short_description' => '5-part and 3-part automated differential hematology blood cell counters.',
                'sort_order' => 1,
            ],
            [
                'name' => 'POCT Hormone Analyzer',
                'slug' => 'poct-hormone-analyzer',
                'short_description' => 'Rapid point-of-care fluorescence immunoassay hormone diagnostic units.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bio Chemistry Analyzer',
                'slug' => 'bio-chemistry-analyzer',
                'short_description' => 'Fully automated clinical chemistry and spectrophotometric analyzers.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Electrolyte Analyzer',
                'slug' => 'electrolyte-analyzer',
                'short_description' => 'Precision ISE ion selective electrode electrolyte analyzers (K+, Na+, Cl-, Ca++).',
                'sort_order' => 4,
            ],
        ];

        foreach ($labSubs as $sub) {
            Category::firstOrCreate(
                ['slug' => $sub['slug']],
                [
                    'parent_id' => $labCat->id,
                    'name' => $sub['name'],
                    'icon' => 'heroicon-o-cube',
                    'short_description' => $sub['short_description'],
                    'sort_order' => $sub['sort_order'],
                    'is_featured' => true,
                ]
            );
        }
    }
}
