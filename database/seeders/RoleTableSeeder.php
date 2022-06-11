<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Roleの作成を開始します...");

        $object = new \SplFileObject(__DIR__ . '/data/roles.csv');
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

            Role::create([
                'name' => trim($row[0]),
                'name_sub' => trim($row[1]),
            ]);
            $count++;
        }

    }
}
