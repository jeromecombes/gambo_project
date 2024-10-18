<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                9,
                0,
                'mep',
                'Date de mise en production',
                true,
            ],
            [
                9,
                1,
                'url',
                'URL de production',
                true,
            ],
            [
                9,
                2,
                'mail_from',
                'Mail-From de production',
                true,
            ],
            [
                9,
                3,
                'conges',
                'Module congés',
            ],
            [
                9,
                4,
                'ics',
                'Import agendas ICS',
            ],
            [
                9,
                5,
                'office',
                'Import agendas Office 365',
            ],
            [
                9,
                6,
                'sirh',
                'Import absences SIRH',
            ],
            [
                9,
                7,
                'sirh_presence',
                'Import présence SIRH',
            ],
            [
                9,
                8,
                'entra_id',
                'Authentification Microsoft Entra ID',
            ],
            [
                9,
                9,
                'cas',
                'Authentification CAS',
            ],
            [
                9,
                10,
                'ldap',
                'Authentification ou importation LDAP',
            ],
            [
                9,
                11,
                'open_id',
                'Authentification Open ID Connect',
            ],
            [
                9,
                12,
                'data',
                'Récupération des données',
            ],
        ]; 

        foreach (Option::all() as $option) {
            $option->delete();
        }

        foreach ($options as $elem) {
            $option = new Option();
            $option->product_id = $elem[0];
            $option->order = $elem[1];
            $option->name = $elem[2];
            $option->value = $elem[3];
            if (isset($elem[4])) {
                $option->default = $elem[4];
            }
            $option->save();
        }
    }
}
