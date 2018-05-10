create database delta;
grant all privileges on delta.* to sperez@localhost identified by 'sam';
connect delta;


create table clavesActividad(clave char(10), descrip char(50), costo Decimal(9,4), unidad char(10), primary key(clave));
insert into clavesActividad(clave,descrip,costo,unidad) values ('apino','aserrio pino','0.500','pie-tabla');
insert into clavesActividad(clave,descrip,costo,unidad) values ('hpino','hojeado pino','0.2500','pie-tabla');
insert into clavesActividad(clave,descrip,costo,unidad) values ('clatar','Clavado de tarima','10.2500','pieza');
insert into clavesActividad(clave,descrip,costo,unidad) values ('cosca','costado de caja agricola','0.2500','bulto');
insert into clavesActividad(clave,descrip,costo,unidad) values ('cabca','cabecera de caja agricola','0.2500','bulto');

select * from clavesActividad;
#------------------------------------------------------------------------



create table empleados(id int not null auto_increment, nombre char(60), primary key(id), key(nombre));
insert into empleados(nombre) values ('samuel perez');
select * from empleados;
#------------------------------------------------------------------------

create table prodSierrasCintas(id int not null auto_increment,supervisor char(20), fecha date, sierraCinta char(10), operador int, ayudante int, entrego char(20), recibio char(20), primary key(id), key (fecha), key(operador), key(ayudante));

insert into prodSierrasCintas(supervisor,fecha,sierraCinta, operador, ayudante,entrego, recibio) values ('sup001',now(),'1','1','NULL','entrego','recibio');
#------------------------------------------------------------------------

create table prodSierrasCintasMovs(id int not null auto_increment,idRepo int not null, cantidad int not null, descripcion char(50) not null, actividad char(10) not null, cubicacionPT decimal(9,3), primary key(id), key (idRepo), key(clave,descripcion));

#------------------------------------------------------------------------
create table tablas(id int not null auto_increment, especie char(10) not null, claveprod char(10) not null, descrip char(50) not null, grueso decimal(9,4) not null, ugrueso char(1) not null default 'i', ancho decimal(9,4) not null, uancho char(1) not null default 'i', largo decimal(9,4) not null, ulargo char(1) not null default 'i', volpt decimal(9,4) not null,  existen int, primary key(id), key(descrip), key(claveprod,descrip));

insert into tablas (especie, claveprod,descrip, grueso, ancho, largo, volpt) values ('pino','hp','3/4x4x81/4',0.75,4,8.25,1.1);

