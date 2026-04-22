<style>
.link2 {ldelim}font:bold 12pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.aler {ldelim}font:normal 10pt verdana; border: 1px solid black; padding:20px;color:black; background-color:#dddddd;{rdelim}
</style>

<br>
						<table align=center>
						<tr>
						<td class="aler">
ВНИМАНИЕ.
<br>
<br>
В момента <b>{$CASEDATA.lockname}</b> работи с постъпленията по дело <b>{$ROCASE.serial}/{$ROCASE.year}</b>
<br>
Съвместната ви работа може да причини проблеми.
<br>
<br>
Само в случай, че <b>{$CASEDATA.lockname} СЪС СИГУРНОСТ НЕ РАБОТИ</b> с делото,
<br>
<a class="link2" {include file="_href.tpl" LINK=$CASEDATA.linkforc}>
премини </a>
към дело  <b>{$ROCASE.serial}/{$ROCASE.year}</b>
<br>
<br>
						</table>
