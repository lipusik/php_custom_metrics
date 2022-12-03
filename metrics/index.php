<?php

define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/../config/config.php');
require_once(__ROOT__.'/../utils/datetime.php');
require_once(__ROOT__.'/../utils/get_included_php_modules.php');
require_once(__ROOT__.'/../library/database_connect.php');
require_once(__ROOT__.'/../library/tables.php');


$date_now=getDatetimeNow();
$GetName = new tables_class('php_module');

$table_name=($GetName->table_name);
$query_table="CREATE TABLE  IF NOT EXISTS  $table_name (
	module_id int(20) NOT NULL AUTO_INCREMENT,
	module_name varchar(60) COMMENT 'name of module php',
	update_time DATETIME NOT NULL COMMENT 'update datetime',
	PRIMARY KEY (module_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

conn()->query($query_table);
foreach (get_loaded_extensions() as &$value) {
	$result=conn()->query("SELECT module_name FROM $table_name where module_name='$value'");
	if ($result->num_rows < 1) {
		$sql="INSERT INTO $table_name (module_name,update_time) value ('$value','$date_now')";

        conn()->query($sql);
		echo "Add module '$value' to $table_name\n";
	} 
}
conn()->close();

$list_of_metrics=get_metrics($table_name);
echo "$list_of_metrics\n";


?>