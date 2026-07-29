<?php

namespace Database\Seeders;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use RuntimeException;

class BeachSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('datas/plage.csv');
        $handle = fopen($path, 'r');

        if ($handle === false) {
            throw new RuntimeException("Unable to open CSV file: {$path}");
        }

        try {
            Model::unguarded(function () use ($handle): void {
                while (($row = fgetcsv($handle, null, ';')) !== false) {
                    if ($row === [null] || count($row) < 2) {
                        continue;
                    }

                    [$nomPlage, $codeInsee, $descriptionHtml] = array_pad(
                        array_map(
                            static fn ($value) => is_string($value) ? trim($value) : $value,
                            array_slice($row, 0, 3)
                        ),
                        3,
                        null
                    );

                    if ($nomPlage === '' || $codeInsee === '' || $codeInsee === null) {
                        continue;
                    }

                    $commune = Commune::query()
                        ->where('code_insee', $codeInsee)
                        ->first();

                    if ($commune === null) {
                        continue;
                    }

                    $commune->beaches()->updateOrCreate(
                        ['nom' => $nomPlage],
                        ['description' => $descriptionHtml !== '' ? $descriptionHtml : null]
                    );
                }
            });
        } finally {
            fclose($handle);
        }
    }
}
