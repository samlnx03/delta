<div  id="maderaexit" style="<?php echo $styl1;?>">
<form id='cant_esp_dimx' action='clDetalleAltaMA.php' method='POST'>
<?php
//$q="select clave, descrip from actividades where tipo='tabla'";
//$clave=htmlSelect($q, "clave", "clave", "descrip", '');
//echo "$clave\n";
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especiex", "especie", "especie", '');
?>
<?php //echo "$clave\n";?>
cantidad[-clave] <input id='cantidadx' type='text' name='cantidad' size='4' onfocusout="cantidadFocusOut('#cantidadx', '#dimensionesx', '#especiex')"> 
especie <?php echo $especies;?> 
Dimensiones <input id='dimensionesx' type='text' name='descripcion'>
<input type='submit' name='salidaMA' value='agregar'> 
<button id="verlistax">Ver Lista</button>
</form>
<div id=listax></div>
<script>
</script>
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
</div>
