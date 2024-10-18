<?php

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $q = Question::where('value', 'Date de mise en production souhaitée ?')->first();
        $q->name = 'mep';
        $q->type = 'date';
        $q->save();

        $q = Question::where('value', 'URL de production ?')->first();
        $q->name = 'url';
        $q->save();

        $q = Question::where('value', 'Adresse e-mail à utiliser pour envoyer les notifications ?')->first();
        $q->name = 'mail-from';
        $q->type = 'email';
        $q->save();

        $q = Question::where('value', 'ID du locataire ?')->first();
        $q->name = 'entra_tenant';
        $q->save();

        $q = Question::where('value', 'ID de l\'application ?')->first();
        $q->name = 'entra_client';
        $q->save();

        $q = Question::where('value', 'Secret  ?')->first();
        $q->name = 'entra_secret';
        $q->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $q = Question::where('value', 'Date de mise en production souhaitée ?')->first();
        $q->name = null;
        $q->type = null;
        $q->save();

        $q = Question::where('value', 'URL de production ?')->first();
        $q->name = null;
        $q->save();

        $q = Question::where('value', 'Adresse e-mail à utiliser pour envoyer les notifications ?')->first();
        $q->name = null;
        $q->type = null;
        $q->save();
    }
};
