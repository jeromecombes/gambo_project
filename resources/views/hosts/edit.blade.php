@extends('layouts.myApp')
@section('content')

  <h3>Housing - {{ session('semester') }}</h3>

  <a href='/housing/home'>Housing Home</a> > <a href='/hosts'>Host list</a>

  <br/>
  <br/>

  <fieldset>

    {{ Form::open(['route' => 'host.update']) }}
      {{ Form::hidden('id', $host->id) }}

      <table>
        <tr>
          <td>{{ Form::label('lastname', 'Last name') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('lastname', old('lastname', $host->lastname)) }}
            @else
              <span class='response'>{{ $host->lastname }}</span>
            @endif
          </td>
          <td>{{ Form::label('lastname2', 'Last name') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('lastname2', old('lastname2', $host->lastname2)) }}
            @else
              <span class='response'>{{ $host->lastname2 }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('firstname', 'First name') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('firstname', old('firstname', $host->firstname)) }}
            @else
              <span class='response'>{{ $host->firstname }}</span>
            @endif
          </td>
          <td>{{ Form::label('firstname2', 'First name') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('firstname2', old('firstname2', $host->firstname2)) }}
            @else
              <span class='response'>{{ $host->firstname2 }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('address', 'Address') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('address', old('address', $host->address)) }}
            @else
              <span class='response'>{{ $host->address }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('zipcode', 'Zip code') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('zipcode', old('zipcode', $host->zipcode)) }}
            @else
              <span class='response'>{{ $host->zipcode }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('city', 'City') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('city', old('city', $host->city)) }}
            @else
              <span class='response'>{{ $host->city }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('phonenumber', 'Phone number') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('phonenumber', old('phonenumber', $host->phonenumber)) }}
            @else
              <span class='response'>{{ $host->phonenumber }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('cellphone', 'Cellphone') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('cellphone', old('cellphone', $host->cellphone )) }}
            @else
              <span class='response'>{{ $host->cellphone }}</span>
            @endif
          </td>
          <td>{{ Form::label('cellphone2', 'Cellphone') }}</td>
          <td>
            @if ($edit)
              {{ Form::text('cellphone2', old('cellphone2', $host->cellphone2 )) }}
            @else
              <span class='response'>{{ $host->cellphone2 }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td>{{ Form::label('email', 'E-mail address') }}</td>
          <td>
            @if ($edit)
              {{ Form::email('email', old('email', $host->email )) }}
            @else
              <span class='response'>{{ $host->email }}</span>
            @endif
          </td>
          <td>{{ Form::label('email2', 'E-mail address') }}</td>
          <td>
            @if ($edit)
              {{ Form::email('email2', old('email2', $host->email2 )) }}
            @else
              <span class='response'>{{ $host->email2 }}</span>
            @endif
          </td>
        </tr>

        <tr>
          <td style='padding-top:20px;'>
            Etudiant(e) attribué(e) :
          </td>
          <td colspan='3' style='padding-top:20px;' class='response'>
            {{ $student->firstname }} {{ $student->lastname }}
          </td>
        </tr>

        <tr>
          <td colspan='4' style='text-align:right;padding-top:20px;'>
            @if ($edit)
              {{ Form::button('Cancel', ['onclick' => "location.href='/host/$host->id';", 'class' => 'btn']) }}
              {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

            @else
              {{ Form::button('Back', ['onclick' => 'location.href="/hosts";', 'class' => 'btn']) }}

              @if (in_array(7, Auth::user()->access))
                {{ Form::button('Delete', ['onclick' => 'delete_host();', 'class' => 'btn']) }}
                {{ Form::button('Edit', ['onclick' => "location.href='/host/$host->id/edit';", 'class' => 'btn btn-primary']) }}
              @endif
            @endif

      </table>
    </form>
  </fieldset>

@if (in_array(7, Auth::user()->access) and $host->id)
  {!! Form::open(['route' => 'host.delete', 'id' => 'delete-form']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  {!! Form::hidden('id', $host->id) !!}
  {!! Form::close() !!}
@endif

@endsection
