<h3>University</h3>

<div id='course4'>

  {{-- END OF SELECTED COURSES --}}

  @foreach ($courses as $course)

    @if ($course['lien'])
      <div style='position:absolute;font-size:40pt;'>&rdsh;</div>
      @php
        $disabled = "disabled='disabled'";
        $margin1 = 50;
        $margin2 = 0;
      @endphp
    @else
      @php
        $disabled = null;
        $margin1 = 0;
        $margin2 = 50;
      @endphp
    @endif


    <fieldset id='UnivCourse{{ $course['id'] }}' style='margin-left:{{ $margin1 }}px;'>
      <form name='UnivCourseFormModalites{{ $course['id'] }}' method='post' action='/courses/univ/update'>
        {{ csrf_field() }}
        <input type='hidden' name='id' value='{{ $course['id'] }}' />
        <input type='hidden' name='modalitesOnly' value='{{ $course['id'] }}' />

        <table style='margin-left:{{ $margin2 }}px;' class='tableUnivCourse' >

          <tr>
            <td>Code</td>
            <td class='response'>
              @if ($edit)
                <input type='text' name='code' value='{{ $course['code'] }}'/>
              @else
                {{ $course['code'] }}
              @endif
            </td>
          </tr>

          <tr>
            <td>Nom du cours</td>
            <td class='response'>
              @if ($edit)
                <input type='text' name='nom' value='{{ $course['nom'] }}'/>
              @else
                {{ $course['nom'] }}
              @endif
            </td>
          </tr>

          <tr>
            <td>Nature du cours</td>
            <td class='response'>
              @if ($edit)
                <select name='nature'>
                  <option value=''>&nbsp;</option>
                  {{-- @foreach ($config']['course_type'] as $elem) --}}
                  @foreach (explode(',', env('APP_COURSE_TYPE')) as $elem)
                    <option value='{{ $elem }}' @if ($course['nature'] == $elem) selected='selected' @endif >{{ $elem }}</option>
                  @endforeach
                </select>
              @else
                {{ $course['nature'] }}
              @endif
            </td>
          </tr>

          {{-- EDIT Course link --}}

          @if ($edit)
            @if (!empty($coursesForLink) and !$course['liaison'])
              <tr>
                <td style='padding-top:20px;'>
                  Si ce cours est rattaché à un autre cours déjà enregistré,<br/>veuillez le sélectionner dans cette liste
                </td>
                <td style='padding-top:20px;'>
                  <select name='lien' onchange='checkLink(this, $admin, {{ $course['id'] }});'>
                    <option value=''>&nbsp;</option>
                    @foreach ($coursesForLink as $elem)
                      @if (!$elem['lien'])
                        <option value='{{ $elem['id'] }}' @if ($course['lien'] == $elem['id']) selected='selected' @endif >{{ $elem['nom'] }} {$elem['prof'] }}</option>
                      @endif
                    @endforeach
                  </select>
                </td>
              </tr>
            @endif

            <tr>
              <td style='padding-top:20px;'>Institution</td>
              <td style='padding-top:20px;'>
                <select name='institution' id='institution{{ $course['id'] }}' onchange='checkInstitution(this, {{ $course['id'] }});' {{ $disabled }}>
                  <option value=''>&nbsp;</option>
                  {{-- @foreach ($config['institutions'] as $elem) --}}
                  @foreach (explode(',', env('APP_INSTITUTIONS')) as $elem)
                    <option value='{{ $elem }}' @if ($course['institution'] == htmlentities($elem, ENT_QUOTES|ENT_IGNORE, 'utf-8')) selected='selected' @endif >{{ $elem }}</option>
                  @endforeach
                  <option value='Autre' @if ($course['institution'] == 'Autre') selected='selected' @endif >Autre (Précisez)</option>
                </select>
              </td>
            </tr>

            <tr id='institutionAutreTr{{ $course['id'] }}' @if ($course['institution'] != 'Autre') style='display:none;' @endif>
              <td>Autre institution</td>
              <td>
                <input type='text' name='institutionAutre' id='institutionAutre{{ $course['id'] }}' value='{{ $course['institutionAutre'] }}' {{ $disabled}} />
              </td>
            </tr>

            <tr>
              <td>Discipline</td>
              <td>
                <select name='discipline' {{ $disabled }} id='discipline{{ $course['id'] }}'>
                  <option value=''>&nbsp;</option>
                  {{-- @foreach ($config['disciplines'] as $elem) --}}
                  @foreach (explode(',', env('APP_DISCIPLINES')) as $elem)
	                  <option value='{{ $elem }}' @if ($course['discipline'] == htmlentities($elem, ENT_QUOTES|ENT_IGNORE, 'UTF-8')) selected='selected' @endif >{{ $elem }}</option>
                  @endforeach
                </select>
              </td>
            </tr>

            <tr>
              <td>Niveau</td>
              <td>
                <select name='niveau' {{ $disabled }} id='niveau{{ $course['id'] }}'>
                  <option value=''>&nbsp;</option>
                  {{-- @foreach ($config['levels'] as $elem) --}}
                  @foreach (explode(',', env('APP_LEVELS')) as $elem)
                    <option value='{{ $elem }}' @if ($course['niveau'] == $elem) selected='selected' @endif >{{ $elem }}</option>
                  @endforeach
                </select>
              </td>
            </tr>

          {{-- END EDIT Course link --}}

          @else

          {{-- SHOW Course link --}}

            @if ($course['lien'])
              <tr>
                <td style='padding-top:20px;'>Ce cours est rattaché au cours suivant :</td>
                <td style='padding-top:20px;' class='response'>{{ $course['lien'] }}</td>
              </tr>
            @else
              <tr>
                <td style='padding-top:20px;'>Institution</td>
                <td style='padding-top:20px;' class='response'> {{$course['institution'] }}</td>
              </tr>

              <tr>
                <td>Discipline</td>
                <td class='response'>{{ $course['discipline'] }}</td>
              </tr>

              <tr>
                <td>Niveau</td>
                <td class='response'>{{ $course['niveau'] }}</td>
              </tr>
            @endif
          @endif

          {{-- END SHOW Course link --}}

          <tr>
            <td style='padding-top:20px;'>Professeur (Nom, Prénom)</td>
            <td style='padding-top:20px;' class='response'>
              @if ($edit)
                <input type='text' name='prof' value='{{ $course['prof'] }}' />
              @else
                {{ $course['prof'] }}
              @endif
            </td>
          </tr>

          <tr>
            <td>E-mail</td>
            <td class='response'>
              @if ($edit)
                <input type='text' name='email' value='{{ $course['email'] }}' />
              @else
                {{ $course['email'] }}
              @endif
            </td>
          </tr>

          <tr>
            <td>Horaires</td>
            <td class='response'>
              @if ($edit)
                <select name='jour' style='width:31%;'>
                  <option value=''>Jour</option>
                  @foreach ($days as $day)
                    <option value='{{ $day[0] }}' @if ($course['jour'] == $day[0]) selected='selected' @endif >{{ $day[1] }}</option>
                  @endforeach
                </select>
                <select name='debut' style='width:33%;'>
                  <option value=''>Début</option>
                  @for ($i = $hoursStart; $i < $hoursEnd + 1; $i++)
                    @for ($j = 0; $j < 60; $j = $j + 15)
                      @php
                        $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                        $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                      @endphp
                      <option value='{{ $h1 }}' @if ($course['debut'] == $h1) selected='selected'@endif >de {{ $h2 }}</option>
                    @endfor
                  @endfor
                </select>

                <select name='fin' style='width:33%;'>
                  <option value=''>Fin</option>
                  @for ($i = $hoursStart; $i < $hoursEnd + 1; $i++)
                    @for ($j = 0; $j < 60; $j = $j + 15)
                      @php
                        $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                        $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                      @endphp
                      <option value='{{ $h1 }}' @if ($course['fin'] == $h1) selected='selected'@endif >de {{ $h2 }}</option>
                    @endfor
                  @endfor
                </select>
              @else
                {{ $days[$course['jour']][1] }} {{ $course['debut'] }} {{ $course['fin'] }}
              @endif
              </td>
          </tr>

          <tr>
            <td style='padding-top:20px;'>Aurez-vous une note pour ce cours ?</td>
            <td style='padding-top:20px;' class='response'>
              @if ($edit)
                <input type='radio' name='note' value='1' @if ($course['note'] == 1) checked='checked' @endif /> Oui
                <input type='radio' name='note' value='2' @if ($course['note'] == 2) checked='checked' @endif /> Non
              @else
                {{ $course['note2'] }}
              @endif
            </td>
          </tr>

          <tr>
            <td colspan='2' style='padding-top:20px;'>Avez-vous discuté des modalités du devoir final avec votre professeur ?</td>
          </tr>

          <tr id='modalites0_{{ $course['id'] }}'>
            <td>&nbsp;</td>
            <td class='response'>
              @if ($edit)
                <input type='radio' name='note' value='1' @if ($course['modalites'] == 1) checked='checked' @endif /> Oui
                <input type='radio' name='note' value='2' @if ($course['modalites'] == 2) checked='checked' @endif /> Non
              @else
                {{ $course['modalites'] }}
              @endif
              </td>
          </tr>

          <tr>
            <td colspan='2'>Si oui, quelles sont-elles ?</td>
          </tr>

          <tr id='modalitesText{{ $course['id'] }}'>
            <td colspan='2' class='response'>
              @if ($edit)
                <textarea name='modalites1'>{{ $course['modalites1'] }}</textarea>
              @else
                {{ $course['modalites1'] }}
              @endif
              </td>
          </tr>

          <tr>
            <td colspan='2' style='font-size:9pt;'>Champ réservé aux administrateurs</td>
          </tr>
          <tr>
            <td colspan='2' class='response'>
              @if ($admin and $edit)
                <textarea name='modalites2'>{{ $course['modalites2'] }}</textarea>
              @else
                {{ $course['modalites2'] }}
              @endif
            </td>
          </tr>

          @if ($edit)
            <tr>
              <td colspan='2' style='text-align:right;'>
                <input type='reset' value='Annuler' onclick='editCourse({{ $course['id'] }}, false);' class='myUI-button-right'/>
                <input type='submit' value='Valider' class='myUI-button-right' />
              </td>
            </tr>
          @else
            @if ($admin2 or (!$admin and !$course['lock']))
              <tr>
                <td colspan='2' style='padding-top:20px; text-align:right;'>
                  <input type='button' value='Modifier' onclick='editCourse({{ $course['id'] }}, true);' class='myUI-button-right'/>

                  @if (!$course['liaison'])
                    <input type='button' value='Supprimer' onclick='dropCourse({{ $course['id'] }}, {{ $admin }});' class='myUI-button-right'/>
                  @endif

                  @if ($admin2)
                    <input type='button' value='@if ($course['lock']) Déverrouiller @else Verrouiller @endif' id='lock{{ $course['id'] }}' onclick='lockCourse4({{ $course['id'] }});' class='myUI-button-right'/>
                  @endif
                </td>
              </tr>
            @endif

            @if (!$admin and $course['lock'])
              <tr>
                <td colspan='2' style='padding-top:20px; text-align:right;'>
                  <input type='button' value='Modifier' id='modalitesUpdate{{ $course['id'] }}' onclick='editModalites({{ $course['id'] }}, true);' class='myUI-button-right'/>
                  <input type='reset' value='Annuler' style='display:none;' id='modalitesReset{{ $course['id'] }}' onclick='editModalites({{ $course['id'] }}, false);' class='myUI-button-right'/>
                  <input type='submit' value='Valider' style='display:none;' id='modalitesSubmit{{ $course['id'] }}' class='myUI-button-right'/>
                </td>
              </tr>
            @endif
          @endif
        </table>
      </form>
    </fieldset>
  @endforeach

  {{-- END OF SELECTED COURSES --}}


  {{-- ADD A COURSE BUTTON --}}

  @if (!$admin or $admin2)
    <br/>
    <input type='button' value="Ajouter un cours à l'université" onclick='addUnivCourse(this);' id='AddCourseButton' class='myUI-button'/>
  @endif


  {{-- ADD A NEW COURSE --}}

{{--
$coursesForLink=array();
foreach($courses as $elem){
  if(!$elem['lien']){
    $coursesForLink[]=$elem;
  }
}
--}}

  <fieldset id='newUnivCourse' style='display:none;'>
    <form name='newUnivCourseForm' method='post' action='/courses/univ/add'>
      {{ csrf_field() }}

      <table>
        <tr>
          <td>Code</td>
          <td>
            <input type='text' name='code' />
          </td>
        </tr>
        <tr>
          <td>Nom du cours</td>
          <td>
            <input type='text' name='nom' />
          </td>
        </tr>
        <tr>
          <td>Nature du cours</td>
          <td>
            <select name='nature'>
              <option value=''>&nbsp;</option>
              @foreach (explode(',', env('APP_COURSE_TYPE')) as $elem)
                <option value='{{ $elem }}'>{{ $elem }}</option>
              @endforeach
            </select>
          </td>
        </tr>

        @if (!empty($courses))
          <tr>
            <td style='padding-top:20px;'>
              Si ce cours est rattaché à un autre cours déjà enregistré,<br/>veuillez le sélectionner dans cette liste
            </td>
            <td style='padding-top:20px;'>
              <select name='lien' onchange='checkLink(this, {{ $admin }}, "");'>
                <option value=''>&nbsp;</option>
                @foreach ($coursesForLink as $elem)
                  <option value='{{ $elem['id'] }}'>{{ $elem['nom'] }} {{ $elem['prof'] }}</option>
                @endforeach
              </select>
            </td>
          </tr>
        @endif

        <tr>
          <td style='padding-top:20px;'>Institution</td>
          <td style='padding-top:20px;'>
            <select name='institution' id='institution' onchange='checkInstitution(this, "");'>
              <option value=''>&nbsp;</option>
              @foreach (explode(',', env('APP_INSTITUTIONS')) as $elem)
                <option value='{{ $elem }}'>{{ $elem }}</option>
              @endforeach
              <option value='Autre'>Autre (Précisez)</option>
            </select>
          </td>
        </tr>

        <tr id='institutionAutreTr' style='display:none;'>
          <td>Autre institution</td>
          <td>
            <input type='text' name='institutionAutre' id='institutionAutre'/>
          </td>
        </tr>
        <tr>
          <td>Discipline</td>
          <td>
            <select name='discipline' id='discipline' >
              <option value=''>&nbsp;</option>
              @foreach (explode(',', env('APP_DISCIPLINES')) as $elem)
                <option value='{{ $elem }}'>{{ $elem }}</option>
              @endforeach
            </select>
          </td>
        </tr>

        <tr>
          <td>Niveau</td>
          <td>
            <select name='niveau' id='niveau'>
              <option value=''>&nbsp;</option>
              @foreach (explode(',', env('APP_LEVELS')) as $elem)
                <option value='{{ $elem }}'>{{ $elem }}</option>
              @endforeach
            </select>
          </td>
        </tr>

        <tr>
          <td style='padding-top:20px;'>Professeur (Nom, Prénom)</td>
          <td style='padding-top:20px;'>
            <input type='text' name='prof' />
          </td>
        </tr>

        <tr>
          <td>E-mail</td>
          <td>
            <input type='text' name='email'/>
          </td>
        </tr>

        <tr>
          <td>Horaires</td>
          <td>
            <select name='jour' style='width:31%;'>
              <option value=''>Jour</option>
              <option value='1'>Lundi</option>
              <option value='2'>Mardi</option>
              <option value='3'>Mercredi</option>
              <option value='4'>Jeudi</option>
              <option value='5'>Vendredi</option>
              <option value='6'>Samedi</option>
              <option value='7'>Dimanche</option>
            </select>
            <select name='debut' style='width:33%;'>
              <option value=''>Début</option>
              @for ($i = $hoursStart; $i < $hoursEnd + 1; $i++)
                @for ($j = 0; $j < 60; $j = $j + 15)
                  @php
                    $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                    $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                  @endphp
                  <option value='{{ $h1 }}'>de {{ $h2 }}</option>
                @endfor
              @endfor
            </select>
            <select name='fin' style='width:33%;'>
              <option value=''>Fin</option>
              @for ($i = $hoursStart; $i < $hoursEnd + 1; $i++)
                @for ($j = 0; $j < 60; $j = $j + 15)
                  @php
                    $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                    $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                  @endphp
                  <option value='{{ $h1 }}'>de {{ $h2 }}</option>
                @endfor
              @endfor
            </select>
          </td>
        </tr>

        <tr>
          <td style='padding-top:20px;'>Aurez-vous une note pour ce cours ?</td>
          <td style='padding-top:20px;'>
            <input type='radio' name='note' value='1' /> Oui
            <input type='radio' name='note' value='0' /> Non
          </td>
        </tr>

        <tr>
          <td colspan='2' style='padding-top:20px;'>Avez-vous discuté des modalités du devoir final avec votre professeur ?</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type='radio' name='modalites' value='Oui' /> Oui
            <input type='radio' name='modalites' value='Non' /> Non
          </td>
        </tr>

        <tr>
          <td colspan='2'>Si oui, quelles sont-elles ?</td>
        </tr>
        <tr>
          <td colspan='2'><textarea name='modalites1'></textarea></td>
        </tr>

        @if ($admin)
          <tr>
            <td colspan='2' style='font-size:9pt;'>Champ réservé aux administrateurs</td>
          </tr>
          <tr>
            <td colspan='2'><textarea name='modalites2'></textarea></td>
          </tr>
        @endif

        <tr>
          <td colspan='2' style='text-align:right;'>
            <input type='reset' value='Annuler' onclick='resetNewCourse();' class='myUI-button-right'/>
            <input type='submit' value='Valider' class='myUI-button-right' />
          </td>
        </tr>
      </table>
    </form>
  </fieldset>

  {{-- END OF ADD A NEW COURSE --}}
</div>
