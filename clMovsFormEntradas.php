<div  id="madera" style="<?php echo $styl1;?>">
<form id='cant_esp_dim' action='clDetalleAltaMA.php' method='POST'>
<?php
$q="select clave, descrip from actividades where tipo='tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
//echo "$clave\n";
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especie", "especie", "especie", '');
?>
<?php echo "$clave\n";?>
cantidad[-clave] <input id='cantidad' type='text' name='cantidad' size='4' onfocusout="cantidadFocusOut('#cantidad', '#dimensiones', '#especie')"> 
especie <?php echo $especies;?> 
Dimensiones <input id='dimensiones' type='text' name='descripcion'>
<input type='submit' name='aserrioYhojeado' value='agregar'> 
<button id="verlista">Ver Lista</button>
</form>
<div id=lista></div>
<script>
$('#cant_esp_dim').submit(function(e){  // al enviar el formulario mad dimensionada (enter)
	// form submit
	  var cc = $( "#cantidad" ).val();
	  var nd;
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		if($("#dimensiones").val().length==0){
			e.preventDefault();
			return;
		}else{ //hay dimensiones, normalizar
			nd=analizadimensiones($("#dimensiones").val());
			$("#dimensiones").val(nd);
		}
		return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( "#cantidad" ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] })
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( "#dimensiones" ).val( r.descrip );
			  $( "#especie" ).val(r.especie);
		  });
	  e.preventDefault(); // asyncrona, espera antes de enviar sirve que se revisa
});
</script>
</div>
