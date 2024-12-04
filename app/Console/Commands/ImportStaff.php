<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;

class ImportStaff extends Command
{
    protected $signature = 'staff:import {file}';
    protected $description = 'Import staff data from a CSV file';

    public function handle()
    {
        $filePath = $this->argument('file');
        $this->info("Processing file: $filePath");

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return Command::FAILURE;
        }

        $file = fopen($filePath, 'r');

        $headerRaw = fgets($file);
        $header = str_getcsv($headerRaw, ',');

        if (!$header) {
            $this->error("Failed to read the header from the file.");
            fclose($file);
            return Command::FAILURE;
        }

        $this->info("Header detected: " . implode(', ', $header));

        $success = 0;
        $failed = 0;
        $failedRecords = [];

        while (($data = fgetcsv($file, 0, ',')) !== false) {
            $this->info("Row data: " . implode(', ', $data));

            $data = array_map('trim', $data);

            if (count($header) !== count($data)) {
                $this->error("Header count does not match data count for row: " . implode(', ', $data));
                $failed++;
                continue;
            }

            $record = array_combine($header, $data);

            if ($record === false) {
                $this->error("Failed to map data: " . implode(', ', $data));
                $failed++;
                continue;
            }

            $this->info("Mapped record: " . json_encode($record));

            $validator = Validator::make($record, [
                'firstname' => 'required|string|min:2|max:50',
                'lastname' => 'required|string|min:2|max:50',
                'email' => 'required|email|unique:staff,email|max:100',
                'phonenumber1' => 'nullable|string|max:20',
                'phonenumber2' => 'nullable|string|max:20',
                'comment' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                $failed++;
                $failedRecords[] = [
                    'row' => implode('; ', $data),
                    'errors' => $validator->errors()->all(),
                ];
                $this->error("Validation failed for row: " . implode('; ', $data));
                continue;
            }

            try {
                Staff::updateOrCreate(
                    ['email' => $record['email']],
                    $record
                );
                $success++;
            } catch (\Exception $e) {
                $failed++;
                $this->error("Failed to insert or update record: " . $e->getMessage());
            }
        }

        fclose($file);

        $this->info("Import completed: $success success, $failed failed.");

        if ($failed > 0) {
            $this->warn("\nFailed records:");
            foreach ($failedRecords as $failedRecord) {
                $this->warn("Row: " . $failedRecord['row']);
                $this->warn("Errors: " . implode(', ', $failedRecord['errors']));
            }
        }

        return Command::SUCCESS;
    }
}
