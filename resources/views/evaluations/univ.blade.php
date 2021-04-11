@extends('evaluations.layout')
@section('evaluation_form')

<tr>
  <td colspan='4' style='font-style:italic;text-align:justify;'>
    This form will not be shared with the university instructor. It is intended for VWPP directors and help future students make an informed decision in their choice of courses. We would appreciate a thoughtful response.
  </td>
</tr>

<tr>
  <td style='padding-top:20px;'><b>Name of course :</b></td>
  <td style='padding-top:20px;' class='response' >
    <input type='hidden' name='data[1]' value='{{ $data[1] }}' />
    {{ $data[1] }}
  </td>
  <td style='padding-top:20px;'><b>Professor :</b></td>
  <td style='padding-top:20px;' class='response' >
    <input type='hidden' name='data[2]' value='{{ $data[2] }}' />
    {{ $data[2] }}
  </td>
</tr>

<tr>
  <td><b>Institution :</b></td>
  <td class='response'>
    <input type='hidden' name='data[3]' value='{{ $data[3] }}' />
    {{ $data[3] }}
  </td>
  <td><b>Course code :</b></td>
  <td class='response'>
    <input type='hidden' name='data[4]' value='{{ $data[4] }}' />
    {{ $data[4] }}
  </td>
</tr>

<tr>
  <td style='padding-top:20px;'><b>Course Format :</b></td>
  @if ($edit)
    <td style='padding-top:20px;'>{!! Form::radio('data[7]', 'Lecture', false, ['id' => 'radio1']) !!} {!! Form::label('radio1', 'Lecture') !!}</td>
    <td style='padding-top:20px;'>{!! Form::radio('data[7]', 'Discussion', false, ['id' => 'radio2']) !!} {!! Form::label('radio2', 'Discussion') !!}</td>
    <td style='padding-top:20px;'>{!! Form::radio('data[7]', 'Lecture and Discussion', false, ['id' => 'radio3']) !!} {!! Form::label('radio3', 'Lecture and Discussion') !!}</td>
  @else
    <td style='padding-top:20px;' class='response'>{{ $data[7] }}</td>
  @endif
</tr>


<tr>
  <td colspan='3' style='padding-top:20px;'><b>1. How would you describe your efforts in this course ?</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[8] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[8]', 'Strenuous', false, ['id' => 'radio4']) !!} {!! Form::label('radio4', 'Strenuous') !!}</td>
    <td>{!! Form::radio('data[8]', 'Fairly strenuous', false, ['id' => 'radio5']) !!} {!! Form::label('radio5', 'Fairly strenuous') !!}</td>
    <td>{!! Form::radio('data[8]', 'Moderate', false, ['id' => 'radio6']) !!} {!! Form::label('radio6', 'Moderate') !!}</td>
    <td>{!! Form::radio('data[8]', 'Light', false, ['id' => 'radio7']) !!} {!! Form::label('radio7', 'Light') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>2. Do you think your French was at a level that allowed you to understand and take notes ?</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) At the beginning :</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[9] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[9]', 'Comfortably', false, ['id' => 'radio8']) !!} {!! Form::label('radio8', 'Comfortably') !!}</td>
    <td>{!! Form::radio('data[9]', 'With some difficulty', false, ['id' => 'radio9']) !!} {!! Form::label('radio9', 'With some difficulty') !!}</td>
    <td>{!! Form::radio('data[9]', 'With considerable difficulty', false, ['id' => 'radio10']) !!} {!! Form::label('radio10', 'With considerable difficulty') !!}</td>
    <td>{!! Form::radio('data[9]', 'Not Applicable', false, ['id' => 'radio11']) !!} {!! Form::label('radio11', 'Not Applicable') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) After half-term :</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[10] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[10]', 'Comfortably', false, ['id' => 'radio12']) !!} {!! Form::label('radio12', 'Comfortably') !!}</td>
    <td>{!! Form::radio('data[10]', 'With some difficulty', false, ['id' => 'radio13']) !!} {!! Form::label('radio13', 'With some difficulty') !!}</td>
    <td>{!! Form::radio('data[10]', 'With considerable difficulty', false, ['id' => 'radio14']) !!} {!! Form::label('radio14', 'With considerable difficulty') !!}</td>
    <td>{!! Form::radio('data[10]', 'Not Applicable', false, ['id' => 'radio15']) !!} {!! Form::label('radio15', 'Not Applicable') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-top:20px;'><b>Did you attend every class at the University ?</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[11] }}</td>
  @endif
</tr>

<tr>
  @if ($edit)
    <td>{!! Form::radio('data[11]', 'Yes', false, ['id' => 'radio16']) !!} {!! Form::label('radio16', 'Yes') !!}</td>
    <td>{!! Form::radio('data[11]', 'No', false, ['id' => 'radio17']) !!} {!! Form::label('radio17', 'No') !!}</td>
  @endif
  <td colspan='2'><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[12]'>{{ $data[12] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[12])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'><b>4. Please evaluate your own work in the course. Did you :</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Keep up with assigned reading ?</b></td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[13] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[13]', 'Almost always', false, ['id' => 'radio18']) !!} {!! Form::label('radio18', 'Almost always') !!}</td>
    <td>{!! Form::radio('data[13]', 'Most of the time', false, ['id' => 'radio19']) !!} {!! Form::label('radio19', 'Most of the time') !!}</td>
    <td>{!! Form::radio('data[13]', 'Some of the time', false, ['id' => 'radio20']) !!} {!! Form::label('radio20', 'Some of the time') !!}</td>
    <td>{!! Form::radio('data[13]', 'Almost never/never', false, ['id' => 'radio21']) !!} {!! Form::label('radio21', 'Almost never/never') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[14]'>{{ $data[14] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[14])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) Contribute to in-class discussion ?</b></td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[15] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[15]', 'Almost always', false, ['id' => 'radio22']) !!} {!! Form::label('radio22', 'Almost always') !!}</td>
    <td>{!! Form::radio('data[15]', 'Most of the time', false, ['id' => 'radio23']) !!} {!! Form::label('radio23', 'Most of the time') !!}</td>
    <td>{!! Form::radio('data[15]', 'Some of the time', false, ['id' => 'radio24']) !!} {!! Form::label('radio24', 'Some of the time') !!}</td>
    <td>{!! Form::radio('data[15]', 'Almost never/never', false, ['id' => 'radio25']) !!} {!! Form::label('radio25', 'Almost never/never') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[16]'>{{ $data[16] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[16])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>C) Raise questions ?</b></td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[17] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[17]', 'Almost always', false, ['id' => 'radio26']) !!} {!! Form::label('radio26', 'Almost always') !!}</td>
    <td>{!! Form::radio('data[17]', 'Most of the time', false, ['id' => 'radio27']) !!} {!! Form::label('radio27', 'Most of the time') !!}</td>
    <td>{!! Form::radio('data[17]', 'Some of the time', false, ['id' => 'radio28']) !!} {!! Form::label('radio28', 'Some of the time') !!}</td>
    <td>{!! Form::radio('data[17]', 'Almost never/never', false, ['id' => 'radio29']) !!} {!! Form::label('radio29', 'Almost never/never') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[18]'>{{ $data[18] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[18])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>5. Did you have a clear understanding of what was expected from you in this course for the following :</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'>Readings :</td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[19] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[19]', 'Very clear', false, ['id' => 'radio30']) !!} {!! Form::label('radio30', 'Very clear') !!}</td>
    <td>{!! Form::radio('data[19]', 'Somewhat clear', false, ['id' => 'radio31']) !!} {!! Form::label('radio31', 'Somewhat clear') !!}</td>
    <td>{!! Form::radio('data[19]', 'Not clear', false, ['id' => 'radio32']) !!} {!! Form::label('radio32', 'Not clear') !!}</td>
    <td>{!! Form::radio('data[19]', 'Not applicable', false, ['id' => 'radio33']) !!} {!! Form::label('radio33', 'Not applicable') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'>Written work :</td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[20] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[20]', 'Very clear', false, ['id' => 'radio34']) !!} {!! Form::label('radio34', 'Very clear') !!}</td>
    <td>{!! Form::radio('data[20]', 'Somewhat clear', false, ['id' => 'radio35']) !!} {!! Form::label('radio35', 'Somewhat clear') !!}</td>
    <td>{!! Form::radio('data[20]', 'Not clear', false, ['id' => 'radio36']) !!} {!! Form::label('radio36', 'Not clear') !!}</td>
    <td>{!! Form::radio('data[20]', 'Not applicable', false, ['id' => 'radio37']) !!} {!! Form::label('radio37', 'Not applicable') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'>Oral presentation :</td>
  @if (!$edit)
    <td class='response' colspan='2'>{{ $data[21] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[21]', 'Very clear', false, ['id' => 'radio38']) !!} {!! Form::label('radio38', 'Very clear') !!}</td>
    <td>{!! Form::radio('data[21]', 'Somewhat clear', false, ['id' => 'radio39']) !!} {!! Form::label('radio39', 'Somewhat clear') !!}</td>
    <td>{!! Form::radio('data[21]', 'Not clear', false, ['id' => 'radio40']) !!} {!! Form::label('radio40', 'Not clear') !!}</td>
    <td>{!! Form::radio('data[21]', 'Not applicable', false, ['id' => 'radio41']) !!} {!! Form::label('radio41', 'Not applicable') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'>Other (Please specify) :</td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[22]' value='{{ $data[22] }}'/>
    @else
      <span class='response'>{{ $data[22] }}</span>
    @endif
  </td>
</tr>

<tr>
  @if ($edit)
    <td>{!! Form::radio('data[23]', 'Very clear', false, ['id' => 'radio42']) !!} {!! Form::label('radio42', 'Very clear') !!}</td>
    <td>{!! Form::radio('data[23]', 'Somewhat clear', false, ['id' => 'radio43']) !!} {!! Form::label('radio43', 'Somewhat clear') !!}</td>
    <td>{!! Form::radio('data[23]', 'Not clear', false, ['id' => 'radio44']) !!} {!! Form::label('radio44', 'Not clear') !!}</td>
    <td>{!! Form::radio('data[23]', 'Not applicable', false, ['id' => 'radio45']) !!} {!! Form::label('radio45', 'Not applicable') !!}</td>
  @else
    <td colspan='2'></td>
    <td>{{ $data[23] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'>
    <b>6. a) Wherether were visits or events outside of class that formed part of this course ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[24] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[24]', 'Yes', false, ['id' => 'radio46']) !!} {!! Form::label('radio46', 'Yes') !!}</td>
    <td>{!! Form::radio('data[24]', 'No', false, ['id' => 'radio47']) !!} {!! Form::label('radio47', 'No') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px; padding-top:20px;'><b>b) Did you attend all of them</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[25] }}</td>
  @endif
</tr>

<tr>
  @if ($edit)
    <td>{!! Form::radio('data[25]', 'Not applicable', false, ['id' => 'radio48']) !!} {!! Form::label('radio48', 'Not applicable') !!}</td>
    <td>{!! Form::radio('data[25]', 'Yes', false, ['id' => 'radio49']) !!} {!! Form::label('radio49', 'Yes') !!}</td>
    <td>{!! Form::radio('data[25]', 'No', false, ['id' => 'radio50']) !!} {!! Form::label('radio50', 'No') !!}</td>
    <td><b>If not, why not ?</b></td>
  @else
    <td colspan='4'><b>If not, why not ?</b></td>
  @endif
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[26]'>{{ $data[26] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[26])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>7. Please comment on the nature/quality of the teaching in this course</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Ability to explain difficult material</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[27] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[27]', 'Excellent', false, ['id' => 'radio51']) !!} {!! Form::label('radio51', 'Excellent') !!}</td>
    <td>{!! Form::radio('data[27]', 'Good', false, ['id' => 'radio52']) !!} {!! Form::label('radio52', 'Good') !!}</td>
    <td>{!! Form::radio('data[27]', 'Fair', false, ['id' => 'radio53']) !!} {!! Form::label('radio53', 'Fair') !!}</td>
    <td>{!! Form::radio('data[27]', 'Rarely able', false, ['id' => 'radio54']) !!} {!! Form::label('radio54', 'Rarely able') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px; padding-top:20px;'><b>b) Organization</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[28] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[28]', 'Excellent', false, ['id' => 'radio55']) !!} {!! Form::label('radio55', 'Excellent') !!}</td>
    <td>{!! Form::radio('data[28]', 'Good', false, ['id' => 'radio56']) !!} {!! Form::label('radio56', 'Good') !!}</td>
    <td>{!! Form::radio('data[28]', 'Fair', false, ['id' => 'radio57']) !!} {!! Form::label('radio57', 'Fair') !!}</td>
    <td>{!! Form::radio('data[28]', 'Not organized', false, ['id' => 'radio58']) !!} {!! Form::label('radio58', 'Not organized') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px; padding-top:20px;'><b>c) Openess to student's remarks</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[29] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[29]', 'Always open', false, ['id' => 'radio59']) !!} {!! Form::label('radio59', 'Always open') !!}</td>
    <td>{!! Form::radio('data[29]', 'Open sometimes', false, ['id' => 'radio60']) !!} {!! Form::label('radio60', 'Open sometimes') !!}</td>
    <td>{!! Form::radio('data[29]', 'Rarely open', false, ['id' => 'radio61']) !!} {!! Form::label('radio61', 'Rarely open') !!}</td>
    <td>{!! Form::radio('data[29]', 'Never open', false, ['id' => 'radio62']) !!} {!! Form::label('radio62', 'Never open') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px; padding-top:20px;'><b>d) Fairness</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[30] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[30]', 'Always fair', false, ['id' => 'radio63']) !!} {!! Form::label('radio63', 'Always fair') !!}</td>
    <td>{!! Form::radio('data[30]', 'Mostly fair', false, ['id' => 'radio64']) !!} {!! Form::label('radio64', 'Mostly fair') !!}</td>
    <td>{!! Form::radio('data[30]', 'Fair sometimes', false, ['id' => 'radio65']) !!} {!! Form::label('radio65', 'Fair sometimes') !!}</td>
    <td>{!! Form::radio('data[30]', 'Never fair', false, ['id' => 'radio66']) !!} {!! Form::label('radio66', 'Never fair') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-left:30px; padding-top:20px;'>
    <b>e) Comments and suggestions on papers or exposés</b>
    @if (!$edit)
      <span class='response'>{{ $data[31] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[31]', 'Extremely helpful', false, ['id' => 'radio67']) !!} {!! Form::label('radio67', 'Extremely helpful') !!}</td>
    <td>{!! Form::radio('data[31]', 'Very helpful', false, ['id' => 'radio68']) !!} {!! Form::label('radio68', 'Very helpful') !!}</td>
    <td>{!! Form::radio('data[31]', 'Not helpful', false, ['id' => 'radio69']) !!} {!! Form::label('radio69', 'Not helpful') !!}</td>
    <td>{!! Form::radio('data[31]', 'Does not give comments', false, ['id' => 'radio70']) !!} {!! Form::label('radio70', 'Does not give comments') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px; padding-top:20px;'><b>f) Encouragement to learn more</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[32] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[32]', 'Very encouraging', false, ['id' => 'radio71']) !!} {!! Form::label('radio71', 'Very encouraging') !!}</td>
    <td>{!! Form::radio('data[32]', 'Encouraging', false, ['id' => 'radio72']) !!} {!! Form::label('radio72', 'Encouraging') !!}</td>
    <td>{!! Form::radio('data[32]', 'Not encouraging', false, ['id' => 'radio73']) !!} {!! Form::label('radio73', 'Not encouraging') !!}</td>
    <td>{!! Form::radio('data[32]', 'Does not give any', false, ['id' => 'radio74']) !!} {!! Form::label('radio74', 'Does not give any') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>8. Assignments.</b> Please list the written and oral work you were assigned in this course</td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[33]'>{{ $data[33] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[33])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>9. Were the assignments effective for archieving the stated goals of the course ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[34] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td>{!! Form::radio('data[34]', 'Absolutely', false, ['id' => 'radio75']) !!} {!! Form::label('radio75', 'Absolutely') !!}</td>
    <td>{!! Form::radio('data[34]', 'Mostly', false, ['id' => 'radio76']) !!} {!! Form::label('radio76', 'Mostly') !!}</td>
    <td>{!! Form::radio('data[34]', 'Somewhat', false, ['id' => 'radio77']) !!} {!! Form::label('radio77', 'Somewhat') !!}</td>
    <td>{!! Form::radio('data[34]', 'Not effective', false, ['id' => 'radio78']) !!} {!! Form::label('radio78', 'Not effective') !!}</td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>Comments :</b></td>
</tr>

<tr>
  <td colspan='4'>
  @if ($edit)
    <textarea name='data[35]'>{{ $data[35] }}</textarea>
  @else
    <span class='response'>{!! nl2br(e($data[35])) !!}</span>
  @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>10. Please share any other observation or comments you would like to make, including on the content of the course and its organization</b> (Amount of work, class meetings, content of, and approach to, the materials studied ...)
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[36]'>{{ $data[36] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[36])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>MERCI BEAUCOUP !</td>
</tr>

<tr>
  <td colspan='2'><b>Your Name (optional) :</td>
  @if ($edit)
    <td colspan='2'><input type='text' autocomplete='off' name='data[37]' value='{{ $data[37] }}' /></td>
  @else
    <td class='response' colspan='2'>{{ $data[37] }}</td>
  @endif
</tr>

@endsection
