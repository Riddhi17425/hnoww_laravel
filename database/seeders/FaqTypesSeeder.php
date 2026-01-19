<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqTypes = [
            1 => 'THE OBJECTS',
            2 => 'ORDERS & THE',
            3 => 'CARE & RITUAL',
        ];

        foreach ($faqTypes as $id => $name) {
            DB::table('faq_types')->insert([
                'id'        => $id,
                'name'      => $name,
                'is_active' => 1, // 0 = Active, 1 = In-active
                'deleted_at'=> null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]);
        }
    }
}
