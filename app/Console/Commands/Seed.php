<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install {--seed=all} {--migrate=true}';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('migrate')) {
            $this->call('migrate:fresh');
            $this->info('Database migrated successfully.');
        }

        $this->mainAppSeed();
        $this->moduleSeed();

        $this->info('Database seeding completed successfully.');
        
        $this->warn('Copying seed files...');
        $this->copySeedFiles();
        $this->info('Copied seed files successfully.');

        // Generate passport Client ID and secret
        $this->call('passport:install', ['--force' => true]);

        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('config:clear');
        $this->call('route:clear');
    }

    protected function mainAppSeed()
    {
        $this->call('db:seed');
    }

    protected function moduleSeed()
    {
        $this->warn('Module Seeding: ');

        foreach ($this->modulesName() as $module) {
            Artisan::call('module:seed ' . $module);
            $this->line('   ✔ ' . $module);
        }

        $this->info('Module seeding completed successfully.');
    }

    protected function modulesName()
    {
        if ($this->option('seed') != 'all') {
            return explode(',', $this->option('seed'));
        }

        $moduels = [];

        foreach (\Nwidart\Modules\Facades\Module::getOrdered() as $module) {
            array_push($moduels, $module->getName());
        }

        return $moduels;
    }

    protected function copySeedFiles()
    {
        \File::copyDirectory( public_path('seeder/') , public_path('uploads/'));
    }
}
