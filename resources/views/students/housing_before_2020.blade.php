<form name='form' action='/housing' method='post'>
  {{ csrf_field() }}
  <input type='hidden' name='student' value='{{ $student->id }}' />

  <div class='fieldset'>

    <h2 style='text-align:center;'>Vassar-Wesleyan Program in Paris Housing Questionnaire</h2>

    <p style='text-align:justify;'>
      This questionnaire will be used by the Assistant Director in Paris to match you with a suitable housing 
      situation.  A specific housing situation will be reserved for you <u>based on your responses to this 
      questionnaire</u>. Thank you for having read the Housing Process Residence commitment sections of 
      the VWPP website before filling out this questionnaire. Be honest and thoughtful in your 
      responses. The more the Assistant Director knows about you, the better the chance of a successful match 
      between you and the housing reserved for you.  Should any criteria concerning you change between filling 
      out this form and your arrival in Paris, please inform the VWPP Paris office as soon as possible at 
      <a href='mailto:housing@vwpp.org'>housing@vwpp.org</a>
    </p>

    <p style='text-align:justify;font-weight:bold;'>
      Please fill this questionnaire by the deadline set by the Office of International Programs (Vassar) or 
      the Office of International Studies (Wesleyan).
    </p>


    <table border='0'>
      <tr>
        <td colspan='5'><h3>I. Personal details</h3></td>
      </tr>
      <tr>
        <td>1. Last Name : </td>
        <td colspan='2'>
          <div class='response2'>{{ $student->lastname }}</div>
        </td>
        <td>First Name : </td>
        <td>
          <div class='response2'>{{ $student->firstname }}</div>
        </td>
      </tr>
      <tr>
        <td>2. Date of birth : </td>
        <td colspan='2'>
          <div class='response2'>{{ $student->dob->format('M d,Y')}}</div>
        </td>
        <td>Gender : </td>
        <td>
          <div class='response2'>{{ $student->gender }}</div>
        </td>
      </tr>
      <tr>
        <td>3. Citizenship : 1. </td>
        <td colspan='2'>
          <div class='response2'>{{ $student->citizenship1 }}</div>
        </td>
        <td>2. </td>
        <td>
          <div class='response2'>{{ $student->citizenship2 }}</div>
        </td>
      </tr>
      <tr>
        <td colspan='5'>4. <u>Home address (street, city, state)</u> : </td></tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan='4'>
          <div class='response2'>{{ $student->address }}</div>
        </td>
      </tr>
      <tr style='margin-top:10px;'>
        <td>5. University or college : </td>
        <td colspan='2'>
          <div class='response2'>{{ $student->university2 }}</div>
        </td>
        <td>Year of graduation : </td>
        <td>
          <div class='response2'>{{ $student->graduation }}</div>
        </td>
      </tr>
      <tr>
        <td>6. e-mail address : </td>
      <td colspan='4'><div class='response2'>{{ $student->email }}</div></td></tr>
      <tr>
        <td>7. I am applying for : </td>
      <td colspan='4'><div class='response2'>{{ $student->semester }}</div></td></tr>

      <tr>
        <td colspan='5'>
          <h3>II. Travel information (please check one box)</h3>
        </td>
      </tr>
      <tr>
        <td colspan='2'>I will arrive with the group flight : </td>
        <td>
          @if ($edit)
            <input type='radio' name='question[1]' value='Yes' @if ($answer[1] == 'Yes') checked='checked' @endif />
          @else
            <div class='response2'>@if ($answer[1] == 'Yes') Yes @else No @endif</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='2'>I will make my own travel arrangements : </td>
        <td style='font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[1]' value='No' @if ($answer[1] == 'No') checked='checked' @endif />
          @else
            <div class='response2'>@if ($answer[1] == 'Yes') No @else Yes @endif</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-style:italic;'>
          Note: Please make every effort to join the group flight.  It will facilitate your travel and arrival 
          in France. If you have to travel on your own, please forward your full travel itinerary as soon as you 
          make your travel plans to <a href='mailto:housing@vwpp.edu'>housing@vwpp.org</a>.
        </td>
      </tr>

      <tr>
        <td colspan='5'>
          <h3>III. Housing</h3>
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
          The Vassar Wesleyan Program in Paris semester fee includes tuition, room and partial board arranged by 
          the Vassar-Wesleyan Program in Paris.
        </td>
      </tr>
      <tr>
        <td colspan='2'>I accept to have housing arranged by VWPP</td>
        <td style='font-weight:bold;'>
          @if ($edit)
            <input type='checkbox' name='question[3]' value='Yes' @if ($answer[3] == 'Yes') checked='checked' @endif />
          @else
            <div class='response2'>{{ $answer[3] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-style:italic;'>
          Please note: Exception may be made only in the case of a student who wishes to live with a relative 
          living in Paris. In such cases, students must indicate this on this housing form after obtaining 
          permission from the Director of International Studies (Wesleyan) or the Director of International 
          Programs (Vassar). The cost of room and partial board will be deducted from the program fee in such 
          cases.
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-style:italic;'>
          If this is the case, please explain below with whom and where you will be living. We must have the 
          address and phone number.
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[4]'>{{ $answer[4] }}</textarea>
          @else
            <div class='response2'>{{ $answer[4] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5'>
          <h3>IV. Background Information</h3>
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
          1. Have you ever traveled or lived in France or another foreign country?  If so, where and for how long? 
          (maximum 220 characters including spaces)
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[5]'>{{ $answer[5] }}</textarea>
          @else
            <div class='response'>{{ $answer[5] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          2. Have you ever had a home stay experience with a foreign family or hosted an international student?  
          If so, please describe briefly your impressions and how this experience influences your current 
          preferences in housing in Paris.
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[6]'>{{ $answer[6] }}</textarea>
          @else
            <div class='response'>{{ $answer[6] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          3. What is your own family like (parents, brothers, sisters, ages, occupations, etc.)?
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[7]'>{{ $answer[7] }}</textarea>
          @else
            <div class='response'>{{ $answer[7] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
            4. Have you lived in an independent living situation before such as an apartment or house, or non-dormitory style living?
        </td>
      </tr>
      <tr>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[8]' value='Yes' @if ($answer[8] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[8]' value='No' @if ($answer[8] == 'No') checked='checked' @endif /> No
          @else
            <div class='response'>{{ $answer[8] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
            5. With roommates?
        </td>
      </tr>
      <tr>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[9]' value='Yes' @if ($answer[9] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[9]' value='No' @if ($answer[9] == 'No') checked='checked' @endif /> No
          @else
            <div class='response'>{{ $answer[9] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
            6. Did you cook for yourself?
        </td>
      </tr>
      <tr>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[10]' value='Yes' @if ($answer[10] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[10]' value='No' @if ($answer[10] == 'No') checked='checked' @endif /> No
          @else
            <div class='response'>{{ $answer[10] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
            7. How does this experience influence your current preference in housing in Paris?
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[11]'>{{ $answer[11] }}</textarea>
          @else
            <div class='response'>{{ $answer[11] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
            8. What are your principal reasons for coming to Paris?
        </td>
      </tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[12]'>{{ $answer[12] }}</textarea>
          @else
            <div class='response'>{{ $answer[12] }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
          9. What are your main academic interests?
        </td></tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[13]'>{{ $answer[13] }}</textarea>
          @else
            <div class='response'>{{ $answer[13] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          10. What are your extra-curricular and leisure time interests and activities?
        </td></tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[14]'>{{ $answer[14] }}</textarea>
          @else
            <div class='response'>{{ $answer[14] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;'>
          Please note : Student smoking is prohibited in host homes.
        </td>
      </tr>

      <tr>
        <td colspan='1' style='text-align:justify;'>
          11. Do you smoke?
        </td>
        <td colspan='4' style='font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[15]' value='No' @if ($answer[15] == 'No') checked='checked' @endif /> No
            <input type='radio' name='question[15]' value='Regular smoker' @if ($answer[15] == 'Regular smoker') checked='checked' @endif /> Regular smoker
            <input type='radio' name='question[15]' value='Occasional smoker' @if ($answer[15] == 'Occasional smoker') checked='checked' @endif /> Occasional smoker
          @else
            <div class='response2'>{{ $answer[15] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='1' style='text-align:justify;'>
          12. Can you live with smokers if you are placed to live with them?
        </td>
        <td style='font-weigh:bold;'>
          @if ($edit)
            <input type='radio' name='question[16]' value='Yes' @if ($answer[16] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[16]' value='No' @if ($answer[16] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[16] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5'>
          <h3 style='text-align:justify;'>V. The VWPP housing is described in detail in the <a href='http://en.vwpp.org/info-for-accepted-students/essential-housing-information/'>Essential Housing Information page on the VWPP Web site</a>. <u>You must read through this description 
          VERY carefully and then answer the following questions</u>.</h3>
        </td>
      </tr>

      <tr>
        <td colspan='5'style='text-align:justify;'>
          1. What is your principal concern or priority regarding housing?
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[28]'>{{ $answer[28] }}</textarea>
          @else
            <div class='response'>{{ $answer[28] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          2. <u>Please note</u> : every student participating on the VWPP should be prepared to live in a room in a French host's apartment (chambre dans un appartement - accueil en famille) with 3 family dinners and all breakfasts provided.
        </td>
      </tr>

      <tr>
        <td colspan='5'>
          <h3>VI. Dietary considerations</h3>
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
          Please note : French host homes are rarely solely vegetarian and almost never non-dairy or gluten free. Non-allergen meals and packaging cannot be guaranteed in France. If any of these specific dietary concerns apply to you and are noted below, we will do our best to accommodate them but cannot guarantee them.
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;'>
          1. Are you a vegetarian now?
        </td>
        <td style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[17]' value='Yes' @if ($answer[17] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[17]' value='No' @if ($answer[17] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[17] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          2. Do you eat:
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;padding-left:30px;'>
          a) fish?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[18]' value='Yes' @if ($answer[18] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[18]' value='No' @if ($answer[18] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[18] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;padding-left:30px;'>
          b) chicken?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[19]' value='Yes' @if ($answer[19] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[19]' value='No' @if ($answer[19] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[19] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;padding-left:30px;'>
          c) eggs?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[20]' value='Yes' @if ($answer[20] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[20]' value='No' @if ($answer[20] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[20] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;padding-left:30px;'>
          d) dairy products?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[21]' value='Yes' @if ($answer[21] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[21]' value='No' @if ($answer[21] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[21] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;padding-left:30px;'>
          e) pork?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[22]' value='Yes' @if ($answer[22] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[22]' value='No' @if ($answer[22] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[22] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:justify;'>
          3. Do you occasionally eat red meat?
        </td>
        <td colspan='2' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[23]' value='Yes' @if ($answer[23] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[23]' value='No' @if ($answer[23] == 'No') checked='checked' @endif /> No
          @else
            <div class='response2'>{{ $answer[23] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5'style='text-align:justify;'>
          4. Please note any specific:
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;padding-left:30px;'>
          a) dietary allergies
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[24]'>{{ $answer[24] }}</textarea>
          @else
            <div class='response'>{{ $answer[24] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;padding-left:30px;'>
          b) customs
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[25]'>{{ $answer[25] }}</textarea>
          @else
            <div class='response'>{{ $answer[25] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5'style='text-align:justify;'>
          5. Do you think you will adhere strictly to these dietary habits in France and do we need to abide 
          by them when considering your housing?
        </td>
      </tr>
      <tr>
        <td colspan='2'>&nbsp;</td>
        <td style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <input type='radio' name='question[26]' value='Yes' @if ($answer[26] == 'Yes') checked='checked' @endif /> Yes
            <input type='radio' name='question[26]' value='No' @if ($answer[26] == 'No') checked='checked' @endif /> No
          @else
            <div class='response'>{{ $answer[26] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5' style='text-align:justify;'>
          6. Do you have any allergies to cats, dogs, or are you allergic to anything else?
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[27]'>{{ $answer[27] }}</textarea>
          @else
            <div class='response'>{{ $answer[27] }}</div>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='5'>
          <h3>Other information</h3>
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;'>
          Please provide any further information that will assist us in securing the best housing arrangements for you by commenting on any of the following topics that are important to you with reference to your housing: children, animals, interests, neatness, study habits, noise, sleeping habits. (120 words)
        </td>
      </tr>
      <tr>
        <td colspan='5' style='text-align:justify;font-weight:bold;'>
          @if ($edit)
            <textarea name='question[32]'>{{ $answer[32] }}</textarea>
          @else
            <div class='response'>{{ $answer[32] }}</div>
          @endif
        </td>
      </tr>
    </table>

    <h3>Thank you for submitting your Housing questionnaire online.</h3>

    <p style='text-align:right'>
      @if ($edit)
        <a href='{{ asset("housing/{$student->id}") }}' class='myUI-button-right'>Cancel</a>
        <input type='submit' value='Submit' class='myUI-button-right'/>
      @else
        <a href='{{ asset("housing/{$student->id}/edit") }}' class='myUI-button-right'>Edit</a>
      @endif
    </p>

  </div>
</form>