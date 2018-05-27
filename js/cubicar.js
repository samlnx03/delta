function analizadimensiones(d){
	var res;
	var nd;
        var d1;
        d1=d.replace(/X/gi,"x");
        d1=d1.replace(/\*/gi,"x");
        d1=d1.replace(/[ ]*x[ ]*/g,"x");
        d1=d1.replace(/ /g,"+");
        //alert("normalizando dimensones: "+d1);
        res=d1.split("x");
        //alert("tokens: "+res);
        if((nd=res.length)!=3){
                alert("dimensiones incorrectas, hay "+nd);
                return;
        }
	
	var g,a,l;
	g=res[0]; a=res[1]; l=res[2];
	//alert("g:"+g+" a:"+a+" l:"+l);
	var vg,va,vl;
	vg=eval(g); va=eval(a); vl=eval(l);
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	
	var ug, ua, ul;
	// grueso
	if(g.includes("."))
		ug='C'; // centimetros
	else if(g.includes("/"))
		ug='I'; // pulgadas
	else if(vg>3)
		ug='C'; // centimetros
	else
		ug='I'; // pulgadas
	// ancho
	if(a.includes("."))
		ua='C'; // centimetros
	else if(a.includes("/"))
		ua='I'; // pulgadas
	else if(va>10)
		ua='C'; // centimetros
	else
		ua='I'; // pulgadas
	// largo
	if(l.includes("."))
		ul='M'; // metros
	else if(vl>=100)	// no hay . ni /
		ul='C'; // centimetros
	else
		ul='I'; // pulgadas
	//alert("ug:"+ug+" ua:"+ua+" ul:"+ul);
	//
	// ajuste de selects
	var gid='ugrueso'+ug;
	//alert("gid:"+gid); //+" ua:"+ua+" ul:"+ul);
	document.getElementById(gid).selected = true;
	document.getElementById("gruesoDecimal").value = vg;
	var aid='uancho'+ua;
	document.getElementById(aid).selected = true; 
	document.getElementById("anchoDecimal").value = va;
	var lid='ulargo'+ul;
	document.getElementById(lid).selected = true; 
	document.getElementById("largoDecimal").value = vl;
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	// calculo del volumne en pie-t
	var vol=vg*va*vl;
	if(ug=='C') vol=vol/2.54;
	if(ua=='C') vol=vol/2.54;
	if(ul=='C') vol=vol/2.54;
	else if(ul=='M') vol=vol*100/2.54;
	else if(ul=='F') vol=vol*12;
	vol=vol/144;
	document.getElementById("volumenPT").value = vol;
	// descripcion normalizada
	d1=d1.replace(/\+/gi," ");
	document.getElementById("descripcion").value = d1;
}
function recalcVol(){
	var vg=document.getElementById("gruesoDecimal").value;
	var va=document.getElementById("anchoDecimal").value;
	var vl=document.getElementById("largoDecimal").value;
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	//var x  = document.getElementById("ugrueso").selectedIndex;
	var ug  = document.getElementById("ugrueso").value;
//	alert("grueso index x:"+x);
	var ua  = document.getElementById("uancho").value;
	var ul  = document.getElementById("ulargo").value;
	/*
	var ua = document.getElementsByTagName("option")[x].value;
	var x  = document.getElementById("ulargo").selectedIndex;
	var ul = document.getElementsByTagName("option")[x].value;
	 */
	//alert("ug:"+ug+" ua:"+ua+" ul:"+ul);
	var vol=vg*va*vl;
	if(ug=='C') vol=vol/2.54;
	if(ua=='C') vol=vol/2.54;
	if(ul=='C') vol=vol/2.54;
	else if(ul=='M') vol=vol*100/2.54;
	else if(ul=='F') vol=vol*12;
	vol=vol/144;
	document.getElementById("volumenPT").value = vol;
}
