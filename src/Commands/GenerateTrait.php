<?php

namespace LaravelPHPGenerator\Commands;

use Illuminate\Console\Command;
use LaravelPHPGenerator\Logic\FileManager;

class GenerateTrait extends Command
{
       /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:trait {--p|path=Logic/Traits : The path to the trait(s). Should preferably be in App directory. Useful for namespacing} {name* : Name(s) of the trait(s)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generates a trait with the specified namespace plus necessary directories";

     /**
     * Instance of FileManager class
     *
     * @var object
     */

    protected $fm;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FileManager $fm)
    {
        parent::__construct();
        $this->fm = $fm;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->option('path');
        $traits = $this->argument('name');

        $is_plural = (count($traits) > 1) ? 'traits' : 'trait';

        $this->info('Generating '.$is_plural.'...');

        // $value = 1000;
        // $bar = $this->output->createProgressBar($value);
        // $bar->setBarWidth(50);
        
        // Generate the required trait(s)
        $this->fm->generateTrait($traits, $path);

        // $bar->advance();
        // $bar->finish();

        $this->info("");

        $this->info("Generated the following ".$is_plural.":");

        foreach ($traits as $trait) {
            $this->line("- ".$trait);
        }
    }
}
