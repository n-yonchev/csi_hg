<?php
# 15.05.2010 - консолидация на агентите (адвокатите) 
# ВНИМАНИЕ. 
#    Създава се нова таблица - agent 
#    Извън този скрипт има средство за промени в тази таблица 
#    - корекция на имена, приравняване на агенти 
# Поради което : 
#    Скрипта да се изпълни еднократно. 
# Възможни са следващи изпълнения, но 
#    Всяко следващо изпълнение ще унищожи евентуалните промени в таблицата 

									include "common.php";

# новата таблица - уникалните агенти от взискателите 
$DB->query("truncate table agent");
$DB->query("insert into agent (name)
	select trim(agent) from claimer 
	where agent<>''
	group by agent
	");

# временна таблица - дело-агент 
$DB->query("create temporary table t2
	select claimer.idcase, agent.id as idagent 
	from claimer 
	left join agent on claimer.agent=agent.name
	where claimer.agent<>''
	");

# указателите към агент за всяко дело 
$DB->query("update suit set idagent=0");
$DB->query("update suit
	left join t2 on suit.id=t2.idcase
	set suit.idagent= t2.idagent
	");

print "OK";

?>
