@extends('layouts.myApp')
@section('content')

  <h3>User list</h3>

  <div class="container">
    <div class="row">
      <div class="col col-9">
        <input type="text" class="search-table form-control" placeholder="Search">
      </div>
      <div class="col">
        <input type="button" value="Add" class="btn btn-primary w-100" onclick="location.href='{{ route('user.edit') }}';" />
      </div>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Last name</th>
        <th scope="col">First name</th>
        <th scope="col">Email</th>
        <th scope="col">University</th>
      </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
      <tr>
        @if (in_array(10, Auth::user()->access))
          <th>
            <a href='{{ route('user.edit', $user->id) }}'>
              {{ $user->lastname }}
            </a>
          </th>
        @else
          <td>
            {{ $user->lastname }}
          </td>
        @endif
        <td>{{ $user->firstname }}</td>
        <td><a href='mailto:{{ $user->email }}'>{{ $user->email }}</a></td>
        <td>{{ $user->university }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@endsection
