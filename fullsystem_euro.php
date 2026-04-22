<?php

include_once "common.php";
include_once "commspec.php";

$multiplier = 0.511292;
$test_id = 15048;

$sql = array(
    "UPDATE docutype 
    SET regitax = round(regitax * {$multiplier}, 2),
        regitax_1 = round(regitax * {$multiplier}, 2),
        regitax_2 = round(regitax * {$multiplier}, 2),
        regitax_3 = round(regitax * {$multiplier}, 2),
        regitax_4 = round(regitax * {$multiplier}, 2)",

    "UPDATE finatranrefe fs
    SET fs.suma = round(fs.suma * {$multiplier}, 2)",

    "UPDATE claimadva ca
    SET ca.amount = round(ca.amount * {$multiplier}, 2)",

    "UPDATE finance 
    SET inco = round(inco * {$multiplier}, 2),
        separa = round(separa * {$multiplier}, 2),
        separa2 = round(separa2 * {$multiplier}, 2),
        rest = round(rest * {$multiplier}, 2),
        back = round(back * {$multiplier}, 2),
        backtax = round(backtax * {$multiplier}, 2)",

    "UPDATE finasource fs
    SET fs.amount = round(fs.amount * {$multiplier}, 2)",

    "UPDATE finatran ft 
    SET ft.amount = round(ft.amount * {$multiplier}, 2)",

    "UPDATE subject 
    SET amount = round(amount * {$multiplier}, 2)",

    "UPDATE suit 
    SET actual_debt = round(actual_debt * {$multiplier}, 2),
        t26 = round(t26 * {$multiplier}, 2)",
);

foreach($sql as $query) {
    $DB->query($query);
}

$others = array(
    "finance" => array("toclai", "toclaitax"),
);

$other_data = [];

foreach($others as $table => $cols) {
    $select_cols = implode(", ", $cols);
    $other_data[$table] = $DB->select("SELECT id, " . $select_cols . " FROM " . $table);
}

foreach($other_data["finance"] as $data) {
    $de_array_tocl = unserialize($data["toclai"]);
    foreach($de_array_tocl as $key => $item) {
        $de_array_tocl[$key] = round($item * $multiplier, 2);
    }
    $se_array_tocl = serialize($de_array_tocl);

    $de_array_tax = unserialize($data["toclaitax"]);
    foreach($de_array_tax as $key => $item) {
        $de_array_tax[$key] = round($item * $multiplier, 2);
    }
    $se_array_tax = serialize($de_array_tax);

    $DB->query("UPDATE finance SET toclai = '{$se_array_tocl}', toclaitax = '{$se_array_tax}' WHERE id = {$data['id']}");
}