<?php
# източник : И.Борисова 
# цел : Шукри Дервиш 
# прехвърляне на изх.шаблони от М.Бъзински 
# изпълнява се на сървъра на Дервиш 

							include_once "common.php";
$dire= "outgoing/";

$ar2cont= file_get_contents($dire."data.ser");
$ar2= unserialize($ar2cont);
foreach($ar2 as $elem){
	$DB->query("insert into docutype set ?a"  ,$elem);
}

print "OK";

?>