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
                'mep',
                'date',
                'Date de mise en production souhaitée ?',
                'Date de mise en production (desc) ?',
                'Date de mise en production (long desc) ?',
                1,
            ],
            [
                'url',
                'url',
                'text',
                'URL de production ?',
                'URL de production (desc)',
                'URL de production (long desc)',
                2,
            ],
            [
                'mail_from',
                'mail_from',
                'email',
                'Adresse e-mail à utiliser pour envoyer les notifications ?',
                'Adresse e-mail (desc)',
                'Adresse e-mail (long desc)',
                3,
            ],
            [
                'entra_id',
                'entra_tenant',
                'text',
                'ID du locataire ?',
                'ID du locataire (desc)',
                'ID du locataire (long desc)',
                4,
            ],
            [
                'entra_id',
                'entra_client',
                'text',
                "ID de l'application ?",
                "ID de l'applicationu (desc)",
                "ID de l'applicationu (long desc)",
                5,
            ],
            [
                'entra_id',
                'entra_secret',
                'text',
                'Secret  ?',
                "Valeur du secret associé à l'ID de l'application",
                'Secret (long desc)',
                6,
            ],
        ];

        foreach (Question::all() as $question) {
            $question->delete();
        }

        $options = Option::all();

        foreach ($questions as $elem) {
            $question = new Question();
            $question->option_id = $elem[0] ? $options->where('name', $elem[0])->first()->id : null;
            $question->name = $elem[1];
            $question->type = $elem[2];
            $question->value = $elem[3];
            $question->description = $elem[4];
            $question->long_desc = $elem[5];
            $question->order = $elem[6];
            $question->save();
        }
    }
}
