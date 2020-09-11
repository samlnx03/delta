<?php
// grant select, lock tables on delta.* to deltaRespaldo@localhost identified by 'deltaBackup';
// crontab -e
// 00 00 * * 0 php /home/sperez/delta/backupDB.php
// cada domingo a las 0:00

$path = '/home/sperez/delta/db';
$backup_file = "$path/deltadb" . date("Y-m-d-H-i-s") . '.gz';
$command = "mysqldump --opt -h localhost -u deltaRespaldo -pdeltaBackup ". "delta | gzip > $backup_file";
system($command);

$files=glob("$path/deltadb*.gz");
foreach ($files as $filename) {
    echo "$filename size " . filesize($filename) . "\n";
}
// mover al drive de google
?>
