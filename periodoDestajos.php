<?php
require_once "Auth/session.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores

$db=db::getInstance();
$f1="";
$f2="";
if (isset($_POST["recalc"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$q="update claveValor set valor='$f1' where clave='rDestajSCf1'"; // registra fechas 
	$db->query($q);
	$q="update claveValor set valor='$f2' where clave='rDestajSCf2'"; 
	$db->query($q);

	$rangoFechas="fecha>='$f1' AND fecha<='$f2'";
	$q="DELETE FROM destajosMDim";
	$db->query($q);
	$q="ALTER TABLE destajosMDim AUTO_INCREMENT = 1";
	$db->query($q);
	// aserrio operadores
	$q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso) 
	select fecha, operador as empleado, e.nombre, pctjOp as pctj, m.id, m.idrepo, m.actividad, a.descrip as activ, m.cantidad, m.idtabla, t.especie, t.descrip as medidas,  t.volpt*cantidad as volpt, a.costo, round(a.costo*volpt*cantidad*pctjOp/100,2) as destajo, a.proceso
	from movsRepoDimensionado m
	     left join repoProd rp1 on m.idRepo=rp1.id
		left join tablas t on m.idtabla=t.id
		left join actividades a on m.actividad=a.clave
		left join empleados e on operador=e.id
	where e.id IS NOT NULL AND a.proceso=1 AND $rangoFechas
";
	//echo $q;
	$db->query($q);
	// aserrio ayudantes
	$q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso) 
	select fecha, ayudante as empleado, e.nombre, pctjAyu as pctj, m.id, m.idrepo, m.actividad, a.descrip as activ, m.cantidad, m.idtabla, t.especie, t.descrip as medidas,  t.volpt*cantidad as volpt, a.costo, round(a.costo*volpt*cantidad*pctjAyu/100,2) as destajo, a.proceso
	from movsRepoDimensionado m
	     left join repoProd rp1 on m.idRepo=rp1.id
		left join tablas t on m.idtabla=t.id
		left join actividades a on m.actividad=a.clave
		left join empleados e on ayudante=e.id
	where e.id IS NOT NULL AND a.proceso=1 AND $rangoFechas
";
	//echo $q;
	$db->query($q);

	//corte a largo
	$q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso) 
	select fecha, operador as empleado, e.nombre, 100 as pctj, m.id, m.idrepoCL, m.actividad, a.descrip as activ, m.cantidad, m.idtabla, t.especie, t.descrip as medidas,  t.volpt*cantidad as volpt, a.costo, round(a.costo*volpt*cantidad,2) as destajo, a.proceso
	from movsRepoCL m
	     left join repoCL rp1 on m.idRepoCL=rp1.id
		left join tablas t on m.idtabla=t.id
		left join actividades a on m.actividad=a.clave
		left join empleados e on operador=e.id
		where e.id IS NOT NULL AND a.proceso=2 AND $rangoFechas
";
	echo $q;
	$db->query($q);

        // clavado de tarimas, los campos de destajosMDim, sufren cambios
        // fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso
        // fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso
        //                                                                          xxxxxxxxxxxxxxxxxxxxx
        // idtabla va en 0, especie, medidas,volpt no se usan
        // 
        $q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,costo,destajo,proceso) 
        select fecha, idempleado as empleado, e.nombre, 100 as pctj, m.id, m.idrepoCT, m.actividad, a.descrip as activ, m.cantidad, 0,a.costo, round(a.costo*cantidad,2) as destajo, a.proceso
        from movsRepoOtrasActiv m
             left join repoCT rp1 on m.idRepoCT=rp1.id
                left join actividades a on m.actividad=a.clave
                left join empleados e on idempleado=e.id
                where e.id IS NOT NULL AND a.proceso=3 AND $rangoFechas
";
        echo $q;
	$db->query($q);

        // otros destajo, similar a clavado de tarimas
        // fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso
        // fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo,proceso
        //                                                                          xxxxxxxxxxxxxxxxxxxxx
        // idtabla va en 0, especie, medidas,volpt no se usan
        // 
        $q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,costo,destajo,proceso) 
        select fecha, idempleado as empleado, e.nombre, 100 as pctj, m.id, m.idrepoOD, m.actividad, a.descrip as activ, m.cantidad, 0,a.costo, round(a.costo*cantidad,2) as destajo, a.proceso
        from movsRepoOtrasActiv m
             left join repoOD rp1 on m.idRepoOD=rp1.id
                left join actividades a on m.actividad=a.clave
                left join empleados e on idempleado=e.id
                where e.id IS NOT NULL AND a.proceso=0 AND $rangoFechas
";
        echo $q;
	$db->query($q);

	// otros destajos de reportes de aserrio
        $q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,costo,destajo,proceso) 
        select fecha, idempleado as empleado, e.nombre, 100 as pctj, m.id, m.idRepo, m.actividad, a.descrip as activ, m.cantidad, 0,a.costo, round(a.costo*cantidad,2) as destajo, a.proceso
        from movsRepoOtrasActiv m
             left join repoProd rp1 on m.idRepo=rp1.id
                left join actividades a on m.actividad=a.clave
                left join empleados e on idempleado=e.id
                where e.id IS NOT NULL AND a.proceso=0 AND $rangoFechas
";
        echo $q;
        $db->query($q);
}
$_SESSION["msg"]="Periodo de destajos actualizado";
header("Location: destajos.php");
die();
?>
