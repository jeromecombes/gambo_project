@extends('layouts.myApp')

@section('content')

<div id='home'>
  <p>
    Congratulations! You are soon going to be a student in the Vassar-Wesleyan Program in Paris.
    It is very important that you provide all information requested on this site by the VWPP administration.
  </p>

  <p>
    Before you leave the US for France, please click on the appropriate tab to provide VWPP information regarding:
    <ul>
      <li>Personal details and contact information by <b>{{ $dates->date1 }}</b></li>
      <li>Housing preferences by <b>{{ $dates->date2 }}</b></li>
      <li>University preference by <b>{{ $dates->date3 }}</b></li>
      <li>pre-registration for VWPP Courses by <b>{{ $dates->date4 }}</b></li>
    </ul>
  </p>

  <p>Thank you for providing the above information by the date indicated above.</p>

  <div id='map'>
    <img src='img/map.png' alt='' />
  </div>

  <p>
    Une fois à Paris, vous devez accéder à ce site pour saisir l’information concernant :
    <ul>
      <li>vos cours universitaires</li>
      <li>tout voyage entrepris à titre personnel pendant votre séjour en France</li>
      <li>les évaluations requises par le programme à la fin de votre séjour</li>
    </ul>
  </p>

  <p>
    Merci de bien vouloir fournir toute information sollicitées dans les délais mentionnés par le
    directeur du programme. Une fois que vous êtes inscrit(e) dans tous les cours, vous pouvez aussi
    consulter votre emploi du temps individuel en cliquant sur l’onglet “Schedule” ci-dessus.
  </p>

</div>

<br/><br/>
<hr/>

<p style='font-size:8pt;text-align:justify;'>
  The information given to and collected on this database is for sole use by the Vassar-Wesleyan Program in Paris, the Office of International Studies at Wesleyan University and the Office of International Programs at Vassar College.<br/>
  The aforementioned offices abide by the French CNIL law « informatique et libertés » (data processing and personal rights) voted January 6, 1978 and amended in 2004.   You have access and are entitled to rectify your personal information and can request to do so at our office in Paris: VWPP, 4 rue de Chevreuse, Paris, 75006.<br/>
  To learn more about the CNIL compliance, view the following site: <a href='http://www.cnil.fr' target='_blank'>www.cnil.fr</a>
  <br/>
</p>

@endsection
