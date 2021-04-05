@extends('emails.layouts.plain')

@section('content')

Nom, prénom : {{ $trip->lastname }}, {{ $trip->firstname }}
Email, Mobile : {{ $trip->email }}, {{ $trip->cellphone }}

Date de départ : {{ $trip->start }}
Date de retour : {{ $trip->end }}

Destination(s) :
{{ $trip->destination }}


Moyen(s) de transport (avion - N° de vols, horaires et compagnies aériennes ; trains - horaires et destinations des trains)
{{ $trip->transport }}

Adresse(s) sur place (hôtel, auberge, amis, etc.) :
{{ $trip->address }}

N° de téléphone où on peut vous joindre : {{ $trip->phone }}

Acceptez-vous que l'on communique ces informations à vos parents ? {{ __($trip->parents_notification) }}

Pour pouvoir envoyer votre formulaire, veuillez accepter les conditions suivantes :
- J’accepte que l'on communique ces informations à mon université : @if ($trip->university_notification == 'Yes') Oui @else Non @endif
- J'ai lu les consignes de sécurité avant les congés</b> : @if ($trip->terms == 'Yes') Oui @else Non @endif

Assurez-vous que vous avez le N° de téléphone portable du directeur avec vous : 06-40-15-51-71

@endsection
