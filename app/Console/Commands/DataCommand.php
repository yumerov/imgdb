<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

abstract class DataCommand extends Command
{

    public function getDatabasePath() {
        $connections = config("database.connections");
        return $connections[config('database.default')]["database"];
    }
}
