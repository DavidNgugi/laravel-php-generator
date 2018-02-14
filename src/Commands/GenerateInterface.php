<?php

namespace DavidNgugi\LaravelPHPGenerator\Commands;

use Illuminate\Console\Command;
use DavidNgugi\LaravelPHPGenerator\Logic\FileManager;

class GenerateInterface extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:interface {--p|path=Logic/Interfaces : The path to the interface(s). Should preferably be in App directory. Useful for namespacing} {name* : Name(s) of the interface(s)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generates an interface with the specified namespace plus necessary directories";

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
        $interfaces = $this->argument('name');

        $is_plural = (count($interfaces) > 1) ? 'interfaces' : 'interface';

        $this->info('Generating '.$is_plural.'...');

        // $value = 1000;
        // $bar = $this->output->createProgressBar($value);
        // $bar->setBarWidth(50);
        
        // Generate the required interface(s)
        $this->fm->generateInterface($interfaces, $path);

        // $bar->advance();
        // $bar->finish();

        $this->info("");

        $this->info("Generated the following ".$is_plural.":");

        foreach ($interfaces as $interface) {
            $this->line("- ".$interface);
        }
    }
}
