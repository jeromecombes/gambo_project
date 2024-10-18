var li_ids=new Array();
var logins=new Array();

function projectDelete() {
  if (confirm('Etes-vous sûr(e) de vouloir supprimer ce projet ?')) {
    $('#delete-form').submit();
  }
}

function showDiv(number) {
  $('.tabDiv').hide();
  $('#tabDiv' + number).show();
  $('#project-menu li').removeClass('active');
  $('#li' + number).addClass('active');
}

function change_password(){
    $('#password_checkbox')
    if($('#password_checkbox').prop('checked')) {
      document.getElementById("tr_password").style.display="";
      document.getElementById("tr_password_confirmation").style.display="";
      document.form.password.disabled=false;
      document.form.password_confirmation.disabled=false;
      document.form.password.value="";
      document.form.password_confirmation.value="";
      password_ctrl(document.form.password);
    }
    else{
      document.getElementById("tr_password").style.display="none";
      document.getElementById("tr_password_confirmation").style.display="none";
      document.form.password.disabled=true;
      document.form.password_confirmation.disabled=true;
    }
}

function checkall(form,me){
  elem=document.forms[form].elements;
  for(i=0;i<elem.length;i++)
    if(elem[i].type=="checkbox" && elem[i]!=me)
      elem[i].click();
}

function ctrl_form1(){
  password_ctrl(document.form.password);
  password_ctrl(document.form.password_confirmation);
  return form1_ctrl();
}

function ctrl_form2(first){
  password_ctrl(document.form.password);
  password_ctrl(document.form.password_confirmation);
  return form1_ctrl();
}

function ctrl_form3(){
    if(confirm("Do you really want to submit this form ?"))
      return true;
    return false;
}

function delete_user() {
  if (confirm('Do you really want to delete this user ?')) {
    $('#delete-form').submit();
  }
}

function form1_ctrl() {
  if (!$('#password_checkbox').prop('checked')) {
    return;
  }

  if($('#passwd1').text() =='') {
    $('.btn-primary').prop('disabled', false);
     return true;
  }
   else{
    $('.btn-primary').prop('disabled', true);
     return false;
   }
}

function password_ctrl(me) {
  if (me.disabled)
    return;
  if (me.name=="password") {
    if(me.value.length<8) {
      $('#passwd1').text('The password must be at least 8 characters.');
      form1_ctrl();
      return;
    }

    $('#passwd1').text('');
    form1_ctrl();
    return;
  }

  if (me.name=="password_confirmation") {
    if (me.value != $('input[name=password]').val()) {
      $('#passwd1').text('Passwords do not match !');
      form1_ctrl();
      return;
    }

    $('#passwd1').text('');
    form1_ctrl();
    return;
  }
}

function select_action(form){
  me=document.getElementById("action");
  elem=document.forms[form].elements;
  checked=false;
  for(i=0;i<elem.length;i++)
    if(elem[i].checked && elem[i].name!="all")
    checked=true;
  if(me.value && checked){
     $("#submit_button").attr("disabled",false);
     $("#submit_button").removeClass("ui-state-disabled");
  }
  else{
     $("#submit_button").attr("disabled",true);
     $("#submit_button").addClass("ui-state-disabled");
  }

}

function session_init() {
  $.ajax({
    url: '/session',
    type: 'get',
    datatype: 'json',
    success: function(result) {
      result = JSON.parse(result);

      if (!result['session_required']) {
        return;
      }

      session_redirect_time = (result['session_lifetime'] * 60000) + 10000;
      session_warning_time = (result['session_lifetime'] - 2) * 60000;

      if (typeof(session_timeout) != 'undefined') {
        clearTimeout(session_timeout);
      }

      if (typeof(session_warning_timeout) != 'undefined') {
        clearTimeout(session_warning_timeout);
      }

      session_warning_timeout = setTimeout("session_renew()", session_warning_time);
      session_timeout = setTimeout('document.location.href="/login";', session_redirect_time);
    },
    error: function(result) {
      console.log(result.responseText);
    }
  });
}

function session_renew() {

  var dialogbox = "<div id='renew-session-dialog' title='Renew your session'>\n"
    + "<div id='renew_session'>\n"
    + "<p>Warning !<br/>\n"
    + "Your session is about to expire</p>\n"
    + "</div>\n";

  if ($('#renew-session-dialog').length == 0) {
    $('#content').append(dialogbox);
  }

  $('#renew-session-dialog').dialog({
    autoOpen: true,
    height: 200,
    width: 400,
    modal: true,
    buttons: {
      Cancel: function() {
        $( this ).dialog( "close" );
      },

      Renew: function() {
        session_init();
        $( this ).dialog( "close" );
      }
    },
  });

}

function isNumeric(input){
    return (input-0)==input && input.length>0;
}

$(document).ready(function(){
  session_init();

  $(".myUI-button").button();
  $(".myUI-button-right").button();
  $(".myUI-datepicker-string").datepicker({dateFormat: "MM d, yy"});

  $("#loginName").find("span").hover(function(){
    $("#myMenu").show();
  });

  $("#loginName").find("span").mouseout(function(){
    timeoutMyMenu=window.setTimeout(function(){$("#myMenu").hide()},3000);
  });

  $(document).tooltip();

  // Positionne l'onglet "Back to list" à droite
  $(".back-to-list").each(function(){
    $(this).css("position","absolute");
    var ulLeft=$(this).closest("ul").position().left;
    var ulWidth=$(this).closest("ul").width();
    var liWidth=$(this).width();
    var liLeft=ulLeft+ulWidth-liWidth-3;
    $(this).css("left",liLeft);

    var liTop=$("#student-menu li").position().top;
    $(this).css("top",liTop);
  });


  // Positionne l'onglet "Next" à droite
  $(".li-next").each(function(){
    $(this).css("position","absolute");
    var BTLLeft=$(".back-to-list").position().left;
    var liWidth=$(this).width();
    var liLeft=BTLLeft-liWidth-4;
    $(this).css("left",liLeft);

    var liTop=$("#student-menu li").position().top;
    $(this).css("top",liTop);
  });

  // Positionne l'onglet "Previous" à droite
  $(".li-previous").each(function(){
    $(this).css("position","absolute");
    if($(".li-next").length){
      var NLeft=$(".li-next").position().left;
    }else{
      var NLeft=$(".back-to-list").position().left;
    }
    var liWidth=$(this).width();
    var liLeft=NLeft-liWidth-4;
    $(this).css("left",liLeft);

    var liTop=$("#student-menu li").position().top;
    $(this).css("top",liTop);
  });

  if ($('#password_checkbox').prop('checked')) {
    change_password();
  }
});

$(function(){

    $('#check_all').click(function() {
        $('.check_item').prop('checked', false);
        if ($(this).prop('checked')) {
            $('.check_item:visible').prop('checked', true);
        }
    });


  // Users can not have simultaneously access 15 and 22 (See who filled evaluations / see evaluations)
  $('#access15').change(function() {
    if(this.checked) {
      $('#access22').attr('checked', false);
    }
  });

  $('#access22').change(function() {
    if(this.checked) {
      $('#access15').attr('checked', false);
    }
  });

});
