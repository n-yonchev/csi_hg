<?php
# 21.10.2010 - ново поле за постъпление : inco - дата на постъпление 
# ще може да се корегира и ръчно 

									include "common.php";
									
$DB->query("update finance set dateinco=date(time)");

print "OK";

?>