{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="събрани суми"}
{include file="_erform.tpl"}
<style>
.head {ldelim}font:normal 7pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;{rdelim}
</style>
списък на сумите в брой {$FILTTX} от {$NAME}

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<tr>
<td class="head" align=center> дата
<td class="head" align=center> сума
<td class="head" align=center> дело
<td class="head" align=center> деловодител
<td class="head" align=center> описание
							{assign var=suma value=0}
{foreach from=$LIST item=elem key=ekey}
		<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' >
<td> {$elem.cashdate|date_format:"%d.%m.%Y"}
<td align=right bgcolor=wheat> <b>{$elem.inco|tomo3}</b>
						{math equation="a+b" a=$suma b=$elem.inco assign=suma}
<td> {$elem.caseseri}/{$elem.caseyear}
<td> <nobr>{$elem.username}</nobr>
<td> <nobr>{$elem.descrip|truncate:70:"...":false}</nobr>
{/foreach}
		<tr class='header'>
<td> ОБЩО
<td align=right> <b>{$suma|tomo3}</b>
<td colspan=3> &nbsp;
		</table>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
