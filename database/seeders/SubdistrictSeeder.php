<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SubdistrictSeeder extends Seeder
{
    public function run()
    {
        $limit = -1;
        if (env('APP_ENV') == 'local') $limit = 1000;

    	$jsonSubdistricts = File::get(database_path('json/subdistricts.json'));
        $dataSubdistricts = json_decode($jsonSubdistricts);
        $dataSubdistricts = collect($dataSubdistricts);

        $i = 0;
        foreach ($dataSubdistricts as $data) {
            if ($limit == $i) break;
            
            Subdistrict::create([
                'kelurahan' => ucwords(strtolower($data->urban)),
                'kecamatan' => ucwords(strtolower($data->sub_district)),
                'city' => ucwords(strtolower($data->city)),
                'province_code' => $data->province_code,
                'postal_code' => $data->postal_code,
            ]);

            $i++;
        }    
	}
}
