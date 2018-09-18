<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name' => 'Tyre',
                'hs_code' => 'Ogsdfsdfghfhd',
                'product_category_id' => 1,
                'product_pattern_id' => 1,
                'product_group_id' => 1,
                'product_brand_id' => 1,
                'model' => 2,
                'serial' => 3,
                'part_number' => 2,
                'country_of_origin_country_id' => 1,
                'country_of_manufacture_country_id' =>1,
                'unit_of_measurement_id' => 1,
                'product_status_id' => 1,
                'tp_rate' => 32,
                'mrp_rate' => 43,
                'flat_rate' => 45,
                'special_rate' => 45,
                'distribution_rate' =>54,
                'other' => 41,
                'pack_size' => 34,
                'shipper_carton_size' => 44,
                'description' => 'description',
                'creator_user_id' => 1,
            ],
            [
                'name' => 'Tube',
                'hs_code' => 'sdfsdfhgf',
                'product_category_id' => 1,
                'product_pattern_id' => 1,
                'product_group_id' => 1,
                'product_brand_id' => 1,
                'model' => 2,
                'serial' => 3,
                'part_number' => 2,
                'country_of_origin_country_id' => 1,
                'country_of_manufacture_country_id' =>1,
                'unit_of_measurement_id' => 1,
                'product_status_id' => 1,
                'tp_rate' => 32,
                'mrp_rate' => 43,
                'flat_rate' => 45,
                'special_rate' => 45,
                'distribution_rate' =>54,
                'other' => 41,
                'pack_size' => 34,
                'shipper_carton_size' => 44,
                'description' => 'description',
                'creator_user_id' => 1,
            ],
            [
                'name' => '6" Tyre',
                'hs_code' => 'sdffsdfkjl',
                'product_category_id' => 1,
                'product_pattern_id' => 1,
                'product_group_id' => 1,
                'product_brand_id' => 1,
                'model' => 2,
                'serial' => 3,
                'part_number' => 2,
                'country_of_origin_country_id' => 1,
                'country_of_manufacture_country_id' =>1,
                'unit_of_measurement_id' => 1,
                'product_status_id' => 1,
                'tp_rate' => 32,
                'mrp_rate' => 43,
                'flat_rate' => 45,
                'special_rate' => 45,
                'distribution_rate' =>54,
                'other' => 41,
                'pack_size' => 34,
                'shipper_carton_size' => 44,
                'description' => 'description',
                'creator_user_id' => 1,
            ],
            [
                'name' => 'Arif',
                'hs_code' => 'Ogdfgdfghfgd',
                'product_category_id' => 1,
                'product_pattern_id' => 1,
                'product_group_id' => 1,
                'product_brand_id' => 1,
                'model' => 2,
                'serial' => 3,
                'part_number' => 2,
                'country_of_origin_country_id' => 1,
                'country_of_manufacture_country_id' =>1,
                'unit_of_measurement_id' => 1,
                'product_status_id' => 1,
                'tp_rate' => 32,
                'mrp_rate' => 43,
                'flat_rate' => 45,
                'special_rate' => 45,
                'distribution_rate' =>54,
                'other' => 41,
                'pack_size' => 34,
                'shipper_carton_size' => 44,
                'description' => 'description',
                'creator_user_id' => 1,
            ],
            [
                'name' => 'Atik',
                'hs_code' => 'fghghjfgh',
                'product_category_id' => 1,
                'product_pattern_id' => 1,
                'product_group_id' => 1,
                'product_brand_id' => 1,
                'model' => 2,
                'serial' => 3,
                'part_number' => 2,
                'country_of_origin_country_id' => 1,
                'country_of_manufacture_country_id' =>1,
                'unit_of_measurement_id' => 1,
                'product_status_id' => 1,
                'tp_rate' => 32,
                'mrp_rate' => 43,
                'flat_rate' => 45,
                'special_rate' => 45,
                'distribution_rate' =>54,
                'other' => 41,
                'pack_size' => 34,
                'shipper_carton_size' => 44,
                'description' => 'description',
                'creator_user_id' => 1,
              ]
        ];

        \DB::table('products')->insert($data);

    }
}