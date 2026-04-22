{*
	източник : napcase.tpl 
*}
<style>
.h2 {ldelim}font: normal 8pt verdana; background-color:wheat;{rdelim}
.r1 {ldelim}font: normal 8pt verdana;{rdelim}
.r10 {ldelim}font: normal 10pt verdana;{rdelim}
.r2 {ldelim}font: normal 8pt verdana; border-bottom:1px solid black;{rdelim}
.r3 {ldelim}font: normal 8pt verdana;background-color:red;color:white;padding:1px 4px;{rdelim}
.r4 {ldelim}font: normal 8pt verdana;background-color:khaki;padding:1px 4px;{rdelim}
.st2 {ldelim}background-color:orange;cursor:help;{rdelim}
.st3 {ldelim}background-color:olive;cursor:help;{rdelim}
</style>
										<table align=center>
										<tr>
<td class="r1" colspan=3>
дело <b>{$DATACASE.serial}/{$DATACASE.year}</b> деловодител <b>{$DATACASE.username}</b>
{*---- ЦРД-2014 -----------------*}
&nbsp;&nbsp;
{include file='reg4case.tpl' EDIT=$IDCASE}
										<tr>
										<td valign=top>
						<table align=center>
						<tr>
<td class="h2" colspan=9 align=center> основни данни по делото
			<tr>
<td class="r1"> образувано на
<td class="r2"> {$DATACASE.created|date_format:"%d.%m.%Y"}
			<tr>
<td class="r1"> описание
<td class="r2"> {$DATACASE.text}
			<tr>
<td class="r1"> идва от
<td class="r2"> {$ARFROM[$DATACASE.idcofrom]}
	{if empty($DATACASE.cogrou)}
	{else}
/ състав {$DATACASE.cogrou}
	{/if}
			<tr>
<td class="r1"> изп.титул
<td class="r2"> {$ARTITU[$DATACASE.idtitu]}
						{if $DATACASE.idtitu==1}
от {$DATACASE.dateexec}
						{else}
						{/if}
			<tr>
<td class="r1"> вид номер/год
<td class="r2"> {$ARSORT[$DATACASE.idsort]} {$DATACASE.conome}/{$DATACASE.coyear}
			<tr>
<td class="r1"> текущ статус
<td class="r2"> {$ARSTAT[$DATACASE.idstat]}
{*
			<tr>
<td class="r1"> вземане произход
<td class="r2"> {$DATACASE.origtext}
*}
			<tr>
<td class="r1"> тип вземане
<td class="r2"> {$AR4TYPENAME[$DATACASE.idtypereg4]}
			<tr>
<td class="r1"> вид вземане
<td class="r2"> {$AR4VARINAME[$DATACASE.idvarireg4]}
			<tr>
<td class="r1"> произход вземане
<td class="r2"> {$AR4ORIGNAME[$DATACASE.idorigreg4]}
						</table>
										<td width=14> &nbsp;
										<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=9 align=center> взискатели по делото
{**}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$CLAICREA}" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
{**}
						<tr>
<td class="h2"> статус
<td class="h2"> тип
<td class="h2"> подтип
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
{foreach from=$CLAILIST item=elem}
						<tr>
{*
						{if $elem.etcode==1}
<td class="r4"> стар ЕТ
						{elseif $elem.etcode==2}
<td class="r3"> нов ЕТ
						{else}
<td class="r2"> &nbsp;
						{/if}
*}
					{if $elem.isform}
<td class="r2 r4"> бивш ЕТ
					{else}
<td class="r2"> &nbsp;
					{/if}
<td class="r2"> {$elem.type}&nbsp;
<td class="r2"> {$elem.subt}&nbsp;
				{if $elem.idtype==1}
					{if empty($elem.bulstat)}
<td class="r3"> липсва
					{else}
<td class="r2"> {$elem.bulstat}
					{/if}
<td class="r2"> &nbsp;
				{elseif $elem.idtype==2}
<td class="r2"> &nbsp;
<td class="r2"> {$elem.egn}
				{else}
<td class="r2"> {$elem.bulstat}
<td class="r2"> {$elem.egn}
				{/if}
<td class="r2"> {$elem.name}
<td class="r2"> 
<a href="{$elem.claimodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
{*
<img src="images/free.gif" style="cursor:pointer" title="изтрий" onclick="deleelem('{$elem.claidele}','взискател {$elem.name}');"> 
*}
{***
<img id="c{$elem.id}" src="images/free.gif" style="cursor:pointer" title="изтрий">
<script>
document.getElementById("c{$elem.id}").onclick= function(){ldelim}deleelem('{$elem.claidele}','взискател {$elem.name}');{rdelim}
</script>
***}
{/foreach}
			{if empty($ARCLAI0)}
			{else}
{foreach from=$ARCLAI0 item=elem}
		<tr>
<td class="r4" colspan=20> бивш ЕТ физическо лице <b>{$elem.name}</b> - изтрит
{/foreach}
			{/if}
						</table>
<br>
						<table>
						<tr>
<td class="h2" colspan=9 align=center> длъжници по делото
{**}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$DEBTCREA}" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
{**}
						<tr>
<td class="h2"> статус
<td class="h2"> тип
<td class="h2"> подтип
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
{*
<td class="h2"> вх.№ НАП
<td class="h2"> &nbsp;
*}
{foreach from=$DEBTLIST item=elem}
						<tr>
{*
						{if $elem.etcode==1}
<td class="r4"> стар ЕТ
						{elseif $elem.etcode==2}
<td class="r3"> нов ЕТ
						{else}
<td class="r2"> &nbsp;
						{/if}
*}
					{if $elem.isform}
<td class="r2 r4"> бивш ЕТ
					{else}
<td class="r2"> &nbsp;
					{/if}
<td class="r2"> {$elem.type}&nbsp;
<td class="r2"> {$elem.subt}&nbsp;
				{if $elem.idtype==1}
					{if empty($elem.bulstat)}
<td class="r3"> липсва
					{else}
<td class="r2"> {$elem.bulstat}
					{/if}
<td class="r2"> &nbsp;
				{elseif $elem.idtype==2}
<td class="r2"> &nbsp;
<td class="r2"> {$elem.egn}
				{else}
<td class="r2"> &nbsp;
<td class="r2"> &nbsp;
				{/if}
<td class="r2"> {$elem.name}
<td class="r2"> 
<a href="{$elem.debtmodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
{*
<img src="images/free.gif" style="cursor:pointer" title="изтрий" onclick="deleelem('{$elem.debtdele}','длъжник {$elem.name}');"> 
*}
{***
<img id="d{$elem.id}" src="images/free.gif" style="cursor:pointer" title="изтрий">
<script>
document.getElementById("d{$elem.id}").onclick= function(){ldelim}deleelem('{$elem.debtdele}','длъжник {$elem.name}');{rdelim}
</script>
***}
{/foreach}
			{if empty($ARDEBT0)}
			{else}
{foreach from=$ARDEBT0 item=elem}
		<tr>
<td class="r4" colspan=20> бивш ЕТ физическо лице <b>{$elem.name}</b> - изтрит
{/foreach}
			{/if}
						</table>
										</table>
									
<br>
										<table align=center width=50% style="padding:10px;border:1px solid black;background-color:khaki;">
										<tr><td class="r10">
{$TXCONT}
										</table>
<script>
function deleelem(link,text){ldelim}
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на '+text);
	if (resu){ldelim}
		document.location.href= link;
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
</script>
