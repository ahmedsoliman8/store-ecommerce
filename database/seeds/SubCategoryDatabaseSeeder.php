<?php

use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Category::class,10)->create([
            'parent_id'=>$this->getRandomParentId()->id
        ]);
    }
    public function getRandomParentId(){
       return \App\Models\Category::inRandomOrder()->first();
    }
}
