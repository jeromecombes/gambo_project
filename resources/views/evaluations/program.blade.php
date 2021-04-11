@extends('evaluations.layout')
@section('evaluation_form')

<tr>
  <td colspan='4'>
    <b>I. BENEFITS</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>1) What do you see as the main benefits you derived from your semester in France ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[1]'>{{ $data[1] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[1])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>2) In retrospect, is there anything you would have done differently ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[2]'>{{ $data[2] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[2])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>II. UNIVERSITY COURSES</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>3) What did you learn about the French university by taking a course in the French system ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[3]'>{{ $data[3] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[3])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>4) What was the most positive aspect taking a course in the French university for you personally ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[4]'>{{ $data[4] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[4])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>III. LANGUAGE SKILS.</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>5) About what percentage of the time did you speak French in your interactions with people ?</b>
  </td>
</tr>

<tr>
  @if ($edit)
    <td><input type='radio' name='data[5]' id='radio1' value='More than 80%' @if ($data[5] == 'More than 80%') checked='checked' @endif /><label for='radio1'>More than 80%</label></td>
    <td><input type='radio' name='data[5]' id='radio2' value='70-80%' @if ($data[5] == '70-80%') checked='checked' @endif /><label for='radio2'>70-80%</label></td>
    <td><input type='radio' name='data[5]' id='radio3' value='50-70%' @if ($data[5] == '50-70%') checked='checked' @endif /><label for='radio3'>50-70%</label></td>
    <td><input type='radio' name='data[5]' id='radio4' value='Less than 50%' @if ($data[5] == 'Less than 50%') checked='checked' @endif /><label for='radio4'>Less than 50%</label><br/><br/></td>
  @else
    <td colspan='2'></td>
    <td colspan='2' class='response' >{{ $data[5] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'><b>6) In which aspects of your French have noticed the most significant improvement ?</b>
  </td>
</tr>

<tr>
  @if ($edit)
    <td><input type='radio' name='data[6]' id='radio5' value='Comprehension' @if ($data[6] == 'Comprehension') checked='checked' @endif /><label for='radio5'>Comprehension</label></td>
    <td><input type='radio' name='data[6]' id='radio6' value='Speaking' @if ($data[6] == 'Speaking') checked='checked' @endif /><label for='radio6'>Speaking</label></td>
    <td><input type='radio' name='data[6]' id='radio7' value='Reading' @if ($data[6] == 'Reading') checked='checked' @endif /><label for='radio7'>Reading</label></td>
    <td><input type='radio' name='data[6]' id='radio8' value='Writing' @if ($data[6] == 'Writing') checked='checked' @endif /><label for='radio8'>Writing</label><br/><br/></td>
  @else
    <td colspan='2'></td>
    <td colspan='2' class='response' >{{ $data[6] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'>
    <b>To what factors do you attribute the improvements ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[7]'>{{ $data[7] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[7])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>IV. INTERACTIONS WITH ADMINISTRATION</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>7) Did you solicit help from Program administrators for </b>
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Practical matters ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[8] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[8]' id='radio9' value='Often' @if ($data[8] == 'Often') checked='checked' @endif /><label for='radio9'>Often</label></td>
    <td><input type='radio' name='data[8]' id='radio10' value='Sometimes' @if ($data[8] == 'Sometimes') checked='checked' @endif /><label for='radio10'>Sometimes</label></td>
    <td><input type='radio' name='data[8]' id='radio11' value='Rarely' @if ($data[8] == 'Rarely') checked='checked' @endif /><label for='radio11'>Rarely</label></td>
    <td><input type='radio' name='data[8]' id='radio12' value='Never' @if ($data[8] == 'Never') checked='checked' @endif /><label for='radio12'>Never</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) Extra-curricular activities ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[9] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[9]' id='radio13' value='Often' @if ($data[9] == 'Often') checked='checked' @endif /><label for='radio13'>Often</label></td>
    <td><input type='radio' name='data[9]' id='radio14' value='Sometimes' @if ($data[9] == 'Sometimes') checked='checked' @endif /><label for='radio14'>Sometimes</label></td>
    <td><input type='radio' name='data[9]' id='radio15' value='Rarely' @if ($data[9] == 'Rarely') checked='checked' @endif /><label for='radio15'>Rarely</label></td>
    <td><input type='radio' name='data[9]' id='radio16' value='Never' @if ($data[9] == 'Never') checked='checked' @endif /><label for='radio16'>Never</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>c) Social interactions ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[10] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[10]' id='radio17' value='Often' @if ($data[10] == 'Often') checked='checked' @endif /><label for='radio17'>Often</label></td>
    <td><input type='radio' name='data[10]' id='radio18' value='Sometimes' @if ($data[10] == 'Sometimes') checked='checked' @endif /><label for='radio18'>Sometimes</label></td>
    <td><input type='radio' name='data[10]' id='radio19' value='Rarely' @if ($data[10] == 'Rarely') checked='checked' @endif /><label for='radio19'>Rarely</label></td>
    <td><input type='radio' name='data[10]' id='radio20' value='Never' @if ($data[10] == 'Never') checked='checked' @endif /><label for='radio20'>Never</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>d) Academic issues ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[11] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[11]' id='radio21' value='Often' @if ($data[11] == 'Often') checked='checked' @endif /><label for='radio21'>Often</label></td>
    <td><input type='radio' name='data[11]' id='radio22' value='Sometimes' @if ($data[11] == 'Sometimes') checked='checked' @endif /><label for='radio22'>Sometimes</label></td>
    <td><input type='radio' name='data[11]' id='radio23' value='Rarely' @if ($data[11] == 'Rarely') checked='checked' @endif /><label for='radio23'>Rarely</label></td>
    <td><input type='radio' name='data[11]' id='radio24' value='Never' @if ($data[11] == 'Never') checked='checked' @endif /><label for='radio24'>Never</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>e) Housing matters ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[12] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[12]' id='radio25' value='Often' @if ($data[12] == 'Often') checked='checked' @endif /><label for='radio25'>Often</label></td>
    <td><input type='radio' name='data[12]' id='radio26' value='Sometimes' @if ($data[12] == 'Sometimes') checked='checked' @endif /><label for='radio26'>Sometimes</label></td>
    <td><input type='radio' name='data[12]' id='radio27' value='Rarely' @if ($data[12] == 'Rarely') checked='checked' @endif /><label for='radio27'>Rarely</label></td>
    <td><input type='radio' name='data[12]' id='radio28' value='Never' @if ($data[12] == 'Never') checked='checked' @endif /><label for='radio28'>Never</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>8) In general, how helpful was the advicegiven to you for</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>a) Practical matters ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[13] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[13]' id='radio29' value='Very helpful' @if ($data[13] == 'Very helpful') checked='checked' @endif /><label for='radio29'>Very helpful</label></td>
    <td><input type='radio' name='data[13]' id='radio30' value='Helpful' @if ($data[13] == 'Helpful') checked='checked' @endif /><label for='radio30'>Helpful</label></td>
    <td><input type='radio' name='data[13]' id='radio31' value='Not helpful' @if ($data[13] == 'Not helpful') checked='checked' @endif /><label for='radio31'>Not helpful</label></td>
    <td><input type='radio' name='data[13]' id='radio32' value='Not applicable' @if ($data[13] == 'Not applicable') checked='checked' @endif /><label for='radio32'>Not applicable</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>b) Extra-curricular activities ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[14] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[14]' id='radio33' value='Very helpful' @if ($data[14] == 'Very helpful') checked='checked' @endif /><label for='radio33'>Very helpful</label></td>
    <td><input type='radio' name='data[14]' id='radio34' value='Helpful' @if ($data[14] == 'Helpful') checked='checked' @endif /><label for='radio34'>Helpful</label></td>
    <td><input type='radio' name='data[14]' id='radio35' value='Not helpful' @if ($data[14] == 'Not helpful') checked='checked' @endif /><label for='radio35'>Not helpful</label></td>
    <td><input type='radio' name='data[14]' id='radio36' value='Not applicable' @if ($data[14] == 'Not applicable') checked='checked' @endif /><label for='radio36'>Not applicable</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>c) Social interactions ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[15] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[15]' id='radio37' value='Very helpful' @if ($data[15] == 'Very helpful') checked='checked' @endif /><label for='radio37'>Very helpful</label></td>
    <td><input type='radio' name='data[15]' id='radio38' value='Helpful' @if ($data[15] == 'Helpful') checked='checked' @endif /><label for='radio38'>Helpful</label></td>
    <td><input type='radio' name='data[15]' id='radio39' value='Not helpful' @if ($data[15] == 'Not helpful') checked='checked' @endif /><label for='radio39'>Not helpful</label></td>
    <td><input type='radio' name='data[15]' id='radio40' value='Not applicable' @if ($data[15] == 'Not applicable') checked='checked' @endif /><label for='radio40'>Not applicable</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>d) Academic issues ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[16] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[16]' id='radio41' value='Very helpful' @if ($data[16] == 'Very helpful') checked='checked' @endif /><label for='radio41'>Very helpful</label></td>
    <td><input type='radio' name='data[16]' id='radio42' value='Helpful' @if ($data[16] == 'Helpful') checked='checked' @endif /><label for='radio42'>Helpful</label></td>
    <td><input type='radio' name='data[16]' id='radio43' value='Not helpful' @if ($data[16] == 'Not helpful') checked='checked' @endif /><label for='radio43'>Not helpful</label></td>
    <td><input type='radio' name='data[16]' id='radio44' value='Not applicable' @if ($data[16] == 'Not applicable') checked='checked' @endif /><label for='radio44'>Not applicable</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>e) Housing matters ?</b></td>
  @if (!$edit)
    <td colspan='2' class='response' >{{ $data[17] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[17]' id='radio45' value='Very helpful' @if ($data[17] == 'Very helpful') checked='checked' @endif /><label for='radio45'>Very helpful</label></td>
    <td><input type='radio' name='data[17]' id='radio46' value='Helpful' @if ($data[17] == 'Helpful') checked='checked' @endif /><label for='radio46'>Helpful</label></td>
    <td><input type='radio' name='data[17]' id='radio47' value='Not helpful' @if ($data[17] == 'Not helpful') checked='checked' @endif /><label for='radio47'>Not helpful</label></td>
    <td><input type='radio' name='data[17]' id='radio48' value='Not applicable' @if ($data[17] == 'Not applicable') checked='checked' @endif /><label for='radio48'>Not applicable</label><br/><br/></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>Comments (optional) :</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[18]'>{{ $data[18] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[18])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>V. SOCIAL, CULTURAL ACTIVITIES AND EXCURSIONS SPONSORED BY THE PROGRAM</b></td>
</tr>

<tr>
  <td colspan='4'>
    <b>9) a) Which of the following cultural activities sponsored by theprogram did you participate in ?</b></td>
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Excursions outside of Paris</b></td>
  @if ($edit)
    <td><input type='radio' name='data[19]' id='radio49' value='Yes' @if ($data[19] == 'Yes') checked='checked' @endif /><label for='radio49'>Yes</label></td>
    <td><input type='radio' name='data[19]' id='radio50' value='No' @if ($data[19] == 'No') checked='checked' @endif /><label for='radio50'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[19] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4' style='padding-left:30px;'><b>Extracurricular Visits in Paris (Croisière sur la seine, Louvre etc.)</b>
    @if (!$edit)
      <span class='response' >{{ $data[20] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td colspan='2'></td>
    <td><input type='radio' name='data[20]' id='radio51' value='Yes' @if ($data[20] == 'Yes') checked='checked' @endif /><label for='radio51'>Yes</label></td>
    <td><input type='radio' name='data[20]' id='radio52' value='No' @if ($data[20] == 'No') checked='checked' @endif /><label for='radio52'>No</label></td>
  </tr>
@endif

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Cooking Classes / Cheese tasting</b></td>
  @if ($edit)
    <td><input type='radio' name='data[21]' id='radio53' value='Yes' @if ($data[21] == 'Yes') checked='checked' @endif /><label for='radio53'>Yes</label></td>
    <td><input type='radio' name='data[21]' id='radio54' value='No' @if ($data[21] == 'No') checked='checked' @endif /><label for='radio54'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[21] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Lunches at the Lycée Hôtelier</b></td>
  @if ($edit)
    <td><input type='radio' name='data[22]' id='radio55' value='Yes' @if ($data[22] == 'Yes') checked='checked' @endif /><label for='radio55'>Yes</label></td>
    <td><input type='radio' name='data[22]' id='radio56' value='No' @if ($data[22] == 'No') checked='checked' @endif /><label for='radio56'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[22] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Receptions</b></td>
  @if ($edit)
    <td><input type='radio' name='data[23]' id='radio57' value='Yes' @if ($data[23] == 'Yes') checked='checked' @endif /><label for='radio57'>Yes</label></td>
    <td><input type='radio' name='data[23]' id='radio58' value='No' @if ($data[23] == 'No') checked='checked' @endif /><label for='radio58'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[23] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Opera</b>
  </td>
  @if ($edit)
    <td><input type='radio' name='data[24]' id='radio59' value='Yes' @if ($data[24] == 'Yes') checked='checked' @endif /><label for='radio59'>Yes</label></td>
    <td><input type='radio' name='data[24]' id='radio60' value='No' @if ($data[24] == 'No') checked='checked' @endif /><label for='radio60'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[24] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Theatre</b>
  </td>
  @if ($edit)
    <td><input type='radio' name='data[25]' id='radio61' value='Yes' @if ($data[25] == 'Yes') checked='checked' @endif /><label for='radio61'>Yes</label></td>
    <td><input type='radio' name='data[25]' id='radio62' value='No' @if ($data[25] == 'No') checked='checked' @endif /><label for='radio62'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[25] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2' style='padding-left:30px;'><b>Dance / Ballet</b>
  </td>
  @if ($edit)
    <td><input type='radio' name='data[26]' id='radio63' value='Yes' @if ($data[26] == 'Yes') checked='checked' @endif /><label for='radio63'>Yes</label></td>
    <td><input type='radio' name='data[26]' id='radio64' value='No' @if ($data[26] == 'No') checked='checked' @endif /><label for='radio64'>No</label></td>
  @else
    <td colspan='2' class='response' >{{ $data[26] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'>
    <b>b) Which of these were the most memorable / rewarding ? Why did you find them so ?</b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[27]'>{{ $data[27] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[27])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>PROGRAM SPONSORED ACTIVITIES THAT PUT YOU IN TOUCH WITH FRENCH PEOPLE : </b>
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>10) Did you participate in any CIJP Excursions and/or activities ?</b>
    @if (!$edit)
      <span class='response' >{{ $data[28] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[28]' id='radio65' value='Yes' @if ($data[28] == 'Yes') checked='checked' @endif /><label for='radio65'>Yes</label></td>
    <td><input type='radio' name='data[28]' id='radio66' value='No' @if ($data[28] == 'No') checked='checked' @endif /><label for='radio66'>No</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:20px;'><b>If yes, please give details and what you gained from theexperience.</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[29]'>{{ $data[29] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[29])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>11) OTHER EXTRACURRICULAR ACTIVITIES :</b></td>
</tr>

<tr>
  <td colspan='4'>Did you try to meet French people informally ? If so, what did you do to mee them ?</td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[30]'>{{ $data[30] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[30])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>12) Did you join a specific club, team, group, or activity ?</b>
    @if (!$edit)
      <span class='response' >{{ $data[31] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[31]' id='radio67' value='Yes' @if ($data[31] == 'Yes') checked='checked' @endif /><label for='radio67'>Yes</label></td>
    <td><input type='radio' name='data[31]' id='radio68' value='No' @if ($data[31] == 'No') checked='checked' @endif /><label for='radio68'>No</label></td>
    <td colspan='2'><b>If Yes, please check all appropriate boxes below :</td>
  </tr>

  <tr>
    <td><input type='checkbox' name='data[32][]' id='checkbox1' value='Club' @if (strstr($data[32], 'Club')) checked='checked' @endif /><label for='checkbox1'>Club</label></td>
    <td><input type='checkbox' name='data[32][]' id='checkbox2' value='Team' @if (strstr($data[32], 'Team')) checked='checked' @endif /><label for='checkbox2'>Team</label></td>
    <td><input type='checkbox' name='data[32][]' id='checkbox3' value='Group' @if (strstr($data[32], 'Group')) checked='checked' @endif /><label for='checkbox3'>Group</label></td>
    <td><input type='checkbox' name='data[32][]' id='checkbox4' value='Activity' @if (strstr($data[32], 'Activity')) checked='checked' @endif /><label for='checkbox4'>Activity</label></td>
  </tr>
@else
  <tr>
    <td colspan='4' >{{ $data[32] }}</td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-top:30px;'><b>Please give the following details for the benefit of future students there :</b></td>
</tr>

<tr>
  <td colspan='2'><b>Name of organization 1 :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[33]' value='{{ $data[33] }}' />
    @else
      <span class='response' >{{ $data[33] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[34]' value='{{ $data[34] }}'/>
    @else
      <span class='response' >{{ $data[34] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>tel. n°/e-mail address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[35]' value='{{ $data[35] }}'/>
    @else
      <span class='response' >{{ $data[35] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Name of Person to contact :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[36]' value='{{ $data[36] }}'/>
    @else
      <span class='response' >{{ $data[36] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-top:25px;'><b>Name of organization 2 :</b></td>
  <td colspan='2' style='padding-top:25px;'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[37]' value='{{ $data[37] }}'/>
    @else
      <span class='response' >{{ $data[37] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[38]' value='{{ $data[38] }}'/>
    @else
      <span class='response' >{{ $data[38] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>tel. n°/e-mail address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[39]' value='{{ $data[39] }}'/>
    @else
      <span class='response' >{{ $data[39] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Name of Person to contact :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[40]' value='{{ $data[40] }}'/>
    @else
      <span class='response' >{{ $data[40] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-top:25px;'><b>Name of organization 3 :</b></td>
  <td colspan='2' style='padding-top:25px;'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[41]' value='{{ $data[41] }}'/>
    @else
      <span class='response' >{{ $data[41] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[42]' value='{{ $data[42] }}'/>
    @else
      <span class='response' >{{ $data[42] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>tel. n°/e-mail address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[43]' value='{{ $data[43] }}'/>
    @else
      <span class='response' >{{ $data[43] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Name of Person to contact :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[44]' value='{{ $data[44] }}'/>
    @else
      <span class='response' >{{ $data[44] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2' style='padding-top:25px;'><b>Name of organization 4 :</b></td>
  <td colspan='2' style='padding-top:25px;'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[45]' value='{{ $data[45] }}'/>
    @else
      <span class='response' >{{ $data[45] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[46]' value='{{ $data[46] }}'/>
    @else
      <span class='response' >{{ $data[46] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>tel. n°/e-mail address :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[47]' value='{{ $data[47] }}'/>
    @else
      <span class='response' >{{ $data[47] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'><b>Name of Person to contact :</b></td>
  <td colspan='2'>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[48]' value='{{ $data[48] }}'/>
    @else
      <span class='response' >{{ $data[48] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='padding-top:25px;'><b>13) INTERNSHIP/EXPERIENTIAL LEARNING : Did you undertake a "stage" ?</b>
    @if (!$edit)
      <span class='response' >{{ $data[49] }}</span>
    @endif
  </td>
</tr>

<tr>
  @if ($edit)
    <td><input type='radio' name='data[49]' id='radio69' value='Yes' @if ($data[49] == 'Yes') cheched='checked' @endif ><label for='radio69'>Yes</label></td>
    <td><input type='radio' name='data[49]' id='radio70' value='No' @if ($data[49] == 'No') cheched='checked' @endif ><label for='radio70'>No</label></td>
  @endif
  <td colspan='2'><b>If Yes, please fill out the stage evaluation as well.</td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[50]'>{{ $data[50] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[50])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>VI. BORDEAU ORIENTATION</b> (For Fall semester only)</td>
</tr>

<tr>
  <td colspan='4'><b>14) What features of the Bordeaux program did you find most useful ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[51]'>{{ $data[51] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[51])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>15) Please comment on housing and cultural activities in Bordeaux.</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[52]'>{{ $data[52] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[52])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>16) Do you have any suggestions for the Bordeaux orientation session ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[53]'>{{ $data[53] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[53])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>VII. FINAL COMMENTS</b></td>
</tr>

<tr>
  <td colspan='4'><b>17) What advice would you give to students to help them to prepare to study abraod in Paris ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[54]'>{{ $data[54] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[54])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>18) If you wish, you, please add comments on any aspects of the VWPP not covered in this evaluation.</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[55]'>{{ $data[55] }}</textarea>
    @else
      <span class='response' >{!! nl2br(e($data[55])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>MERCI BEAUCOUP !</b></td>
</tr>

<tr>
  <td colspan='2'><b>Your Name (optional) :</b></td>
  <td>
    @if ($edit)
      <input type='text' autocomplete='off' name='data[56]' value='{{ $data[56] }}' />
    @else
      <span class='response' >{{ $data[56] }}</span>
    @endif
  </td>
</tr>

@endsection
