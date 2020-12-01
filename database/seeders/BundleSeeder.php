<?php

namespace Database\Seeders;

use App\Models\Bundle;
use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    public function run()
    {
        $bundles = ['Basic Class', 'Intermediate Class', 'Superior Class'];
        $prices = [78000000, 98000000, 150000000];

        $i = 0;
        foreach ($bundles as $bundle) {
        	Bundle::create([
        		'name' => $bundles[$i],
        		'price' => $prices[$i]
        	]);

        	$i++;
        }
    }
}
