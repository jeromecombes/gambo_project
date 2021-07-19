@extends('emails.layouts.html')

@section('content')
  <p>
    Dear {{ $student->firstname }} {{ $student->lastname }},<br/>
    <br/>
    Congratulations on being accepted to the Vassar-Wesleyan Program in Paris.<br/>
    Please use the following login and password information to connect to the VWPP Administrative Portal at <a href="https://data.vwpp.org">https://data.vwpp.org</a>. You will need access to your account in order fill in required forms for the Housing Questionnaire, University choice and Course registration among others.<br/>
    Instructions and key deadlines can be found on the pre-registration timeline on the VWPP website at <a href="https://en.vwpp.org">https://en.vwpp.org</a> under the heading "Info for Accepted Students".<br/>
    <ul>
        <li>login: <b>{{ $student->email }}</b></li>
        <li>password: <b>{{ $password }}</b></li>
    </ul>
    Please note: you will be able to change your password by clicking on the My Account tab once you enter into the system.<br/>
    <br/>
    If you have any questions, please do not hesitate to contact the office of International Programs at Vassar College or the Office of International Studies at Wesleyan University.<br/>
    <br/>
    Thank you.<br/>
  </p>
@endsection
