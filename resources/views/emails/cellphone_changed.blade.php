@extends('emails.layouts.html')

@section('content')
<p>
Le numéro de téléphone de <b>{{ $data->firstname }} {{ $data->lastname }}</b> a changé : <br/>
Son nouveau numéro est le "<b>{{ $data->cellphone }}</b>"
</p>
@endsection