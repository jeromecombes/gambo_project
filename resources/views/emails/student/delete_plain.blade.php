@extends('emails.layouts.plain')

Les étudiants suivants ont été supprimés de la base de données VWPP :

@foreach ($data as $student)
  - {{ $student->lastname }} {{ $student->firstname }}, {{ $student->email }}, {{ $student->university }} {{ $student->visiting }}
@endforeach

Université : {{ Auth::user()->university }}

@section('content')
@endsection
