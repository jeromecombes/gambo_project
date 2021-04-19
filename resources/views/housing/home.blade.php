@extends('layouts.myApp')
@section('content')

<h3>Housing</h3>

<p>
    <a href="{{ route('hosts.index') }}">Liste des logements</a>
</p>
<p>
    <a href="{{ asset('housing/requests') }}">Demande des étudiants</a>
</p>

@endsection
