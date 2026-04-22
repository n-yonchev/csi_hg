<style>
.link2 {ldelim}font:bold 12pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.aler {ldelim}font:normal 10pt verdana; border: 1px solid black; padding:20px;color:black;{rdelim}
</style>

<br>
						<table align=center>
						<tr>
						<td class="aler">
{*
				{if $ALERMODE==1}
ВНИМАНИЕ.
<br>
<br>
В момента <b>{$CASEDATA.lockname}</b> работи с постъпленията по дело <b>{$CASEDATA.caseseri}/{$CASEDATA.caseyear}</b>
<br>
Съвместната ви работа може да причини проблеми.
<br>
<br>
Само в случай, че <b>{$CASEDATA.lockname} СЪС СИГУРНОСТ НЕ РАБОТИ</b> по това дело,
<br>
<a class="link2" {include file="_href.tpl" LINK=$CASEDATA.linkforc}>
отвори </a>
постъпленията по него
<br>
<br>
				{elseif $ALERMODE==2}
*}
ВНИМАНИЕ.
<br>
<br>
В момента <b>{$CASEDATA.lockname}</b> работи с общия списък с преводите.
<br>
Съвместната ви работа може да причини проблеми.
<br>
<br>
Само в случай, че <b>{$CASEDATA.lockname} СЪС СИГУРНОСТ НЕ РАБОТИ</b> с преводите,
<br>
<a class="link2" {include file="_href.tpl" LINK=$CASEDATA.linkforc}>
премини </a>
към общия списък с преводите.
<br>
<br>
{*
				{else}
ПРЕДУПРЕЖДЕНИЕ-ГРЕШКА
				{/if}
*}
						</table>
