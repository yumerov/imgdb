<?php

namespace App\Console\Commands;

use \File;
use \Zip;
// use Illuminate\Console\Command;

/**
 * Class Restore
 *
 * @package App\Console\Commands
 */
class Restore extends DataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:data:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    protected function getFilePath() {
        $files = File::glob(storage_path('backups') . '/*.zip');
        $files = array_reverse($files);
        foreach ($files as $key => $file) {
            $this->info("[" . $key . "] " . File::basename($file));
        }
        $fileIndex = null;
        $file = null;
        while ($file == null) {
            $fileIndex = $this->ask("Select the source file for restoring.");
            if (isset($files[$fileIndex])) {
                $file = $files[$fileIndex];
            } else {
                $this->error("Enter a valid value!");
            }
        }

        return $file;
    }

    /**
     * @param $path
     */
    protected function extract($path) {
        $zip = Zip::open($path);
        $files = collect($zip->listFiles())->filter(function ($file) {
            return substr($file, 0, 4) == "img/" && strlen($file) > 4;
        })->toArray();
        $zip->extract(database_path(), 'database.sqlite');
        foreach ($files as $file) {
            $zip->extract(public_path(), $file);
        }
        dd($files);
        $zip->close();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $path = $this->getFilePath();
            $this->callSilent("app:data:export", [
                "name" => "before-restoring"
            ]);
            $this->extract($path);
            $this->info("Restored");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
