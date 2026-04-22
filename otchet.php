<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'jzSHxGa912bna4HSAV';
	$dbname = 'exof';

	$db = mysql_connect($dhost, $dbuser, $dbpass);
				if (!$db)
					{
						die('Грешка: В момента базата данни се подновява.');
					}
	mysql_select_db($dbname);
	mysql_query("SET NAMES 'utf8'");
	/*
		mysql_query("SET SESSION character_set_results = 'UTF8'");
		mysql_query("SET SESSION character_set_client = 'UTF8'");
		mysql_query("SET SESSION character_set_connection = 'UTF8'");
	*/
	$qr = "SELECT f.time, f.inco, f.idcase, f.toclai, f.isclosed, 
	f.back, f.separa2, f.separa, s.idrepo, s.serial, s.year
	FROM finance f
	LEFT JOIN suit s ON s.id=f.idcase
	WHERE 
	f.time>='2010-01-01 00:00:00' AND 
	f.time<='2010-12-31 23:59:59' AND
	f.isclosed='1'";
	$res = mysql_query($qr);
	$num = mysql_num_rows($res);
	echo $num;
	echo "<table style='width: 1000px;' border='1'>";
	echo "<tr>";
		echo "<td>DELO</td>";
		echo "<td>VREME</td>";
		echo "<td>SUM</td>";
		echo "<td>VURNATA</td>";
		echo "<td>CSI NEOLIH</td>";
		echo "<td>t.26</td>";
		echo "<td>RAZPREDELENA</td>";
		echo "<td>SUMA PO DELOTO</td>";
	echo "</tr>";
	while($row =  mysql_fetch_array($res)) {
		
		//$arr[$row['idcase']] = array();
		
		foreach(unserialize($row['toclai']) as $kp => $vp) {
			$arr[$row['idcase']]['vzis'] = $arr[$row['idcase']]['vzis']+$vp;
		}

		if($row['separa2']>0) {
			$arr[$row['idcase']]['t26'] = $arr[$row['idcase']]['t26']+$row['separa2'];
		}

		if($row['separa']>0) {
			$arr[$row['idcase']]['neolih'] = $arr[$row['idcase']]['neolih']+$row['separa'];
		}
		echo "<tr>";
			echo "<td>".$row['serial']."/".$row['year']."</td>";
			echo "<td>".$row['time']."</td>";
			echo "<td>".$row['inco']."</td>";
			echo "<td>".$row['back']."</td>";
			echo "<td>".$row['separa']."</td>";
			echo "<td>".$row['separa2']."</td>";

			if(count($sumi_delo[$row['idcase']])==0) {
				
				$idrepo[$row['idcase']] = $row['idrepo'];

				//$sumi_delo[$row['idcase']] = array();
				$qrp = "SELECT 
				SUM(IF(idtype=1, amount, 0)) as glavnica,
				SUM(IF(idsubtype=4, amount, 0)) as izplist,
				SUM(IF(idsubtype=8, amount, 0)) as avansovi,
				SUM(IF(idsubtype=12, amount, 0)) as subsidirani,
				SUM(IF(idsubtype=16, amount, 0)) as dopulnitelni,
				SUM(IF(idsubtype=18, amount, 0)) as poudost,
				SUM(IF(idsubtype=20, amount, 0)) as prieti
				FROM subject 
				WHERE idcase='".$row['idcase']."'";
				$predmet = mysql_fetch_array(mysql_query($qrp));
				echo "<td>";
					echo "<pre>";
						$sumi_delo[$row['idcase']]['izplist'] = $predmet['izplist']+$predmet['glavnica'];
						$sumi_delo[$row['idcase']]['avansovi'] = $predmet['avansovi'];
						$sumi_delo[$row['idcase']]['subsidirani'] = $predmet['subsidirani'];
						$sumi_delo[$row['idcase']]['dopulnitelni'] = $predmet['dopulnitelni'];
						$sumi_delo[$row['idcase']]['poudost'] = $predmet['poudost'];
						$sumi_delo[$row['idcase']]['prieti'] = $predmet['prieti'];
						$all_avan = $predmet['avansovi']+$all_avan;
					echo "</pre>";
				echo "</td>";
			}
		echo "</tr>";
	}
	echo "</table>";
echo $all_avan;

//echo count($sumi_delo);



foreach($arr as $k => $v) {

	$sumata_e = $v['vzis'];

	$toadd[$idrepo[$k]]['taksi'] = $toadd[$idrepo[$k]]['taksi']+$v['t26']+$v['neolih'];
	
	if($sumata_e>$sumi_delo[$k]['avansovi']) {
		$toadd[$idrepo[$k]]['taksi'] = $toadd[$idrepo[$k]]['taksi']+$sumi_delo[$k]['avansovi'];
		$sumata_e = $sumata_e-$sumi_delo[$k]['avansovi'];
	} else {
		$toadd[$idrepo[$k]]['taksi'] = $toadd[$idrepo[$k]]['taksi']+$sumata_e;
		$sumata_e = $sumata_e-$sumi_delo[$k]['avansovi'];
	}
	
	if($sumata_e>0) {
		if($sumata_e>$sumi_delo[$k]['dopulnitelni']) {
			$toadd[$idrepo[$k]]['dop'] = $toadd[$idrepo[$k]]['dop']+$sumi_delo[$k]['dopulnitelni'];
			$sumata_e = $sumata_e-$sumi_delo[$k]['dopulnitelni'];
		} else {
			$toadd[$idrepo[$k]]['dop'] = $toadd[$idrepo[$k]]['dop']+$sumi_delo[$k]['dopulnitelni'];
			$sumata_e = $sumata_e-$sumi_delo[$k]['dopulnitelni'];
		}
	}

	if($sumata_e>0) {
		if($sumata_e>$sumi_delo[$k]['prieti']) {
			$toadd[$idrepo[$k]]['prieti'] = $toadd[$idrepo[$k]]['prieti']+$sumi_delo[$k]['prieti'];
			$sumata_e = $sumata_e-$sumi_delo[$k]['prieti'];
		} else {
			$toadd[$idrepo[$k]]['prieti'] = $toadd[$idrepo[$k]]['prieti']+$sumi_delo[$k]['prieti'];
			$sumata_e = $sumata_e-$sumi_delo[$k]['prieti'];
		}
	}

	if($sumata_e>0) {
		$percent = (rand(5,25)/100);
		$am_lihvi = ($sumata_e*$percent);
		$toadd[$idrepo[$k]]['lihvi'] = $toadd[$idrepo[$k]]['lihvi']+$am_lihvi;
		$sumata_e = $sumata_e-$am_lihvi;
	}

	if($sumata_e>0) {
		$toadd[$idrepo[$k]]['izplist'] = $toadd[$idrepo[$k]]['izplist']+$sumata_e;
	}
}
echo "<pre>";
	print_r($toadd);
echo "</pre>";

?>