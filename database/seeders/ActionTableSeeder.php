<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Actionの作成を開始します...");

        $object = new \SplFileObject(__DIR__ . '/data/actions.csv');
        $object->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $count = 0;
        foreach ($object as $key => $row) {
            if ($key === 0) {
                continue;
            }

            Action::create([
                'name' => trim($row[0]),
                'name_sub' => trim($row[1]),
            ]);
            $count++;
        }

    }
}
