<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    private array $letters = ["A", "B", "C", "D", "E", "F", "G", "H"];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->letters as $letter) {
            $group = new Group();
            $group->letter = $letter;
            $group->save();
        }
    }
}
