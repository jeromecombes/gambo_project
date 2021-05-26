@extends('layouts.myApp')
@section('content')

  {{ Form::open(['route' => 'hosts.sendmail']) }}

    <h3>Email</h3>

    <div style='margin-bottom:30px; text-align:right;'>
      {{ Form::button('Back to list', ['class' => 'btn btn-primary', 'onclick' => 'document.location.href="/hosts";']) }}
    </div>

    <fieldset>

      @if (empty($host_ids))
        <strong>No host selected</strong>
      @else

        {{ Form::hidden('hosts', $host_ids) }}

        <table>
          <tr>
            <td colspan='2'>
              <b>This email will be sent to the following hosts</b> :
            </td>
          </tr>

          <tr>
            <td colspan='2'>
              {{ $hosts }}
            </td>
          </tr>

          <tr>
            <td style='padding-top:40px; width:100px;'>
              {{ Form::label('subject', 'Subject') }}
            </td>
            <td style='padding-top:40px;'>
              {{ Form::text('subject') }}
            </td>
          </tr>

          <tr>
            <td colspan='2' style='padding-top:40px;'>
              {{ Form::label('message', 'Message') }}
            </td>
          </tr>

          <tr>
            <td colspan='2'>
              {{ Form::textarea('message') }}
            </td>
          </tr>

          <tr>
            <td colspan='2' style='text-align:right;'>
              {{ Form::button('Cancel', ['class' => 'btn', 'onclick' => 'document.location.href="/hosts";']) }}
              {{ Form::submit('Send', ['class' => 'btn btn-primary']) }}
            </td>
          </tr>

        </table>
      @endif

    </fieldset>

  {{ Form::close() }}

@endsection
