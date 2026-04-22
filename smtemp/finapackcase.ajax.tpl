{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE='разпределения на постъпленията за дело'}
дело <b>{$ROCASE.serial}/{$ROCASE.year}</b> деловодител <b>{$ROCASE.username}</b>
<br>
<style>
tr.header td {ldelim}border-right: 1px solid silver;{rdelim}
</style>

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
{*---- заглавие ----------------------*}
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>разпределени суми за пакет {$PACKNO} </td>
		</tr>
		</thead>

{*---- антетка ----------------------*}
		<tr class='header'>
<td rowspan=2>постъп</td>
<td rowspan=2>тип</td>
<td rowspan=2>длъжник</td>
<td rowspan=2>опис</td>
				{foreach from=$CLAILIST item=clainame}
<td colspan=2>за<br><b>{$clainame}</b></td>
				{/foreach}
<td rowspan=2>статус</td>
		</tr>
		<tr class='header'>
				{foreach from=$CLAILIST item=clainame}
<td>сума</td>
<td>пакет</td>
				{/foreach}
		</tr>

{*---- съдържание ----------------------*}
{foreach from=$LIST item=elem key=ekey}
					{assign var=finaid value=$elem.finaid}
				{if $elem.isclosed==1}
					{assign var=bgco value="#ddffcc"}
					{assign var=stat value="приключено"}
				{elseif $elem.rest<>0}
					{assign var=bgco value="#ffddcc"}
					{assign var=stat value="неизравнено"}
				{else}
					{assign var=bgco value=""}
					{assign var=stat value=""}
				{/if}
{*
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' onclick="window.location.href='{$elem.view}';" style="cursor:pointer;">
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
		<tr bgcolor="{$bgco}" onmouseover='this.style.backgroundColor="#dedede";' onmouseout='this.style.backgroundColor="{$bgco}";'>
*}
		<tr bgcolor="{$bgco}">
<td align=right> {$elem.inco} </td>
<td> {$ARTYPE[$elem.idtype]} </td>
<td> {$elem.debtname} </td>
<td align=center>
					{if empty($elem.descrip)}
&nbsp;
					{else}
<img src="images/view.png" title="{$elem.descrip}" style="cursor:help">
					{/if}
				{*---- взискателите ----------------------*}
				{foreach from=$CLAILIST item=clainame key=clid}
<td align=right>{$DATA[$finaid][$clid].amount}</td>
	{if is_array($CBCODE[$finaid][$clid])}
						{*---- изключваме типа "за връщане" ----*}
						{if $clid== -1}
<td align=center>
						{*---- ако сумата е вече преведена ----*}
						{elseif $DATA[$finaid][$clid].isdone<>0}
<td align=center bgcolor="green"> {$DATA[$finaid][$clid].idfinatranpack}
						{else}
<td align=center bgcolor="gold">
<input type=checkbox name=listfinatran[] value="{$CBCODE[$finaid][$clid][0]}" {$CBCODE[$finaid][$clid][1]}>
						{/if}
	{else}
		{if empty($CBCODE[$finaid][$clid])}
<td align=center>
{$CBCODE[$finaid][$clid]}
		{else}
<td align=center bgcolor="darksalmon">
{$CBCODE[$finaid][$clid]}
		{/if}
	{/if}
</td>
				{/foreach}
<td> {$stat} </td>
{*
<td> {$elem.username}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.casecrea|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.cofrname}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.caseid}" class="nyroModal" target="_blank"><img src="images/edit.png" title="виж постъпленията"></a></td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.view}"><img src="images/edit.png" title="съдържание"></a></td>
*}
		</tr>
	{/foreach}
</table>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
