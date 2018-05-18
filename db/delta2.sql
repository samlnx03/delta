create database delta;
grant all privileges on delta.* to sperez@localhost identified by 'sam';
connect delta;

create table actividades(
        clave char(10),
        descrip char(50),
        costo Decimal(9,4),
        unidad char(10),
        primary key(clave)
);

#---------------------------------------
create table empleados(
        id int not null auto_increment, 
        nombre char(60), 
        primary key(id), 
        key(nombre)
);

#---------------------------------------
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
        primary key(id), key (fecha), key(operador), key(ayudante)
);

create table movsRepoDimensionado(
        id int not null auto_increment,
        idRepo int not null,
        actividad char(10) not null comment 'aserrio u hojeado',
        cantidad int not null,
        idtabla int not null comment 'la tabla incluye la especie de madera',
        primary key(id), key (idRepo), key(actividad,idtabla)
);
create table movsRepoOtrasActiv(
        id int not null auto_increment,
        idRepo int not null,
        actividad char(10) not null comment 'clavado, cabecera, horas ...',
        cantidad int not null,
        idEmpleado int not null comment 'a quien se le paga el destajo',
        primary key(id), key (idRepo), key(idEmpleado,idRepo)
);
#---------------------------------------
create table destajosDim(
        id int not null auto_increment,
        idDimensionado int comment 'tabla movsRepoDimensionado',
        idEmpleado int not null,
        cubicacionPT decimal(9,3),
        costo_pu Decimal(9,4) comment 'de la tabla de actividades',
        costo Decimal(9,4),
        primary key(id), key (idEmpleado)
);
create table destajosOtros(
        id int not null auto_increment,
        idOtras int comment 'tabla movsRepoOtrasActividades',
        idEmpleado int not null,
        costo_pu Decimal(9,4) comment 'de la tabla de actividades',
        costo Decimal(9,4),
        primary key(id), key (idEmpleado)
);

#---------------------------------------
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
        primary key(id), key(descrip), key(especie,descrip)
);

#---------------------------------------
create table tarimas(
        id int not null auto_increment,
        tarima char(20),
        descripcion char(50),
        primary key(id), key(tarima)
);
create table deftarima(
        id int not null auto_increment,
        idtarima int not null,
        idtabla int not null,
        cantidad int not null,
        primary key(id)
)
