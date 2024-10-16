@extends('layouts.myApp')
@section('content')

<h3>Projets</h3>
<p>
Vous trouverez ci-dessous la liste de vos projets.<br/>
</p>

<input type='button' value='Nouveau projet' class='btn btn-primary' onclick='location.href="{{ route('project.edit') }}";' />

<table class='datatable' data-sort='[]'>
  <thead>
    <tr>
      <th>Commande</th>
      <th>Produit</th>
      <th>Client</th>
      <th>Statut</th>
    </tr>
  </thead>

  <tbody>

    <tr>
      <td><a href="{{ route('project.edit', [$project->id, 'edit']) }}">{{ $project->order }}</a></td>
      <td>{{ $project->product }}</td>
      <td>{{ $project->customer }}</td>
      <td>{{ $project->statusText }}</td>
    </tr>
  </tbody>
</table>

@endsection

