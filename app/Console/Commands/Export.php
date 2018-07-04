<?php

namespace App\Console\Commands;

use \Zip;
use \Carbon\Carbon;
use \Exception;
// use Illuminate\Console\Command;

/**
 * Class Export
 *
 * @package App\Console\Commands
 */
class Export extends DataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:data:export {name?}';

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

    private function _handle() {
        $name = $this->argument('name', '');
        $name = $name ? "-" . $name : "";
        $name = Carbon::now()->format("Y-m-d--H-i-s") . $name. ".zip";
        $file = Zip::create(storage_path() . '/backups/' . $name);
        $file->add($this->getDatabasePath());
        $file->add(public_path('img'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->_handle();
            $this->info("Exported successfully.");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
