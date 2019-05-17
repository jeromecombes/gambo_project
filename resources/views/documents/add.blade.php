@extends('layouts.myApp')
@section('content')

<h3>Documents</h3>
<p>
In this space you can upload required documents by clicking the edit button below.<br/>
Note that only pdf, jpg and word documents (with extensions .pdf, jpg our .jpeg and .doc or .docx) are permitted.<br/>
<br/>
</p>

<fieldset>
    <form method='POST' enctype='multipart/form-data' action='/documents'>
    {{ csrf_field() }}
    
    <input type='hidden' name='student' value="{{session('student')}}" />

        <table>
            <thead>
                <tr>
                    <th>File</th>
                    <th>Type of document</th>
                    @if(session('admin'))
                        <th>Admin Only</th>
                    @endif
                </tr>
            </thead>

            <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>
                        <input type='file' name='file{{$i}}' />
                    </td>
                    <td>
                        <select name='rel{{$i}}'>
                        @foreach($document_types as $elem)
                            <option value='{{ $elem }}'>{{ $elem }}</option>
                        @endforeach
                        </select>
                    </td>
                    @if(session('admin'))
                        <td><input type='checkbox' name='admin{{$i}}' value='1' /></td>
                    @endif
                </tr>
            @endfor

            </tbody>
        </table>

        <p class='align-right'>
            <a class='myUI-button' href='/documents'>Cancel</a>
            <input type='submit' value='Save' class='myUI-button' />
        </p>
    
    </form>

</fieldset>

@endsection