create database delta;
grant all privileges on delta.* to sperez@localhost identified by 'sam';
connect delta;


create table clavesActividad(
	clave char(10), 
	descrip char(50), 
	costo Decimal(9,4), 
	unidad char(10), 
	primary key(clave)
);
insert into clavesActividad(clave,descrip,costo,unidad) values ('apino','aserrio pino','0.500','pie-tabla');
insert into clavesActividad(clave,descrip,costo,unidad) values ('hpino','hojeado pino','0.2500','pie-tabla');
insert into clavesActividad(clave,descrip,costo,unidad) values ('clatar','Clavado de tarima','10.2500','pieza');
insert into clavesActividad(clave,descrip,costo,unidad) values ('cosca','costado de caja agricola','0.2500','bulto');
insert into clavesActividad(clave,descrip,costo,unidad) values ('cabca','cabecera de caja agricola','0.2500','bulto');

select * from clavesActividad;
#------------------------------------------------------------------------
create table empleados(
	id int not null auto_increment, 
	nombre char(60), 
	primary key(id), 
	key(nombre)
);

insert into empleados(nombre) values ('samuel perez');
select * from empleados;
#------------------------------------------------------------------------
create table prodRepos(
	id int not null auto_increment,
	supervisor char(20), 
	fecha date, 
	sierraCinta char(10), 
	operador int, 
	pctjOp int,
	ayudante int, 
	pctjAyu int,
	entrego char(20), 
	recibio char(20), 
	primary key(id), key (fecha), key(operador), key(ayudante)
);

#insert into prodRepos(supervisor,fecha,sierraCinta, operador, pctjOp, ayudante, pctjAyu, entrego, recibio) values ('sup001',now(),'1','1',100,'NULL',0,'entrego','recibio');
#------------------------------------------------------------------------
create table repoMovs(
	id int not null auto_increment,
	idRepo int not null, 
	actividad char(10) not null, 
	cantidad int not null, 
	descripcion char(50) not null, 
	primary key(id), key (idRepo), key(descripcion, actividad)
);
#------------
create table destajos(
	id int not null auto_increment,
	idRepoMovs int not null, 
	idEmpleado int not null,
	cubicacionPT decimal(9,3), 
	costo_pu Decimal(9,4), 
	costo Decimal(9,4), 
	primary key(id), key (idEmpleado), key(actividad,descripcion)
);

#  usa la tabla para aserrio y para hojeado, tambien para otros destajos
# pero en ese caso no se usa el campo cubicacionPT
#------------------------------------------------------------------------
create table tablas(
	id int not null auto_increment, 
	especie char(10) not null, 
	claveprod char(10) not null, 
	descrip char(50) not null, 
	grueso decimal(9,4) not null, 
	ugrueso char(1) not null default 'i', 
	ancho decimal(9,4) not null, 
	uancho char(1) not null default 'i', 
	largo decimal(9,4) not null, 
	ulargo char(1) not null default 'i', 
	volpt decimal(9,4) not null,  
	existen int, 
	primary key(id), key(descrip), key(claveprod,descrip)
);

insert into tablas (especie, claveprod,descrip, grueso, ancho, largo, volpt) values ('pino','hp','3/4x4x81/4',0.75,4,8.25,1.1);

#------------------------------------------------------------------------
create table tarimas(
	id int not null auto_increment, 
	tarima char(20),
	descripcion char(50),
	primary key(id), key(tarima)
);
#----------------
create table deftarima(
	id int not null auto_increment, 
	idtarima int not null,
	idtabla int not null,
	cantidad int not null,
	primary key(id)
);

