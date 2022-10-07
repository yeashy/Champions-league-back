<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    private array $clubs = [
        [
            'name' => "Manchester City",
            'logo' => "path/to/logo/Manchester_City.webp",
            'pot_id' => 1
        ],
        [
            'name' => "Real Madrid",
            'logo' => "path/to/logo/Real_Madrid.webp",
            'pot_id' => 1
        ],
        [
            'name' => "Bayern Munich",
            'logo' => "path/to/logo/Bayern_Munich.webp",
            'pot_id' => 1
        ],
        [
            'name' => "PSG",
            'logo' => "path/to/logo/PSG.webp",
            'pot_id' => 1
        ],
        [
            'name' => "AC Milan",
            'logo' => "path/to/logo/AC_Milan.webp",
            'pot_id' => 1
        ],
        [
            'name' => "Eintracht Frankfurt",
            'logo' => "path/to/logo/Eintracht_Frankfurt.webp",
            'pot_id' => 1
        ],
        [
            'name' => "FC Porto",
            'logo' => "path/to/logo/FC_Porto.webp",
            'pot_id' => 1
        ],
        [
            'name' => "Ajax",
            'logo' => "path/to/logo/Ajax.webp",
            'pot_id' => 1
        ],
        [
            'name' => "Liverpool",
            'logo' => "path/to/logo/Liverpool.webp",
            'pot_id' => 2
        ],
        [
            'name' => "Chelsea",
            'logo' => "path/to/logo/Chelsea.webp",
            'pot_id' => 2
        ],
        [
            'name' => "FC Barcelona",
            'logo' => "path/to/logo/FC_Barcelona.webp",
            'pot_id' => 2
        ],        [
            'name' => "Juventus",
            'logo' => "path/to/logo/Juventus.webp",
            'pot_id' => 2
        ],
        [
            'name' => "Atlético de Madrid",
            'logo' => "path/to/logo/Atlético_de_Madrid.webp",
            'pot_id' => 2
        ],
        [
            'name' => "Sevilla FC",
            'logo' => "path/to/logo/Sevilla_FC.webp",
            'pot_id' => 2
        ],
        [
            'name' => "RB Leipzig",
            'logo' => "path/to/logo/RB_Leipzig.webp",
            'pot_id' => 2
        ],
        [
            'name' => "Tottenham Hotspur",
            'logo' => "path/to/logo/Tottenham_Hotspur.webp",
            'pot_id' => 2
        ],
        [
            'name' => "Borussia Dortmund",
            'logo' => "path/to/logo/Borussia_Dortmund.webp",
            'pot_id' => 3
        ],
        [
            'name' => "RB Salzburg",
            'logo' => "path/to/logo/RB_Salzburg.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Shakhtar Donetsk",
            'logo' => "path/to/logo/Shakhtar_Donetsk.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Inter",
            'logo' => "path/to/logo/Inter.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Napoli",
            'logo' => "path/to/logo/Napoli.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Benfica",
            'logo' => "path/to/logo/Benfica.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Sporting CP",
            'logo' => "path/to/logo/Sporting_CP.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Bayer 04 Leverkusen",
            'logo' => "path/to/logo/Bayer_04_Leverkusen.webp",
            'pot_id' => 3
        ],
        [
            'name' => "Olympique de Marseille",
            'logo' => "path/to/logo/Olympique_de_Marseille.webp",
            'pot_id' => 4
        ],
        [
            'name' => "Club Brugge",
            'logo' => "path/to/logo/Club_Brugge.webp",
            'pot_id' => 4
        ],
        [
            'name' => "Celtic",
            'logo' => "path/to/logo/Celtic.webp",
            'pot_id' => 4
        ],
        [
            'name' => "FC Viktoria Plzeň",
            'logo' => "path/to/logo/FC_Viktoria_Plzeň",
            'pot_id' => 4
        ],
        [
            'name' => "Maccabi Haifa",
            'logo' => "path/to/logo/Maccabi_Haifa.webp",
            'pot_id' => 4
        ],
        [
            'name' => "Rangers FC",
            'logo' => "path/to/logo/Rangers_FC.webp",
            'pot_id' => 4
        ],
        [
            'name' => "FC København",
            'logo' => "path/to/logo/FC_København.webp",
            'pot_id' => 4
        ],
        [
            'name' => "Dinamo Zagreb",
            'logo' => "path/to/logo/Dinamo_Zagreb.webp",
            'pot_id' => 4
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->clubs as $club) {
            $newClub = new Club();
            $newClub->name = $club['name'];
            $newClub->logo = $club['logo'];
            $newClub->pot_id = $club['pot_id'];
            $newClub->save();
        }
    }
}
