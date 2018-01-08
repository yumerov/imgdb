<?php

namespace App\Console\Commands;

use \Zip;
use \Carbon\Carbon;
use \Exception;
use Illuminate\Console\Command;

class Export extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports application data in an archive file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getDatabasePath() {
        $connections = config("database.connections");
        return $connections[config('database.default')]["database"];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $name = Carbon::now()->format("Y-m-d--H-i-s") . ".zip";
            $file = Zip::create(storage_path() . '/backups/' . $name);
            $file->add($this->getDatabasePath());
            $file->add(public_path('img'));
            $this->info("Exported successfully.");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
