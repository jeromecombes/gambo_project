@extends('layouts.myApp')
@section('content')

<form name='stdform$id' action='update.php' method='post' />
  <input type='hidden' name='std_id' value='{{ $student->id}}' />
  <input type='hidden' name='table' value='students' />
  <input type='hidden' name='acl' value='6' />

  <h3>Personal Details and Contact Information</h3>

  <fieldset>

    <table style='width:100%;'>
      <tr>
        <td style='width:40%;'>
          <table style='width:100%;'>

            <!-- Personal details -->
            <tr>
              <td colspan='2'>
                <br/>
                <b><u>Personal Details</u></b>
              </td>
            </tr>
            <tr>
              <td style='width:220px;'>Lastname</td>
              <td style='width:360px;'>
                @if ($edit)
                  <input type='text' name='std[lastname]' value='{{ $student->lastname}}'/>
                @else
                  {{ $student->lastname}}
                @endif
              </td>
            </tr>
            <tr>
              <td>Firstname</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[firstname]' value='{{ $student->firstname}}'/>
                @else
                  {{ $student->firstname}}
                @endif
              </td>
            </tr>
            <tr>
              <td>Gender</td>
              <td>
                @if ($edit)
                  <select name='std[gender]'>
                    <option value=''>&nbsp;</option>
                    <option value='Female' @if ($student->gender == 'Female') selected='selected' @endif >Female</option>
                    <option value='Male' @if ($student->gender == 'Male') selected='selected' @endif >Male</option>
                  </select>
                @else
                  {{ $student->gender }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Citizenship 1</td>
              <td>
                @if ($edit)
                  <select name='std[citizenship1]'/>
                    <option value=''>&nbsp;</option>
                    @foreach ($countries as $country)
                      <option value='$elem' @if ($student->citizenship1 == $country) selected='selected' @endif >{{ $country }}</option>
                    @endforeach
                  </select>
                @else
                  {{ $student->citizenship1 }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Citizenship 2</td>
              <td>
                @if ($edit)
                  <select name='std[citizenship2]'/>
                    <option value=''>&nbsp;</option>
                    @foreach ($countries as $country)
                      <option value='$elem' @if ($student->citizenship2 == $country) selected='selected' @endif >{{ $country }}</option>
                    @endforeach
                  </select>
                @else
                  {{ $student->citizenship2 }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Date of birth </td>
              <td>
                @if ($edit)
                  <select name='std[mob]' style='width:30%;'>
                    <option value=''>Month</option>
                    @foreach ($months as $month)
                      <option value='{{ $month->id }}' @if ($student->dob->format('n') == $month->id) selected='selected' @endif >{{ $month->name }}</option>\n";
                    @endforeach
                  </select>

                  <select name='std[dayob]' style='width:30%;'>
                    <option value=''>Day</option>
                    @for ($i = 1; $i < 32; $i++)
                      <option value='{{ str_pad($i,2,'0',STR_PAD_LEFT) }}' @if ($student->dob->format('d') == $i) selected='selected' @endif >{{ str_pad($i,2,'0',STR_PAD_LEFT) }}</option>
                    @endfor
                  </select>

                  <select name='std[yob]' style='width:30%;'>
                    <option value=''>Year</option>
                    @for ($i = $years[0]; $i > $years[1]; $i--)
                      <option value='{{ $i }}' @if ($student->dob->format('Y') == $i) selected='selected' @endif >{{ $i }}</option>
                    @endfor
                  </select>
                @else
                  {{ $student->dob->format('M d, Y') }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Place of birth (City, State)</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[placeOB]' value='{{ $student->placeOB }}' />
                @else
                  {{ $student->placeOB }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Country of birth</td>
              <td>
                @if ($edit)
                  <select name='std[countryOB]'/>
                    <option value=''>&nbsp;</option>
                    @foreach ($countries as $country)
                      <option value='{{ $country }}' @if ($student->countryOB == $country) selected='selected' @endif >{{ $country }}</option>
                    @endforeach
                  </select>
                @else
                  {{ $student->countryOB }}
                @endif
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[email]' value='{{ $student->email }}'/>
                @else
                  {{ $student->email }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Cellphone in France</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[cellphone]' value='{{ $student->cellphone }}'/>
                @else
                  {{ $student->cellphone }}
                @endif
              </td>
            </tr>

            <!-- Housing 	-->
            @if ($host)
              <tr>
                <td colspan='2'><br/><b><u>Housing in France</u></b></td>
              </tr>			
              <tr>
                <td>Lastname</td>
                <td>{{ $host->lastname }}</td>
              </tr>
              <tr>
                <td>Firstname</td>
                <td>{{ $host->firstname }}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>{{ $host->address }}</td>
              </tr>
              <tr>
                <td>Zip Code</td>
                <td>{{ $host->zipcode }}</td>
              </tr>
              <tr>
                <td>City</td>
                <td>{{ $host->city }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ $host->email }}</td>
              </tr>
              <tr>
                <td>Phone number</td>
                <td>{{ $host->phonenumber }}</td>
              </tr>
              <tr>
                <td>Cellphone</td>
                <td>{{ $host->cellphone }}</td>
              </tr>
            @endif
          </table>
        </td>

        <td style='width:40%;'>
          <table style='width:100%;'>

            <!-- Contact information -->
            <tr>
              <td colspan='2'><br/><b><u>Contact Information for Parent/Guardian</u></b></td>
            </tr>
            <tr>
              <td style='width:40%;'>Lastname</td>
              <td style='width:60%;'>
                @if ($edit)
                  <input type='text' name='std[contactlast]' value='{{ $student->contactlast }}'/>
                @else
                  {{ $student->contactlast }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Firstname</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[contactfirst]' value='{{ $student->contactfirst }}'/>
                @else
                  {{ $student->contactfirst }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Street</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[street]' value='{{ $student->street }}'/>
                @else
                  {{ $student->street }}
                @endif
              </td>
            </tr>
            <tr>
              <td>City</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[city]' value='{{ $student->city }}'/>
                @else
                  {{ $student->city }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Zip code</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[zip]' value='{{ $student->zip }}'/>
                @else
                  {{ $student->zip }}
                @endif
              </td>
            </tr>
            <tr>
              <td>State</td>
              <td>
                @if ($edit)
                  <select name='std[state]'/>
                    <option value=''>&nbsp;</option>
                    @foreach ($states as $state)
                      <option value='{{ $state }}' @if ($student->state == $state) selected='selected' @endif >{{ $state }}</option>
                    @endforeach
                  </select>
                @else
                  {{ $student->state }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Country</td>
              <td>
                @if ($edit)
                  <select name='std[country]'/>
                    <option value=''>&nbsp;</option>
                    @foreach ($countries as $country)
                      <option value='{{ $country }}' @if ($student->country == $country) selected='selected' @endif >{{ $country }}</option>
                    @endforeach
                  </select>
                @else
                  {{ $student->country }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Phone number</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[contactphone]' value='{{ $student->contactphone }}'/>
                @else
                  {{ $student->contactphone }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Cellphone number</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[contactmobile]' value='{{ $student->contactmobile }}'/>
                @else
                  {{ $student->contactmobile }}
                @endif
              </td>
            </tr>
            <tr>
              <td>Email</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[contactemail]' value='{{ $student->contactemail }}'/>
                @else
                  {{ $student->contactemail }}
                @endif
              </td>
            </tr>

            <!-- Program information -->
            <tr>
              <td colspan='2'><br/><b><u>Program Information</u></b></td>
            </tr>

            @if (strstr($student->semesters[0], 'Fall'))
              <tr>
                <td>Semesters with VWPP</td>
                <td>
                  @if (session('admin') and $edit)
                    <ul style='margin-top:0px;'>
                      <li>{{ $student->semesters[0] }}</li>
                      <li>{{ $student->newSemester }} ? <input type='checkbox' name='std[semesters][]' value='{{ $student->newSemester }}' @if ($student->newSemesterChecked) checked='checked' @endif /></li>
                    </ul>
                  @else
                    {{ $student->semesters[0] }}
                    @if ($student->newSemesterChecked)
                      , {{ $student->newSemester }}
                      <input type='hidden' name='std[semesters][]' value='{{ $student->newSemester }}' />
                    @endif
                  @endif
                </td>
              </tr>
            @else
              <tr>
                <td>Semester with VWPP</td>
                <td>{{ $student->semesters[0] }}</td>
              </tr>
            @endif

            <tr>
              <td>Home Institution</td>
              <td>{{ $student->home_institution }}</td>
            </tr>
            <tr>
              <td>Résultat TCF</td>
              <td>
                @if (session('admin') and $edit)
                  <input type='text' name='std[resultatTCF]' value='{{ $student->resultatTCF }}' />
                @else
                  {{ $student->resultatTCF }}
                @endif
              </td>
            </tr>
            <tr>
              <td>French University</td>
              <td>{{ $french_univ }}</td>
            </tr>
            <tr>
              <td>French Univ. Student number</td>
              <td>
                @if ($edit)
                  <input type='text' name='std[frenchNumber]' value='{{ $student->frenchNumber }}' />
                @else
                  {{ $student->frenchNumber }}
                @endif
              </td>
            </tr>
          </table>
        </td>
        <td style='padding-top:20px;'>{!! $photo !!}</td>
      </tr>
    </table>

    <p style='text-align:right'>
      @if ($edit)
        <input type='hidden' name='std[semesters][]' value='{{ $student->semesters[0] }}'/>
        <a href='{{ asset("student/{$student->id}") }}' class='myUI-button-right'>Cancel</a>
        <input type='button' onclick='document.stdform$id.submit();' value='Done' class='myUI-button-right'/>
      @else
        <a href='{{ asset("student/{$student->id}/edit") }}' class='myUI-button-right'>Edit</a>
      @endif
    </p>
  </fieldset>
</form>

@endsection