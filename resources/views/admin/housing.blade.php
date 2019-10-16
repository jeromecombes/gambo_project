@extends('layouts.myApp')
@section('content')

<h3>Housing</h3>

<p>
    <a href="{{ asset('admin/hosts') }}">Liste des logements</a>
</p>
<p>
    <a href="{{ asset('admin/housing/requests') }}">Demande des étudiants</a>
</p>

@endsection