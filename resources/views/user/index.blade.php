@extends('layouts.myApp')
@section('content')

  <h3>User list</h3>

  <table class='datatable' data-sort='[[1, "asc"],[2, "asc"]]' >
    <thead>
      <tr>
        <th class='dataTableNoSort'></th>
        <th>Last name</th>
        <th>First name</th>
        <th>Email</th>
        <th>University</th>
      </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
      <tr>
        <td>
          @if (in_array(10, Auth::user()->access))
            <a href='{{ route('user.edit', $user->id) }}'>
              <img src='/img/edit.png' alt='Edit' />
            </a>
          @endif
        </td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->firstname }}</td>
        <td><a href='mailto:{{ $user->email }}'>{{ $user->email }}</a></td>
        <td>{{ $user->university }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <div style='margin-top:30px; text-align:right;'>
    <input type='button' value='Add' class='btn btn-primary' onclick='location.href="{{ route('user.edit') }}";' />
  </div>

@endsection
