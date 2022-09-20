@extends('layouts.myApp')
@section('content')
  <h3>Deadlines for {{ session('semester') }}</h3>

  <fieldset id='dates_fieldset'>

    {{ Form::open(['url' => route('dates.update')]) }}

      <table>

        <thead>
          <tr>
            <th>Home form</th>
            <th>Date</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              {{ Form::label('date1', 'Personal details and contact information by') }}
            </td>
            <td>
              {{ Form::text('date1', $dates->date1, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date2', 'Housing preferences by') }}
            </td>
            <td>
              {{ Form::text('date2', $dates->date2, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date3', 'University preference by') }}
            </td>
            <td>
              {{ Form::text('date3', $dates->date3, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date4', 'Pre-registration for VWPP Courses by') }}
            </td>
            <td>
              {{ Form::text('date4', $dates->date4, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>
        </tbody>
      </table>

      <br/>
      <br/>

      <table>

        <thead>
          <tr>
            <th>Univ registration form</th>
            <th>Date</th>
          </tr>
        </thead>

        <tbody>
          @php
            $i = 4;
          @endphp

          @foreach ($partners as $partner)
            @php
              $i++;
            @endphp

            <tr>
              <td>
                {{ Form::label('date' . $i, $partner->name . ', end of course') }}
              </td>
              <td>
                {{ Form::text('date' . $i, $dates->{"date$i"}, ['class' => 'myUI-datepicker-string']) }}
              </td>
            </tr>
          @endforeach

        </tbody>

      </table>

      <div>
        {{ Form::submit('Valider', ['class' => 'btn btn-primary']) }}
      </div>

    {{ Form::close() }}

  </fieldset>

@endsection
