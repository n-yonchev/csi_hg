<?php

							# копирай от извлечението на ОББ 
							$copyfrom= $GETPARAM["copyfrom"];
							if (isset($copyfrom)){
								include_once "finacopy.ajax.php";
								exit;
							}else{
							}

									# корекция на избран запис 
									# влиза и изтриването на записа 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "finaedit.ajax.php";
										exit;
									}else{
									}

							# разглеждане на избран запис - приключено постъпление 
							$info= $GETPARAM["info"];
							if (isset($info)){
								include_once "finainfo.ajax.php";
								exit;
							}else{
							}

									# приключване на избран запис 
									$clos= $GETPARAM["clos"];
									if (isset($clos)){
										include_once "finaclos.ajax.php";
										exit;
									}else{
									}

							# корекция само на датата за погасяване 
							$date= $GETPARAM["date"];
							if (isset($date)){
//			# специален флаг 
//			$CALLFROMCASE= true;
		include_once "finadate.ajax.php";
		exit;
							}else{
							}
									
									# историята на избран запис 
									$hist= $GETPARAM["hist"];
									if (isset($hist)){
										include_once "finahist.ajax.php";
										exit;
									}else{
									}

							# 05.05.2010 
							# игнориране на избран запис 
							$igno= $GETPARAM["igno"];
							if (isset($igno)){
								include_once "finaigno.ajax.php";
								exit;
							}else{
							}

?>
