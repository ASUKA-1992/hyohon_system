<?php

namespace Database\Seeders;

use App\Models\Explode;
use Illuminate\Database\Seeder;

class ExplodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Explodeの作成を開始します...");

        $object = new \SplFileObject(__DIR__ . '/data/explodes.csv');
        $object->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $count = 1;
        foreach ($object as $key => $row) {
            Explode::create([
                'name' => trim($row[0]),
                'note' => trim($row[1]),
                'place' => trim($row[2]),
                'speed' => trim($row[3]),
                'quantity' => trim($row[4]),
                'size' => trim($row[5]),
                'colors' => trim($row[6]),
                'count' => trim($row[7]),
                'order' => $count,
            ]);
            $count++;
        }

    }
}
