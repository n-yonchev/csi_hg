<?php

define("DB_HOST", "localhost");
define("DB_USER", "softhouse");
define("DB_PASS", "MFPY6t4B5vDm3GYj");
define("DB_NAME", "exof");

$db = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME);

mysql_query("SET NAMES 'utf8'");
mysql_query("SET SESSION collation_connection = `utf8_unicode_ci` ");

switch ($_GET['cmd']) {
    case "show_tables":
        $res = mysql_query("SHOW TABLES");
        while ($row = mysql_fetch_array($res, MYSQL_NUM)) {
            $return[] = $row[0];
        }
        break;
    case "show_columns":
        $tbl = mysql_real_escape_string($_GET['tbl']);
        $q = sprintf("SHOW COLUMNS FROM `%s`", $tbl);
        $res = mysql_query($q);
        while ($row = mysql_fetch_assoc($res)) {
            $return[$row['Field']] = $row;
        }
        break;

    case "get_rows":
        $tbl = mysql_real_escape_string($_GET['tbl']);
        $q = sprintf("SELECT * FROM `%s`", $tbl);
        $res = mysql_query($q);
        while ($row = mysql_fetch_assoc($res)) {
            $return[] = $row;
        }
        break;
}

if ($return) {
    $return = serialize($return);
    $return = base64_encode($return);
    if (isset($_GET['gz'])) {
        $return = gzcompress($return);
    }
    echo $return;
}
