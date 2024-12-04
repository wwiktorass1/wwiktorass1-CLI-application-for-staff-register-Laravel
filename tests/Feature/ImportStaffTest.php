<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ImportStaffTest extends TestCase
{
    use RefreshDatabase;
        public function test_import_staff_command()
    {
        $csvContent = "firstname,lastname,email,phonenumber1,phonenumber2,comment\n";
        $csvContent .= "Jonas,Jonaitis,jonas@exbbbample.com,+37061234567,+37061234568,Vadybininkas\n";
        $csvContent .= "Petras,Petraitis,petras@exbbbample.com,+37061234569,+37061234570,Programuotojas\n";
        $filePath = 'imports/workers.csv';
    
        Storage::fake('local');
        Storage::put($filePath, $csvContent);

        $fullPath = Storage::path($filePath);

        $exitCode = Artisan::call('staff:import', [
            'file' => Storage::path($filePath),
        ]);

        $this->assertEquals(0, $exitCode);

        $this->assertDatabaseHas('staff', [
            'firstname' => 'Jonas',
            'lastname' => 'Jonaitis',
            'email' => 'jonas@exbbbample.com',
        ]);

    }

}
