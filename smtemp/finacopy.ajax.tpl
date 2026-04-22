{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="копиране от банково извлечение"}
{include file="_erform.tpl"}

спусни тук редовете от банковото извлечение
<br>
<textarea name="bankdata" id="bankdata" rows=4 cols=120 style="font: normal 7pt verdana; border: 0px solid black;"></textarea>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='трансформирай' NAME='transform' ID='transform'}
{include file='_button.tpl' TITLE='изчисти' ONCLICK="document.getElementById('bankdata').value='';"}

			{if empty($BANKLIST)}
			{else}
<br>
трансформирани данни
	<table class='d_table' cellspacing=0 cellpadding=0 align=center width=900>
	<tr class='header'>
<td> дата
<td> час
<td> сума
<td> описание
<td> кореспондент
<td> основание
<td> пояснения
<td> референция
	{foreach from=$BANKLIST item=elem}
	<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' style="color:{if isset($elem.error)}red{else}black{/if}">
<td> {$elem.date}
<td> {$elem.hour}
<td> {$elem.amount}
<td> {$elem.desc1}
<td> {$elem.desc2}
<td> {$elem.desc3}
<td> {$elem.desc4}
<td> {$elem.reference}
<td> {$elem.error}
	{/foreach}
	</table>
{include file='_but2.tpl' TYPE='submit' TITLE='добави верните редове' NAME='submit' ID='submit'}
			{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
