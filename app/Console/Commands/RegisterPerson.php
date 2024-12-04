<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;

class RegisterPerson extends Command
{
    protected $signature = 'staff:register';
    protected $description = 'Register a new person in the staff register';

    public function handle()
    {
        $data = [];
        $data['firstname'] = $this->ask('Enter first name');
        $data['lastname'] = $this->ask('Enter last name');
        $data['email'] = $this->ask('Enter email');
        $data['phonenumber1'] = $this->ask('Enter primary phone number (optional)', '');
        $data['phonenumber2'] = $this->ask('Enter secondary phone number (optional)', '');
        $data['comment'] = $this->ask('Enter comment (optional)', '');

        $validator = Validator::make($data, [
            'firstname' => 'required|string|min:2|max:50',
            'lastname' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:staff,email|max:100',
            'phonenumber1' => 'nullable|string|max:20',
            'phonenumber2' => 'nullable|string|max:20',
            'comment' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return Command::FAILURE;
        }

        Staff::create($data);
        $this->info('Person successfully registered!');
        return Command::SUCCESS;
    }
}
