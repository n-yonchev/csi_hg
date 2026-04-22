<?php

$file = $DB->select(
    "SELECT 
        *
    FROM epep_files
    WHERE id = ?d"
, $epep_process);
$file = $file[0];
$file = dbconv($file);

$smarty->assign("DOCU", $file);

$case_number = $DB->select("SELECT CONCAT(serial, '/', year) as case_number FROM suit WHERE id = ?d", $file['suit_id']);
$case_number = $case_number[0]['case_number'];
$smarty->assign("CASE_NUMBER", $case_number);

print smdisp("epep_proccess_file.tpl","iconv");