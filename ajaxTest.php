<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>click demo</title>
  <style>
  p {
    color: red;
    margin: 5px;
    cursor: pointer;
  }
  p:hover {
    background: yellow;
  }
  </style>
  <script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
 
<p>First Paragraph</p>
<p>Second Paragraph</p>
<p>Yet one more Paragraph</p>
<button id="b1">ClickMe</button> 
<button id="b2">ClickMe</button> 
<button id="b3">ClickMe</button> 
<div id="ajaxOut"></div>
<script>
$( "p" ).click(function() {
  $( this ).slideUp();
});
$("#b1").click(function(){
	alert("B1 was clicked!");
});
$("#b2").click(function(){
	$.ajax({
	  url: "ajaxMaderaDim.php",
	  context: document.body
	}).done(function(r) {
	  //$( this ).addClass( "done" );
	  $("#ajaxOut").html( r );
	});	
});
$("#b3").click(function(){
	$.get("ajaxMaderaDim.php",
		function(r) {
	  		$("#ajaxOut").html( r );
		});
	//
});
</script>
 
</body>
</html>
