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
        $option = new Option();
        $option->product_id = 9;
        $option->name = 'conges';
        $option->value = 'Module congés';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'ics';
        $option->value = 'Import agendas ICS';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'office';
        $option->value = 'Import agendas Office 365';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'sirh';
        $option->value = 'Import absences SIRH';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'sirh_presence';
        $option->value = 'Import présence SIRH';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'entra_id';
        $option->value = 'Authentification Microsoft Entra ID';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'cas';
        $option->value = 'Authentification CAS';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'ldap';
        $option->value = 'Authentification ou importation LDAP';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'open_id';
        $option->value = 'Authentification Open ID Connect';
        $option->save();

        $option = new Option();
        $option->product_id = 9;
        $option->name = 'data';
        $option->value = 'Récupération des données';
        $option->save();

    }
}
