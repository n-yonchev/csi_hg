	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на ПДИ</td>
	</tr>
	</thead>

	<tr class='header'>
<td> изх.номер </td>
	<td class='sep'>&nbsp;</td>
<td> изведена </td>
	<td class='sep'>&nbsp;</td>
<td> връчена </td>
	<td class='sep'>&nbsp;</td>
<td> започ. </td>
	<td class='sep'>&nbsp;</td>
<td> задълж.лице </td>
	<td class='sep'>&nbsp;</td>
<td> по дело </td>
	<td class='sep'>&nbsp;</td>
<td> изп.титул </td>
	<td class='sep'>&nbsp;</td>
<td> срок </td>
	<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
	</tr>

{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> {$elem.serial}/{$elem.year} </td>
	<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"} </td>
	<td class='sep'>&nbsp;</td>
<td> {$elem.date|date_format:"%d.%m.%Y"} &nbsp;</td>
	<td class='sep'>&nbsp;</td>
<td align=center> {if $elem.flag==1}да{else}{/if} &nbsp;</td>
	<td class='sep'>&nbsp;</td>
<td> {$elem.person} </td>
	<td class='sep'>&nbsp;</td>
<td> {$elem.caseseri}/{$elem.caseyear} </td>
	<td class='sep'>&nbsp;</td>
{assign var=indxtitu value=$elem.casetitu}
<td> {$LISTTITU.$indxtitu} </td>
	<td class='sep'>&nbsp;</td>
<td> {$TIMETITU.$indxtitu} </td>
	<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
	</tr>
	{/foreach}

{include file="_pagina.tr.tpl"}
	</table>



