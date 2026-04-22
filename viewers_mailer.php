#!/usr/local/bin/php
<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "executor");
	define("DB_PASS", "S7dHnAP73Z3sZLCL");
	define("DB_NAME", "exof");

	$db = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	mysql_select_db(DB_NAME);
	mysql_query("set names utf8;");

	define("TBL_VIEWER", "viewer");
	define("TBL_VIEWERSUIT", "viewersuit");
	define("TBL_SUIT", "suit");
	define("TBL_FINANCE", "finance");
	define("TBL_CLAIMER", "claimer");

	define("SENDER", "vir_georgiev@abv.bg");
	define("TEAM", "Шукри Дервиш");

	date_default_timezone_set("Europe/Sofia");
	$start_date = date("Y-m-d 00:00:00", strtotime("NOW -1 day"));
	$end_date = date("Y-m-d 00:00:01");

	$mail_headers = "From: ".SENDER."\n".
			"X-Mailer: PHP/" . phpversion()."\n".
			"Content-type: text/html; charset=UTF-8\n";

	$viewers_q = sprintf("select id,name,email from %s where inactive = 0 and email IS NOT NULL and expiration > NOW() AND isfina = 1;", TBL_VIEWER);
	$viewers_res = mysql_query($viewers_q, $db);

	while($viewer_row = mysql_fetch_row($viewers_res)) {
		$viewer_id = $viewer_row[0];
		$viewer_name = stripslashes($viewer_row[1]);
		$viewer_email = $viewer_row[2];
		printf("Creating message for viewer %s...", $viewer_name);

		$msg = sprintf("Здравейте, \n<br /> С този e-mail Ви изпращаме справка за наблюдател <b>%s</b>, с която Ви информираме за новите постъпления <br /><br />\n", $viewer_name);

		$suits_q = sprintf("
			SELECT
				CONCAT(s.serial,'/',s.year) as income_suit,
				COUNT(f.id) as income_count, 
				SUM(f.inco) as income_sum,
				claimer.name as claimer_name
			FROM 
				%s f, 
				%s vs, 
				%s s,
				%s claimer
			WHERE 
				vs.idcase = s.id AND 
				claimer.idcase = s.id AND
				vs.idcase = f.idcase AND 
				vs.idviewer = %d AND 
				(f.idtype = 1 OR f.idtype = 2) AND 
				f.marked = 0
			GROUP BY 
				f.idcase;
		",
			TBL_FINANCE,
			TBL_VIEWERSUIT,
			TBL_SUIT,
			TBL_CLAIMER,
			$viewer_id
		);

		$total_incomes = 0;
		$total_sum = 0;

		$suits_res = mysql_query($suits_q, $db);
print mysql_error($db);
		while($suit = mysql_fetch_array($suits_res, MYSQL_ASSOC)) {
			$msg.= sprintf("По дело на <b>%s</b> с No. <b>%s</b>: Постъпила сума = <b>%s</b>, Брой постъпления = <b>%d</b><br />\n", $suit['claimer_name'], $suit['income_suit'], number_format($suit['income_sum'], 2, '.', ' '), $suit['income_count']);

			$total_incomes += $suit['income_count'];
			$total_sum += $suit['income_sum'];
		}

		$msg.= sprintf("<br />\n---------------<br />\nОбщо постъпила сума = <b>%s</b><br />\nОбщ брой постъпления = <b>%d</b><br /><br />С Уважение, <br>\n ЧСИ %s \n\n", number_format($total_sum, 2, '.', ' '), $total_incomes, TEAM);

		$mail_subject = sprintf("Нови постъпления");

		if ($total_incomes != 0) {
			mail($viewer_email, $mail_subject, $msg, $mail_headers)?printf("Done\n"):printf("Error\n");
		} else {
			printf("Skip\n");
		}
	}

	$q = sprintf("UPDATE %s SET marked=1;", TBL_FINANCE);
	mysql_query($q, $db);
?>

