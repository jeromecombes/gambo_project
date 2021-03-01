<?php 

require_once(__DIR__ . '/../public/inc/config.php');
require_once(__DIR__ . '/../public/inc/db_mysql.php');

$sql[] = "DROP TABLE IF EXISTS `univ_reg3s`;";

foreach ($sql as $queries) {
    print $queries . " : ";

    $db = new db();
    $db->query($queries);
    if ($db->error) {
        print "\033[31m[KO]\e[0m\n";
        continue;
    }
    print "\033[32m[OK]\e[0m\n";
}
