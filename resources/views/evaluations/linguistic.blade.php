@extends('evaluations.layout')

@push('subtitle')
  <h3>La grammaire et syntaxe, la phonétique, l'interculturel</h3>
@endpush

@section('evaluation_form')

<tr>
  <td colspan='4' style='text-align:justify;'>
    <i>This form is intended to assist your instructor in evaluating his or her teaching effectiveness. We would appreciate a thoughtful response.</i>
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-top:20px;'><b>Did you attend every session ?</b></td>
  @if (!$edit)
    <td class='response' colspan='2' style='padding-top:20px;'>{{ $data[1] }}</td>
  @endif
</tr>

<tr>
  @if ($edit)
    <td>{!! Form::radio('data[1]', 'Yes', false, ['id' => 'radio1']) !!} {!! Form::label('radio1', 'Yes') !!}</td>
    <td>{!! Form::radio('data[1]', 'No', false, ['id' => 'radio2']) !!} {!! Form::label('radio2', 'No') !!}</td>
    <td colspan='2'><b>If not, why not ?</b></td>
  @else
    <td colspan='4' style='color:black;'>If not, why not ?</td>
  @endif
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[2]'>{{ $data[2] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[2])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>2. Please comment on the <i>content</i> of the sessions and their <i>usefulness</i> to <i>you</i>. To what extent did they help you to :</b>
  </td>
</tr>

<tr>
  <td colspan='3' style='padding-left:30px;'><b>a) Develop a mastery of the French language</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[3] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[3]', 'Extremely helpful', false, ['id' => 'radio3']) !!} {!! Form::label('radio3', 'Extremely helpful') !!}</td>
    <td>{!! Form::radio('data[3]', 'Very helpful', false, ['id' => 'radio4']) !!} {!! Form::label('radio4', 'Very helpful') !!}</td>
    <td>{!! Form::radio('data[3]', 'Helpful', false, ['id' => 'radio5']) !!} {!! Form::label('radio5', 'Helpful') !!}</td>
    <td>{!! Form::radio('data[3]', 'Not very helpful', false, ['id' => 'radio6']) !!} {!! Form::label('radio6', 'Not very helpful') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='3' style='padding-left:30px;'><b>b) Understand French culture :</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[4] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[4]', 'Extremely helpful', false, ['id' => 'radio7']) !!} {!! Form::label('radio7', 'Extremely helpful') !!}</td>
    <td>{!! Form::radio('data[4]', 'Very helpful', false, ['id' => 'radio8']) !!} {!! Form::label('radio8', 'Very helpful') !!}</td>
    <td>{!! Form::radio('data[4]', 'Helpful', false, ['id' => 'radio9']) !!} {!! Form::label('radio9', 'Helpful') !!}</td>
    <td>{!! Form::radio('data[4]', 'Not very helpful', false, ['id' => 'radio10']) !!} {!! Form::label('radio10', 'Not very helpful') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;' ><b>3. What aspect of the "Ateliers Linguistiques" did you find most helpful ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[5]'>{{ $data[5] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[5])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' ><b>4. Do you have any suggestions for how the "Ateliers Linguistiques" could be modified to faciliate your experience in Paris ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[6]'>{{ $data[6] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[6])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' ><b>5. Feel free to provide comments on a specific "Atelier"</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[7]'>{{ $data[7] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[7])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>MERCI BEAUCOUP !</b></td>
</tr>

<tr>
  <td colspan='2'><b>Your name (optional) :</b></td>
  <td>
    @if ($edit)
      <input type='text' name='data[8]' value='{{ $data[8] }}' />
    @else
      <span class='response'>{{ $data[8] }}</span>
    @endif
  </td>
</tr>

@endsection
