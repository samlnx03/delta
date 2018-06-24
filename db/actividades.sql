alter table actividades add column proceso int default 0;
update actividades set proceso=1 where descrip like 'ASERRIO%';
update actividades set proceso=2 where descrip like 'Corte a Longitud%';

