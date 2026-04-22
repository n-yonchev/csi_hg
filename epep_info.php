<?php

include "common.php";

$case_serial = 297;
$case_year = 2025;

$case = $DB->select("SELECT * FROM suit WHERE serial = ?d AND year = ?d", $case_serial, $case_year);
$case = $case[0];

echo "<br><div>EPEP Queue</div>";
$data = $DB->select("SELECT * FROM epep_payments_queue");
echo renderTable($data);

echo "<br><div>EPEP Distribution</div>";
$data = $DB->select("SELECT * FROM epep_debt_distribution WHERE case_id = ?d", $case['id']);
echo renderTable($data);

echo "<br><div>EPEP Obligations</div>";
$data = $DB->select("SELECT * FROM epep_obligations WHERE case_id = ?d", $case['id']);
echo renderTable($data);

echo "<br><div>EPEP Payments</div>";
$data = $DB->select(
    "SELECT p.* FROM epep_payments p
    INNER JOIN finance f ON f.id = p.finance_id
    WHERE f.idcase = ?d", $case['id']);
echo renderTable($data);


function renderTable(array $data) {

    // Вземаме ключовете от първия елемент (имената на колоните)
    $headers = array_keys($data[0]);

    // Започваме таблицата
    $html = "<table border='1' cellpadding='5' cellspacing='0'>";

    // Заглавия
    $html .= "<tr>";
    foreach ($headers as $header) {
        $html .= "<th>" . htmlspecialchars($header) . "</th>";
    }
    $html .= "</tr>";

    // Проверяваме дали има редове
    $hasRows = false;

    // Редове
    foreach ($data as $row) {
        $hasRows = true;
        $html .= "<tr>";
        foreach ($headers as $header) {
            $html .= "<td>" . htmlspecialchars($row[$header]) . "</td>";
        }
        $html .= "</tr>";
    }

    // Ако няма редове (например празни масиви)
    if (!$hasRows) {
        $html .= "<tr><td colspan='" . count($headers) . "'>No Rows!</td></tr>";
    }

    $html .= "</table>";

    return $html;
}

