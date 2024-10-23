@extends('layouts.myApp')
@section('content')

<h3>Projets</h3>
<p>
Vous trouverez ci-dessous la liste de vos projets.<br/>
</p>

<div class="container">
  <div class="row">
    <div class="col col-9">
      <input type="text" class="search-table form-control" placeholder="Search">
    </div>
    <div class="col">
      <input type="button" value="Nouveau projet" class="btn btn-primary w-100" onclick="location.href='{{ route('project.edit') }}';" />
    </div>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Commande</th>
      <th scope="col">Produit</th>
      <th scope="col">Client</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($projects->where('status', 0) as $project)
      <tr>
        <th scope="row"><a href="{{ route('project.edit', [$project->id, 'edit']) }}">{{ $project->order }}</a></td>
        <td>{{ $project->product }}</td>
        <td>{{ $project->customer }}</td>
        <td>{{ $project->statusText }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection

