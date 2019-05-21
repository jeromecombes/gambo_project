@extends('layouts.myApp')
@section('content')

<h3>Documents</h3>
<p>
In this space you can upload required documents by clicking the edit button below.<br/>
Note that only pdf, jpg and word documents (with extensions .pdf, jpg our .jpeg and .doc or .docx) are permitted.<br/>
<br/>
</p>

<fieldset>
    <form method='post' enctype='multipart/form-data' action='/documents'>
    {{ csrf_field() }}
    
    <input type='hidden' name='student' value="{{session('student')}}" />

        <table class='datatable' data-sort='[]'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Document</th>
                    <th>Admin Only</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($documents as $doc)
                <tr>
                    <td>
                        {!! Form::hidden("id[$doc->id]", old('id', $doc->id)) !!}
                        {!! Form::text("name[$doc->id]", old('name', $doc->name), ['class' => 'form-control', 'required' => 'required']) !!}
                    </td>
                    <td>
                        {!! Form::select("rel[$doc->id]", $document_types, old('rel', $doc->rel), ['class' => 'form-control']) !!}
                    </td>
                    <td>
                        {!! Form::checkbox("adminOnly[$doc->id]", 1, old('adminOnly', $doc->adminOnly), ['class' => 'form-control']) !!}
                    </td>
                    <td>{{ $doc->type }}</td>
                    <td style='white-space:nowrap; text-align:right;'>{{ $doc->size }}</td>
                    <td style='white-space:nowrap;'>{{ $doc->time }}</td>
                    <td><img src='/css/images/delete.png' alt='Delete' onclick='delete_doc({{ $doc->id }});' style='cursor:pointer;'/></td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <p class='align-right'>
            <a class='myUI-button' href='/documents'>Cancel</a>
            <input type='submit' value='Save' class='myUI-button' />
        </p>
    
    </form>

</fieldset>

@endsection