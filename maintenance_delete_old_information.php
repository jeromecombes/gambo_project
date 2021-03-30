<?php

require_once __DIR__ . '/public/inc/config.php';
require_once __DIR__ . '/public/inc/db_mysql.php';

$not_really = true;

$keep = 2017;

$tables = array(
    'courses',
    'courses_attrib_rh',
    'courses_choices',
    'courses_cm',
    'courses_rh',
    'courses_rh2',
    'courses_td',
    'courses_univ',
    'courses_univ3',
    'courses_univ4',
    'dates',
    'eval_enabled',
    'evaluations',
    'forms',
    'grades',
    'housing',
    'housing_accept',
    'housing_affect',
    'housing_closed',
    'stage',
    'stages',
    'students',
    'tutorat',
    'univ_reg',
    'univ_reg2',
    'univ_reg3s',
    'univ_reg_lock1',
    'univ_reg_show',
);

$documents_folder = 'storage/app/';

foreach ($tables as $table) {
    for ($year = 2011; $year < $keep; $year++) {

        foreach (array('Spring ', 'Fall ') as $elem) {
            $semester = $elem . $year;

            $db = new db();
            $db->delete($table, "semester = '$semester' or semester = '' or semester is null", $not_really);
        }
    }
}

// Documents and Responses

$db = new db();
$db->query("select max(id) as max from students");
$max = $db->result[0]['max'];

$deleted_students = array();

for ($i = 1; $i < $max; $i++) {
    $db = new db();
    $db->select('students', 'id', "id=$i");
    if (!$db->result) {
        $deleted_students[] = $i;
    }
}

if (!empty($deleted_students)) {
    $deleted_students = join(',', $deleted_students);

    $db = new db();
    $db->delete('documents', "student in ($deleted_students)", $not_really);
    $db->delete('responses', "student in ($deleted_students)", $not_really);
}


// Hosts
$db = new db();
$db->delete("logements_dispo", "end between 20201 and {$keep}1", $not_really);

$db = new db();
$db->query("select max(id) as max from logements");
$max = $db->result[0]['max'];

$deleted_hosts = array();

for ($i = 1; $i < $max; $i++) {
    $db = new db();
    $db->select('logements_dispo', 'logement_id', "logement_id=$i");
    if (!$db->result) {
        $deleted_hosts[] = $i;
    }
}

if (!empty($deleted_hosts)) {
    $deleted_hosts = join(',', $deleted_hosts);

    $db = new db();
    $db->delete('logements', "id in ($deleted_hosts)", $not_really);
}


$db =new db();
$db->delete('log', "`time` < '$keep-00-00'", $not_really);
$db =new db();
$db->delete('log_access', "`timestamp` < '$keep-00-00'", $not_really);

// Documents
$db = new db();
$db->query("select max(id) as max from documents");
$max = $db->result[0]['max'];

$deleted_documents = array();

for ($i = 1; $i < $max; $i++) {
    $db = new db();
    $db->select('documents', 'id', "id=$i");
    if (!$db->result) {
        $deleted_documents[] = $i;
    }
}

if (!empty($deleted_documents)) {

    foreach (scandir($documents_folder) as $folder1) {
        if (!is_numeric($folder1)) {
            continue;
        }

        foreach (scandir($documents_folder . $folder1) as $folder2) {
            if (!is_numeric($folder2)) {
                continue;
            }

            foreach ($deleted_documents as $doc) {
                if (file_exists ($documents_folder . $folder1 . '/' . $folder2 . '/' . $doc)) {
                    echo 'Deleting storage/app/' . $folder1 . '/' . $folder2 . '/' . $doc . "\n";

                    if (!$not_really) {
                        unlink($documents_folder . $folder1 . '/' . $folder2 . '/' . $doc);
                    }
                }
            }

            if (count(scandir($documents_folder . $folder1 . '/' . $folder2)) == 2) {
                echo "Deleting folder $folder1/$folder2\n";
                if (!$not_really) {
                    rmdir($documents_folder . $folder1 . '/' . $folder2);
                }
            }
        }
        if (count(scandir($documents_folder . $folder1)) == 2) {
            echo "Deleting folder $folder1\n";
            if (!$not_really) {
                rmdir($documents_folder . $folder1);
            }
        }
    }
}
