<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Staff;

class FindPerson extends Command
{
    protected $signature = 'staff:find {query}';
    protected $description = 'Find a person in the staff register by email or name';

    public function handle()
    {
        $query = $this->argument('query');

        $results = Staff::where('email', 'like', "%$query%")
            ->orWhere('firstname', 'like', "%$query%")
            ->orWhere('lastname', 'like', "%$query%")
            ->get();

        if ($results->isEmpty()) {
            $this->warn('No results found for the query: ' . $query);
            return Command::FAILURE;
        }

        $this->info("Found " . $results->count() . " person(s) matching the query:");
        $this->table(
            ['ID', 'Firstname', 'Lastname', 'Email', 'Phonenumber1', 'Phonenumber2', 'Comment'], 
            $results->map(function ($person) {
                return [
                    $person->id,
                    $person->firstname,
                    $person->lastname,
                    $person->email,
                    $person->phonenumber1,
                    $person->phonenumber2,
                    $person->comment,
                ];
            })->toArray()
        );

        return Command::SUCCESS;
    }
}
