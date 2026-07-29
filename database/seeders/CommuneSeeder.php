<?php

namespace Database\Seeders;

use App\Models\Commune;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class CommuneSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('datas/commune.csv');
        $handle = fopen($path, 'r');

        if ($handle === false) {
            throw new RuntimeException("Unable to open CSV file: {$path}");
        }

        try {
            fgetcsv($handle, null, ',');

            Model::unguarded(function () use ($handle): void {
                while (($row = fgetcsv($handle, null, ',')) !== false) {
                    if ($row === [null] || count($row) < 3) {
                        continue;
                    }

                    [$codePostal, $nom, $codeInsee] = array_map(
                        static fn ($value) => is_string($value) ? trim($value) : $value,
                        array_slice($row, 0, 3)
                    );

                    if ($codeInsee === '' || $codeInsee === null) {
                        continue;
                    }

                    Commune::updateOrCreate(
                        ['code_insee' => $codeInsee],
                        [
                            'code_postal' => $codePostal !== '' ? $codePostal : null,
                            'nom' => $nom !== '' ? $nom : null,
                        ]
                    );
                }
            });
        } finally {
            fclose($handle);
        }
    }
}
