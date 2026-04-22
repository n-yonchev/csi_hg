<style>
.link {ldelim}font: normal 7pt verdana; color:black; cursor:pointer; border-bottom: 1px solid black{rdelim}
.text {ldelim}font: normal 7pt verdana; color:black;{rdelim}
</style>

{*---- съдържание ------------------------------------------*}
			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
списък на сметките
		</thead>
		<tr class='header'>
<td> номер </td>
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td> взискател </td>
		<td class='sep'>&nbsp;</td>
<td> сума </td>
		<td class='sep'>&nbsp;</td>
<td> дело </td>
		<td class='sep'>&nbsp;</td>
<td> деловодител </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
		<tbody>

		{foreach from=$LIST item=elem key=ekey}
								{if $elem.serial== -1}
{***
									{if $ONLYUSER==0}
***}
			<tr>
											{if $elem.arch2==$elem.arch1}
<td colspan=7 bgcolor=salmon> ЛИПСВА АРХИВЕН НОМЕР <b>{$elem.arch2}</b>
											{else}
<td colspan=7 bgcolor=salmon> липсват <b>{$elem.archcoun}</b> бр. архивни номера <b>{$elem.arch2} - {$elem.arch1}</b>
											{/if}
{***
									{else}
									{/if}
***}
								{else}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> {$elem.serial}
			{include file="_sepa.tpl"}
<td> {$elem.date|date_format:"%d.%m.%Y"}
			{include file="_sepa.tpl"}
<td> {$elem.persname}
			{include file="_sepa.tpl"}
<td align=right> {$LISTSUMA[$elem.id]|tomo3}</td>
			{include file="_sepa.tpl"}
<td> {$elem.caseseri|cat:"/"|cat:$elem.caseyear}
			{include file="_sepa.tpl"}
<td> {$elem.username}
			{include file="_sepa.tpl"}
{*
					{if $elem.isentered}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
					{else}
<td> &nbsp;
					{/if}
<td>
			{if $elem.t2userid==$LOGGEDID or $LOGGEDISADMIN}
<a href="{$elem.edit}" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" title="корегирай"></a>
			{else}
			{/if}
*}
<td>
<a href="{$elem.prinbill}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати"></a>
								{/if}
		{/foreach}

		</tbody>
						{if $FLPRIN}
						{else}
{include file="_pagina.tr.tpl"}
						{/if}
			</table>
