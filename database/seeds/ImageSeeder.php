<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\Tag;

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
        Tag::truncate();
        factory(Image::class, 1)->create()->each(function ($image) {
            $image->tags()->saveMany(factory(Tag::class, 5)->make());
        });
    }
}
