<?php

chdir(dirname(__FILE__) . "/../../");

include_once(dirname(__FILE__) . "/common.php");

ob_start();
$url = "http://softhouse.bg/tools/rates.xml";
date_default_timezone_set("Europe/Sofia");

$xml_data = file_get_contents($url);
$arr = xml2assoc($xml_data);
$_arr = normal_array($arr[0]['value']);

echo "BNB ARRAY:\n";
foreach ($_arr['rate'] as $k=>$v) {
	$exp = explode(".", $v['begin']);
	$from = mktime(0,0,0,$exp[1], $exp[0], $exp[2]);
	$rate = $v['bnb'];
	echo $v['begin'] . ": " . $rate . "\n";

	$q = "SELECT * FROM percent WHERE begin='{$v['begin']}'";
	$r = $DB->select($q);

	if (empty($r)) {
		$row = $DB->query("SELECT * FROM percent ORDER BY id DESC LIMIT 1");
		$row = $row[0];

		$last_id = $row['id'];
		$yesterday = strtotime("-1 days", $from);
		$upd_prev = sprintf("UPDATE percent SET `end`='%s', endstamp='%s' WHERE id='%d'", date("d.m.Y", $yesterday), $yesterday, $last_id);
		$DB->query($upd_prev);
		
		$ins = sprintf("INSERT INTO percent (`begin`, `end`, `bnb`, `begstamp`, `endstamp`, `_daily`) VALUES ('%s', '', '%.2f', '%d', '', '')",
			$v['begin'],
			$rate,
			$from
		);
		$DB->query($ins);
	}
}

function normal_array($arr) {
	$narr = array();
	foreach ($arr as $k=>$v) {
		if (is_array($v['value'])) {
			$narr[$v['name']][] = normal_array($v['value']);
		}else {
			$narr[$v['name']] = $v['value'];
		}
	}
	return $narr;
}
function xml2assoc($data) {
	$g_ret = array();
	$matched = preg_match_all('/<(\w+)\s*(.*?)>(.*?)<\/\1>/is' ,$data, $m);
	if ($matched) {
		for($i = 0; $i < $matched; $i++) {
			$ret = array();
			$ret['name'] = $m[1][$i];
			$ret['attributes'] = $m[2][$i];
			$ret['value'] = xml2assoc($m[3][$i]);
			$g_ret[] = $ret;
		}
		return $g_ret;
	}
	return $data;
}

$output = ob_get_clean();
$time = new DateTime();
$time = $time->format('d_m_Y');
$log_name = '/logs/log_' . $time . '.txt';
file_put_contents(__DIR__ . $log_name, $output);

?>