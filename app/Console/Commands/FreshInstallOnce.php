<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class FreshInstallOnce extends Command
{
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
    protected $description = 'When env file is read it makes the fresh application';

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
                '--seed' => true,
            ]);
        } 

        if ($result === 0) {
            $this->info($message);
        }
        

    }

    public function setEnv($values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    // for adding quotes if value has spaces in between
                    if (preg_match('/\s/',$envValue)) {
                        $str .= "{$envKey}='{$envValue}'\n";
                    } else {
                        $str .= "{$envKey}={$envValue}\n";
                    }
                } else {
                    // for adding quotes if value has spaces in between
                    if (preg_match('/\s/',$envValue)) {
                        $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }

                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;        
    }   
}
