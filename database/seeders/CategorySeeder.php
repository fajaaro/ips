<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // basic categories
        $categories = ['Basic Bread', 'Basic Cookies', 'Tart / Pie', 'Dessert', 'Basic Cakes'];
        foreach ($categories as $category) {
        	Category::create(['name' => $category]);
        }

        // intermediate categories
        $categories = ['Intermediate Cookies', 'Pudding', 'Intermediate Bread', 'Tart', 'Pasta', 'Pastry', 'Chocolate Praline', 'Intermediate Cakes'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
