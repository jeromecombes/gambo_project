@extends('layouts.myApp')
@section('content')

  <h3>University Registration, {{ session('semester') }}</h3>

  <input type='button' onclick='$(".buttons-excel").click();' value='Export to excel' class='btn btn-primary' />

  <br/>
  <br/>

  @if ($year >= 2019)

    <table class='datatable'>
      <thead>
        <tr>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Major 1</th>
          <th>Minor 1</th>
          <th>Major 2</th>
          <th>Minor 2</th>
          @foreach ($partners as $partner)
            <th>{{ $partner->name }}</th>
          @endforeach
          <th>Justification</th>
          <th>Motivated by the calendar</th>
          <th>Final Reg.</th>
          <th>Diploma</th>
          <th>Graduation Year</th>
          <th>Country</th>
          <th>City</th>
          <th>State</th>
          <th>Start college</th>
          <th>Disability or special needs</th>
          <th>Details</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($tab as $elem)
          <tr>
            <td>{{ $elem['lastname'] }}</td>
            <td>{{ $elem['firstname'] }}</td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][10] }}'>{{ $elem[0][10] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][12] }}'>{{ $elem[0][12] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][11] }}'>{{ $elem[0][11] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][13] }}'>{{ $elem[0][13] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][14] }}'>{{ $elem[0][14] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][15] }}'>{{ $elem[0][15] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][16] }}'>{{ $elem[0][16] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][17] }}'>{{ $elem[0][17] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][18] }}'>{{ $elem[0][18] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][19] }}'>{{ $elem[0][19] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][22] }}'>{{ $elem[0][22] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[2] }}'>{{ $elem[2] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][1] }}'>{{ $elem[0][1] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][2] }}'>{{ $elem[0][2] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][3] }}'>{{ $elem[0][3] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][4] }}'>{{ $elem[0][4] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][5] }}'>{{ $elem[0][5] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][6] }}'>{{ $elem[0][6] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][7] }}'>{{ $elem[0][7] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][8] }}'>{{ $elem[0][8] }}</div></td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @else

    <table class='datatable'>
      <thead>
        <tr>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Major 1</th>
          <th>Minor 1</th>
          <th>Major 2</th>
          <th>Minor 2</th>
          @foreach ($partners as $partner)
            <th>{{ $partner->name }}</th>
          @endforeach
          <th>Justification</th>
          <th>Motivated by the calendar</th>
          <th>Final Reg.</th>
          <th>Diplome</th>
          <th>Obtention</th>
          <th>Pays</th>
          <th>Ville</th>
          <th>Etat</th>
          <th>Etudes actuelles</th>
          <th>Faculté</th>
          <th>Début des études</th>
          <th>Domaine</th>
          <th>Discipline voulue</th>
          <th>Handicap</th>
          <th>Handicap, précisez</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($tab as $elem)
          <tr>
            <td>{{ $elem['lastname'] }}</td>
            <td>{{ $elem['firstname'] }}</td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][1] }}'>{{ $elem[0][1] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][2] }}'>{{ $elem[0][2] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][3] }}'>{{ $elem[0][3] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][4] }}'>{{ $elem[0][4] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][5] }}'>{{ $elem[0][5] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][6] }}'>{{ $elem[0][6] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][7] }}'>{{ $elem[0][7] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][12] }}'>{{ $elem[0][12] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][8] }}'>{{ $elem[0][8] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][9] }}'>{{ $elem[0][9] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[0][11] }}'>{{ $elem[0][11] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[2] }}'>{{ $elem[2] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][0] }}'>{{ $elem[1][0] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][1] }}'>{{ $elem[1][1] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][2] }}'>{{ $elem[1][2] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][3] }}'>{{ $elem[1][3] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][4] }}'>{{ $elem[1][4] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][5] }}'>{{ $elem[1][5] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][6] }}'>{{ $elem[1][6] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][7] }}'>{{ $elem[1][7] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][8] }}'>{{ $elem[1][8] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][9] }}'>{{ $elem[1][9] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][10] }}'>{{ $elem[1][10] }}</div></td>
            <td><div style='height:50px; max-height:50px; overflow:hidden' title='{{ $elem[1][11] }}'>{{ $elem[1][11] }}</div></td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @endif

@endsection
