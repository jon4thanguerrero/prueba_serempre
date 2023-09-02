<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunMigrateAndSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:run-migrate-and-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute migrations and seeder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Execute migrations
        Artisan::call('migrate');

        // Execute seeders
        Artisan::call('db:seed', [
            '--class' => 'UserSeeder',
        ]);

        Artisan::call('db:seed', [
            '--class' => 'CitySeeder',
        ]);

        Artisan::call('db:seed', [
            '--class' => 'ClientSeeder',
        ]);
        
        return Command::SUCCESS;
    }
}
