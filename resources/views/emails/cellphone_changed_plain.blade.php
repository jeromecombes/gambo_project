@extends('emails.layouts.plain')

@section('content')
Le numéro de téléphone de {{ $data->firstname }} {{ $data->lastname }} a changé :
Son nouveau numéro est le "{{ $data->cellphone }}"
@endsection
