@extends('emails.layouts.plain')
Dear {{ $student->firstname }} {{ $student->lastname }},


Congratulations on being accepted to the Vassar-Wesleyan Program in Paris.
Please use the following login and password information to connect to the VWPP Administrative Portal at https://data.vwpp.org. You will need access to your account in order fill in required forms for the Housing Questionnaire, University choice and Course registration among others.
Instructions and key deadlines can be found on the pre-registration timeline on the VWPP website at ttps://en.vwpp.org under the heading "Info for Accepted Students".

login: {{ $student->email }}
password: {{ $password }}

Please note: you will be able to change your password by clicking on the My Account tab once you enter into the system.

If you have any questions, please do not hesitate to contact the office of International Programs at Vassar College or the Office of International Studies at Wesleyan University.

Thank you.

@section('content')
@endsection
