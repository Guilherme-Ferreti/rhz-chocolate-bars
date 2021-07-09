<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateApiAuthTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:create-auth-token {--length=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an api authentication token.';

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
        $token = Str::random($this->option('length') ?? 24);

        Artisan::call('env:set', ['key' => 'API_AUTH_TOKEN', 'value' => $token]);

        $this->info("Api Auth Token has been set successfully! Token: $token");
    }
}
