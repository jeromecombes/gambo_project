var li_ids=new Array();
var logins=new Array();

// function activEval(semester){
//     file("activEval.php?semester="+semester);
// }
function accept_housing_charte(me) {
  if(me.checked) {
    $.ajax({
      url: '/housing/accept_terms',
      data: {_token: $('input[name=_token]').val()},
      type: 'post',
      datatype: 'json',
      success: function() {
        document.location.href = '/housing';
      }
    });
  }
  else {
    me.checked=true;
  }
}

function add_fields(i){
 i++;
 if(document.getElementById("tr_"+i).style.display=="none")
   document.getElementById("tr_"+i).style.display="";
}

function alertDelete(msg,id){
  if(confirm(msg))
    location.href="courses-update.php?id="+id+"&delete=";
}

function change_password(me){
    if(me.checked){
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

function checkInstitution(me,id){
  if(me.value=="Autre"){
    document.getElementById("institutionAutreTr"+id).style.display="";
  }
  else{
    document.getElementById("institutionAutreTr"+id).style.display="none";
  }
}

function checkLink(me,admin,id){
  document.getElementById("institution"+id).value="";
  document.getElementById("institutionAutre"+id).value="";
  document.getElementById("discipline"+id).value="";
  document.getElementById("niveau"+id).value="";
  document.getElementById("institutionAutreTr"+id).style.display="none";
  document.getElementById("institution"+id).disabled=false;
  document.getElementById("institutionAutre"+id).disabled=false;
  document.getElementById("discipline"+id).disabled=false;
  document.getElementById("niveau"+id).disabled=false;

  if(me.value){
    data=file("/inc/courses_univ4Info.php?id="+me.value);
    tab=data.split("&&&");
    document.getElementById("institution"+id).value=tab[1];
    document.getElementById("institutionAutre"+id).value=tab[2];
    document.getElementById("discipline"+id).value=tab[3];
    document.getElementById("niveau"+id).value=tab[4];
    document.getElementById("institution"+id).disabled=true;
    document.getElementById("institutionAutre"+id).disabled=true;
    document.getElementById("discipline"+id).disabled=true;
    document.getElementById("niveau"+id).disabled=true;
    if(tab[1]=="Autre"){
      document.getElementById("institutionAutreTr"+id).style.display="";
    }
  }
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

function ctrl_form_univreg(){
  if(!document.getElementById("univ_reg_1_21").value && document.getElementById("category").value=="student"){
    document.getElementById("univ_reg_1_21").style.background="#FF3333";
    alert("Vous devez remplir le champ \"Discipline voulue à l'université\".");
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FF5555\"",800);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FF6666\"",900);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FF7777\"",1000);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FF9999\"",1100);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFAAAA\"",1200);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFBBBB\"",1300);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFCCCC\"",1400);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFDDDD\"",1500);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFEEEE\"",1600);
    setTimeout("document.getElementById(\"univ_reg_1_21\").style.background=\"#FFFFFF\"",1700);
    return false;
  }
  return true;
}

function delete_doc(id) {
    if (confirm("Do you really want to delete this document ?")) {
//         document.location.href = '/documents/'+id+'/destroy';
        $.ajax({
            url: '/documents',
            type: 'post',
            datatype: 'json',
            data: {id : id, _method: 'delete', _token: $('input[name=_token]').val()},
            success: function(){
                document.location.href = '/documents';
            }
        });
    }
}

function delete_user() {
  if (confirm('Do you really want to delete this user ?')) {
    $('#delete-form').submit();
  }
}

function displayForm(form,id){

  if(form == "univreg2b") {

    $('.inputField').show();
    $('.cancel-button').show();
    $('.submit-button').show();
    $('.inputValue').hide();
    $('.edit-button').hide();

  } else {

    inputs=document.forms[form+"_"+id].elements;
    i=0;
    while(inputs[i]){
      inputs[i++].style.display="";
    }
    /*
    * While ne fonctionne pas correctement s'il y a des interruptions,
    * donc remplace progressivement par $(".inputField").hide();
    */
    $("#"+form+"_"+id+" .inputField").show();

    i=0;
    while(document.getElementById(form+"_"+id+"_radio"+"_"+i)){
      document.getElementById(form+"_"+id+"_radio"+"_"+i++).style.display="";
    }

    i=0;
    while(document.getElementById(form+"_"+id+"_"+i)){
          if(!$("#"+form+"_"+id+"_"+i).hasClass("inputField")){
          document.getElementById(form+"_"+id+"_"+i).style.display="none";
      }
      i++;
    }

    /*
    * While ne fonctionne pas correctement s'il y a des interruptions,
    * donc remplace progressivement par $(".inputValue").hide();
    */
    $("#"+form+"_"+id+" .inputValue").hide();

    document.getElementById(form+"_"+id+"_done").style.display="";

    //	Les étudiants voient mais ne changent pas les infos discipline, UFR et MoveOnLine
    if(form=="univreg" && document.getElementById("category").value=="student"){
      document.getElementById("univreg_1_13").style.display="";		//	Discipline
      document.getElementById("univreg_1_14").style.display="";		//	UFR
      document.getElementById("univreg_1_15").style.display="";		//	MoveOnLine Username
      document.getElementById("univreg_1_16").style.display="";		//	MoveOnLine Password
      document.getElementById("univreg_1_17").style.display="none";	//	Discipline (Form)
      document.getElementById("univreg_1_18").style.display="none";	//	UFR (Form)
      document.getElementById("univreg_1_19").style.display="none";	//	MoveOnLine Username (Form)
      document.getElementById("univreg_1_20").style.display="none";	//	MoveOnLine Password (Form)
    }
  }
}

function dropCourse(id,admin){
  if(confirm("Etes vous sûr(e) de vouloir supprimer ce cours ?")){
    if(admin){
      url="../inc/courses_univ4Update.php?delete=true&id="+id;
    }
    else{
      url="inc/courses_univ4Update.php?delete=true&id="+id;
    }
    document.location.href=url;
  }
}

function dropCourse2(id,admin){
  if(confirm("Etes vous sûr(e) de vouloir supprimer ce cours ?")){
    url="courses4-univ-update.php?delete=true&id="+id;
    document.location.href=url;
  }
}

function editCourse(id,edit){
  if(edit){
    document.getElementById("UnivCourse"+id).style.display="none";
    document.getElementById("UnivCourseEdit"+id).style.display="";
  }
  else{
    document.getElementById("UnivCourse"+id).style.display="";
    document.getElementById("UnivCourseEdit"+id).style.display="none";
  }
}

function editModalites(id,edit){
  if(edit){
    document.getElementById("modalitesText"+id).style.display="none";
    document.getElementById("modalitesTextarea"+id).style.display="";
    document.getElementById("modalites0_"+id).style.display="none";
    document.getElementById("modalitesRadio"+id).style.display="";
    document.getElementById("modalitesUpdate"+id).style.display="none";
    document.getElementById("modalitesReset"+id).style.display="";
    document.getElementById("modalitesSubmit"+id).style.display="";

  }
  else{
    document.getElementById("modalitesText"+id).style.display="";
    document.getElementById("modalitesTextarea"+id).style.display="none";
    document.getElementById("modalites0_"+id).style.display="";
    document.getElementById("modalitesRadio"+id).style.display="none";
    document.getElementById("modalitesUpdate"+id).style.display="";
    document.getElementById("modalitesReset"+id).style.display="none";
    document.getElementById("modalitesSubmit"+id).style.display="none";
  }
}

function file(fichier){
  if(fichier.indexOf("php?")>0)
    fichier=fichier+"&ms="+new Date().getTime();
  else if(fichier.indexOf("php")>0)
    fichier=fichier+"?ms="+new Date().getTime();

  if(window.XMLHttpRequest) // FIREFOX
    xhr_object = new XMLHttpRequest();
  else if(window.ActiveXObject) // IE
    xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
   else
    return(false);

   xhr_object.open("GET", fichier, false);
   xhr_object.send(null);
   if(xhr_object.readyState == 4) return(xhr_object.responseText);
   else return(false);
}

function lock(me, model, id) {

  if (id == undefined) {
    id = 0;
  }

  model = "App\\Models\\" + model;

  var button_id = me.id;
  var button = $('#'+button_id).val();
  var token = $('input[name=_token]').val();

  $.ajax({
    url: '/lock',
    type: 'post',
    data_type: 'json',
    data: {_token: token, model: model, button: button, id: id},
    success: function(result) {
      result = JSON.parse(result);
      $('#'+button_id).val(result['button']);
      if (result['error']) {
        CJInfo(result['message']);
      }
    },
    error: function(result) {
      CJInfo('Error');
    }
  });
}


function lockCourse4(id){
  lock=file("/admin/courses4Lock.php?id="+id);
  if(lock==1){
    document.getElementById("lock"+id).value="Déverrouiller";
  }
  else{
    document.getElementById("lock"+id).value="Verrouiller";
  }
}

function lockRH(me,student){
  file("/admin/lockRH.php?student="+student+"&lock="+me.value);
  if(me.value=="Lock")
     me.value="Unlock";
  else
    me.value="Lock";
}

function lockRH2(me,student){
  file("/admin/lockRH2.php?student="+student+"&lock="+me.value);
  if(me.value=="Publish")
     me.value="Hide";
  else
    me.value="Publish";
}

function form1_ctrl(){
  if(document.getElementById("passwd1").innerHTML==""
    && document.getElementById("passwd2").innerHTML==""){
     document.getElementById("submit").disabled=false;
     return true;
  }
   else{
     document.getElementById("submit").disabled=true;
     return false;
   }
}

function password_ctrl(me){
  if(me.disabled)
    return;
  if(me.name=="password"){
    if(me.value.length<8){
      document.getElementById("passwd1").innerHTML="Must be 8 characters";
      form1_ctrl();
      return;
    }
     document.getElementById("passwd1").innerHTML="";
      form1_ctrl();
     return;
  }
   if(me.name=="password_confirmation"){
     if(me.value!=document.getElementById("password").value){
       document.getElementById("passwd2").innerHTML="Passwords don't match";
      form1_ctrl();
     return;
     }
     document.getElementById("passwd2").innerHTML="";
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

function submit_action(form,form2){		// a finir
  switch(document.forms[form].action.value){
    case "Delete" :
        if(confirm("Do you really want to delete selected items ?")) {
            document.forms[form2].action="/students/delete";
            document.forms[form2].submit();
        }
        break;

    case "CreatePassword" :
	if(confirm("The password of selected students will be changed.\nContinue ?")){
	  document.forms[form2].action="students-password.php";
	  document.forms[form2].submit();
	}
	break;

    case "Email" :
	inputs=document.forms[form2].elements;
	i=0;
	mails=new Array();
	while(inputs[i]){
	  if(inputs[i].name=="students[]" && inputs[i].checked){
	    mails.push(document.getElementById("mail_"+inputs[i].value).value);
	  }
	  i++;
	}
	mails=mails.join(", ");
	document.location.href="mailto:"+mails;
	break;

    case "Email2" :
	  document.forms[form2].action="students-email.php";
	  document.forms[form2].submit();	break;


    case "Excel" :
	  document.forms[form2].action="students-excel.php";
	  document.forms[form2].submit();	break;

    case "Email_Housing" :
	inputs=document.forms[form2].elements;
	i=0;
	mails=new Array();
	while(inputs[i]){
	  if(inputs[i].name=="housing[]" && inputs[i].checked){
	    if(document.getElementById("mail_"+inputs[i].value).value);
	      mails.push(document.getElementById("mail_"+inputs[i].value).value);
	    if(document.getElementById("mail2_"+inputs[i].value).value);
	      mails.push(document.getElementById("mail2_"+inputs[i].value).value);
	  }
	  i++;
	}
	mails=mails.join(", ");
	document.location.href="mailto:"+mails;
	break;

    case "Email2_Housing" :
	  document.forms[form2].action="housing-email.php";
	  document.forms[form2].submit();	break;


    case "Excel_Housing" :
	  document.forms[form2].action="housing-excel.php";
	  document.forms[form2].submit();	break;

    case "closeHousing" :
	  document.forms[form2].action="/admin/housing/lock";
	  document.forms[form2].submit();	break;

    case "openHousing" :
	  document.forms[form2].action="/admin/housing/unlock";
	  document.forms[form2].submit();	break;

    case "lockVWPP" :
	  document.forms[form2].action="/admin/RHCourses/lock";
	  document.forms[form2].submit();	break;

    case "unlockVWPP" :
	  document.forms[form2].action="/admin/RHCourses/unlock";
	  document.forms[form2].submit();	break;

    case "publishVWPP" :
	  document.forms[form2].action="/admin/RHCourses/show";
	  document.forms[form2].submit();	break;

    case "hideVWPP" :
	  document.forms[form2].action="/admin/RHCourses/hide";
	  document.forms[form2].submit();	break;

    case "publishUnivReg" :
	  document.forms[form2].action="/admin/UnivReg/show";
	  document.forms[form2].submit();	break;

    case "hideUnivReg" :
	  document.forms[form2].action="/admin/UnivReg/hide";
	  document.forms[form2].submit();	break;

    case "Univ_reg" :
	  document.forms[form2].action="univ_reg_export2.php";
	  document.forms[form2].submit();	break;

    case "internship" :
	  document.forms[form2].action="internship_export.php";
	  document.forms[form2].submit();	break;

    case "tutorial" :
	  document.forms[form2].action="tutorial_export.php";
	  document.forms[form2].submit();	break;


  }


}

function tripFormValidation(){
  var myReturn=true;
  $(".required").each(function(){
    if(!$(this).val().trim()){
     myReturn=false;
    }
  });

  $(".requiredCheckbox").each(function(){
    if(!$(this).is(":checked")){
     myReturn=false;
    }
  });

  if($(".requiredRadio:checked").length<1){
     myReturn=false;
  }

  if(!myReturn){
    alert("Veuillez remplir tous les champs obligatoires et accepter les conditions");
  }

  return myReturn;
}

function isNumeric(input){
    return (input-0)==input && input.length>0;
}

function verifNote(form,me){
  me.value=me.value.replace(",",".");
  me.value=me.value.replace(";",".");
  me.value=me.value.replace(" ","");
// Update 2020-05-19 : symbol - is now authorized. Asked by Vinay Swamy
//   me.value=me.value.replace("-","");
  me.value=me.value.replace("+","");

  if(me.value && (me.value>20 || !isNumeric(me.value) || me.value.length>5)){
    me.style.background="red";
  }
  else{
    me.style.background="white";
  }
// Update 2020-05-19 : symbol - is now authorized. Asked by Vinay Swamy
  if (me.value == '-') {
    me.style.background="white";
  }

  verifNote2(form);
}

function verifNote2(form){
  if(document.getElementById("submit"))
    document.getElementById("submit").disabled=false;
  if(document.getElementById(form+"_done"))
    document.getElementById(form+"_done").disabled=false;
  elem=document.forms[form].elements;
  for(i=0;i<elem.length;i++){
    if(elem[i].style.background.search("red")!=-1){
      if(document.getElementById("submit"))
	document.getElementById("submit").disabled=true;
      if(document.getElementById(form+"_done"))
	document.getElementById(form+"_done").disabled=true;
      return;
    }
  }

}

$(document).ready(function(){

	$(".datatable").each(function(){
	  // columns sort
  		var aoCol=[];
  		$(this).find("thead th").each(function(){
    		if($(this).attr("class")==undefined){
      			aoCol.push({"bSortable":true});
    		}
    		else if($(this).hasClass("dataTableDate")){
      			aoCol.push({"sType": "date"});
   			}
    		else if($(this).hasClass("dataTableNoSort")){
      			aoCol.push({"bSortable":false});
   			}
		else{
      			aoCol.push({"bSortable":true});
			}
   		});

	  var sort=[[1,"asc"],[2,"asc"]];		// {{"1","asc"},{"2","asc"}}
	  if($(this).attr("data-sort")){
	    var sort=JSON.parse($(this).attr("data-sort"));
	  }
  		$(this).dataTable({
      		"bJQueryUI": true,
      		"sPaginationType": "full_numbers",
                "bStateSave": true,
      		"aLengthMenu" : [[25,50,75,100,-1],[25,50,75,100,"All"]],
                "iDisplayLength" : 25,
      		"aaSorting" : sort,
      		"aoColumns" : aoCol,
  		});
  	});


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

  // Menu : set active tab
  var href=document.location.href;
  if(href.indexOf(".php")<1){
    href+="index.php";
  }

  href=href.replace("users-edit.php","users.php");
  href=href.replace(/(courses.*)/,"courses.php");
  href=href.replace(/(eval.*)/,"eval_index.php");
  href=href.replace(/(grades.*)/,"grades3-1.php");
  href=href.replace(/(housing.*)/,"housing.php");
  href=href.replace(/(\?.*)/,"");

  $("li.ui-state-default").each(function(){
    if($(this).find("a").prop("href")==href){
      $(this).addClass("ui-tabs-active");
      $(this).addClass("ui-state-active");
    }
  });

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

  $(".tableUnivCourse").each(function(){
    var width=$(this).width()-$(this).css("margin-left").replace("px","");
    $(this).css("width",width);
  });


});

$(function(){

    $('#check_all').click(function() {
        $('.check_item').prop('checked', false);
        if ($(this).prop('checked')) {
            $('.check_item:visible').prop('checked', true);
        }
    });

  $("#enableEvaluation").click(function(){
    $.ajax({
      url: "/admin/enableEval.php",
      dataType: "json",
      type: "post",
      data: {semester : $(this).attr("data-semester")},
      success: function(){
	var value=$("#enableEvaluation").attr("data-enabled")==1?"Enable evaluations":"Disable evaluations";
	var enable=$("#enableEvaluation").attr("data-enabled")==1?0:1;
	$("#enableEvaluation").attr("data-enabled",enable);
	$("#enableEvaluation").attr("value",value);
      },
      error: function(){
	alert($("#enableEvaluation").attr("data-enabled"));
	var msg=$("#enableEvaluation").attr("data-enabled")==1?"disable":"enable";
	CJInfo("Cannot "+msg+" evaluations","error");
      }
    });
  });

  // Création de la liste des étudiants pour la navigation précédent suivant
  // Lors du click sur une icône "Edit" du tableau
  $(".studentsEdit").click(function(){
    var tab=new Array();
    $(".studentsCheckbox").each(function(){
      tab.push($(this).val());
    });
    $.ajax({
      url: "/admin/ajax.studentsList.php",
      dataType: "json",
      type: "post",
      async:false,
      data: {list: JSON.stringify(tab)},
    });
  });

});
