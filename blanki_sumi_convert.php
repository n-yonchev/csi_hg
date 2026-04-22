<?php
include "common.php";

$GLOBALS['BGN_TO_EUR_RATE'] = 1.95583;
$GLOBALS['CONVERSION_LOG'] = array();

function parseBgNumberToFloat($s) {
    $s = str_replace("\xC2\xA0", "", $s);
    $s = str_replace(" ", "", $s);
    $s = str_replace(",", ".", $s);
    return (float)$s;
}

function formatEuro($eur) {
    return number_format($eur, 2, ",", " ");
}

function log_conversion($type, $old, $new) {
    $GLOBALS['CONVERSION_LOG'][] = array(
        'type' => $type,
        'old'  => $old,
        'new'  => $new
    );
}

function cb_convert_range($m) {
    $rate = $GLOBALS['BGN_TO_EUR_RATE'];

    $a = parseBgNumberToFloat($m[1]);
    $b = parseBgNumberToFloat($m[2]);

    $new = formatEuro($a / $rate) . " до " . formatEuro($b / $rate) . " €";

    log_conversion("диапазон", $m[0], $new);

    return $new;
}

function cb_convert_single($m) {
    $rate = $GLOBALS['BGN_TO_EUR_RATE'];

    $a = parseBgNumberToFloat($m[1]);
    $new = formatEuro($a / $rate) . " €";

    log_conversion("сума", $m[0], $new);

    return $new;
}

function convertBgnAmountsMarkedAsEuro($text) {
    $num = '(?:\d{1,3}(?:[ \x{00A0}]\d{3})*|\d+)(?:,\d{1,2})?';

    $patternRange  = '/(?<!\w)(' . $num . ')\s*до\s*(' . $num . ')\s*€/u';
    $text = preg_replace_callback($patternRange, 'cb_convert_range', $text);

    $patternSingle = '/(?<!\w)(?:' . $num . ')\s*до\s*(?:' . $num . ')\s*€(*SKIP)(*F)|(?<!\w)(' . $num . ')\s*€/u';

    $text = preg_replace_callback($patternSingle, 'cb_convert_single', $text);

    return $text;
}


// ------------------ ОБХОЖДАНЕ НА ФАЙЛОВЕТЕ ------------------

$blanks = $DB->select("SELECT filename FROM docutype WHERE ishidden = 0");

foreach ($blanks as $row) {

    $file = "./outgoing/" . $row['filename'];
    $content = file_get_contents($file);

    if ($content === false) {
        echo "Грешка при четене на $file" . "<br>";
        continue;
    }

    $GLOBALS['CONVERSION_LOG'] = array(); // reset log

    $newContent = convertBgnAmountsMarkedAsEuro($content);

    echo "<b>====== $file ======</b><br>";

    if ($newContent !== $content) {
        file_put_contents($file, $newContent);

        foreach ($GLOBALS['CONVERSION_LOG'] as $entry) {
            echo 
                "[{$entry['type']}] "
                . "'{$entry['old']}' ? "
                . "'{$entry['new']}'<br>";
        }
    } else {
        echo "Няма намерени суми за превалутиране<br>";
    }

    echo "<br>";
}
