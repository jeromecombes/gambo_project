<h3>University Registration</h3>

<fieldset>
  <div style='text-align:center;margin-bottom:40px;'>
    <h3>Vassar-Wesleyan Program in Paris<br/>
      University Registration Request Form</h3>
  </div>

  <form name='form' id='univ_reg_form' action='/univ_reg' method='post' >
    {{ csrf_field() }}
    <input type='hidden' name='student' value='{{ $student->id }}' />

    <table>
      <tr>
        <td>Lastname :</td>
        <td colspan='2' class='response'>{{ $student->lastname }}</td>
      </tr>
      <tr>
        <td>Firstname :</td>
        <td colspan='2' class='response'>{{ $student->firstname }}</td>
      </tr>
      <tr>
        <td>Email :</td>
        <td colspan='2' class='response'>{{ $student->email }}</td>
      </tr>
