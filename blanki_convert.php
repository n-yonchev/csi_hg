<?php

include "common.php";

$blanks = $DB->select("SELECT filename FROM docutype WHERE ishidden = 0");
$blanks[] = "billprin.tpl";
$blanks[] = "BILL.html";

$replaceMap = [
    toutf8("лв.") => toutf8("€"),
    toutf8("лв,") => toutf8("€,"),
    toutf8("лв ") => toutf8("€ "),
    toutf8("лв<") => toutf8("€<"),
    toutf8("лева") => toutf8("евро"),
];

foreach ($blanks as $filename) {

    $file = "./outgoing/" . $filename['filename'];

    $content = file_get_contents($file);
    if ($content === false) {
        echo toutf8("Грешка при четене на $file") . "<br>";
        continue;
    }

    echo toutf8("====== $file ======<br>");

    foreach ($replaceMap as $search => $replace) {

        $count = 0;
        $content = str_replace($search, $replace, $content, $count);

        if ($count > 0) {
            echo toutf8("Замених '$search' с '$replace' — срещания: $count<br>");
        }
    }

    // запиши файла обратно
    file_put_contents($file, $content);

    echo "<br>";
}


