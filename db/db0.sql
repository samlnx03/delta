#mysq -u user -p db < db0.sql

drop table if exists actividades;
create table actividades(
        clave char(10),
        descrip char(50),
        costo Decimal(9,4),
        unidad char(10),
	tipo enum('tabla','tarima','otro') default 'otro',
        primary key(clave)
);
#---------------------------------------
drop table if exists empleados;
create table empleados(
        id int not null auto_increment, 
        nombre char(60), 
        primary key(id), 
        key(nombre)
);

#---------------------------------------
drop table if exists repoProd;
create table repoProd(
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
	aplicadaEnInventario char(1) default 'n',
        primary key(id), key (fecha), key(operador), key(ayudante)
);

drop table if exists movsRepoDimensionado;
create table movsRepoDimensionado(
        id int not null auto_increment,
        idRepo int not null,
        actividad char(10) not null comment 'aserrio u hojeado',
        cantidad int not null,
        idtabla int not null comment 'la tabla incluye la especie de madera',
        primary key(id), key (idRepo), key(actividad,idtabla)
);

drop table if exists movsRepoOtrasActiv;
create table movsRepoOtrasActiv(
        id int not null auto_increment,
        idRepo int not null,
        actividad char(10) not null comment 'clavado, cabecera, horas ...',
        cantidad int not null,
        idEmpleado int not null comment 'a quien se le paga el destajo',
        primary key(id), key (idRepo), key(idEmpleado,idRepo)
);
#---------------------------------------
drop table if exists destajosDim;
create table destajosDim(
        id int not null auto_increment,
        idDimensionado int comment 'tabla movsRepoDimensionado',
        idEmpleado int not null,
        cubicacionPT decimal(9,3),
        costo_pu Decimal(9,4) comment 'de la tabla de actividades',
        costo Decimal(9,4),
        primary key(id), key (idEmpleado)
);

drop table if exists destajosOtros;
create table destajosOtros(
        id int not null auto_increment,
        idOtras int comment 'tabla movsRepoOtrasActividades',
        idEmpleado int not null,
        costo_pu Decimal(9,4) comment 'de la tabla de actividades',
        costo Decimal(9,4),
        primary key(id), key (idEmpleado)
);

#---------------------------------------
drop table if exists tablas;
create table tablas(
        id int not null auto_increment,
        especie char(10) not null,
        descrip char(50) not null,
        grueso decimal(9,4) not null,
        ugrueso char(1) not null default 'i',
        ancho decimal(9,4) not null,
        uancho char(1) not null default 'i',
        largo decimal(9,4) not null,
        ulargo char(1) not null default 'i',
        volpt decimal(9,4) not null,
        existen int,
        primary key(id), key(descrip), key(especie,descrip), key(especie,grueso)
);

drop table if exists tablasIO;
create table tablasIO(
	id int not null auto_increment,
	idtabla int not null,
	cantidad int not null comment 'positivo o neg, p.e. compras y ventas directas',
	fecha date,
	observaciones char(50),
	aplicadaEnInventario char(1) default 'n',
	primary key(id), key(fecha)
);
#---------------------------------------
drop table if exists tarimas;
create table tarimas(
        id int not null auto_increment,
        tarima char(10),
        descripcion char(50),
	editable char(1) default 's' comment 'si !=s ya no se puede editar componentes', 
        primary key(id), key(tarima)
);

drop table if exists deftarima;
create table deftarima(
        id int not null auto_increment,
        idtarima int not null,
        idtabla int not null,
        cantidad int not null,
        primary key(id)
);
