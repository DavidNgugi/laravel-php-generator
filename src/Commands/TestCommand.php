<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs PHPUnit & Dusk tests';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(100);
        $bar->setBarWidth(50);
        $time_start = microtime(true); 
           
            // Unit tests
            $this->info("Running PHPUNIT Tests...");
            $return = shell_exec("php ./vendor/phpunit/phpunit/phpunit");
            $this->info($return);
            $bar->advance(50);    
            $this->info("");
            $this->info("Finished UNIT tests!");

            // Feature tests
            $this->info("Running DUSK FEATURE Tests...");
            $return = null;
            $return = shell_exec("php artisan dusk");
            $this->info($return);    
            $bar->finish();
            $this->info("");
            $this->info("Finished DUSK FEATURE tests!");
        $time_end = microtime(true);
        

        $this->info("Done Testing! Completed in ". ceil($time_end/1000000). " seconds");
    }
}
