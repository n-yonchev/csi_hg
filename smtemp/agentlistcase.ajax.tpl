{*---- източник : case/tpl ----*}
{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE='списък на дела с представител "'|cat:$AGNAME|cat:'"'}

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
{*
		<tr>
<td class='d_table_title' colspan='200'>списък на входящите документи</td>
		</tr>
*}
		</thead>
		<tr class='header'>
<td> номер
		<td class='sep'>&nbsp;</td>
<td> опис
		<td class='sep'>&nbsp;</td>
<td> идва от 
		<td class='sep'>&nbsp;</td>
<td> създадено
		<td class='sep'>&nbsp;</td>
<td> деловодител
		<td class='sep'>&nbsp;</td>
<td> статус
		</tr>
		<tbody>
{foreach from=$LIST item=elem key=ekey}
{*----
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
		<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
----*}
		<tr onmouseover='this.style.backgroundColor="#dddddd";' onmouseout='this.style.backgroundColor="";'>
<td align=right> {$elem.serial}/{$elem.year}
		<td class='sep'>&nbsp;</td>
<td align=center> <img src="images/view2.gif" title="{$elem.text}">
		<td class='sep'>&nbsp;</td>
<td align=left> <nobr>{$elem.coname}</nobr>
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.created|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td align=left> <nobr>{$elem.username}</nobr>
		<td class='sep'>&nbsp;</td>
<td align=left> <nobr>{$ARSTAT[$elem.idstat]}</nobr>
		</tr>

{/foreach}
		</tbody>
{*
	{include file="_pagina.tr.tpl"}
*}		
		</table>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
