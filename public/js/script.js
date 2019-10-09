var li_ids=new Array();
var logins=new Array();

// function activEval(semester){
//     file("activEval.php?semester="+semester);
// }
function accept_housing_charte(me){
  file("housing-accept.php");
  if(me.checked){
     document.getElementById("text").style.display="none";
     document.getElementById("link").style.display="";
  }
  else
    me.checked=true;
/*  else{
     document.getElementById("text").style.display="";
     document.getElementById("link").style.display="none";
  }*/
}


function add_fields(i){
 i++;
 if(document.getElementById("tr_"+i).style.display=="none")
   document.getElementById("tr_"+i).style.display="";
}

function addUnivCourse(me){
  me.style.display="none";
  document.getElementById("newUnivCourse").style.display="block";
}

function alertDelete(msg,id){
  if(confirm(msg))
    location.href="courses-update.php?id="+id+"&delete=";
}

function change_menu(id){
  for(i=0;i<li_ids.length;i++)
    if(!document.getElementById("li"+li_ids[i]))
    original=li_ids[i];						// find original id
  document.getElementById("current").id="li"+original;		// change menu
  document.getElementById("li"+id).id="current";
  if(document.getElementById("div"+original))			// change content
    document.getElementById("div"+original).style.display="none";
  if(document.getElementById("div-edit"+original))
    document.getElementById("div-edit"+original).style.display="none";
  if(document.getElementById("div"+id))
    document.getElementById("div"+id).style.display="";
  file("../inc/change_menu.php?id="+id);
  document.getElementById("div6").style.display="none";
  
}

function changeNotifications(me){
  file("myAccountNotifications.php?notif="+me.checked);
}

function resetNewCourse(){
  document.getElementById("newUnivCourse").style.display="none";
  document.getElementById("AddCourseButton").style.display="";
}

function showHousingForm(){
  document.getElementById("div6").style.display="";
  document.getElementById("div2").style.display="none";
}

function change_password(me){
    if(me.checked){
      document.getElementById("tr_password1").style.display="";
      document.getElementById("tr_password2").style.display="";
      document.form.password.disabled=false;
      document.form.password2.disabled=false;
      document.form.password.value="";
      document.form.password2.value="";
      password_ctrl(document.form.password);
    }
    else{
      document.getElementById("tr_password1").style.display="none";
      document.getElementById("tr_password2").style.display="none";
      document.form.password.disabled=true;
      document.form.password2.disabled=true;
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
    if(admin)
      url="../inc/courses_univ4Info.php?id="+me.value;
    else
      url="inc/courses_univ4Info.php?id="+me.value;
    data=file(url);
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

function ctrlAddTD(me){
    if(me.nom.value)
      return true;
    return false;
}

function ctrl_form1(){
//   login_ctrl(document.form.login);
  password_ctrl(document.form.password);
  password_ctrl(document.form.password2);
  return form1_ctrl();
}

function ctrl_form2(first){
//   login_ctrl2(document.form.login,first);
  password_ctrl(document.form.password);
  password_ctrl(document.form.password2);
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

function delete_course(univ,id,admin){
   if(confirm("Voulez-vous vraiment supprimer ce cours ?"))
    if(admin)
      document.location.href="students-coursesUpdate.php?id="+id+"&univ="+univ+"&delete=";
    else
      document.location.href="courses-update.php?id="+id+"&univ="+univ+"&delete=";
}

function delete_line(i){
  document.getElementById("q"+i).value="";
  document.getElementById("t"+i).selectedIndex=0;
  document.getElementById("r"+i).value="";
}

function displayAdd(form){
  document.getElementById("fieldSet"+form).style.display="";
  if(document.forms["form"+form+"_"]){
    inputs=document.forms["form"+form+"_"].elements;
    i=0;
    while(inputs[i]){
      inputs[i++].style.display="";
    }
  }

  i=0;
  while(document.getElementById("form"+form+"__"+i)){
     document.getElementById("form"+form+"__"+i++).style.display="none";
  }
  
  if(document.getElementById("form"+form+"__done")){
    document.getElementById("form"+form+"__done").style.display="";
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

function displayText(form,id){

  if(form=="univreg2b") {
    
    $('.inputField').hide();
    $('.cancel-button').hide();
    $('.submit-button').hide();
    $('.inputValue').show();
    $('.edit-button').show();

  } else {

    inputs=document.forms[form+"_"+id].elements;
    i=0;
    while(inputs[i]){
      inputs[i++].style.display="none";
    }
    /*
    * While ne fonctionne pas correctement s'il y a des interruptions,
    * donc remplace progressivement par $(".inputField").hide();
    */
    $("#"+form+"_"+id+" .inputField").hide();

    i=0;
    while(document.getElementById(form+"_"+id+"_"+i)){
      document.getElementById(form+"_"+id+"_"+i++).style.display="";
    }
    /*
    * While ne fonctionne pas correctement s'il y a des interruptions,
    * donc remplace progressivement par $(".inputValue").show();
    */
    $("#"+form+"_"+id+" .inputValue").show();

    document.getElementById(form+"_"+id+"_done").style.display="none";
  }
}

function displayTD(id){
  document.getElementById("TD_"+id+"_5").style.display=""; 
  document.getElementById("TD_"+id+"_6").style.display=""; 
  document.getElementById("TD_"+id+"_Add").style.display="none"; 
  document.getElementById("Delete_"+id).style.display="none"; 
  document.location.href="#TD1_"+id;
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
    
    
function edit(id){
  if(document.getElementById("div-edit"+id).style.display==""){
    document.getElementById("div-edit"+id).style.display="none";
    document.getElementById("div"+id).style.display="";
  }
  else{
    document.getElementById("div-edit"+id).style.display="";
    document.getElementById("div"+id).style.display="none";
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

function js_autocomplete(me){			// supprimer les éléments ne contenant pas à me.value
//   auto=autocomplete[me.name].join(",");	// afficher les éléments dans un <div> flotant
//    alert(auto);				// click sur element -> me.value=element
}
function lock_registration(form,id,lock){
  table="courses_"+form;
  if(form=="stages" || form=="tutorat")
     table=form;
  file("lock.php?table="+table+"&id="+id+"&lock="+lock);
  document.location.reload(false);
}

function lock2(table){
  msg=file("lock2.php?table="+table);
  document.location.href="students-view2.php?error=0&msg="+msg;
}

function lockCourse4(id){
  lock=file("courses4Lock.php?id="+id);
  if(lock==1){
    document.getElementById("lock"+id).value="Déverrouiller";
  }
  else{
    document.getElementById("lock"+id).value="Verrouiller";
  }
}

function lockRH(me,student){
  file("lockRH.php?student="+student+"&lock="+me.value);
  if(me.value=="Lock")
     me.value="Unlock";
  else
    me.value="Lock";
}

function lockRH2(me,student){
  file("lockRH2.php?student="+student+"&lock="+me.value);
  if(me.value=="Publish")
     me.value="Hide";
  else
    me.value="Publish";
}

function login_ctrl(me){
  if(me.value==""){
      document.getElementById("login_msg").innerHTML="Login is required.";
      form1_ctrl();
      return;
    }
    for(i=0;i<logins.length;i++)
    if(logins[i]==me.value.toLowerCase()){
      document.getElementById("login_msg").innerHTML="This login is allready used.";
      form1_ctrl();
      return;
    }
   document.getElementById("login_msg").innerHTML="";
   form1_ctrl();
}

function login_ctrl2(me,first){
  if(me.value==first){
    document.getElementById("login_msg").innerHTML="";
    form1_ctrl();
  }
  else
   login_ctrl(me);
}

function form1_ctrl(){
/*  if(document.getElementById("login_msg").innerHTML=="" 
    && document.getElementById("passwd1").innerHTML=="" */
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
   if(me.name=="password2"){
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
            document.forms[form2].action="/admin/students/delete";
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

    case "intership" :
	  document.forms[form2].action="intership_export.php";
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
    alert("Veuillez remplir tous les champs obligatoires et accepter les condditions");
  }
  
  return myReturn;
}


function user_delete(id){
 if(confirm("Do you really want to delete this user ?"))
   document.location.href="users-delete.php?id="+id;
}



function verifLoginForm(){
 if(document.form.login.value && document.form.password.value)
   document.form.submit2.disabled=false;
 else
   document.form.submit2.disabled=true;
}


function isNumeric(input){
    return (input-0)==input && input.length>0;
}

function verifNote(form,me){
  me.value=me.value.replace(",",".");
  me.value=me.value.replace(";",".");
  me.value=me.value.replace(" ","");
  me.value=me.value.replace("-","");
  me.value=me.value.replace("+","");
  if(me.value && (me.value>20 || !isNumeric(me.value) || me.value.length>5)){
    me.style.background="red";
  }
  else{
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
      url: "enableEval.php",
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
      url: "ajax.studentsList.php",
      dataType: "json",
      type: "post",
      data: {list: JSON.stringify(tab)},
    });
  });
  
});