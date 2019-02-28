#!/bin/bash

if [ $PWD != "/home/sperez/deltadev" ]; then
	echo "undo solo en el directorio deltadev"
	exit 1
fi

#regresa al color de menu para produccion y a la base de datos en produccion
git checkout -- styles/menu.css
git checkout -- Auth/dbclass.php

echo "to do:
	git status
	git add .
	git commit -m \"log de cambios\"
	git push origin master

	cd ../delta
	git pull

	mysql -u sperez -p delta < changesdb.sql
	"

