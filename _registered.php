<?php
# 23.02.2010 
# синхронизация на времето на извеждане за старите изх.документи 
# причина : 
#    имаше само старото поле created 
#    сега вече има доп.поле registered 

						include_once "common.php";

$DB->query("update docuout set registered=created where registered='' and serial<>0 and year<>0");

print "OK";

?>
