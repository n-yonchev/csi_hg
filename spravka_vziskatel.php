<?php

include "common.php";

$claimer_bulstat = "103002253";
// $claimer_name_utf8 = toutf8($claimer_name);

$dates = [
    // ['2023-03-01', '2023-07-31'],
    // ['2023-08-01', '2023-12-31'],
    ['2024-01-01', '2024-11-01'],
//     ['2024-11-01', '2025-03-31'],
];
$first_date = $dates[0][0];
$last_date = end($dates)[1];

echo "Да имаше грешка ето ги по еик<br><br>";
echo "Справка разпределени суми към ВиК-Варна(ЕИК: " . $claimer_bulstat . ")<br>";

$claimers = $DB->select("SELECT id, idcase FROM claimer WHERE bulstat = '{$claimer_bulstat}'");
$claimers = dbconv($claimers);

$sums = [];
foreach($dates as $key => $date) {
    $sums[$key] = 0;
}

foreach($claimers as $claimer) {
    $finances = $DB->select(
        "SELECT finance.*, CONCAT(suit.serial, '/', suit.year) as 'suit_serial' FROM finance 
        LEFT JOIN suit ON suit.id = finance.idcase
        WHERE idcase = {$claimer['idcase']}
            AND isclosed = 1
            AND STR_TO_DATE(timeclosed, '%Y-%m-%d') BETWEEN '{$first_date}' AND '{$last_date}'
        ORDER BY suit.year, suit.serial");
    
    foreach($finances as $finance) {
        $distribution = unserialize($finance['toclai']);
        foreach($dates as $key => $date) {
            if($finance['timeclosed'] >= $date[0] && $finance['timeclosed'] <= $date[1]) {
                $sums[$key] += $distribution[$claimer['id']];
                if($distribution[$claimer['id']]) {
                    echo "{$finance['suit_serial']} - {$distribution[$claimer['id']]}<br>";
                }
            }
        }
    }
}

foreach($dates as $key => $value) {
    $date_from = new DateTime($value[0]);
    $date_to = new DateTime($value[1]);
    echo "от " . $date_from->format("d.m.Y") . " до " . $date_to->format("d.m.Y") . " - " . $sums[$key] . " лв <br>";
}

$sum_all = 0;
foreach($sums as $sum) {
    $sum_all += $sum;
}

$date_to_first = new DateTime($first_date);
$date_to_last = new DateTime($last_date);
echo "Общо от " . $date_to_first->format("d.m.Y") . " до " . $date_to_last->format("d.m.Y") . " - " . $sum_all . " лв <br>";
