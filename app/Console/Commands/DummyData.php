<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set dummy data for test';

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
        $this->info('Migrating tables');
        $this->call('migrate:fresh');
        $this->info('Migration finished');

        $this->info('Creating users and posts');
        factory(\App\Models\User::class, 10)
            ->state('withPosts')->create();

        $this->info('Create blocked users');
        factory(\App\Models\UserMute::class, 2)->create();
    }
}
