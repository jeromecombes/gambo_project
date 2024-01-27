<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends MyTestCase
{
    public function test_form_status_200()
    {
        $user = User::where('admin', 1)->first();

        $response = $this->actingAs($user)
            ->withSession(['2FAVerified' => true])
            ->get('/test/form');

        $response->assertStatus(200)
            ->assertSee('name="form" onsubmit="return someJSFunction();"><input type="hidden" name="_token" value="', false)
            ->assertSee('<input type="hidden" name="id" id="id" value="120">', false)
            ->assertSee('<input type="hidden" name="hidden_input_name" id="hidden_input_id" value="value">', false)
            ->assertSee('<label for="lastname">Lastname</label>', false)
            ->assertSee('<input type="text" name="lastname" id="lastname" value="A lastname" required>', false)
            ->assertSee('<label for="firstname">Firstname</label>', false)
            ->assertSee('<input type="text" name="firstname" id="firstname" value="A firstname" required>', false)
            ->assertSee('<label class="email_label_class" for="email">Email</label>', false)
            ->assertSee('<input class="email_class" type="email" name="email" id="email_id" required>', false)
            ->assertSee('<select name="university" id="university" required><option value></option><option value="Vassar">Vassar</option><option value="Wesleyan">Wesleyan</option><option value="VWPP">VWPP</option></select>', false)
            ->assertSee('<label for="password_checkbox">Change password</label>', false)
            ->assertSee('<input class="password_checkbox test_class" type="checkbox" name="password_checkbox" id="password_checkbox" value="on" onclick="change_password();">', false)
            ->assertSee('<input type="password" name="password" id="password" onblur="password_ctrl(this);" onkeyup="password_ctrl(this);" required>', false)
            ->assertSee('<input type="password" name="password_disabled" id="password_id" disabled="disabled">', false)
            ->assertSee('<input type="password" name="password_confirmation" id="password_confirmation" onblur="password_ctrl(this);" onkeyup="password_ctrl(this);" required>', false)
            ->assertSee('<select name="language" id="language"><option value="en">English</option><option value="fr" selected="selected">Fran&ccedil;ais</option></select>', false)
            ->assertSee('<input type="checkbox" name="alerts" id="alerts_id" value="1" checked>', false)
            ->assertSee('<input type="checkbox" name="access[]" id="access0" value="on" checked>', false)
            ->assertSee('<label for="access0">Access 0</label>', false)
            ->assertSee('<input type="checkbox" name="access[]" id="access1" value="on" checked>', false)
            ->assertSee('<label for="access1">Access 1</label>', false)
            ->assertSee('<input type="checkbox" name="access[]" id="access2" value="on">', false)
            ->assertSee('<input class="radio_class" type="radio" name="radio_name" id="radio1" value="yes" checked>', false)
            ->assertSee('<label for="radio1">Radio 1</label>', false)
            ->assertSee('<input class="radio_class" type="radio" name="radio_name" id="radio2" value="no">', false)
            ->assertSee('<label for="radio2">Radio 2</label>', false)
            ->assertSee('<button class="btn btn-secondary" onclick="location.href=', false)
            ->assertSee('">Cancel</button>', false)
            ->assertSee('<button class="btn" onclick="someJSAFunction();">Delete</button>', false)
            ->assertSee('<button class="btn btn-primary" type="submit">Update</button>', false)
            ->assertSee('"><input type="hidden" name="_token" value="', false)
            ->assertSee('<input type="hidden" name="_method" id="_method" value="DELETE">', false)
            ->assertSee('<input type="hidden" name="id" id="id" value="120">', false)
            ->assertSee('</form>', false)
            ->assertSee('<form method="POST"><input type="hidden" name="_token" value="', false)
            ->assertSee('<form method="GET" action="/test.form.php">', false)
            ->assertSee('<form method="POST" action="/test.form.php" name="form1"><input type="hidden" name="_token" value="', false)
            ->assertSee('<input class="text_class" type="text" name="lastname" id="text_id" value="A lastname" onkeydown="onkeydownFonction();" onkeyup="onkeyupFonction();" required>', false)
            ->assertSee('<textarea class="textarea_class class" name="textarea_name" id="textarea_name">Some text</textarea>', false)
            ->assertSee('<form method="POST" action="/test.form.php" id="form_id" name="form1" onsubmit="someJSAction();"><input type="hidden" name="_token" value="', false)
            ->assertSee('<select class="select_class" name="university" id="select_id" required><option value></option><option value="Vassar">Vassar</option><option value="Wesleyan">Wesleyan</option><option value="VWPP">VWPP</option></select>', false);

        $content = $response->getContent();
        $this->assertMatchesRegularExpression('/<form method="POST" action="http.*" id="delete-form"/', $content);
    }
}
