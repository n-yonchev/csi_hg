<?php

include_once "common.php";

$allCats = array_merge(range(1, 41), range(109, 118), range(127, 150));

$outTypes = $DB->select("SELECT * FROM docutype WHERE ishidden = 0 ORDER BY idsort");

foreach($outTypes as $type) {
    $isAssigned = empty($DB->select("SELECT * FROM issi_docu_outgoing WHERE id_docutype = {$type['id']}"))? false : true;

    if(!$isAssigned) {

        $randomCat = array_rand($allCats);
        $DB->query("INSERT INTO issi_docu_outgoing(id_doc_sub_category, id_docutype) VALUES ({$allCats[$randomCat]},{$type['id']})");
    }
}

$inTypes = $DB->select("SELECT * FROM aadocutype ORDER BY name");

$allCats = array_merge(range(42, 108), range(119, 126), range(177, 195));

foreach($inTypes as $type) {
    $isAssigned = empty($DB->select("SELECT * FROM issi_docu_outgoing WHERE id_docutype = {$type['id']}"))? false : true;

    if(!$isAssigned) {

        $randomCat = array_rand($allCats);
        $DB->query("INSERT INTO issi_docu_incoming(id_doc_sub_category, id_docutype) VALUES ({$allCats[$randomCat]},{$type['id']})");
    }
}