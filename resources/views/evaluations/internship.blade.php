@extends('evaluations.layout')
@section('evaluation_form')

<tr>
  <td colspan='2'><b>Your name :</b></td>
  @if ($edit)
    <td colspan='2'><input type='text' name='data[1]' value='{{ $data[1] }}' /></td>
  @else
    <td class='response' colspan='2'>{{ $data[1] }}</td>
  @endif
</tr>

<tr>
  <td colspan='2'><b>Your University :</b></td>
  @if ($edit)
    <td colspan='2'><input type='text' name='data[2]' value='{{ $data[2] }}' /></td>
  @else
    <td class='response' colspan='2'>{{ $data[2] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4'><b>Place of internship (name of association, company, etc...) :</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[3]'>{{ $data[3] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[3])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>1. Work assignment,</b></td>
</tr>

<tr>
  <td><b>Beginning date</b></td>
  @if ($edit)
    <td><input type='text' name='data[4]' value='{{ $data[4] }}' /></td>
  @else
    <td class='response'>{{ $data[4] }}</td>
  @endif

  <td><b>End date</b></td>
  @if ($edit)
    <td><input type='text' name='data[5]' value='{{ $data[5] }}' /></td>
  @else
    <td class='response'>{{ $data[5] }}</td>
  @endif
</tr>

<tr>
  <td><b>N° of hours per week</b></td>
  @if ($edit)
    <td><input type='text' name='data[6]' value='{{ $data[6] }}' /></td>
  @else
    <td class='response'>{{ $data[6] }}</td>
  @endif
</tr>

<tr>
  <td colspan='4'><b>Your weekly schedule :</b></td>
</tr>

<tr>
  <td colspan='4'>
    <table border='1' style='width:100%;' cellspacing='0' >
      <tr>
        <td></td>
        <td><b>Monday</b></td>
        <td><b>Tuesday</b></td>
        <td><b>Wednesday</b></td>
        <td><b>Thursday</b></td>
        <td><b>Friday</b></td>
        <td><b>Saturday</b></td>
        <td><b>Sunday</b></td>
      </tr>

      <tr>
        <td><b>From</b></td>
        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[7]' value='{{ $data[7] }}' /></td>
        @else
          <td class='response'>{{ $data[7] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[8]' value='{{ $data[8] }}' /></td>
        @else
          <td class='response'>{{ $data[8] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[9]' value='{{ $data[9] }}' /></td>
        @else
          <td class='response'>{{ $data[9] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[10]' value='{{ $data[10] }}' /></td>
        @else
          <td class='response'>{{ $data[10] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[11]' value='{{ $data[11] }}' /></td>
        @else
          <td class='response'>{{ $data[11] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[12]' value='{{ $data[12] }}' /></td>
        @else
          <td class='response'>{{ $data[12] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[13]' value='{{ $data[13] }}' /></td>
        @else
          <td class='response'>{{ $data[13] }}</td>
        @endif
      </tr>

      <tr>
        <td><b>To</b></td>
        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[14]' value='{{ $data[14] }}' /></td>
        @else
          <td class='response'>{{ $data[14] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[15]' value='{{ $data[15] }}' /></td>
        @else
          <td class='response'>{{ $data[15] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[16]' value='{{ $data[16] }}' /></td>
        @else
          <td class='response'>{{ $data[16] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[17]' value='{{ $data[17] }}' /></td>
        @else
          <td class='response'>{{ $data[17] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[18]' value='{{ $data[18] }}' /></td>
        @else
          <td class='response'>{{ $data[18] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[19]' value='{{ $data[19] }}' /></td>
        @else
          <td class='response'>{{ $data[19] }}</td>
        @endif

        @if ($edit)
          <td style='padding: 2px 5px 0 2px;'><input type='text' name='data[20]' value='{{ $data[20] }}' /></td>
        @else
          <td class='response'>{{ $data[20] }}</td>
        @endif
      </tr>
    </table>
  </td>
</tr>

<tr>
  <td colspan='3' style='padding-top:20px;'><b>Where there any special events you participated in ?</b></td>
  @if (!$edit)
    <td class='response' style='padding-top:20px;'>{{ $data[21] }}</td>
  @endif
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[21]' id='radio1' value='Yes' /><label for='radio1'>Yes</label></td>
    <td><input type='radio' name='data[21]' id='radio2' value='No' /><label for='radio2'>No</label></td>
    <td colspan='2'><b>If yes, which one(s) :</b></td>
  </tr>
@else
  <tr>
    <td class='response' colspan='4' style='color:black;'><b>If yes, which one(s) :</b></td>
  </tr>
@endif

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[23]'>{{ $data[23] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[23])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>2. What regular tasks were included in your internship ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[24]'>{{ $data[24] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[24])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>3.a) Please estimate the amount of time (in %) you used French in your internship</b>
    @if (!$edit)
      <span class='response'>{{ $data[25] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[25]' id='radio3' value='More than 80%' /><label for='radio3'>More than 80%</label></td>
    <td><input type='radio' name='data[25]' id='radio4' value='70-80%' /><label for='radio4'>70-80%</label></td>
    <td><input type='radio' name='data[25]' id='radio5' value='50-70%' /><label for='radio5'>50-70%</label></td>
    <td><input type='radio' name='data[25]' id='radio6' value='Less than 50%' /><label for='radio6'>Less than 50%</label></td>
  </tr>
@endif

<tr>
  <td colspan='4' style='padding-left:30px;'>
    <b>b) Please estimate the amount of time (in %) you used English in your internship</b>
    @if (!$edit)
      <span class='response'>{{ $data[26] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[26]' id='radio7' value='More than 80%' /><label for='radio7'>More than 80%</label></td>
    <td><input type='radio' name='data[26]' id='radio8' value='70-80%' /><label for='radio8'>70-80%</label></td>
    <td><input type='radio' name='data[26]' id='radio9' value='50-70%' /><label for='radio9'>50-70%</label></td>
    <td><input type='radio' name='data[26]' id='radio10' value='Less than 50%' /><label for='radio10'>Less than 50%</label></td>
  </tr>
@endif

<tr>
  <td colspan='4'><b>4. Describe your interaction with the local population and/or colleagues</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[27]'>{{ $data[27] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[27])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>5. How was the internship pertinent to your interests and/or background or experience ?</b></td>
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
  <td colspan='4'><b>6. Did you take any relevant courses previously or concomitantly that you would recommend ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[29]'>{{ $data[29] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[29])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'><b>7. Please comment on how your supervisor directed your work.</b></td>
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
  <td colspan='4'><b>8. How did your "stage" experience influence your semester abroad ?</b></td>
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
  <td colspan='4'><b>9. What did you learn about local institutions, business, society, and people through your experience ?</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[32]'>{{ $data[32] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[32])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4'>
    <b>10. Did your "stage" experience influence your plans for your future (career, other) ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[33] }}</span>
    @endif
  </td>
</tr>

<tr>
  @if ($edit)
    <td><input type='radio' name='data[33]' id='radio11' value='Yes' /><label for='radio11'>Yes</label></td>
    <td><input type='radio' name='data[33]' id='radio12' value='No' /><label for='radio12'>No</label></td>
    <td colspan='2'>if yes, please explain how :</td>
  @else
    <td class='response' colspan='4' style='color:black;font-weight:normal;'>If yes, please explain how :</td>
  @endif
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[34]'>{{ $data[34] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[34])) !!}</span>
    @endif
  </td>
</tr>


<tr>
  <td colspan='4'>
    <b>11. Did you receive any perks ?</b>
    @if (!$edit)
      <span class='response'>{{ $data[35] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[35]' id='radio13' value='Yes' /><label for='radio13'>Yes</label></td>
    <td><input type='radio' name='data[35]' id='radio14' value='No' /><label for='radio14'>No</label></td>
  </tr>
@endif

<tr>
  <td colspan='4'>If yes, please list them below (meal tickets, or meal or travel reimbursements, payments, or other) at your "stage" :</td>
</tr>

<tr>
  <td colspan='2'>1.
    @if ($edit)
      <input type='text' name='data[36]' value='{{ $data[36] }}' style='width:90%;'/>
    @else
      <span class='response'>{{ $data[36] }}</span>
    @endif
  </td>
  <td colspan='2'>3.
    @if ($edit)
      <input type='text' name='data[38]' value='{{ $data[38] }}' style='width:90%;'/>
    @else
      <span class='reponse'>{{ $data[38] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='2'>2.
    @if ($edit)
      <input type='text' name='data[37]' value='{{ $data[37] }}' style='width:90%;'/>
    @else
      <span class='response'>{{ $data[37] }}</span>
    @endif
  </td>
  <td colspan='2'>4.
    @if ($edit)
      <input type='text' name='data[39]' value='{{ $data[39] }}' style='width:90%;'/>
    @else
      <span class='response'>{{ $data[39] }}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='padding-top:20px;'><b>12. Other observations or comments :</b></td>
</tr>

<tr>
  <td colspan='4'>
    @if ($edit)
      <textarea name='data[40]'>{{ $data[40] }}</textarea>
    @else
      <span class='response'>{!! nl2br(e($data[40])) !!}</span>
    @endif
  </td>
</tr>

<tr>
  <td colspan='4' style='margin-top:20px;'>
    <b>I authorize the program to quote form my "stage" evaluation for a college publication/site.</b>
    @if (!$edit)
      <span class='response'>{{ $data[41] }}</span>
    @endif
  </td>
</tr>

@if ($edit)
  <tr>
    <td><input type='radio' name='data[41]' id='radio15' value='Yes' /><label for='radio15'>Yes</label></td>
    <td><input type='radio' name='data[41]' id='radio16' value='No' /><label for='radio16'>No</label></td>
  </tr>
@endif

@endsection
