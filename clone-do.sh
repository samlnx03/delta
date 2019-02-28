#!/bin/bash

#requiere ejecutar como sudo

if [[ $EUID > 0 ]]; then # we can compare directly with this syntax.
  echo "Please run as root/sudo"
  exit 1
fi

if [ -d /home/sperez/deltadev ]; then
	#existe el directorio
	#checar que deltadev este vacio
	if [ "$(ls -A /home/sperez/deltadev)" ]; then
		echo "deltadev not empty"
		exit 1
	fi
else
	mkdir /home/sperez/deltadev
	chown sperez.sperez /home/sperez/deltadev
fi


# clonar la base de datos

echo "DROP database IF EXISTS deltadev;" | mysql 
echo "create database deltadev;" | mysql 
mysqldump  delta | mysql deltadev
echo "grant all privileges on deltadev.* to sperez@localhost;" | mysql deltadev
#sperez ya existe en mysql 

#copiar scripts
rm -rf /home/sperez/deltadev/*
#cp -rT /home/sperez/delta/* /home/sperez/deltadev
rsync -rogt /home/sperez/delta/ /home/sperez/deltadev/

#color de menu para identificar desarrollo de pruebas (dev)
sed -i 's/#3b5998/#bf1d0b/g' /home/sperez/deltadev/styles/menu.css

#trabajar en la base de datos clonada
sed -i 's/delta/deltadev/g' /home/sperez/deltadev/Auth/dbclass.php

echo "goto to dir deltadev and do your changes and test freely"

