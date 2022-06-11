<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Themeの作成を開始します...");

        $object = new \SplFileObject(__DIR__ . '/data/themes.csv');
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

            Theme::create([
                'name' => trim($row[0]),
                'note' => trim($row[1]),
            ]);
            $count++;
        }

    }
}
