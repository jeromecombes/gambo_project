@extends('evaluations.layout')
@section('evaluation_form')

@if ($edit)
  <tr>
    <td colspan='4' style='padding-top:20px;text-align:justify;'>
      <i>This form will be shared with your instructor. It is also intended for VWPP to evaluate the work of the program's instructors. We would appreciate a thoughtful response.</i>
    </td>
  </tr>
@endif

<tr>
  <td style='padding-top:20px;'><b>Course Name :</b></td>
  <td colspan='3' style='padding-top:20px;color:blue; font-weight:bold;'>
    <input type='hidden' name='data[1]' value='{{ $data[1] }}' />
    {{ $data[1] }}
  </td>
</tr>

<tr>
  <td style='padding-top:20px;'><b>Insctructor :</b></td>
  <td colspan='3' style='padding-top:20px;color:blue; font-weight:bold;'>
    <input type='hidden' name='data[2]' value='{{ $data[2] }}' />
    {{ $data[2] }}
  </td>
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'><b>1. How would you describe your efforts in this course ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[3] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[3]' id='radio1' value='Strenuous' @if ($data[3] == 'Strenuous') checked='checked' @endif /><label for='radio1'>Strenuous</label></td>
    <td><input type='radio' name='data[3]' id='radio2' value='Fairly strenuous' @if ($data[3] == 'Fairly strenuous') checked='checked' @endif /><label for='radio2'>Fairly strenuous</label></td>
    <td><input type='radio' name='data[3]' id='radio3' value='Moderate' @if ($data[3] == 'Moderate') checked='checked' @endif /><label for='radio3'>Moderate</label></td>
    <td><input type='radio' name='data[3]' id='radio4' value='Light' @if ($data[3] == 'Light') checked='checked' @endif /><label for='radio4'>Light</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>2. Do you think your French was at a level that allowed you to understand and take notes ?</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) At the begining :</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[4] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[4]' id='radio5' value='Comfortably' @if ($data[4] == 'Comfortably') checked='checked' @endif /><label for='radio5'>Comfortably</label></td>
    <td><input type='radio' name='data[4]' id='radio6' value='With some difficulty' @if ($data[4] == 'With some difficulty') checked='checked' @endif /><label for='radio6'>With some difficulty</label></td>
    <td><input type='radio' name='data[4]' id='radio7' value='With considerable difficulty' @if ($data[4] == 'With considerable difficulty') checked='checked' @endif /><label for='radio7'>With considerable difficulty</label></td>
    <td><input type='radio' name='data[4]' id='radio8' value='Not applicable' @if ($data[4] == 'Not applicable') checked='checked' @endif /><label for='radio8'>Not applicable</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) After half-term :</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[5] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[5]' id='radio9' value='Comfortably' @if ($data[5] == 'Comfortably') checked='checked' @endif /><label for='radio9'>Comfortably</label></td>
    <td><input type='radio' name='data[5]' id='radio10' value='With some difficulty' @if ($data[5] == 'With some difficulty') checked='checked' @endif /><label for='radio10'>With some difficulty</label></td>
    <td><input type='radio' name='data[5]' id='radio11' value='With considerable difficulty' @if ($data[5] == 'With considerable difficulty') checked='checked' @endif /><label for='radio11'>With considerable difficulty</label></td>
    <td><input type='radio' name='data[5]' id='radio12' value='Not applicable' @if ($data[5] == 'Not applicable') checked='checked' @endif /><label for='radio12'>Not applicable</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-top:20px;' ><b>3) Did you attend every class at the University ?</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[6] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[6]' id='radio13' value='Yes' @if ($data[6] == 'Yes') checked='checked' @endif /><label for='radio13'>Yes</label></td>
    <td><input type='radio' name='data[6]' id='radio14' value='No' @if ($data[6] == 'No') checked='checked' @endif /><label for='radio14'>No</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' ><b>If not, why not ?</b></td>
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
  <td colspan='4' style='padding-top:20px;' ><b>4) Please evaluate your own work in the course. Did you :</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Keep up with assigned reading ?</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[8] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[8]' id='radio15' value='Almost always' @if ($data[8] == 'Almost always') checked='checked' @endif /><label for='radio15'>Almost always</label></td>
    <td><input type='radio' name='data[8]' id='radio16' value='Most of the time' @if ($data[8] == 'Most of the time') checked='checked' @endif /><label for='radio16'>Most of the time</label></td>
    <td><input type='radio' name='data[8]' id='radio17' value='Some of the time' @if ($data[8] == 'Some of the time') checked='checked' @endif /><label for='radio17'>Some of the time</label></td>
    <td><input type='radio' name='data[8]' id='radio18' value='Almost never/never' @if ($data[8] == 'Almost never/never') checked='checked' @endif /><label for='radio18'>Almost never/never</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' ><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[9]'>{{ $data[9] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[9])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) Contribute to in-class discussion ?</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[10] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[10]' id='radio19' value='Almost always' @if ($data[10] == 'Almost always') checked='checked' @endif /><label for='radio19'>Almost always</label></td>
    <td><input type='radio' name='data[10]' id='radio20' value='Most of the time' @if ($data[10] == 'Most of the time') checked='checked' @endif /><label for='radio20'>Most of the time</label></td>
    <td><input type='radio' name='data[10]' id='radio21' value='Some of the time' @if ($data[10] == 'Some of the time') checked='checked' @endif /><label for='radio21'>Some of the time</label></td>
    <td><input type='radio' name='data[10]' id='radio22' value='Almost never/never' @if ($data[10] == 'Almost never/never') checked='checked' @endif /><label for='radio22'>Almost never/never</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' ><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[11]'>{{ $data[11] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[11])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>c) Raise questions ?</b></td>
  @if (!$edit)
    <td class='response'>{{ $data[12] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[12]' id='radio23' value='Almost always' @if ($data[12] == 'Almost always') checked='checked' @endif /><label for='radio23'>Almost always</label></td>
    <td><input type='radio' name='data[12]' id='radio24' value='Most of the time' @if ($data[12] == 'Most of the time') checked='checked' @endif /><label for='radio24'>Most of the time</label></td>
    <td><input type='radio' name='data[12]' id='radio25' value='Some of the time' @if ($data[12] == 'Some of the time') checked='checked' @endif /><label for='radio25'>Some of the time</label></td>
    <td><input type='radio' name='data[12]' id='radio26' value='Almost never/never' @if ($data[12] == 'Almost never/never') checked='checked' @endif /><label for='radio26'>Almost never/never</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' ><b>If not, why not ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[13]'>{{ $data[13] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[13])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='text-align:justify;'><b>5) Did you have a clear understanding of what was expected from you in this course for the following :</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'>Readings :</td>
  @if (!$edit)
    <td class='response'>{{ $data[14] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[14]' id='radio27' value='Very clear' @if ($data[14] == 'Very clear') checked='checked' @endif /><label for='radio27'>Very clear</label></td>
    <td><input type='radio' name='data[14]' id='radio28' value='Somewhat clear' @if ($data[14] == 'Somewhat clear') checked='checked' @endif /><label for='radio28'>Somewhat clear</label></td>
    <td><input type='radio' name='data[14]' id='radio29' value='Not clear' @if ($data[14] == 'Not clear') checked='checked' @endif /><label for='radio29'>Not clear</label></td>
    <td><input type='radio' name='data[14]' id='radio30' value='Not applicable' @if ($data[14] == 'Not applicable') checked='checked' @endif /><label for='radio30'>Not applicable</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;padding-top:20px;'>Written work :</td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[15] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[15]' id='radio31' value='Very clear' @if ($data[15] == 'Very clear') checked='checked' @endif /><label for='radio31'>Very clear</label></td>
    <td><input type='radio' name='data[15]' id='radio32' value='Somewhat clear' @if ($data[15] == 'Somewhat clear') checked='checked' @endif /><label for='radio32'>Somewhat clear</label></td>
    <td><input type='radio' name='data[15]' id='radio33' value='Not clear' @if ($data[15] == 'Not clear') checked='checked' @endif /><label for='radio33'>Not clear</label></td>
    <td><input type='radio' name='data[15]' id='radio34' value='Not applicable' @if ($data[15] == 'Not applicable') checked='checked' @endif /><label for='radio34'>Not applicable</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;padding-top:20px;'>Oral presentation :</td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[16] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[16]' id='radio35' value='Very clear' @if ($data[16] == 'Very clear') checked='checked' @endif /><label for='radio35'>Very clear</label></td>
    <td><input type='radio' name='data[16]' id='radio36' value='Somewhat clear' @if ($data[16] == 'Somewhat clear') checked='checked' @endif /><label for='radio36'>Somewhat clear</label></td>
    <td><input type='radio' name='data[16]' id='radio37' value='Not clear' @if ($data[16] == 'Not clear') checked='checked' @endif /><label for='radio37'>Not clear</label></td>
    <td><input type='radio' name='data[16]' id='radio38' value='Not applicable' @if ($data[16] == 'Not applicable') checked='checked' @endif /><label for='radio38'>Not applicable</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;padding-top:20px;'>Other (Please specify)</td>
  <td style='padding-top:20px;'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[17]' value='{{ $data[17] }}'/>
    @else
      <span class='response'>{{ $data[17] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[18]' id='radio39' value='Very clear' @if ($data[18] == 'Very clear') checked='checked' @endif /><label for='radio39'>Very clear</label></td>
    <td><input type='radio' name='data[18]' id='radio40' value='Somewhat clear' @if ($data[18] == 'Somewhat clear') checked='checked' @endif /><label for='radio40'>Somewhat clear</label></td>
    <td><input type='radio' name='data[18]' id='radio41' value='Not clear' @if ($data[18] == 'Not clear') checked='checked' @endif /><label for='radio41'>Not clear</label></td>
    <td><input type='radio' name='data[18]' id='radio42' value='Not applicable' @if ($data[18] == 'Not applicable') checked='checked' @endif /><label for='radio42'>Not applicable</label></td>
  </tr>
@else
  <tr>
    <td colspan='2'></td>
    <td class='response'>{{ $data[18] }}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>6.a) Where there visits or events outside of class that formed part of this course ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[19] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[19]' id='radio43' value='Yes' @if ($data[19] == 'Yes') checked='checked' @endif /><label for='radio43'>Yes</label></td>
    <td><input type='radio' name='data[19]' id='radio44' value='No' @if ($data[19] == 'No') checked='checked' @endif /><label for='radio44'>No</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-top:20px;padding-left:30px;'><b>b) Did you attend all of them ?</b></td>
  @if (!$edit)
    <td style='padding-top:20px;' class='response'>{{ $data[20] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[20]' id='radio45' value='Not applicable' @if ($data[20] == 'Not applicable') checked='checked' @endif /><label for='radio45'>Not applicable</label></td>
    <td><input type='radio' name='data[20]' id='radio46' value='Yes' @if ($data[20] == 'Yes') checked='checked' @endif /><label for='radio46'>Yes</label></td>
    <td><input type='radio' name='data[20]' id='radio47' value='No' @if ($data[20] == 'No') checked='checked' @endif /><label for='radio47'>No</label></td>
    <td><b>If not, why not</b></td>
  </tr>
@else
  <tr>
    <td colspan='4' style='color:black;'><b>If not, why not</b></td>
  </tr>
@endif

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[21]'>{{ $data[21] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[21])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='text-align:justify;'><b>7. Please comment on the nature/quality of the teaching in this course</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Ability to explain difficult material</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[22] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[22]' id='radio48' value='Excellent' @if ($data[22] == 'Excellent') checked='checked' @endif /><label for='radio48'>Excellent</label></td>
    <td><input type='radio' name='data[22]' id='radio49' value='Good' @if ($data[22] == 'Good') checked='checked' @endif /><label for='radio49'>Good</label></td>
    <td><input type='radio' name='data[22]' id='radio50' value='Fair' @if ($data[22] == 'Fair') checked='checked' @endif /><label for='radio50'>Fair</label></td>
    <td><input type='radio' name='data[22]' id='radio51' value='Rarely able' @if ($data[22] == 'Rarely able') checked='checked' @endif /><label for='radio51'>Rarely able</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) Organization</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[23] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[23]' id='radio52' value='Excellent' @if ($data[23] == 'Excellent') checked='checked' @endif /><label for='radio52'>Excellent</label></td>
    <td><input type='radio' name='data[23]' id='radio53' value='Good' @if ($data[23] == 'Good') checked='checked' @endif /><label for='radio53'>Good</label></td>
    <td><input type='radio' name='data[23]' id='radio54' value='Fair' @if ($data[23] == 'Fair') checked='checked' @endif /><label for='radio54'>Fair</label></td>
    <td><input type='radio' name='data[23]' id='radio55' value='Not organized' @if ($data[23] == 'Not organized') checked='checked' @endif /><label for='radio55'>Not organized</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>c) Openness to student's remarks</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[24] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[24]' id='radio56' value='Always open' @if ($data[24] == 'Always open') checked='checked' @endif /><label for='radio56'>Always open</label></td>
    <td><input type='radio' name='data[24]' id='radio57' value='Open sometimes' @if ($data[24] == 'Open sometimes') checked='checked' @endif /><label for='radio57'>Open sometimes</label></td>
    <td><input type='radio' name='data[24]' id='radio58' value='Rarely open' @if ($data[24] == 'Rarely open') checked='checked' @endif /><label for='radio58'>Rarely open</label></td>
    <td><input type='radio' name='data[24]' id='radio59' value='Never open' @if ($data[24] == 'Never open') checked='checked' @endif /><label for='radio59'>Never open</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>d) Fairness</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[25] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[25]' id='radio60' value='Always fair' @if ($data[25] == 'Always fair') checked='checked' @endif /><label for='radio60'>Always fair</label></td>
    <td><input type='radio' name='data[25]' id='radio61' value='Mostly fair' @if ($data[25] == 'Mostly fair') checked='checked' @endif /><label for='radio61'>Mostly fair</label></td>
    <td><input type='radio' name='data[25]' id='radio62' value='Fair sometimes' @if ($data[25] == 'Fair sometimes') checked='checked' @endif /><label for='radio62'>Fair sometimes</label></td>
    <td><input type='radio' name='data[25]' id='radio63' value='Never fair' @if ($data[25] == 'Never fair') checked='checked' @endif /><label for='radio63'>Never fair</label></td>
  </tr>
@endif

<tr>
  <td colspan='3' style='padding-left:30px;'><b>e) Comments and suggestions on papers or exposés</b>
    @if (!$edit)
      <span class='response'>{{ $data[26] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[26]' id='radio64' value='Extremely helpful' @if ($data[26] == 'Extremely helpful') checked='checked' @endif /><label for='radio64'>Extremely helpful</label></td>
    <td><input type='radio' name='data[26]' id='radio65' value='Very helpful' @if ($data[26] == 'Very helpful') checked='checked' @endif /><label for='radio65'>Very helpful</label></td>
    <td><input type='radio' name='data[26]' id='radio66' value='Not helpful' @if ($data[26] == 'Not helpful') checked='checked' @endif /><label for='radio66'>Not helpful</label></td>
    <td><input type='radio' name='data[26]' id='radio67' value='Does not give comments' @if ($data[26] == 'Does not give comments') checked='checked' @endif /><label for='radio67'>Does not give comments</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>f) Encouragement to learn more</b></td>
  @if (!$edit)
    <td colspan='2' class='response'>{{ $data[27] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[27]' id='radio68' value='Very encouraging' @if ($data[27] == 'Very encouraging') checked='checked' @endif /><label for='radio68'>Very encouraging</label></td>
    <td><input type='radio' name='data[27]' id='radio69' value='Encouraging' @if ($data[27] == 'Encouraging') checked='checked' @endif /><label for='radio69'>Encouraging</label></td>
    <td><input type='radio' name='data[27]' id='radio70' value='Not encouraging' @if ($data[27] == 'Not encouraging') checked='checked' @endif /><label for='radio70'>Not encouraging</label></td>
    <td><input type='radio' name='data[27]' id='radio71' value='Does not give any' @if ($data[27] == 'Does not give any') checked='checked' @endif /><label for='radio71'>Does not give any</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='text-align:justify;padding-top:20px;'><b>8. Assignments.</b> Please list the written and oral work you were assigned in this course</td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[28]'>{{ $data[28] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[28])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='text-align:justify;'><b>9. Were the assignments effective for archieving the stated goals of the course ?
    @if (!$edit)
      <span class='response'>{{ $data[29] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[29]' id='radio72' value='Absolutely' @if ($data[29] == 'Absolutely') checked='checked' @endif /><label for='radio72'>Absolutely</label></td>
    <td><input type='radio' name='data[29]' id='radio73' value='Mostly' @if ($data[29] == 'Mostly') checked='checked' @endif /><label for='radio73'>Mostly</label></td>
    <td><input type='radio' name='data[29]' id='radio74' value='Somewhat' @if ($data[29] == 'Somewhat') checked='checked' @endif /><label for='radio74'>Somewhat</label></td>
    <td><input type='radio' name='data[29]' id='radio75' value='Not effective' @if ($data[29] == 'Not effective') checked='checked' @endif /><label for='radio75'>Not effective</label></td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>Comments :</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[30]'>{{ $data[30] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[30])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='text-align:justify;'><b>10. Please share any other observations or comments you would like to make, including on the content of the course and its organization</b> (Amount of work, class meetings, content of, and approach to, the materials studied ...)</td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[31]'>{{ $data[31] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[31])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>MERCI BEAUCOUP !</b></td>
</tr>

<tr>
  <td colspan='2'><b>Your name (optional) :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[32]' value='{{ $data[32] }}'/>
    @else
      <span class='response'>{{ $data[32] }}</span>
    @endif
  </td>
</tr>

@endsection
