<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class ApiTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(Auth::attempt(['email' => env('ADMIN_MAIL'), 'password' => env('ADMIN_PASS')])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->plainTextToken;
            setEnv('API_TOKEN', $token);
        }
    }
}
