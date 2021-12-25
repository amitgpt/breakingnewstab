<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesArray = ['Top News','World News', 'Business','Technology','Sports','Health','Science','US News','Entertainment','Politics', 'Travel'];
        for ($i=0; $i < count($categoriesArray); $i++) { 

	    	Categories::create([
	            'name' => trim($categoriesArray[$i]),
                    'slug' => strtolower(preg_replace('/\s/', '', $categoriesArray[$i])) 
	        ]);

    	}
    }
}
