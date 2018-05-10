<html>
<head>
<script type="text/javascript" src="libs/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function(){
   // jQuery methods go here...
	$("#g1_8").click(function(){ //  con id
		//alert("ok si funca "+$( this ).text());
		$(".grueso").val($(this).text());  // con class
	});
	$(".btnGrueso").click(function(){ // con class
		$("#grueso").val(
			$("#grueso").val()+"+"+$(this).text());  // con class
	});
	$("#btnGruesoClear").click(function(){
		$("#grueso").val("");
	});
}); // en document.ready
</script>
</head>
<body>
<form>
 <button id="btnGruesoClear" type="button">Limpiar</button> 
 <button class="btnGrueso" type="button">1/8</button> 
 <button class="btnGrueso" type="button">1/4</button> 
<br>
<input id=grueso type=text name=grueso value="">
</form>
</body>
</html>

