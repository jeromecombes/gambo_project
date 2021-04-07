@extends('layouts.myApp')
@section('content')

<h3>Select your semester</h3>

<fieldset>
  <form method='post' action='{{ route('semester.update') }}' style='margin: 20px 0;'>
  {{ csrf_field() }}
  <table>
      <tr>
      <td>
          <select name='semester'>
          <option value=''></option>
          <option value='{{ $semesters[0] }}'>{{ $semesters[0] }}</option>
          <option value='{{ $semesters[1] }}'>{{ $semesters[1] }}</option>
          </select>
      </td>
      <td>
          <input type='submit' value='OK' class='btn btn-primary' />
      </td>
      </tr>
  </table>
  </form>
</fieldset>

@endsection
