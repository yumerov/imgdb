<?php

use Illuminate\Database\Seeder;
use App\Image;


class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::truncate();
        factory(Image::class, 1)->create()->each(function ($image) {
            $image->save();
        });
    }
}
