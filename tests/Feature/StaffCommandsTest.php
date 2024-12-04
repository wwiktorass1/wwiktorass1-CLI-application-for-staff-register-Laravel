<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffCommandsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_person()
    {
        $this->artisan('staff:register')
            ->expectsQuestion('Enter first name', 'Jonas')
            ->expectsQuestion('Enter last name', 'Jonaitis')
            ->expectsQuestion('Enter email', 'jonas@example.com')
            ->expectsQuestion('Enter primary phone number (optional)', '+37061234567')
            ->expectsQuestion('Enter secondary phone number (optional)', '')
            ->expectsQuestion('Enter comment (optional)', 'Vadybininkas')
            ->expectsOutput('Person successfully registered!')
            ->assertExitCode(0);

        $this->assertDatabaseHas('staff', [
            'firstname' => 'Jonas',
            'lastname' => 'Jonaitis',
            'email' => 'jonas@example.com',
        ]);
    }
}
