<?php 

require_once(__DIR__ . '/../public/inc/config.php');
require_once(__DIR__ . '/../public/inc/db_mysql.php');

$sql[] = "DROP TABLE IF EXISTS `migrations`;";

$sql[] = "CREATE TABLE `migrations` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `batch` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql[] = "INSERT INTO `migrations` (`migration`, `batch`) VALUES ('2014_10_12_000000_create_users_table', '1');";
$sql[] = "INSERT INTO `migrations` (`migration`, `batch`) VALUES ('2014_10_12_100000_create_password_resets_table', '1');";
$sql[] = "INSERT INTO `migrations` (`migration`, `batch`) VALUES ('2019_05_18_154804_alter_users_table', '1');";
$sql[] = "INSERT INTO `migrations` (`migration`, `batch`) VALUES ('2019_05_18_185113_add_field_admin_to_users', '1');";

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
