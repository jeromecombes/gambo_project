<?php
require_once __DIR__ . '/../inc/config.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$button = filter_input(INPUT_POST, 'button', FILTER_SANITIZE_STRING);
$table = filter_input(INPUT_POST, 'table', FILTER_SANITIZE_STRING);

if (!in_array(16, $_SESSION['vwpp']['access'])) {
    echo json_encode(array('error'=>true, 'button' => $button, 'message' => 'Access denied'));
    exit;
}

$db = new db();
$db->select($table, "`lock`", "id=$id");

$lock = $db->result ? $db->result[0]['lock'] : 0;
$lock = $lock ? 0 : 1;

if ($lock) {
    $button = strstr($button, 'Verrouiller') ? 'Déverrouiller' : 'Unlock';
} else {
    $button = strstr($button, 'Déverrouiller') ? 'Verrouiller' : 'Lock';
}

$db = new db();
$db->update($table, "`lock` = '$lock'", "id='$id'");


if ($db->error) {
    echo json_encode(array('error'=>true, 'button' => $button, 'message' => $db->error));
} else {
    echo json_encode(array('error'=>false, 'button' => $button));
}
?>
