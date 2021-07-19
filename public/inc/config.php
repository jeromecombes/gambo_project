<?php
require_once(__DIR__.'/../../vendor/autoload.php');

$evn_file = '.env';
$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../../', $evn_file);
$dotenv->load();

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

global $config;
global $dbprefix;
$config = array();

//	Main Configuration
$config['dbhost'] = $_ENV['DB_HOST'];
$config['dbname'] = $_ENV['DB_DATABASE'];
$config['port'] = $_ENV['DB_PORT'];
$config['dbuser'] = $_ENV['DB_USERNAME'];
$config['dbpass'] = $_ENV['DB_PASSWORD'];
$config['dbprefix'] = '';
$dbprefix = $config['dbprefix'];
$config['dateFormat'] = $_ENV['DATE_FORMAT'];
$config['crypt_key'] = $_ENV['APP_KEY2'];
$config['folder']="";
$config['url'] = $_ENV['APP_URL'];
$config['sessionTimeOut'] = (int) $_ENV['SESSION_LIFETIME'] * 60;

$config['documentType'] = explode(',', $_ENV['DOCUMENT_TYPES']);

sort($config['documentType']);
$config['documentType'][] = 'Other';

$config['Mail-IsMail-IsSMTP'] = ($_ENV['MAIL_MAILER'] == 'smtp') ? 'IsSMTP' : 'IsMail';
$config['Mail-WordWrap'] = 50;
$config['Mail-Hostname'] = preg_replace('/.[^\/]*\/\/(.[^\/]*).*/', "$1", $_ENV['APP_URL']);
$config['Mail-Host'] = $_ENV['MAIL_HOST'];
$config['Mail-Port'] = $_ENV['MAIL_PORT'];
$config['Mail-SMTPSecure'] = (empty($_ENV['MAIL_ENCRYPTION']) or $_ENV['MAIL_ENCRYPTION'] == 'null') ? false : $_ENV['MAIL_ENCRYPTION'];
$config['Mail-SMTPAuth'] = (empty($_ENV['MAIL_USERNAME']) or $_ENV['MAIL_USERNAME'] == 'null') ? false : true;
$config['Mail-Username'] = $_ENV['MAIL_USERNAME'];
$config['Mail-Password'] = $_ENV['MAIL_PASSWORD'];
$config['Mail-From'] = $_ENV['MAIL_FROM_ADDRESS'];
$config['Mail-FromName'] = $_ENV['MAIL_FROM_NAME'];
$config['Mail-Sender'] = $_ENV['MAIL_FROM_ADDRESS'];

// Notification des formulaire de voyage
$config['emailForTripForm'] = explode(',', $_ENV['MAIL_TRIP_FORM']);

$config['disciplines'] = $_ENV['APP_DISCIPLINES'];
$config['institutions'] = $_ENV['APP_INSTITUTIONS'];
$config['niveaux'] = $_ENV['APP_LEVELS'];
$config['univCoursNature'] = $_ENV['APP_COURSE_TYPE'];

$inc=explode("/",$_SERVER['SCRIPT_NAME']);
$folder=($inc[count($inc)-2]=="inc" or $inc[count($inc)-2]=="admin")?"../":null;

require_once __DIR__."/db_mysql.php";
require_once __DIR__."/functions.php";
?>
