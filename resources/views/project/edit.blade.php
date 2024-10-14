@extends('layouts.myApp')
@section('content')

  <h3>{{ $project->order }} - {{ $project->product }} - {{ $project->customer }}</h3>

  <fieldset>
    {!! Form::open(['route' => 'project.update', 'name' => 'form', 'onsubmit' => 'return true;']) !!}
      {!! Form::hidden('id', $project->id) !!}

      <div>
        <p><strong><u>Information générales</u></strong></p>

        <table id='myTab2' border='0' style='width:100%; margin-top:25px;'>

          <tr>
            <td style='width:30%;'>
              <label for='order'>Commande</label>
            </td>
            <td style='width:40%;'>
              {!! Form::text('order', old('order', $project->order), ['id' => 'order', 'required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('order'))
                {{ $errors->first('order') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              <label for='customer'>Client</label>
            </td>
            <td>
              {!! Form::text('customer', old('customer', $project->customer), ['id' => 'customer', 'required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('customer'))
                {{ $errors->first('customer') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              <label for='email'>Email</label>
            </td>
            <td>
              {!! Form::email('email', old('email', $project->email), ['id' => 'email', 'required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('email'))
                {{ $errors->first('email') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              <label for='product'>Produit</label>
            </td>
            <td>
              {!! Form::select('product', $products , old('product', $project->product_id), ['required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('product'))
                {{ $errors->first('product') }}
              @endif
            </td>
          </tr>
        </table>
      </div>

      <div style='margin-top:50px;height: 300px;'>
        <p><strong><u>Options</u></strong></p>
        <table id='myTab2' border='0' style='width:100%; margin-top:25px;'>
          <tr>
            <td>
              <label for='options'>Options</label>
            </td>
            <td>
              {!! Form::checkbox('options', '1', '1', ['id' => 'options']) !!}
            </td>
          </tr>
        </table>
      </div>

      <div style='margin-top:50px;height: 300px;'>
        <p><strong><u>Support</u></strong></p>
        <table id='myTab2' border='0' style='width:100%; margin-top:25px;'>

          @for ($i = 0; $i < 5; $i++)
            <tr>
              <td>
                <label for="support_lastname[{{ $i }}]">Nom</label>
              </td>
              <td>
                {!! Form::text("support_lastname[$i]", old("support_lastname[$i]", $supports[$i]['lastname'])) !!}
              </td>
              <td class='bold red'>
                @if ($errors->has("support_lastname[$i]"))
                  {{ $errors->first("support_lastname[$i]") }}
                @endif
              </td>
            </tr>

            <tr>
              <td>
                <label for="support_firstname[{{ $i }}]">Prénom</label>
              </td>
              <td>
                {!! Form::text("support_firstname[$i]", old("support_firstname[$i]", $supports[$i]['firstname'])) !!}
              </td>
              <td class='bold red'>
                @if ($errors->has("support_firstname[$i]"))
                  {{ $errors->first("support_firstname[$i]") }}
                @endif
              </td>
            </tr>

            <tr>
              <td>
                <label for="support_email[{{ $i }}]">E-Mail</label>
              </td>
              <td>
                {!! Form::text("support_email[$i]", old("support_email[$i]", $supports[$i]['email'])) !!}
              </td>
              <td class='bold red'>
                @if ($errors->has("support_email[$i]"))
                  {{ $errors->first("support_email[$i]") }}
                @endif
              </td>
            </tr>
          @endfor
        </table>

      </div>

      <div style='margin:20px; text-align:right;'>

        {!! Form::button('Cancel', ['onclick' => 'location.href="' . route('project.index') . '";', 'class' => 'btn']) !!}

        @if (in_array(12, Auth::user()->access) and $project->id)
          {!! Form::button('Delete', ['onclick' => "projectDelete()", 'class' => 'btn']) !!}
        @endif

        {!! Form::submit($project->id ? 'Update' : 'Add', ['class' => 'btn btn-primary']) !!}

      </div>

    {!! Form::close() !!}
  </fieldset>

  @if (in_array(12, Auth::user()->access) and $project->id)
    {!! Form::open(['route' => 'project.delete', 'id' => 'delete-form']) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::hidden('id', $project->id) !!}
    {!! Form::close() !!}
  @endif

@endsection
