<?php
// Last update : 2018-10-18, Jérôme Combes
 
require_once "class.univ_reg.inc";
require_once "class.dates.inc";

$d=new dates();
$d->fetch();
$dates=$d->elements;

$u=new univ_reg();
$u->getAttrib();
$university=$u->university;
$published=$u->published;
$u=array();
$u[0]=$university=="Paris 3"?"selected='selected'":null;
$u[1]=$university=="Paris 4"?"selected='selected'":null;
$u[2]=$university=="Paris 7"?"selected='selected'":null;
$u[3]=$university=="Paris 12"?"selected='selected'":null;
$u[4]=$university=="CIPh"?"selected='selected'":null;

$checked[0] = $data[7] == "Oui" ? "checked='checked'" : null;
$checked[1] = $data[7] == "Non" ? "checked='checked'" : null;


$selected=array();
for($i=0;$i<25;$i++){
  $selected[$i]=null;
}

switch($data[14]){
  case "1st"  : $selected[0]="selected='selected'"; break;
  case "2nd"  : $selected[1]="selected='selected'"; break;
  case "3rd"  : $selected[2]="selected='selected'"; break;
  case "4th"  : $selected[3]="selected='selected'"; break;
  case "5th"  : $selected[4]="selected='selected'"; break;
}

switch($data[15]){
  case "1st"  : $selected[5]="selected='selected'"; break;
  case "2nd"  : $selected[6]="selected='selected'"; break;
  case "3rd"  : $selected[7]="selected='selected'"; break;
  case "4th"  : $selected[8]="selected='selected'"; break;
  case "5th"  : $selected[9]="selected='selected'"; break;
}

switch($data[16]){
  case "1st"  : $selected[10]="selected='selected'";  break;
  case "3rd"  : $selected[12]="selected='selected'";  break;
  case "2nd"  : $selected[11]="selected='selected'";  break;
  case "4th"  : $selected[13]="selected='selected'";  break;
  case "5th"  : $selected[14]="selected='selected'";  break;
}

switch($data[17]){
  case "1st"  : $selected[15]="selected='selected'";  break;
  case "2nd"  : $selected[16]="selected='selected'";  break;
  case "3rd"  : $selected[17]="selected='selected'";  break;
  case "4th"  : $selected[18]="selected='selected'";  break;
  case "5th"  : $selected[19]="selected='selected'";  break;
}

switch($data[18]){
  case "1st"  : $selected[20]="selected='selected'";  break;
  case "2nd"  : $selected[21]="selected='selected'";  break;
  case "3rd"  : $selected[22]="selected='selected'";  break;
  case "4th"  : $selected[23]="selected='selected'";  break;
  case "5th"  : $selected[24]="selected='selected'";  break;
}

$textarea = array();
$textarea[8] = str_replace("\n", "<br/>", $data[8]);
$textarea[19] = str_replace("\n", "<br/>", $data[19]);
$textarea[22] = str_replace("\n", "<br/>", $data[22]);

echo <<<EOD
<h3><b>University Registration</b></h3>
<fieldset>
<div style='text-align:center;margin-bottom:40px;'>
<h3>Vassar-Wesleyan Program in Paris<br/>
University Registration Request Form</h3>
</div>

<form name='univreg2b_1' id='univreg2b' action='update.php' method='post'>
<input type='hidden' name='acl' value='17' />
<input type='hidden' name='page' value='students-view2.php' />
<input type='hidden' name='std-page' value='univ_registration.php' />
<input type='hidden' name='table' value='univ_reg' />
<input type='hidden' name='std_id' value='$std_id' />
<input type='hidden' name='semestre' value='$semestre' />
<input type='hidden' id='category' value='{$_SESSION['vwpp']['category']}' />

<table border='0'>
<tr><td>Lastname :</td>
<td colspan='2'><font class='response'>{$std['lastname']}</font></td></tr>
<tr><td>Firstname :</td>
<td colspan='2'><font class='response'>{$std['firstname']}</font></td></tr>
<tr><td>Email :</td>
<td colspan='2'><font class='response'>{$std['email']}</font></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td><b>1. High school diploma :</b></td>
<td>
<input type='text' name='data[1]' value='{$data[1]}' style='display:none;' class='inputField' />
<font class='response inputValue' id='univreg2b_1_1' >{$data[1]}</font>
</td></tr>

<tr><td style='padding-left:30px;width:500px;'>a. Graduation year</td>
<td>
<select name='data[2]' style='display:none;' class='inputField' >
<option value=''>&nbsp;</option>
EOD;
for($i=date("Y");$i>date("Y")-30;$i--){
  $selected2 =$data[2]==$i?"selected='selected'":null;
  echo "<option value='$i' $selected2 >$i</option>\n";
}
echo <<<EOD
</select>
<font class='response inputValue' id='univreg2b_1_2' >{$data[2]}</font></td></tr>
<tr><td style='padding-left:30px;'>b. Country</td>
<td>
<select name='data[3]' style='display:none;' class='inputField' >
<option value=''>&nbsp;</option>
EOD;
foreach($GLOBALS['countries'] as $elem){
  $selected2 =$data[3]==htmlentities($elem,ENT_QUOTES|ENT_IGNORE,"utf-8")?"selected='selected'":null;
  echo "<option value='$elem' $selected2 >$elem</option>\n";
}
echo <<<EOD
</select>
<font class='response inputValue' id='univreg2b_1_3' >{$data[3]}</font></td></tr>
<tr><td style='padding-left:30px;'>c. City</td>

<td><input type='text' name='data[4]' value='{$data[4]}' style='display:none;' class='inputField' />
<font class='response inputValue' id='univreg2b_1_4' >{$data[4]}</font></td></tr>
<tr><td style='padding-left:30px;'>d. State</td>
<td>
<select name='data[5]' style='display:none;' class='inputField' >
<option value=''>&nbsp;</option>
EOD;
foreach($GLOBALS['states'] as $elem){
  $selected2 =$data[5]==htmlentities($elem,ENT_QUOTES|ENT_IGNORE,"utf-8")?"selected='selected'":null;
  echo "<option value='$elem' $selected2 >$elem</option>\n";
}
echo <<<EOD
</select>
<font class='response inputValue' id='univreg2b_1_5' >{$data[5]}</font></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td><b>2. What year did you start college ?</b></td>
<td>
<select name='data[6]' style='display:none;' class='inputField' >
<option value=''>&nbsp;</option>
EOD;
for($i=date("Y");$i>date("Y")-30;$i--){
  $selected2 =$data[6]==$i?"selected='selected'":null;
  echo "<option value='$i' $selected2 >$i</option>\n";
}
echo <<<EOD
</select>
<font class='response inputValue' id='univreg2b_1_6' >{$data[6]}</font></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td><b>3. Do you have a disability or special needs ?</b></td>
<td class='response inputValue' id='univreg2b_1_7' >{$data[7]}</td>
<td id='univreg2b_1_radio_0' style='display:none;padding-left:30px;' class='inputField' ><input type='radio' name='data[7]' value='Oui' {$checked[0]} /> Oui</td>
</tr>
<tr id='univreg2b_1_radio_1' style='display:none;' class='inputField' ><td>&nbsp;</td>
<td style='padding-left:30px;'><input type='radio' name='data[7]' value='Non' {$checked[1]} /> Non</td></tr>

<tr><td colspan='2'>If so, can you provide more details ?</td></tr>
<td colspan='6'><textarea name='data[8]' style='display:none;' class='inputField' >{$data[8]}</textarea>
<font class='response inputValue' id='univreg2b_1_8' colspan='2'>{$textarea[8]}</font></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td><b>4. Your current college :</b></td>
</tr>

<tr><td>Major 1:</td>
<td colspan='2'>
<input type='text' style='display:none;' name='data[10]' value='{$data[10]}' class='inputField' />
<font class='response inputValue' id='univreg2b_1_10'>{$data[10]}</font>
</td></tr>

<tr><td>Major 2:</td>
<td colspan='2'>
<input type='text' style='display:none;' name='data[11]' value='{$data[11]}' class='inputField' />
<font class='response inputValue' id='univreg2b_1_11'>{$data[11]}</font>
</td></tr>

<tr><td>Minor / Correlate 1</td>
<td colspan='2'>
<input type='text' style='display:none;' name='data[12]' value='{$data[12]}' class='inputField' />
<font class='response inputValue' id='univreg2b_1_12'>{$data[12]}</font>
</td></tr>

<tr><td>Minor / Correlate 2</td>
<td colspan='2'>
<input type='text' style='display:none;' name='data[13]' value='{$data[13]}' class='inputField' />
<font class='response inputValue' id='univreg2b_1_13'>{$data[13]}</font>

EOD;

if($dates['date5'] or $dates['date6'] or $dates['date7'] or $dates['date8']){
    echo <<<EOD
        <tr><td colspan='6' style='padding:20px 0 0 0;'text-align:justify';>
        Please note that each university has a different calendar :<br/>
        Paris 3, end of course <b>{$dates['date5']}</b><br/>
        Paris 4, end of course <b>{$dates['date6']}</b><br/>
        Paris 7, end of course <b>{$dates['date7']}</b><br/>
        Paris 12, end of course <b>{$dates['date8']}</b><br/>
        </td></tr>
EOD;
}

echo <<<EOD
<tr><td colspan='6' style='padding:20px 0 0 0;'text-align:justify';>
<b>5. Please rank your choices </b>(fill in 1<sup>st</sup>, 2<sup>nd</sup>, 3<sup>rd</sup> and 4<sup>th</sup> in the appropriate boxes)</td></tr>

<tr><td>Paris 3</td>
<td colspan='2'>
<select style='display:none;' name='data[14]' class='inputField' >
<option value=''>&nbsp;</option>
<option value='1st' {$selected[0]}>1st Choice</option>
<option value='2nd' {$selected[1]}>2nd Choice</option>
<option value='3rd' {$selected[2]}>3rd Choice</option>
<option value='4th' {$selected[3]}>4th Choice</option>
<option value='5th' {$selected[4]}>5th Choice</option>
</select>
<font class='response inputValue' id='univreg2b_1_14'>{$data[14]}</font>
</td></tr>

<tr><td>Paris 4</td>
<td colspan='2'>
<select style='display:none;' name='data[15]' class='inputField' >
<option value=''>&nbsp;</option>
<option value='1st' {$selected[5]}>1st Choice</option>
<option value='2nd' {$selected[6]}>2nd Choice</option>
<option value='3rd' {$selected[7]}>3rd Choice</option>
<option value='4th' {$selected[8]}>4th Choice</option>
<option value='5th' {$selected[9]}>5th Choice</option>
</select>
<font class='response inputValue' id='univreg2b_1_15'>{$data[15]}</font>
</td></tr>

<tr><td>Paris 7</td>
<td colspan='2'>
<select style='display:none;' name='data[16]' class='inputField' >
<option value=''>&nbsp;</option>
<option value='1st' {$selected[10]}>1st Choice</option>
<option value='2nd' {$selected[11]}>2nd Choice</option>
<option value='3rd' {$selected[12]}>3rd Choice</option>
<option value='4th' {$selected[13]}>4th Choice</option>
<option value='5th' {$selected[14]}>5th Choice</option>
</select>
<font class='response inputValue' id='univreg2b_1_16'>{$data[16]}</font>
</td></tr>

<tr><td>Paris 12</td>
<td colspan='2'>
<select style='display:none;' name='data[17]' class='inputField'>
<option value=''>&nbsp;</option>
<option value='1st' {$selected[15]}>1st Choice</option>
<option value='2nd' {$selected[16]}>2nd Choice</option>
<option value='3rd' {$selected[17]}>3rd Choice</option>
<option value='4th' {$selected[18]}>4th Choice</option>
<option value='5th' {$selected[19]}>5th Choice</option>
</select>
<font class='response inputValue' id='univreg2b_1_17'>{$data[17]}</font>
</td></tr>

<tr><td>CIPh</td>
<td colspan='2'>
<select style='display:none;' name='data[18]' class='inputField' >
<option value=''>&nbsp;</option>
<option value='1st' {$selected[20]}>1st Choice</option>
<option value='2nd' {$selected[21]}>2nd Choice</option>
<option value='3rd' {$selected[22]}>3rd Choice</option>
<option value='4th' {$selected[23]}>4th Choice</option>
<option value='5th' {$selected[24]}>5th Choice</option>
</select>
<font class='response inputValue' id='univreg2b_1_18'>{$data[18]}</font>
</td></tr>

<tr><td colspan='6' style='padding:20px 0 0 0;text-align:justify';>
<b>6. Please provide an academic justification for your 1<sup>st</sup> and 2<sup>nd</sup> choices 
in the text box below</b> (Maximum 1200 characters with spaces) :</td></tr>

<tr><td colspan='6'>
<textarea name='data[19]' style='display:none;' class='inputField' >{$data[19]}</textarea>
<font class='response inputValue' id='univreg2b_1_19'>{$textarea[19]}</font>
</td></tr>

EOD;
if($dates['date5'] or $dates['date6'] or $dates['date7']){
    echo <<<EOD
        <tr><td colspan='6' style='padding:20px 0 0 0;text-align:justify';>
        <b>7.Please indicate if your choice of university is motivated by the calendar and explain your reason</b> : 
        job, intership, graduation ...</td></tr>

        <tr><td colspan='6'>
        <textarea style='display:none;' name='data[22]' class='inputField' >{$data[22]}</textarea>
        <font class='response inputValue' id='univreg2b_1_21'>{$textarea[22]}</font>
        </td></tr>
EOD;
}

echo <<<EOD
<tr><td>&nbsp;</td></tr>
<tr><td colspan='6' style='padding:0 0 0 0;'text-align:justify';>
Your wishes will be taken into account but university placement cannot be guaranteed as each university 
has a specific number of spots for our students.<br/>
</td></tr>

<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td colspan='2'>For program administration only</td></tr>
<tr><td>MoveOnLine Username</td>
EOD;

if($_SESSION['vwpp']['category']=="admin"){
  echo "<td><input type='text' name='data[20]' value='{$data[20]}' style='display:none;' class='inputField' />\n";
  echo "<font class='response inputValue' id='univreg2b_1_20' >{$data[20]}</font></td></tr>\n";
} else {
  echo "<td><input type='hidden' name='data[20]' value='{$data[20]}' />\n";
  echo "<font class='response' id='univreg2b_1_20' >{$data[20]}</font></td></tr>\n";
}

echo "<tr><td>MoveOnLine Password</td>\n";

if($_SESSION['vwpp']['category']=="admin"){
  echo "<td><input type='text' name='data[21]' value='{$data[21]}' style='display:none;' class='inputField' />\n";
  echo "<font class='response inputValue' id='univreg2b_1_21' >{$data[21]}</font></td></tr>\n";
} else {
  echo "<td><input type='hidden' name='data[21]' value='{$data[21]}' />\n";
  echo "<font class='response' id='univreg2b_1_21' >{$data[21]}</font></td></tr>\n";
}

echo "<tr><td colspan='6' style='text-align:right;'>\n";
echo "<br/><br/>\n";

if($_SESSION['vwpp']['category']=="admin" or !$university){
  echo "<input id='univreg2b_1_22' type='button' value='Edit' onclick='displayForm(\"univreg2b\",1);' class='myUI-button-right edit-button' />\n";
}

echo <<<EOD
<input style='display:none;' type='button' value='Cancel' onclick='displayText("univreg2b",1);' class='myUI-button-right cancel-button' />
<input type='submit' value='Submit' id='univreg2b_1_done' style='display:none;' class='myUI-button submit-button' /></td></tr>

</table>
</form>
</fieldset>
EOD;

if($_SESSION['vwpp']['category']=="admin"){
  echo <<<EOD
  <fieldset>
  <form method='post' action='univ_reg_update.php'>
  <table>
  <tr><td colspan='2'><h3>University Registration</h3></td></tr>
  <tr><td>University</td>
  <td>
  <input type='hidden' name='action' value='attrib' />
  <select name='university' style='width:800px;'>
  <option value=''>&nbsp;</option>
  <option value='Paris 3' {$u[0]} >Paris 3</option>
  <option value='Paris 4' {$u[1]} >Paris 4</option>
  <option value='Paris 7' {$u[2]} >Paris 7</option>
  <option value='Paris 12' {$u[3]} >Paris 12</option>
  <option value='CIPh' {$u[4]} >CIPh</option>
  </select>
  <span style='position: absolute; right: 20px; margin:-10px 0; padding:0; text-align:right;'>
  <input type='submit' value='Save' class='myUI-button-right' />
  </span>
  </td></tr>
  </table>
  </form>
  </fieldset>
EOD;
}
elseif($university and $published){
  echo <<<EOD
  <fieldset>
  <table>
  <tr><td colspan='2'><h3>University Registration</h3></td></tr>
  <tr><td>University</td>
  <td class='response'>$university</td></tr></table>
  </fieldset>
EOD;
}

?>