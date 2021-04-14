//function to create error and alert dialogs
function CJErrorHighlight(e, type, icon) {
    if (!icon) {
        if (type === 'highlight') {
            icon = 'ui-icon-info';
        } else {
            icon = 'ui-icon-alert';
        }
    }
    return e.each(function() {
        $(this).addClass('ui-widget');
        var alertHtml = '<div class="ui-state-' + type + ' ui-corner-all" style="padding:0 .7em;">';
        alertHtml += '<p style="text-align:center;">';
        alertHtml += '<span class="ui-icon ' + icon + '" style="float:left;margin-right: .3em;"></span>';
        alertHtml += $(this).html();
        alertHtml += '</p>';
        alertHtml += '</div>';

        $(this).html(alertHtml);
    });
}

function CJFileExists(url){
  $.ajax({
    url: url,
    type:'HEAD',
    async: false,
    error: function(retour){
        return false;
    },
    success: function(retour){
        return true;
    }
  });
}

function CJInfo(message,type,top,time,myClass){
  if(top==undefined){
    top=92;
  }

  if(time==undefined){
    time=8000;
  }

  if(myClass==undefined){
    myClass=null;
  }

  if(typeof(timeoutJSInfo)!== "undefined"){
    window.clearTimeout(timeoutCJInfo);
  }

	var id=1;
	$(".CJInfo").each(function(){
		id=$(this).attr("data-id")>=id?($(this).attr("data-id")+1):id;
		top=$(this).position().top+$(this).height();
	});

  $("body").append("<div class='CJInfo "+myClass+"' id='CJInfo"+id+"' data-id='"+id+"'>"+message+"</div>");
  CJErrorHighlight($("#CJInfo"+id),type);
  CJPosition($("#CJInfo"+id),top,"center");
  timeoutCJInfo=window.setTimeout(function(){
  		var height=$("#CJInfo"+id).height();
  		$("#CJInfo"+id).remove();
  		$(".CJInfo").each(function(){
  			var top=$(this).position().top-height;
  			$(this).css("top",top);
  		});
  	},time);
}

function CJPosition(object,top,left){
  object.css("position","absolute");
  object.css("z-index",10);
  object.css("top",top);
  if(left=="center"){
    left=($(window).width()-object.width())/2;
    object.css("left",left);
  }
}

$(function(){
  $(".datatable").each(function(){

    // Tri des colonnes en fonction des classes des th
    var aoCol=[];

    // Variables tr2 utilisées si 2 lignes en entête. tr2 = 2eme ligne
    var tr2=null;
    if($(this).find("thead tr").length==2){
      tr2=$(this).find("thead tr:nth-child(2)");
      tr2th=tr2.find("th");
      tr2thNb=tr2th.length;
      tr2Index=1;
    }

    $(this).find("thead tr:first th").each(function(){

      var th=[$(this)];

      // Si colspan et 2 lignes en entête, on se base sur la 2ème ligne
      if($(this).attr("colspan") && $(this).attr("colspan")>1 && tr2){
	th=new Array();
	for(i=0;i<$(this).attr("colspan");i++){
	  th.push(tr2.find("th:nth-child("+tr2Index+")"));
	  tr2Index++;
	}
      }

      for(i in th){
	// Par défault, tri basic
	if(th[i].attr("class")==undefined){
	  aoCol.push({"bSortable":true});
	}
	// si date
	else if(th[i].hasClass("dataTableDate")){
	  aoCol.push({"sType": "date"});
	}
	// si date FR
	else if(th[i].hasClass("dataTableDateFR")){
	  aoCol.push({"sType": "date-fr"});
	}
	// si date FR Fin
	else if(th[i].hasClass("dataTableDateFR-fin")){
	  aoCol.push({"sType": "date-fr-fin"});
	}
	// si heures fr (00h00)
	else if(th[i].hasClass("dataTableHeureFR")){
	  aoCol.push({"sType": "heure-fr"});
	}
	// si pas de tri
	else if(th[i].hasClass("dataTableNoSort")){
	  aoCol.push({"bSortable":false});
	}
	// Par défaut (encore) : tri basic
	else{
	  aoCol.push({"bSortable":true});
	}
      }
    });

    // Tri au chargement du tableau
    // Par défaut : 1ère colonne
    var sort=[[0,"asc"]];

    // Si le tableau à l'attribut data-sort, on récupère sa valeur
    if($(this).attr("data-sort")){
      var sort=JSON.parse($(this).attr("data-sort"));
    }

    // Taille du tableau par défaut
    var tableLength=25;
    if($(this).attr("data-length")){
      tableLength=$(this).attr("data-length")
    }

    // save state ?
    var saveState=true;
    if($(this).attr("data-stateSave") && ($(this).attr("data-stateSave")=="false" || $(this).attr("data-stateSave")=="0")){
      var saveState=false;
    }

    // Colonnes fixes
    var scollX=$(this).attr("data-fixedColumns")?"100%":"";

    // Liens pour exporter les informations
    var sDom='<"H"lfr>t<"F"ip>T';
    if($(this).attr("data-noExport")){
      sDom='<"H"lfr>t<"F"ip>';
    }

    // On applique le DataTable
    var CJDataTable=$(this).DataTable({
      "bJQueryUI": true,
      "sPaginationType": "full_numbers",
      "bStateSave": saveState,
      "aLengthMenu" : [[10,25,50,75,100,-1],[10,25,50,75,100,"All"]],
      "iDisplayLength" : tableLength,
      "aaSorting" : sort,
      "aoColumns" : aoCol,
      "sScrollX": scollX,
      "autoWidth": false,
      "buttons": true,
      "initComplete": function () {

      },
    });

    $('.fg-toolbar:last').after(CJDataTable.buttons().container());

  });

});
