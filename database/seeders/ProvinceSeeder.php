<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $jsonProvinces = File::get(database_path('json/provinces.json'));
        $dataProvinces = json_decode($jsonProvinces);
        $dataProvinces = collect($dataProvinces);

        foreach ($dataProvinces as $data) {
            Province::create([
                'code' => $data->province_code,
                'name' => ucwords(strtolower($data->province_name)),
                'name_en' => ucwords(strtolower($data->province_name_en)),
            ]);
        }
    }
}
