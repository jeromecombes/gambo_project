<h3>Formulaire de voyage</h3>

<p style='font-weight:bold;text-align:justify;'>
  Veuillez remplir le formulaire ci-dessous au moins 24h avant votre départ et il vous sera envoyé une confirmation de réception de la part du programme avant votre départ :
</p>

<fieldset>

  @if ($edit)
    <form action=' {{ route('trip.update') }}' method='post' onsubmit='return tripFormValidation();'>
    {{ csrf_field() }}
    <input type='hidden' name='lastname' value='{{ $trip->lastname }}' />
    <input type='hidden' name='firstname' value='{{ $trip->firstname }}' />
    <input type='hidden' name='email' value='{{ $trip->email }}' />
    <input type='hidden' name='cellphone' value='{{ $trip->cellphone }}' />
  @endif

    <table style='width:100%;'>
      <tr>
        <td style='width:360px;'></td>
        <td style='width:360px;'></td>
        <td></td>
      </tr>
      <tr>
        <td><b>Nom, prénom : </b></td>
        <td colspan='2' class='response'>{{ $trip->lastname }}, {{ $trip->firstname }}</td>
      </tr>

      <tr>
        <td><b>Email, Mobile: </b></td>
        <td colspan='2' class='response'>{{ $trip->email }}, {{ $trip->cellphone }}</td>
      </tr>

      <tr>
        <td style='padding-top:20px;'><b>Date de départ :</b> @if ($edit) (Obligatoire) @endif</td>
        <td colspan='2' style='padding-top:20px;'>
          @if ($edit)
            <input type='text' name='start' value='{{ $trip->start }}' class='myUI-datepicker-string required' style='width:100%;' />
          @else
            <span class='response'>{{ $trip->start }}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='padding-top:20px;'><b>Date de retour :</b> @if ($edit) (Obligatoire) @endif</td>
        <td colspan='2' style='padding-top:20px;'>
          @if ($edit)
            <input type='text' name='end' value='{{ $trip->end }}' class='myUI-datepicker-string required' style='width:100%;' />
          @else
            <span class='response'>{{ $trip->end }}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='padding-top:20px;'><b>Destination(s) :</b> @if ($edit) (Obligatoire) @endif</td>
        <td colspan='2' style='padding-top:20px;'>
          @if ($edit)
            <textarea name='destination' class='required'>{{ $trip->destination }}</textarea>
          @else
            <span class='response'>{!! nl2br(e($trip->destination)) !!}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='text-align:justify;' colspan='3'><b>Moyen(s) de transport (avion - N° de vols, horaires et compagnies aériennes ; trains - horaires et destinations des trains)</b>
      </td>
      </tr>

      <tr>
        <td></td>
        <td colspan='2'>
          @if ($edit)
            <textarea name='transport'>{{ $trip->transport }}</textarea>
          @else
            <span class='response'>{!! nl2br(e($trip->transport)) !!}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='text-align:justify;' colspan='3'><b>Adresse(s) sur place (hôtel, auberge, amis, etc.) :</b> @if ($edit) (Obligatoire) @endif</td>
      </tr>

      <tr>
        <td></td>
        <td colspan='2'>
          @if ($edit)
            <textarea name='address' class='required'>{{ $trip->address }}</textarea>
          @else
            <span class='response'>{!! nl2br(e($trip->address)) !!}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='1'><b>N° de téléphone où on peut vous joindre :</b> @if ($edit) (Obligatoire) @endif</td>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='phone' value='{{ $trip->phone }}' style='width:100%;' class='required'/>
          @else
            <span class='response'>{{ $trip->phone }}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='padding-top:20px;text-align:justify;' colspan='3'>
          <b>Acceptez-vous que l'on communique ces informations à vos parents ?</b> @if ($edit) (Obligatoire) @endif
          @if ($edit)
            <span style='position: absolute; left:720px;'>
              <input type='radio' name='parents_notification' value='Yes' class='requiredRadio' @if ($trip->parents_notification == 'Yes') checked='checked' @endif /> Oui
              <input type='radio' name='parents_notification' value='No' style='margin-left:20px;' class='requiredRadio' @if ($trip->parents_notification == 'No') checked='checked' @endif /> Non
            </span>
          @else
            <span class='response'>{{ __($trip->parents_notification) }}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td style='padding-top:20px;text-align:justify;' colspan='2'>
          <b>Pour pouvoir envoyer votre formulaire, veuillez accepter les conditions suivantes :</b>

          <ul>
            <li>
              <b>J’accepte que l'on communique ces informations à mon université</b> @if ($edit) (Obligatoire) @endif
              @if ($edit)
                <span style='position: absolute; left:720px;'>
                  <input type='checkbox' name='university_notification' value='Yes' class='requiredCheckbox' @if ($trip->university_notification == 'Yes') checked='checked' @endif />
                </span>
              @else
                <span class='response'> : @if ($trip->university_notification == 'Yes') Oui @else Non @endif</span>
              @endif
            </li>
            <li>
              <b>J'ai lu les consignes de sécurité avant les congés</b> @if ($edit) (Obligatoire) @endif
              @if ($edit)
                <span style='position: absolute; left:720px;'>
                  <input type='checkbox' name='terms' value='Yes' class='requiredCheckbox' @if ($trip->terms == 'Yes') checked='checked' @endif />
                </span>
              @else
                <span class='response'> : @if ($trip->terms == 'Yes') Oui @else Non @endif</span>
              @endif
            </li>
          </ul>
        </td>
      </tr>

      <tr>
        <td colspan='3' style='padding-top:20px;'><b>Assurez-vous que vous avez le N°  de téléphone portable du directeur avec vous :</b></td>
      </tr>

      <tr>
        <td colspan='3' style='padding-top:20px;text-align:center;font-size:22pt;'><b>
      06-40-15-51-71</b></td>
      </tr>

      @if ($edit)
        <tr>
          <td colspan='3' style='padding-top:20px;text-align:center;'>
            <input type='submit' value='Envoyer' class='btn btn-primary' style='font-size:18pt;' />
          </td>
        </tr>
      @endif

    </table>

  @if ($edit)
    </form>
  @endif

</fieldset>
