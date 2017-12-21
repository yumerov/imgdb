<?php

namespace App\Actions\Tags;

use App\Tag;

class Create {

    public function handle() {
        return view("tags.create");
    }
}