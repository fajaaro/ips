<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseVideo;
// use App\Models\Image;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Basic Class Seeder
        $selectedBundle = Bundle::where('name', 'Basic Class')->first();

        $coursesName = [
        	'Baguette + Cheese Stick',
            'Grissini',
            'Bagel + Grissini',
            'Scones',
            'Toast Bread',
            'Wholemeal',
            'Doughnut',
            'Mozarella Corn Bread',
            'Quark Stuten',
            'Raisin Bread',
            'Hamburger',
            'Cinnamon Roll',
            'Multi Cereal Bread',
            'Pizza',
            'Sweet Bun',
            'Banana Bread'
        ];
    	$selectedCategory = Category::where('name', 'Basic Bread')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Marble Sugar Cookies',
            'Cashew Nut Chocolate Cookies',
            'Kaastengels',
            'Chocolate Almond Sugar Cookies',
            'Brown Cookies',
            'Cappuccino Choco Chip Cookies',
            'Ginger Cookies + Ginger Bread House',
            'Sago Cheese Cookies',
            'Pineapple (Nastar)',
        ];
        $selectedCategory = Category::where('name', 'Basic Cookies')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Strawberry Tart',
            'Cheese Tart',
            'Apple Crumble Tart',
            'Lemon Meringue Pie',
        ];
        $selectedCategory = Category::where('name', 'Tart / Pie')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Pancakes',
            'Baileys Souffle',
            'Chocolate Souffle',
            'Orange Creme Caramel',
            'Warm Chocolate Torte',
            'Creme Brulee',
            'Choux Pastry + Custart Cream',
        ];
        $selectedCategory = Category::where('name', 'Dessert')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Vanilla & Choco Sponge with Decoration',
            'Green Tea Sponge with Decoration',
            'White Cheese Layer Cake',
            'Black Forest',
            'Sweet Roll',
            'Cupcakes & Italian Butter Cream with Decor',
            'Chiffon Chocolate & Pandan',
            'Earl Grey Tea Cake',
            'Almond Sour Cream Pound Cake',
            'Marble Cake',
            'Lapis Surabaya',
            'Madeline',
            'Brownies',
            'Brownies Steam',
            'Brownies Cheese Cake',
            'Cheese Cake & Genoise Sponge',
            'Muffin',
        ];
        $selectedCategory = Category::where('name', 'Basic Cakes')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        // Intermediate Class Seeder
        $selectedBundle = Bundle::where('name', 'Intermediate Class')->first();

        $coursesName = [
            'Green Tea Cookies',
            'Biscotti Chocolate',
            'Chewy Fruit Cookies',
            'Florentine (Almond Slice Honey)',
            'Lemon Raisin & Oats Cookies',
            'Macaron',
            'Nougat',
            'White Chocolate Oatmeal Pistachio Cookies',
        ];
        $selectedCategory = Category::where('name', 'Intermediate Cookies')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Pudding Au Chocolate',
            'Rice Cream with Cherry Gellee',
            'Mango Pudding',
            'Coffee Pots de Creme',
        ];
        $selectedCategory = Category::where('name', 'Pudding')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'High Fiber Bread',
            'Russian Bread',
            'Italian Pizza',
            'Baba Rum',
            'Moesly Loaf',
            'Healthy Fruit Bread',
        ];
        $selectedCategory = Category::where('name', 'Intermediate Bread')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Dark Chocolate Tart',
            'Sour Cherry Flan',
            'Egg Tart Crispy / Hong Kong Egg Tart',
            'Quiche',
            'Shortcrust Pastry',
        ];
        $selectedCategory = Category::where('name', 'Tart')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Lasagna',
        ];
        $selectedCategory = Category::where('name', 'Pasta')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Croissant',
            'Puff Pastry',
            'Cheese Straw',
            'Palmiers',
            'Classic Napoleon',
            'Apple Pie',
            'Molen',
            'Apple Struddle',
        ];
        $selectedCategory = Category::where('name', 'Pastry')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Manon\'s Cafe',
            'Cinnamon ganache',
            'Praline',
            'Caramel Passion',
            'White Chocolate Truffle',
        ];
        $selectedCategory = Category::where('name', 'Chocolate Praline')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        $coursesName = [
            'Crepes',
            'Blueberry Mouse',
            'Tiramisu + Ladyfinger',
            'Triple Chocolate Cheese',
            'Chocolate Cheese Cake',
            'Pinneaple Yoghurt Cheese Cake',
            'Lemon Cheese Cake',
            'Green Tea Gateau',
            'Mango Jelly Cheese Cake',
            'Cookies & Cream Cheese Cake',
            'Bean Curt Cheese Cake',
            'Raspberry & White Chocolate Almond Slice',
            'English Rum Fruit Cake',
            'Passion Fruit Torte',
            'Mont Blanc',
            'Frasier',
            'Sacher Torte',
            'Otero',
            'Gateau Marjolaine',
            'Opera Cake',
            'Sweet Pleasure',
            'Dark Chocolate Red Velvet Cake',
            'Chocolate Truffle Cake',
            'Chocolate Mud Cake',
            'Mocha Cake',
        ];
        $selectedCategory = Category::where('name', 'Intermediate Cakes')->first();
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);

        // Superior Class Seeder
        $selectedBundle = Bundle::where('name', 'Superior Class')->first();

        $coursesName = [
            'Nori Cookies',
            'Rainbow Cake',
            'Au Choco Cheese Cake Raspberry',
            'Summer Island',
            'Melon Shower',
            'Banana Choco',
            'Strawberry Short Cake',
            'Fruit Orange Sable',
            'Popcorn Mousse',
            'Chloe',
            'Eclaire',
            'Financier',
            'Torta Ricotta Cremosa',
            'German Coconut Caramel Cake',
            'Klapertart',
            'Candy Soft Jelly (Pate de Fruit)',
            'Honey Loaf',
            'Choco Loaf',
            'Japanese Soft Cake',
            'Carrot Cake',
            'Portugese Egg Tart',
            'Moon Cake',
            'Pistachio Pyramid Chocolate',
            'White Chocolate Cheese Cake',
            'Choco Fondant with Pistachio Siciliano',
            'Yu (Bavarian/Fruit Mousse)',
            'Lapis Legit',
            'Cronut',
            'Printainer',
            'Babka',
            'Canelle',
            'Flavoured Croissants',
            'Japanese Authentic Cheese Cake',
            'Chocolate Charlotte Coffee',
        ];
        $selectedCategory = null;
        $this->createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle);
    }

    private function createCoursePerCategory($coursesName, $selectedCategory, $selectedBundle)
    {
        $totalCourse = count($coursesName);
        
        for ($i = 0; $i < $totalCourse; $i++) {
            $course = new Course();

            if ($selectedCategory) {
                $course->category_id = $selectedCategory->id;
            }
            
            $course->name = $coursesName[$i];
            $course->price = 0;
            $course->save();

            $course->bundles()->attach($selectedBundle->id);

            $courseVideo = new CourseVideo();
            $courseVideo->course_id = $course->id;
            $courseVideo->url = 'https://www.youtube.com/embed/bS9eXS6VucU';
            $courseVideo->save();

            // $imageUrl = 'course-images/' . $course->id . '_' . strtolower(str_replace(' ', '_', $course->name)) . '.jpg';

            // $course->image()->save(
            //     Image::make(['url' => $imageUrl])
            // );
        }
    }
}
