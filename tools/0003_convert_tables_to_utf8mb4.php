<?php

require_once(__DIR__ . '/../public/inc/config.php');
require_once(__DIR__ . '/../public/inc/db_mysql.php');

$tables = array (
    array(
        'name' => 'courses',
        'fields' => array(
            'professor',
            'title',
            'type',
            'semester',
            'univ',
            'nom',
            'code',
            'jour',
            'debut',
            'fin',
        ),
    ),
    array(
        'name' => 'courses_attrib_rh',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'courses_choices',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'courses_ciph',
        'fields' => array(
            'semester',
            'institution',
            'domaine',
            'titre',
            'instructeur',
            'debut',
            'fin',
            'titre2',
            'instructeur2',
            'debut2',
            'fin2',
            'duree',
            'day1',
            'start1',
            'end1',
            'day2',
            'start2',
            'end2',
            'day3',
            'start3',
            'end3',
            'day4',
            'start4',
            'end4',
            'day5',
            'start5',
            'end5',
            'day6',
            'start6',
            'end6',
            'notes',
        ),
    ),
    array(
        'name' => 'courses_cm',
        'fields' => array(
            'university',
            'code',
            'semester',
            'ufr',
            'parcours',
            'discipline',
            'departement',
            'licence',
            'niveau',
            'nom',
            'jour1',
            'debut1',
            'fin1',
            'jour2',
            'debut2',
            'fin2',
            'prof',
            'ufr_en',
            'parcours_en',
            'discipline_en',
            'departement_en',
            'licence_en',
            'nom_en',
            'email',
            'credits',
        ),
    ),
    array(
        'name' => 'courses_rh',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'courses_rh2',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'courses_td',
        'fields' => array(
            'university',
            'code',
            'semester',
            'jour1',
            'debut1',
            'fin1',
            'jour2',
            'debut2',
            'fin2',
            'prof',
            'nom',
            'nom_en',
            'email',
        ),
    ),
    array(
        'name' => 'courses_univ',
        'fields' => array(
            'semester',
            'university',
            'ufr',
            'parcours',
            'discipline',
            'departement',
            'licence',
            'niveau',
            'cm_name',
            'cm_code',
            'cm_day1',
            'cm_start1',
            'cm_end1',
            'cm_day2',
            'cm_start2',
            'cm_end2',
            'cm_prof',
            'td_name',
            'td_code',
            'td_day1',
            'td_start1',
            'td_end1',
            'td_day2',
            'td_start2',
            'td_end2',
            'td_prof',
            'university_en',
            'ufr_en',
            'parcours_en',
            'discipline_en',
            'departement_en',
            'licence_en',
            'niveau_en',
            'cm_name_en',
            'cm_code_en',
            'cm_prof_en',
            'td_name_en',
            'td_code_en',
            'td_prof_en',
            'notes',
        ),
    ),
    array(
        'name' => 'courses_univ3',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'courses_univ4',
        'fields' => array(    
            'code',
            'nom',
            'nature',
            'lien',
            'institution',
            'institutionAutre',
            'discipline',
            'niveau',
            'prof',
            'email',
            'jour',
            'debut',
            'fin',
            'note',
            'modalites',
            'modalites1',
            'modalites2',
            'semester',
        ),
    ),
    array(
        'name' => 'dates',
        'fields' => array(    
            'semester',
            'date1',
            'date2',
            'date3',
            'date4',
            'date5',
            'date6',
            'date7',
            'date8',
        ),
    ),
    array(
        'name' => 'documents',
        'fields' => array(
            'realname',
            'name',
            'type',
            'rel',
            'size',
            'type2',
        ),
    ),
    array(
        'name' => 'eval_enabled',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'evaluations',
        'fields' => array(
            'form',
            'response',
            'semester',
        ),
    ),
    array(
        'name' => 'forms',
        'fields' => array(
            'question',
            'name',
            'type',
            'responses',
            'semestre',
        ),
    ),
    array(
        'name' => 'grades',
        'fields' => array(
            'semester',
            'course',
            'note',
            'grade1',
            'grade2',
            'grade',
            'date1',
            'date2',
        ),
    ),
    array(
        'name' => 'housing',
        'fields' => array(
            'semestre',
            'response',
        ),
    ),
    array(
        'name' => 'housing_affect',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'housing_accept',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'housing_closed',
        'fields' => array(
            'semester',
        ),
    ),
    array(
        'name' => 'log',
        'fields' => array(
            'message',
        ),
    ),
    array(
        'name' => 'log_access',
        'fields' => array(
            'login',
            'ip',
        ),
    ),
    array(
        'name' => 'logements',
        'fields' => array(    
            'lastname',
            'firstname',
            'address',
            'zipcode',
            'city',
            'phonenumber',
            'cellphone',
            'email',
            'lastname2',
            'firstname2',
            'cellphone2',
            'email2',
        ),
    ),
    array(
        'name' => 'logements_dispo',
        'fields' => array(    
        ),
    ),
    array(
        'name' => 'migrations',
        'fields' => array(
            'migration',
        ),
    ),
    array(
        'name' => 'responses',
        'fields' => array(
            'responses',
        ),
    ),
    array(
        'name' => 'stage',
        'fields' => array(    
            'semester',
            'stage',
        ),
    ),
    array(
        'name' => 'stages',
        'fields' => array(    
            'semester',
            'stage',
            'lock',
            'notes',
        ),
    ),
    array(
        'name' => 'students',
        'fields' => array(    
            'lastname',
            'firstname',
            'email',
            'token',
            'password',
            'semestre',
            'gender',
            'dob',
            'citizenship1',
            'citizenship2',
            'town',
            'university2',
            'graduation',
            'city',
            'street',
            'zip',
            'state',
            'contactlast',
            'contactfirst',
            'contactphone',
            'contactmobile',
            'contactemail',
            'university',
            'semesters',
            'country',
            'cellphone',
            'home_institution',
            'placeOB',
            'countryOB',
            'frenchNumber',
            'resultatTCF',
            'tin',
        ),
    ),
    array(
        'name' => 'tutorat',
        'fields' => array(
            'semester',
            'tuteur',
            'day',
            'start',
            'end',
        ),
    ),
    array(
        'name' => 'univ_reg',
        'fields' => array( 
            'semestre',
            'response',
        ),
    ),
    array(
        'name' => 'univ_reg2',
        'fields' => array(  
            'semester',
            'response',
        ),
    ),
    array(
        'name' => 'univ_reg3s',
        'fields' => array(  
            'semester',
            'university',
        ),
    ),
    array(
        'name' => 'univ_reg_lock1',
        'fields' => array(  
            'semester',
        ),
    ),
    array(
        'name' => 'univ_reg_show',
        'fields' => array(  
            'semester',
        ),
    ),
    array(
        'name' => 'users',
        'fields' => array(
            'access',
            'email',
            'firstname',
            'language',
            'lastname',
            'login',
            'name',
            'password',
            'remember_token',
            'token',
            'university',
        ),
    ),
);

$new2old = array(
    'á' => 'Ã¡',
    'À' => 'Ã€',
    'ä' => 'Ã¤',
    'Ä' => 'Ã„',
    'ã' => 'Ã£',
    'å' => 'Ã¥',
    'Å' => 'Ã…',
    'æ' => 'Ã¦',
    'Æ' => 'Ã†',
    'ç' => 'Ã§',
    'Ç' => 'Ã‡',
    'é' => 'Ã©',
    'É' => 'Ã‰',
    'è' => 'Ã¨',
    'È' => 'Ãˆ',
    'ê' => 'Ãª',
    'Ê' => 'ÃŠ',
    'ë' => 'Ã«',
    'Ë' => 'Ã‹',
    'í' => 'Ã-­­',
    'ì' => 'Ã¬',
    'Ì' => 'ÃŒ',
    'î' => 'Ã®',
    'Î' => 'ÃŽ',
    'ï' => 'Ã¯',
    'ñ' => 'Ã±',
    'Ñ' => 'Ã‘',
    'ó' => 'Ã³',
    'Ó' => 'Ã“',
    'ò' => 'Ã²',
    'Ò' => 'Ã’',
    'ô' => 'Ã´',
    'Ô' => 'Ã”',
    'ö' => 'Ã¶',
    'Ö' => 'Ã–',
    'õ' => 'Ãµ',
    'Õ' => 'Ã•',
    'ø' => 'Ã¸',
    'Ø' => 'Ã˜',
    'œ' => 'Å“',
    'Œ' => 'Å’',
    'ß' => 'ÃŸ',
    'ú' => 'Ãº',
    'Ú' => 'Ãš',
    'ù' => 'Ã¹',
    'Ù' => 'Ã™',
    'û' => 'Ã»',
    'Û' => 'Ã›',
    'ü' => 'Ã¼',
    'Ü' => 'Ãœ',
    'ÿ' => 'Ã¿',
    '€' => 'â‚¬',
    '’' => 'â€™',
    '‚' => 'â€š',
    'ƒ' => 'Æ’',
    '„' => 'â€ž',
    '…' => 'â€¦',
    '‡' => 'â€¡',
    'ˆ' => 'Ë†',
    '‰' => 'â€°',
    'Š' => 'Å ',
    '‹' => 'â€¹',
    'Ž' => 'Å½',
    '‘' => 'â€˜',
    '“' => 'â€œ',
    '•' => 'â€¢',
    '–' => 'â€“',
    '—' => 'â€”',
    '˜' => 'Ëœ',
    '™' => 'â„¢',
    'š' => 'Å¡',
    '›' => 'â€º',
    'ž' => 'Å¾',
    'Ÿ' => 'Å¸',
    '¡' => 'Â¡',
    '¢' => 'Â¢',
    '£' => 'Â£',
    '¤' => 'Â¤',
    '¥' => 'Â¥',
    '¦' => 'Â¦',
    '§' => 'Â§',
    '¨' => 'Â¨',
    '©' => 'Â©',
    'ª' => 'Âª',
    '«' => 'Â«',
    '¬' => 'Â¬',
    '®' => 'Â®',
    '¯' => 'Â¯',
    '°' => 'Â°',
    '±' => 'Â±',
    '²' => 'Â²',
    '³' => 'Â³',
    '´' => 'Â´',
    'µ' => 'Âµ',
    '¶' => 'Â¶',
    '·' => 'Â·',
    '¸' => 'Â¸',
    '¹' => 'Â¹',
    'º' => 'Âº',
    '»' => 'Â»',
    '¼' => 'Â¼',
    '½' => 'Â½',
    '¾' => 'Â¾',
    '¿' => 'Â¿',
    'à' => 'Ã ',
    '†' => 'â€',
    '”' => 'â€',
    'â' => 'Ã¢',
    'Â' => 'Ã‚',
    'Ã' => 'Ãƒ',
);

$old_characters = array();
$new_characters = array();

foreach ($new2old as $k => $v) {
    $old_characters[] = $v;
    $new_characters[] = $k;
}

foreach ($tables as $table) {

    $name = $table['name'];
    $fields = $table['fields'];

    $sql[] = "ALTER TABLE `{$dbprefix}{$name}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

    if (empty($fields)) {
        continue;
    }

    $fields_query = '`id`, `' . join('`, `', $table['fields']) . '`';

    $req = "SELECT $fields_query FROM `{$dbprefix}{$name}`;";

    $db = new db();
    $db->query($req);

    if ($db->result) {
        foreach ($db->result as $elem) {

            foreach ($fields as $field) {

                $value = $elem[$field];
                $origin = $value;

                $value = str_replace($old_characters, $new_characters, $value);

                $test = mb_detect_encoding($value, 'UTF-8', true);

                if ($test === false) {
                    $value = utf8_encode($value);
                }

                if ($origin != $value) {
                    $sql[] = "UPDATE `{$dbprefix}{$name}` SET `$field` = '$value' WHERE `id`='{$elem['id']}';";
                }
            }
        }
    }
}

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
