<?php

namespace App\Console\Commands;

use App\Traits\InteractsWithEnv;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class FreshInstallOnce extends Command
{
    use InteractsWithEnv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh:install:once';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When env file is ready it makes the fresh application can use with --env= also';

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
        // Admin credentials are present in .env
        if ( empty(config('admin.name')) || empty(config('admin.email')) || empty(config('admin.password'))  ) {
            $name = '';
            while ( empty($name) ) {
                $name = $this->ask('What is user\'s name?');
            }

            $email = '';
            while ( empty($email) ) {
                $email = $this->ask('What is user\'s email?');
            }

            $password = '';
            while ( empty($password) ) {
                $password = $this->secret('What is user\'s password?');
            }
            $message = 'Alhamdulillah work done! We\'ve also set ADMIN_NAME= ADMIN_EMAIL= ADMIN_PASSWORD= in env.';
        } else {
            $name = config('admin.name');
            $email = config('admin.email');
            $password = config('admin.password');
            $message = 'Alhamdulillah work done!';
        }

        // If this is run already
        if (Schema::hasTable('users')) {
            $this->info('ran already... Still want to make a fresh start try dropping the tables and try again.');
            return;
        }

        // 1
        $result = $this->call('migrate', [
            '--path' => 'database/migrations/2014_10_12_000000_create_users_table.php',
        ]);

        // 2
        if ($result === 0) { // coz this is returned on success

            // 2a set envs
            $certs = [
                'ADMIN_NAME' => $name,
                'ADMIN_EMAIL' => $email,
                'ADMIN_PASSWORD' => $password,
            ];

            $this->setEnv($certs);

            // 2b create user
            User::create(['name' => $name, 'email' => $email, 'password' => bcrypt($password)]);
            $result = User::where('email', $email)->exists();
        }

        // 3
        if ($result){ // exists
            $result = $this->call('migrate', [
                '--seed' => true, // uncomment this only if you want to seed(not in production as it has fake data)
            ]);
        } 

        if ($result === 0) {
            $this->info($message);
        }
        

    }

}
