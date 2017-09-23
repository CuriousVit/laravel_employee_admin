<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Validator;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

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
     * Validate input data
     *
     * @return array
     */
    public function validate()
    {
        $rules = [
            'name' => 'required|min:4|max:100',
            'email' => 'required|email|min:4|max:100',
            'password' => 'required|min:4|max:100',
        ];

        $validator = Validator::make(
            $this->argument(),
            $rules
        );

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                $this->error($message);
            }
            return false;
        }

        return true;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->validate()) {
            return;
        }

        $name = $this->argument('name');
        User::create([
            'name' => $name,
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
        ]);

        $this->info(sprintf('User "%s" was successfully created', $name));
    }
}
