<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Solution;
use App\Models\NewsArticle;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class MedicalPortalSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categoriesData = [
            [
                'name' => 'Surgery & Operating Theatres',
                'slug' => 'surgery-operating-theatres',
                'icon' => 'scissors',
                'short_description' => 'Electro-hydraulic operating tables, surgical shadowless LED lights, and electrosurgical generators.',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'name' => 'Anesthesia & Respiratory',
                'slug' => 'anesthesia-respiratory',
                'icon' => 'lungs',
                'short_description' => 'Advanced anesthesia workstations, ICU ventilators, respiratory monitors, and vaporizers.',
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'name' => 'Intensive Care & Neonatology',
                'slug' => 'intensive-care-neonatology',
                'icon' => 'heart-pulse',
                'short_description' => 'Multi-parameter patient monitors, infant incubators, phototherapy units, and infusion syringe pumps.',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'name' => 'Functional Diagnostics & Imaging',
                'slug' => 'diagnostics-imaging',
                'icon' => 'activity',
                'short_description' => 'High-resolution ECG recorders, digital color ultrasound Doppler systems, and LED medical film illuminators.',
                'image' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'name' => 'Hospital Functional Beds & Furniture',
                'slug' => 'hospital-furniture',
                'icon' => 'bed',
                'short_description' => 'Motorized intensive care beds, emergency stretchers, examination couches, and medical ward furniture.',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'Turnkey & Mobile Healthcare',
                'slug' => 'turnkey-mobile-healthcare',
                'icon' => 'truck',
                'short_description' => 'Modular hospital complexes, containerized mobile clinics, resuscitation ambulances, and field hospitals.',
                'image' => 'https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 6,
                'is_featured' => true,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::create($c);
        }

        // 2. Products
        $productsData = [
            // Category: Surgery
            [
                'category_id' => $categories['surgery-operating-theatres']->id,
                'name' => 'Dixion Operamed 3000 Electro-Hydraulic Operating Table',
                'model_code' => 'Operamed 3000',
                'slug' => 'dixion-operamed-3000',
                'tagline' => 'Multi-functional German engineered surgical table for complex general, orthopedic, and cardiovascular interventions.',
                'short_description' => 'The Operamed 3000 delivers maximum stability, extreme patient positioning flexibility, and total C-arm radiolucency. Equipped with German hydraulic drives and an intuitive dual-control system.',
                'description' => "The DIXION Operamed 3000 electro-hydraulic operating table is built to meet the rigorous demands of modern surgical suites. Engineered in Germany, it offers whisper-quiet electro-hydraulic adjustments for elevation, Trendelenburg, reverse Trendelenburg, lateral tilt, back plate, and longitudinal table shift up to 350 mm for unobstructed C-arm access without patient repositioning.\n\nThe tabletop consists of 5 modular radiolucent sections made of anti-static SFC memory foam that provides optimal pressure distribution to prevent decubitus ulcers during lengthy surgical procedures.",
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Electro-hydraulic micro-touch wired hand controller with auxiliary backup panel on table column',
                    '350 mm longitudinal sliding for comprehensive 360° full-body C-arm imaging',
                    'High load-bearing capacity of up to 300 kg (660 lbs) with safety locking mechanism',
                    'Modular detachable head and leg plates with pneumatic gas springs for effortless adjustment',
                    'Premium surgical-grade 304 stainless steel base and column housing for superior hygiene',
                    'Integrated emergency battery backup ensuring up to 100 complete surgical cycles'
                ],
                'specifications' => [
                    'Table Length' => '2100 mm ± 50 mm',
                    'Table Width' => '550 mm (590 mm with side rails)',
                    'Height Adjustment' => '680 mm - 1030 mm',
                    'Trendelenburg / Rev. Trendelenburg' => '± 30°',
                    'Lateral Tilt (Left / Right)' => '± 20°',
                    'Longitudinal Shift' => '350 mm',
                    'Back Section' => '+80° / -40°',
                    'Max Patient Weight' => '300 kg'
                ],
                'applications' => ['General Surgery', 'Orthopedics & Traumatology', 'Cardiothoracic Surgery', 'Neurosurgery', 'Urology & Gynecology'],
                'brochure_pdf' => '/docs/dixion-operamed-3000-brochure.pdf',
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => $categories['surgery-operating-theatres']->id,
                'name' => 'Dixion Convelar 1675 Dual LED Surgical Shadowless Light',
                'model_code' => 'Convelar 1675',
                'slug' => 'dixion-convelar-1675',
                'tagline' => 'High-performance cool-spectrum surgical illumination with laminar airflow optimization.',
                'short_description' => 'Dual-satellite surgical light system featuring high-efficiency German Osram LEDs, variable color temperature (3800K–5000K), and aerodynamic design for sterile operating theaters.',
                'description' => "DIXION Convelar 1675 represents the pinnacle of modern surgical lighting technology. Built with a multi-matrix LED optical lens system, it creates a deep, homogeneous light cylinder that penetrates the deepest cavities without casting disturbing shadows from the surgeon's head or hands.\n\nThe aerodynamic open ring design allows unobstructed vertical laminar airflow from the ceiling, guaranteeing strict sterile conditions above the surgical site.",
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Peak illumination of 160,000 Lux per lamp head with uniform field distribution',
                    'Adjustable color rendering index Ra ≥ 96 and R9 ≥ 94 for lifelike tissue distinction',
                    'Infrared-free cool light preventing patient tissue desiccation during long surgery',
                    'Endo-light mode for minimally invasive laparoscopic surgical procedures',
                    'Detachable autoclavable central handle for sterile focus control by the surgeon'
                ],
                'specifications' => [
                    'Max Illuminance' => '160,000 / 140,000 Lux at 1 meter',
                    'Color Temperature' => '3800 K - 5000 K (4-step adjustable)',
                    'Color Rendering Index (Ra)' => '97',
                    'Light Field Diameter (d10)' => '180 - 320 mm',
                    'Depth of Illumination (L1+L2)' => '1400 mm',
                    'LED Service Life' => '> 60,000 hours',
                    'Power Consumption' => '85 W per satellite'
                ],
                'applications' => ['Major Surgical Theatres', 'Emergency Trauma Suites', 'Minimally Invasive Surgery', 'Cardiac Surgery'],
                'brochure_pdf' => '/docs/dixion-convelar-1675.pdf',
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'category_id' => $categories['surgery-operating-theatres']->id,
                'name' => 'Dixion Altair 100 High-Frequency Electrosurgical Unit',
                'model_code' => 'Altair 100',
                'slug' => 'dixion-altair-100',
                'tagline' => 'Intelligent microprocessor-controlled diathermy generator with neutral electrode impedance monitoring.',
                'short_description' => 'Precision monopolar and bipolar cutting and coagulation for general surgery, laparoscopy, and microsurgical procedures.',
                'description' => "The DIXION Altair 100 provides reliable radiofrequency surgical energy with automatic power compensation across varying tissue types. The unit incorporates the REM (Return Electrode Monitoring) safety circuit which continuously checks contact impedance to eliminate skin burns.",
                'image' => 'https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Pure cut, blend cut, contact coagulation, spray coagulation, and bipolar micro-coagulation',
                    'Dynamic impedance monitoring with visual and acoustic alarm triggers',
                    'Programmable memory storage for 10 custom user protocol configurations',
                    'Waterproof foot pedal switch and ergonomic electrosurgical handpiece'
                ],
                'specifications' => [
                    'Max Monopolar Cut Power' => '300 W at 500 Ohm',
                    'Coagulation Power' => '120 W at 500 Ohm',
                    'Bipolar Power' => '80 W at 100 Ohm',
                    'Working Frequency' => '400 kHz ± 10%',
                    'Mains Voltage' => '220-240 V, 50/60 Hz'
                ],
                'applications' => ['General Surgery', 'Plastic & Reconstructive Surgery', 'Gynecology', 'Urology'],
                'brochure_pdf' => '/docs/dixion-altair-100.pdf',
                'is_featured' => false,
                'is_new' => false,
            ],

            // Category: Anesthesia & Respiratory
            [
                'category_id' => $categories['anesthesia-respiratory']->id,
                'name' => 'Dixion Aeros 4600 Premium Anesthesia Workstation',
                'model_code' => 'Aeros 4600',
                'slug' => 'dixion-aeros-4600',
                'tagline' => 'Comprehensive anesthesia delivery platform with integrated electronic gas blender and lung protective ventilation.',
                'short_description' => 'Designed for neonates, pediatric, and adult patients. Features a 15-inch color capacitive touchscreen, integrated AGSS anesthetic gas scavenging, and plug-and-play multi-gas analysis.',
                'description' => "The DIXION Aeros 4600 represents an all-in-one anesthesia solution combining precision mechanical ventilation, digital anesthetic gas dosing, and comprehensive patient monitoring.\n\nWith low-flow and minimal-flow anesthesia management, it reduces anesthetic agent consumption by up to 40% while maintaining optimum safety. Its heated breathing system prevents moisture condensation and protects sensitive airway mechanics.",
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    '15" high-definition tiltable touchscreen with customizable multi-parameter waveforms',
                    'Ventilation modes: VCV, PCV, SIMV-V, SIMV-P, PSV/CPAP, PRVC, and Manual/Spontaneous',
                    'Tidal volume range from 15 ml to 1500 ml covering neonatal to bariatric patients',
                    'Electronic flowmeters for O2, N2O, and Medical Air with digital ratio control',
                    'Dual Selectatec mounting bar compatible with Sevoflurane, Isoflurane, and Desflurane vaporizers',
                    'Comprehensive gas monitoring module: EtCO2, FiO2, N2O, and 5 anesthetic agents with MAC calculation'
                ],
                'specifications' => [
                    'Display' => '15" TFT Touch Screen',
                    'Tidal Volume' => '15 - 1500 mL',
                    'Respiration Rate' => '1 - 100 bpm',
                    'PEEP' => '0 - 30 cmH2O',
                    'Inspiratory Pressure' => '5 - 70 cmH2O',
                    'Gas Supply Inputs' => 'O2, N2O, Air (2.8 - 6.0 bar)',
                    'Internal Battery Autonomy' => '≥ 180 minutes'
                ],
                'applications' => ['Major Operating Rooms', 'Day Surgery Clinics', 'Pediatric Anesthesia', 'Trauma Centers'],
                'brochure_pdf' => '/docs/dixion-aeros-4600.pdf',
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => $categories['anesthesia-respiratory']->id,
                'name' => 'Dixion Aeros 4300 Intensive Care Ventilator',
                'model_code' => 'Aeros 4300',
                'slug' => 'dixion-aeros-4300',
                'tagline' => 'High-end ICU ventilator for invasive and non-invasive ventilation from pediatric to adult patients.',
                'short_description' => 'Features high-flow oxygen therapy, integrated nebulizer, weaning indices, and real-time lung mechanics loops (P-V, F-V, P-F).',
                'description' => "DIXION Aeros 4300 provides cutting-edge respiratory support for critically ill patients in the ICU, post-anesthesia care, and emergency departments. Engineered with an ultra-fast response turbine drive, it operates independently of central gas supplies if needed.",
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Non-invasive (NIV) and invasive ventilation with intelligent leak compensation',
                    'High Flow Oxygen Therapy (HFNC) with flow rate from 2 to 80 L/min',
                    'Comprehensive weaning indices including RSBI, P0.1, and NIF',
                    'Full diagnostic toolset: Lung recruitment maneuvers and stress index'
                ],
                'specifications' => [
                    'Screen' => '12.1" Touchscreen display',
                    'Tidal Volume' => '20 - 2000 mL',
                    'Breathing Frequency' => '1 - 80 /min',
                    'Inspiratory Flow' => 'Up to 180 L/min',
                    'Trigger Sensitivity' => 'Flow: 0.5 - 20 L/min, Pressure: -20 to 0 cmH2O'
                ],
                'applications' => ['Adult ICU', 'Pediatric ICU', 'Pulmonary Care', 'Emergency Resuscitation'],
                'brochure_pdf' => '/docs/dixion-aeros-4300.pdf',
                'is_featured' => false,
                'is_new' => false,
            ],

            // Category: Intensive Care & Neonatology
            [
                'category_id' => $categories['intensive-care-neonatology']->id,
                'name' => 'Dixion Storm 5900 Modular Patient Monitor',
                'model_code' => 'Storm 5900',
                'slug' => 'dixion-storm-5900',
                'tagline' => 'High-acuity bedside monitor with plug-in transport module and comprehensive hemodynamic analysis.',
                'short_description' => '17-inch anti-glare display, modular parameter rack, 12-lead diagnostic ECG, Masimo SpO2, invasive blood pressure (up to 8 channels), and central monitoring networking.',
                'description' => "The DIXION Storm 5900 is engineered for high-dependency intensive care units, coronary care, and operating rooms. Its seamless modular design allows clinicians to unplug the compact transport module without disconnecting patient leads, ensuring uninterrupted monitoring throughout internal hospital transfer.",
                'image' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    '17" medical-grade HD touchscreen with multiple viewing layouts (OxyCRG, Big Numbers, 12-Lead)',
                    'Plug-and-play transport multi-parameter module with internal battery and display',
                    'Gold-standard measurement technologies: Masimo SET SpO2 and SunTech NIBP',
                    'Advanced hemodynamic monitoring: ICG, PICCO, and continuous Cardiac Output',
                    'Full HL7 protocol compatibility for effortless EMR/HIS hospital integration'
                ],
                'specifications' => [
                    'Display' => '17" TFT Color LCD, 1280x1024',
                    'Waveforms' => 'Up to 12 simultaneous waveforms',
                    'Standard Parameters' => 'ECG (3/5/12 lead), Resp, NIBP, SpO2, 2xTemp, PR',
                    'Optional Modules' => '4xIBP, EtCO2 (Mainstream/Sidestream), Multigas, ICG, BIS',
                    'Data Storage' => '160 hours trend review, 2000 groups NIBP, 1000 alarm events'
                ],
                'applications' => ['ICU / CCU', 'Operating Theatres', 'Recovery PACU', 'Emergency Departments'],
                'brochure_pdf' => '/docs/dixion-storm-5900.pdf',
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => $categories['intensive-care-neonatology']->id,
                'name' => 'Dixion BabyGuard I-1107 Intensive Care Infant Incubator',
                'model_code' => 'BabyGuard I-1107',
                'slug' => 'dixion-babyguard-i-1107',
                'tagline' => 'Optimal thermo-regulated microclimate with servo-controlled humidity and oxygen for premature newborns.',
                'short_description' => 'Double-walled canopy, ultra-quiet operation (<45 dB), integrated digital weighing scale, and built-in LED phototherapy unit.',
                'description' => "The DIXION BabyGuard I-1107 delivers a calm, protective intrauterine-like environment essential for fragile premature neonates. Its micro-computer control maintains precise temperature, relative humidity (up to 95%), and oxygen concentration with dual-probe skin temperature monitoring.",
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Microprocessor servo-controlled air temperature, skin temperature, humidity, and oxygen',
                    'Acoustically insulated canopy with noise level below 45 dB to protect neonatal auditory development',
                    'Integrated mattress weighing scale with historical weight progression curves',
                    'Stepless motorized mattress tilt (Trendelenburg/Reverse) without opening access ports',
                    'Built-in blue LED phototherapy module for hyperbilirubinemia treatment'
                ],
                'specifications' => [
                    'Air Temp Control Range' => '25.0°C - 37.0°C (Override: 37.1°C - 39.0°C)',
                    'Skin Temp Control Range' => '34.0°C - 37.0°C (Override: 37.1°C - 38.5°C)',
                    'Humidity Servo Range' => '30% - 95% RH',
                    'Oxygen Servo Range' => '20% - 60% O2',
                    'Internal Noise Level' => '≤ 45 dBA',
                    'Mattress Tilt Range' => '± 12° Stepless'
                ],
                'applications' => ['Neonatal Intensive Care (NICU)', 'Maternity Hospitals', 'Pediatric Departments'],
                'brochure_pdf' => '/docs/dixion-babyguard-i-1107.pdf',
                'is_featured' => true,
                'is_new' => false,
            ],
            [
                'category_id' => $categories['intensive-care-neonatology']->id,
                'name' => 'Dixion Instilar 1488 Dual-Channel Syringe Infusion Pump',
                'model_code' => 'Instilar 1488',
                'slug' => 'dixion-instilar-1488',
                'tagline' => 'High-precision micro-infusion pump with comprehensive dose error reduction drug library.',
                'short_description' => 'Compatible with standard 5ml, 10ml, 20ml, 30ml, and 50/60ml syringes. Features anti-bolus system, dynamic pressure sensing, and stackable modular housing.',
                'description' => "DIXION Instilar 1488 ensures ultra-smooth drug delivery for delicate cardiac, anesthesia, and neonatal medications where micro-droplet accuracy is vital. Its automatic syringe size detection and occlusion relief protect against unintentional overdosing.",
                'image' => 'https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Dual-channel independent infusion control on a single compact footprint',
                    'Flow rate range from 0.01 ml/h to 2000 ml/h with ±2% precision accuracy',
                    'Dynamic pressure sensing with 12-level occlusion threshold alarm',
                    'Comprehensive drug library storing up to 2000 medications with dosing limits'
                ],
                'specifications' => [
                    'Syringe Sizes' => '5, 10, 20, 30, 50/60 mL',
                    'Flow Rate Range' => '0.01 - 2000.0 mL/h in 0.01 mL/h increments',
                    'Bolus Rate' => 'Up to 2000 mL/h',
                    'KVO Rate' => '0.01 - 5.0 mL/h adjustable',
                    'Battery Life' => '≥ 10 hours at 5 mL/h'
                ],
                'applications' => ['ICU / NICU', 'Chemotherapy Units', 'Anesthesia Rooms', 'Cardiology'],
                'brochure_pdf' => '/docs/dixion-instilar-1488.pdf',
                'is_featured' => false,
                'is_new' => false,
            ],

            // Category: Diagnostics & Imaging
            [
                'category_id' => $categories['diagnostics-imaging']->id,
                'name' => 'Dixion ECG-1012 12-Channel Electrocardiograph',
                'model_code' => 'ECG-1012',
                'slug' => 'dixion-ecg-1012',
                'tagline' => 'Diagnostic quality 12-lead ECG with Glasgow automatic interpretation and DICOM connectivity.',
                'short_description' => '10-inch color touchscreen, 216 mm wide thermal paper printout, alphanumeric keyboard, and built-in lithium rechargeable battery for 300+ ECG recordings.',
                'description' => "The DIXION ECG-1012 is a professional diagnostic 12-channel electrocardiograph designed for high-throughput hospitals, cardiology clinics, and emergency triage. Powered by the internationally recognized Glasgow interpretation algorithm, it accounts for age, gender, and clinical history for precise arrhythmia and ischemia detection.",
                'image' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Simultaneous 12-lead acquisition with 24-bit high-resolution A/D converter',
                    '10" capacitive high-resolution touch display with lead preview and virtual keyboard',
                    'Glasgow automatic ECG analysis and diagnostic interpretation algorithm',
                    'Direct export to DICOM, PDF, XML, and JPEG via Wi-Fi and Ethernet',
                    'Internal memory for over 5,000 digital patient ECG recordings'
                ],
                'specifications' => [
                    'Input Circuit' => 'Defibrillation protected, floating inputs',
                    'Sampling Frequency' => '32,000 Hz',
                    'Frequency Response' => '0.05 Hz - 250 Hz (-3 dB)',
                    'Common Mode Rejection (CMRR)' => '> 115 dB',
                    'Recording Paper' => '216 mm x 140 mm Z-fold or roll thermal paper',
                    'Connectivity' => 'Wi-Fi, LAN, USB, SD Card, DICOM 3.0'
                ],
                'applications' => ['Cardiology Departments', 'Outpatient Clinics', 'General Practice', 'Emergency Rooms'],
                'brochure_pdf' => '/docs/dixion-ecg-1012.pdf',
                'is_featured' => true,
                'is_new' => true,
            ],
            [
                'category_id' => $categories['diagnostics-imaging']->id,
                'name' => 'Dixion EchoWave 800 Color Doppler Ultrasound System',
                'model_code' => 'EchoWave 800',
                'slug' => 'dixion-echowave-800',
                'tagline' => 'Versatile cart-based color ultrasound system with single-crystal transducer technology.',
                'short_description' => 'Features 21.5-inch articulating monitor, 13.3-inch gesture control touch panel, 4 active probe ports, elastography, and 4D OB/GYN rendering.',
                'description' => "DIXION EchoWave 800 brings exceptional imaging clarity across abdominal, vascular, cardiac, musculoskeletal, and superficial applications. Its state-of-the-art beamformer delivers pinpoint spatial resolution and deep tissue contrast penetration.",
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    '21.5" IPS medical display mounted on a flexible 4-way articulating arm',
                    'Single-crystal broadband probes for enhanced signal-to-noise ratio',
                    'Elastography imaging for non-invasive tissue stiffness evaluation',
                    'Real-time 4D surface reconstruction with virtual light shadowing'
                ],
                'specifications' => [
                    'Transducer Connectors' => '4 Active Ports + 1 Parking Port',
                    'Imaging Modes' => 'B, M, CFM, PDI, DPDI, PW, CW, TDI, 3D/4D',
                    'Dynamic Range' => '30 - 280 dB',
                    'Storage' => '1 TB Solid State Drive (SSD)'
                ],
                'applications' => ['Radiology', 'Obstetrics & Gynecology', 'Cardiovascular', 'Point-of-Care Ultrasound'],
                'brochure_pdf' => '/docs/dixion-echowave-800.pdf',
                'is_featured' => false,
                'is_new' => false,
            ],

            // Category: Hospital Beds & Furniture
            [
                'category_id' => $categories['hospital-furniture']->id,
                'name' => 'Dixion Medico Bed 5000 Electric ICU Bed',
                'model_code' => 'Medico 5000',
                'slug' => 'dixion-medico-5000',
                'tagline' => '5-function motorized intensive care bed with lateral tilt and integrated weighing system.',
                'short_description' => 'Equipped with Linak actuators, bilateral nurse control panels with safety lockout, cardiac chair position, and X-ray radiolucent backrest with cassette tray.',
                'description' => "DIXION Medico Bed 5000 is engineered to provide superior patient rehabilitation and reduce clinical caregiver strain. Its lateral tilting function facilitates patient turning and pulmonary drainage, significantly lowering the risk of ventilator-associated pneumonia (VAP).",
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    '5 motorized functions: Height, Backrest, Thigh rest, Trendelenburg/Reverse, Lateral Tilt (±15°)',
                    'Integrated scale system with bed-exit patient monitoring alarm',
                    'Bilateral split side rails with embedded patient and caregiver controls',
                    'One-touch Cardiac Chair and CPR emergency quick release lever'
                ],
                'specifications' => [
                    'Overall Length' => '2240 mm',
                    'Overall Width' => '1020 mm',
                    'Height Adjustment' => '450 mm - 850 mm',
                    'Backrest Angle' => '0° - 75°',
                    'Thigh Rest Angle' => '0° - 45°',
                    'Trendelenburg / Reverse' => '± 16°',
                    'Safe Working Load' => '250 kg'
                ],
                'applications' => ['Intensive Care Units (ICU)', 'Post-Surgical Recovery', 'Specialized Trauma'],
                'brochure_pdf' => '/docs/dixion-medico-5000.pdf',
                'is_featured' => true,
                'is_new' => false,
            ],

            // Category: Turnkey & Mobile
            [
                'category_id' => $categories['turnkey-mobile-healthcare']->id,
                'name' => 'Dixion MobileClinic X1 All-Terrain Medical Unit',
                'model_code' => 'MobileClinic X1',
                'slug' => 'dixion-mobileclinic-x1',
                'tagline' => 'Self-sufficient mobile healthcare unit equipped with diagnostic imaging and telemedicine.',
                'short_description' => 'Customized heavy-duty chassis featuring HVAC medical air filtration, autonomous onboard power generation, digital X-ray, ultrasound, and emergency resuscitation bay.',
                'description' => "The DIXION MobileClinic X1 is built for rapid deployment in rural healthcare programs, disaster response, and occupational health screening. Completely self-contained with independent diesel generator, clean water storage, and satellite telemedicine uplink, it delivers hospital-standard care anywhere.",
                'image' => 'https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=900&q=80',
                'features' => [
                    'Climate-controlled medical environment with HEPA H14 laminar air filtration',
                    'Onboard 20 kVA low-noise diesel generator and solar battery backup bank',
                    'Lead-lined shielded diagnostic imaging room for digital radiography',
                    'Hydraulic wheelchair lift for barrier-free patient access',
                    'Real-time telemedicine satellite terminal for remote specialist consultations'
                ],
                'specifications' => [
                    'Chassis' => 'Heavy-Duty 4x4 or 6x6 All-Terrain Truck Platform',
                    'Body Length' => '8.5 - 12 meters',
                    'Power Autonomy' => 'Up to 72 hours continuous operation',
                    'Water Tanks' => '400 L Fresh Water / 400 L Grey Water',
                    'Medical Rooms' => '2-3 separate clinical consultation & examination rooms'
                ],
                'applications' => ['Rural Outreach Programs', 'Disaster Relief & Military', 'Mobile Screening', 'Pandemic Response'],
                'brochure_pdf' => '/docs/dixion-mobileclinic-x1.pdf',
                'is_featured' => true,
                'is_new' => true,
            ],
        ];

        foreach ($productsData as $p) {
            Product::create($p);
        }

        // 3. Solutions
        $solutionsData = [
            [
                'title' => 'Modular Operating Theater Complexes',
                'slug' => 'modular-operating-theaters',
                'subtitle' => 'Turnkey German engineering from sterile architectural panels to advanced surgical suites.',
                'category' => 'Surgical Engineering',
                'overview' => 'DIXION delivers end-to-end design, construction, and outfitting of cleanroom surgical theaters conforming to ISO Class 5 and DIN 1946-4 standards.',
                'description' => "Our turnkey surgical suite service incorporates stainless steel or glass antibacterial wall panelling, laminar airflow ceilings with HEPA filtration, surgical LED lighting, ceiling pendants with integrated medical gases, and electro-hydraulic surgical tables.\n\nEvery project is managed from preliminary 3D architectural modeling through technical installation, commissioning, and medical staff training.",
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1000&q=80',
                'deliverables' => [
                    'Medical architectural design and 3D BIM modeling',
                    'Antibacterial wall panelling, airtight hermetic sliding doors, and conductive flooring',
                    'Laminar flow ceilings with integrated HEPA filtration',
                    'Ceiling supply units (pendants) for anesthesia and surgery',
                    'Operating tables, surgical lights, and electrosurgical generators',
                    'Central technical alarm and touch-panel theater control systems'
                ],
                'benefits' => [
                    'Single-source German engineering accountability',
                    'Full compliance with international sterile room standards',
                    'Rapid modular installation reducing hospital downtime by up to 50%',
                    'Seamless equipment compatibility and unified technical servicing'
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'Intensive Care & Neonatal Units (ICU / NICU)',
                'slug' => 'intensive-care-neonatal-units',
                'subtitle' => 'Complete department outfitting for high-dependency adult, pediatric, and premature care.',
                'category' => 'Critical Care',
                'overview' => 'Turnkey critical care installations combining patient monitoring networks, ventilators, electric ICU beds, and medical gas pipeline integration.',
                'description' => "DIXION specializes in equipping comprehensive ICU and NICU departments designed around patient recovery and clinical efficiency. From ergonomic ceiling pendants that keep floor spaces clear of cords and hoses to central monitoring stations with telemetry and predictive arrhythmia analysis, we build wards ready for critical demands.",
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1000&q=80',
                'deliverables' => [
                    'Central bedside and telemetry patient monitoring network',
                    'ICU mechanical ventilators and non-invasive respiratory gear',
                    'Electric 5-function ICU beds with pressure-relieving surfaces',
                    'Infant incubators, open reanimation warmers, and phototherapy systems',
                    'Modular infusion pump docking stations and fluid warmers'
                ],
                'benefits' => [
                    'Reduced nosocomial infection risks with antimicrobial surfaces',
                    'Unified central alarm management mitigating alarm fatigue',
                    'Complete compatibility with hospital EMR systems'
                ],
                'sort_order' => 2,
            ],
            [
                'title' => 'Mobile Field Hospitals & Resuscitation Units',
                'slug' => 'mobile-field-hospitals',
                'subtitle' => 'Rapidly deployable containerized and vehicular medical centers for emergency response.',
                'category' => 'Mobile Healthcare',
                'overview' => 'Autonomous medical complexes on heavy-duty truck platforms and ISO container modules for immediate field triage and diagnostics.',
                'description' => "When static healthcare infrastructure is unreachable or compromised, DIXION mobile medical units provide immediate clinical capabilities. Configured with independent electricity, filtered water, surgical suites, and satellite connectivity, our solutions serve governments, disaster response agencies, and industrial operations worldwide.",
                'image' => 'https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=1000&q=80',
                'deliverables' => [
                    'Mobile surgical and resuscitation containers',
                    'Mobile digital X-ray and ultrasound diagnostic trailers',
                    'Onboard diesel generators, UPS power, and solar hybrid packs',
                    'Water purification, waste management, and medical gas cylinders',
                    'Satellite telemedicine communication uplink'
                ],
                'benefits' => [
                    'Operational readiness within 60 minutes of arrival on site',
                    'Full all-weather environmental thermal insulation (-30°C to +50°C)',
                    'Autonomous functioning for up to 14 days without external utilities'
                ],
                'sort_order' => 3,
            ]
        ];

        foreach ($solutionsData as $s) {
            Solution::create($s);
        }

        // 4. News & Events
        $newsData = [
            [
                'title' => 'DIXION Showcases New Modular Operating Suite at MEDICA 2026 Düsseldorf',
                'slug' => 'dixion-at-medica-2026-dusseldorf',
                'category' => 'Exhibition',
                'event_date' => '2026-11-16',
                'location' => 'Messe Düsseldorf, Germany (Hall 10, Stand B24)',
                'summary' => 'DIXION is pleased to invite international partners and healthcare professionals to visit our premier stand at MEDICA 2026 in Düsseldorf.',
                'content' => "At MEDICA 2026, DIXION will unveil the latest developments in electro-hydraulic surgical tables, intelligent anesthesia workstations, and turn-key modular operating room systems. Our engineering team from Düsseldorf will be on hand to demonstrate live interactive equipment simulations and discuss international distribution opportunities.",
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
            ],
            [
                'title' => 'DIXION Expands Global Healthcare Partnership Program in Asia-Pacific',
                'slug' => 'global-partnership-expansion-asia-pacific',
                'category' => 'Corporate',
                'event_date' => '2026-10-05',
                'location' => 'Düsseldorf HQ, Germany',
                'summary' => 'Strengthening distribution ties and technical support hubs to deliver German-certified medical equipment to emerging healthcare markets.',
                'content' => "As part of DIXION's international commitment to healthcare equity, our corporate office has announced three new authorized regional technical training centers. This ensures localized spare parts warehousing, certified biomedical engineer training, and rapid warranty fulfillment for all DIXION equipment lines.",
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
            ],
            [
                'title' => 'Full Conformity Achieved Under New EU Medical Device Regulations (EU MDR)',
                'slug' => 'eu-mdr-compliance-milestone',
                'category' => 'Certification',
                'event_date' => '2026-08-20',
                'location' => 'European Union',
                'summary' => 'Rigorous clinical evaluation and quality management auditing completed under the stringent EU MDR 2017/745 directive.',
                'content' => "DIXION Vertrieb medizinischer Geräte GmbH continues to maintain the highest benchmarks of clinical safety, product traceability, and post-market surveillance. All core surgical, respiratory, and neonatal product portfolios have successfully achieved certification in full accordance with EU MDR standards.",
                'image' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
            ]
        ];

        foreach ($newsData as $n) {
            NewsArticle::create($n);
        }

        // 5. Sample Inquiries
        Inquiry::create([
            'product_id' => Product::first()->id,
            'full_name' => 'Dr. Alexander Schmidt',
            'email' => 'schmidt@klinikum-dusseldorf.de',
            'phone' => '+49 211 445566',
            'organization' => 'Düsseldorf University Clinic',
            'country' => 'Germany',
            'inquiry_type' => 'quote',
            'subject' => 'Quote Request for 4x Operamed 3000 Tables',
            'message' => 'We are renovating two of our surgical theaters and require official technical quotations and delivery timeframes for four Operamed 3000 electro-hydraulic operating tables including orthopedic extensions.',
            'status' => 'new'
        ]);

        Inquiry::create([
            'product_id' => null,
            'full_name' => 'Marcus Vance',
            'email' => 'm.vance@apexhealth.sg',
            'phone' => '+65 6789 0123',
            'organization' => 'Apex Healthcare Solutions',
            'country' => 'Singapore',
            'inquiry_type' => 'partnership',
            'subject' => 'Exclusive Regional Distribution Inquiry',
            'message' => 'Apex Healthcare is interested in representing the DIXION product catalog across Southeast Asia. We would like to schedule a virtual introductory meeting with your export sales division.',
            'status' => 'reviewed'
        ]);
    }
}
