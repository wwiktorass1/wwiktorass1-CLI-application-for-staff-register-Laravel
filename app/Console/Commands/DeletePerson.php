<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Staff;

class DeletePerson extends Command
{
    protected $signature = 'staff:delete {email}';
    protected $description = 'Delete a person from the staff register by email';

    public function handle()
    {
        $email = $this->argument('email');
        $person = Staff::where('email', $email)->first();

        if (!$person) {
            $this->error('Person not found.');
            return Command::FAILURE;
        }

        $person->delete();
        $this->info('Person successfully deleted!');
        return Command::SUCCESS;
    }
}
