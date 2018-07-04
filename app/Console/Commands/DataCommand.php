<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DataCommand
 *
 * @package App\Console\Commands
 */
abstract class DataCommand extends Command
{

    /**
     * @return mixed
     */
    public function getDatabasePath() {
        $connections = config("database.connections");
        return $connections[config('database.default')]["database"];
    }
}
