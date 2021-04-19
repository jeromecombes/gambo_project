@extends('layouts.myApp')
@section('content')

    <h3>Housing - Liste des logements - {{ session('semester') }}</h3>

    <a href="{{ asset('admin/housing') }}">Housing Home</a>

    <div style='text-align:right; margin: 0 0 20px 0;'>
      @if (in_array(7, Auth::user()->access))
        {{ Form::button('Add', ['onclick' => 'location.href="/host"', 'class' => 'btn btn-primary']) }}
      @endif
    </div>

    {{ Form::open(array('name' => 'form', 'url' => '/admin/housing-email.php')) }}

        <table class='datatable'>

            <thead>
                <tr>
                    <th class='dataTableNoSort' style='width:40px;'>
                        <input type='checkbox' onclick='checkall("form",this)' />
                    </th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Code Postal</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Portable</th>
                    <th>Etudiant</th>
                </tr>
            </thead>

            <tbody>

            @foreach($hosts as $host)
                <tr>
                    <td style='white-space: nowrap;'>
                        <input type='checkbox' name='housing[]' value='{{ $host->id }}' onclick='setTimeout("select_action(\"form\")",5);'/>
                        <a href='/host/{{ $host->id }}'>
                            <img src='img/edit.png' alt='Edit' />
                        </a>
                        <input type='hidden' id='mail_{{ $host->id }}' value='{{ $host->email }}' />
                        <input type='hidden' id='mail2_{{ $host->id }}' value='{{ $host->email2 }}' />
                    </td>
                    <td>{{ $host->lastname }}</td>
                    <td>{{ $host->firstname }}</td>
                    <td>{{ $host->zipcode }}</td>
                    <td>
                        <a href='mailto:{{ $host->email }}'>{{ $host->email }}</a>
                    </td>
                    <td>{{ $host->phonenumber }}</td>
                    <td>{{ $host->cellphone }}</td>
                    <td>{{ $host->studentname }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    {{ Form::close() }}

    {{ Form::open(array('name' => 'form2', 'url' => '#')) }}

        <p>
            Pour la sélection :
            <select id='action' onchange='select_action(\"form\");' style='width:250px;' class='ui-widget-content ui-corner-all'>
                <option value=''>&nbsp;</option>
                <option value='Email_Housing'>Envoyer un email (Logiciel)</option>
                <option value='Email2_Housing'>Envoyer un email (Web Browser)</option>
                <option value='Excel_Housing'>Exporter en Excel</option>
            </select>

            <input type='button' id='submit_button' value='Valider' disabled='disabled' onclick='submit_action(\"form2\",\"form\");' class='myUI-button'/>
        </p>

    {{ Form::close() }}

@endsection
