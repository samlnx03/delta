<form id='cant_esp_dimx' action='clDetalleAltaMA.php' method='POST'>
require_once "Auth/proteger.php";
<?php
//$q="select clave, descrip from actividades where tipo='tabla'";
//$clave=htmlSelect($q, "clave", "clave", "descrip", '');
//echo "$clave\n";
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especiex", "especie", "especie", '');
?>
<?php 
echo "<input type=hidden name=tipoMov value='$tipoMov'>\n";
echo "<input type=hidden name=redirect value='".$_SERVER['PHP_SELF']."'>\n";
?>
cantidad[-clave] <input id='cantidadx' type='text' name='cantidad' size='4' onfocusout="cantidadFocusOut('#cantidadx', '#dimensionesx', '#especiex')"> 
especie <?php echo $especies;?>
Dimensiones <input id='dimensionesx' type='text' name='descripcion'>
<input type='submit' name='salidaMA' value='agregar'> 
<button id="verlistax">Ver Lista</button>
</form>
<script>
$('#cant_esp_dimx').submit(function(e){  // al enviar el formulario mad dimensionada (enter)
	// form submit
	  var cc = $( "#cantidadx" ).val();
	  var nd;
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		if($("#dimensionesx").val().length==0){
			e.preventDefault();
			return;
		}else{ //hay dimensiones, normalizar
			nd=analizadimensiones($("#dimensionesx").val());
			$("#dimensionesx").val(nd);
		}
		return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( "#cantidadx" ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] })
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( "#dimensionesx" ).val( r.descrip );
			  $( "#especiex" ).val(r.especie);
		  });
	  e.preventDefault(); // asyncrona, espera antes de enviar sirve que se revisa
});
</script>
<script>
function cantidadFocusOut(cantidad,dimensiones,especie){
	// los tres campos que se afectaran
	//
	  // en cantidad si hay separador la 1a es cantidad, la 2a es clave de tabla
	  //var cc = $( "#cantidad" ).text();
	  var cc = $( cantidad ).val();
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		  //alert("solo cantidad "+nd);
		  return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( cantidad ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] } )
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( dimensiones ).val( r.descrip );
			  $( especie ).val(r.especie);
	  		});
	  return;
}
</script>
<script>
function analizadimensiones(d){
	var res;
        var d1;
        d1=d.replace(/X/gi,"x");
        d1=d1.replace(/\*/gi,"x");
        d1=d1.replace(/[ ]*x[ ]*/g,"x");
        //d1=d1.replace(/ /g,"+");
        //alert("normalizando dimensones: "+d1);
        res=d1.split("x");
        //alert("tokens: "+res);
	if(res.length!=3){
		return d;  // tu sabras lo que metes!
                //alert("dimensiones incorrectas, hay "+nd);
                //return;
        }
	return d1;
}
</script>
<script>
// 0=no cargada, no mostrada, 1=cargada, mostrada, 2=cargada,no mostrada
$( "#verlistax" )
.click(function(){
	//alert( "Handler for .click() called." );
	var dim=$( "#dimensionesx" ).val();
	if(medidas!=dim) {
		status=0;
		medidas=dim;
	}
	if(status==0){
		$.get("ajaxMaderaDim.php",{descrip:medidas})
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  $("#listax").empty().append( data );
	  		});
		status=1;
	} else if(status==1){
		// ocultar
		$("#listax").hide();
		status=2;
	} else {
		// mostrar
		$("#listax").show();
		status=1;
	}
	return false; // no submit
});

function botonclicked(b) { // en la lista ajax de tablas
	$.get( "getdescrip.php", { id:b.value } )
		.done( function (data) {
		//alert("data descrip: "+data);
		var r=jQuery.parseJSON(data);
		$( "#dimensionesx" ).val( r.descrip );
		$( "#especiex" ).val(r.especie);
		}
	);
	//document.getElementById("dimensiones").value = "Hello World" + b.value;
	//alert("boton: "+b.value);
	//document.getElementById("lista").style.display = "none";
	$("#verlistax").trigger("click");
  	$("#cantidadx").focus();
}
</script>
