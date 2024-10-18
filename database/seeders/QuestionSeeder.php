<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'mep',
                'Date de mise en production souhaitée ?',
                'Date de mise en production (desc) ?',
                'Date de mise en production (long desc) ?',
                1,
            ],
            [
                'url',
                'URL de production ?',
                'URL de production (desc)',
                'URL de production (long desc)',
                2,
            ],
            [
                'mail_from',
                'Adresse e-mail à utiliser pour envoyer les notifications ?',
                'Adresse e-mail (desc)',
                'Adresse e-mail (long desc)',
                3,
            ],
            [
                'entra_id',
                'ID du locataire ?',
                'ID du locataire (desc)',
                'ID du locataire (long desc)',
                4,
            ],
            [
                'entra_id',
                'ID de l\'application ?',
                'ID de l\'applicationu (desc)',
                'ID de l\'applicationu (long desc)',
                5,
            ],
            [
                'entra_id',
                'Secret  ?',
                'Valeur du secret associé à l\'ID de l\'application',
                'Secret (long desc)',
                6,
            ],
        ];

/**
| 54 |          9 |     0 | url           | URL de production                    |       1 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 55 |          9 |     1 | mail_from     | Mail-From de production              |       1 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 56 |          9 |     2 | conges        | Module congés                        |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 57 |          9 |     3 | ics           | Import agendas ICS                   |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 58 |          9 |     4 | office        | Import agendas Office 365            |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 59 |          9 |     5 | sirh          | Import absences SIRH                 |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 60 |          9 |     6 | sirh_presence | Import présence SIRH                 |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 61 |          9 |     7 | entra_id      | Authentification Microsoft Entra ID  |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 62 |          9 |     8 | cas           | Authentification CAS                 |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 63 |          9 |     9 | ldap          | Authentification ou importation LDAP |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 64 |          9 |    10 | open_id       | Authentification Open ID Connect     |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
| 65 |          9 |    11 | data          | Récupération des données             |       0 | 2024-10-18 14:06:09 | 2024-10-18 14:06:09 |
*/
        foreach (Question::all() as $question) {
            $question->delete();
        }

        $options = Option::all();

        foreach ($questions as $elem) {
            $question = new Question();
            $question->option_id = $elem[0] ? $options->where('name', $elem[0])->first()->id : null;
            $question->question = $elem[1];
            $question->description = $elem[2];
            $question->long_desc = $elem[3];
            $question->order = $elem[4];
            $question->save();
        }
    }
}
