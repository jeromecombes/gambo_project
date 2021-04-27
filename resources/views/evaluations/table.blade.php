@extends('layouts.myApp')
@section('content')

  <h3>{{ $title }} </h3>

  <div class='align-right'>
    <input type='button' value='All evaluations' class='btn' onclick='location.href="{{ route('evaluations.home') }}";'/>
    <input type='button' value='Export to Excel' class='btn btn-primary' onclick='location.href="/admin/eval_export.php";'/>
  </div>

  <fieldset>

    @if (empty($data))
      <h4>No evaluation found !</h4>
    @else
      <table class='datatable' data-sort='[[0,"asc"]]'>
        <thead>
          <tr>
            @foreach ($questions as $question)
              <th>{{ $question }}</th>
            @endforeach
          </tr>
        </thead>

        <tbody>
          @foreach($data as $elem)
            <tr>
              @for ($i=1; $i < count($questions)+1; $i++)
                <td>
                  <div style='height:50px;overflow:hidden;' title='{{ $elem[$i] }}'>{{ $elem[$i] }}</div>
                </td>
              @endfor
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

  </fieldset>

@endsection
