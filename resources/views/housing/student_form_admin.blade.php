<div style='margin-bottom:50px;'>
  @if (in_array(7, session('access')))
    <p>Affectation d'un logement pour {{ $student->firstname }} {{ $student->lastname }} pour {{ session('semester') }}.</p>

    <form name='housing_assignment' method='post' action='/housing_assignment' >
      {{ csrf_field() }}
      <input type='hidden' name='student' value='{{ $student->id }}' />

      <table>
        <tr>
          <td style='width:500px;'>
            <select name='host'>
              <option value=''>&nbsp;</option>

              @foreach ($hosts as $host)
                <option value='{{ $host->id }}' @if ($selected_host and $selected_host->id == $host->id) selected='selected' @endif>{{ $host->firstname }} {{ $host->lastname }}, {{ $host->zipcode }}</option>
              @endforeach

            </select>
          </td>
          <td>
            <input type='submit' value='Submit' class='btn btn-primary' />
          </td>
        </tr>
      </table>
    </form>
  @endif

  @if ($selected_host)
    <div style='margin-top:40px;'>
      <b>Logement actuellement affecté</b>
      <table>
        <tr><td>Nom</td><td>{{ $selected_host->lastname }}</td></tr>
        <tr><td>Prénom</td><td>{{ $selected_host->firstname }}</td></tr>
        <tr><td>Adresse</td><td>{{ $selected_host->address }}</td></tr>
        <tr><td>Code Postal</td><td>{{ $selected_host->zipcode }}</td></tr>
        <tr><td>Ville</td><td>{{ $selected_host->city }}</td></tr>
        <tr><td>Téléphone</td><td>{{ $selected_host->phonenumber }}</td></tr>
        <tr><td>Portable</td><td>{{ $selected_host->cellphone }}</td></tr>
        <tr><td>Email</td><td>{{ $selected_host->email }}</td></tr>
      </table>
    </div>
  @endif

</div>

<h3>Student form</h3>