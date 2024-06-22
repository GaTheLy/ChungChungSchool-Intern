<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class TestDatabaseConnection extends Command
{
    protected $signature = 'db:test';
    protected $description = 'Test the database connection';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            DB::connection()->getPdo();
            $this->info('Successfully connected to the database.');
        } catch (Exception $e) {
            $this->error('Failed to connect to the database. Error: ' . $e->getMessage());
        }
    }
}
