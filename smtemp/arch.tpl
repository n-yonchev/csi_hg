<style>
.link {ldelim}font: normal 7pt verdana; color:black; cursor:pointer; border-bottom: 1px solid black{rdelim}
.text {ldelim}font: normal 7pt verdana; color:black;{rdelim}
</style>
						{if $FLPRIN}
							{assign var=txpage value="стр."|cat:$PAGENO}
						{else}
{*---- години за избор ------------------------------------------*}
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	{foreach from=$YEARLIST item=elem key=ekey}
		<td class='tabs_sep'>&nbsp;</td> 
		{if $YEAR==$ekey}
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span>{$ekey}</span></td>
			<td class='tabs_right_selected'></td>
		{else}	
			<td onclick='document.location.href="{$elem}"' class='tabs_left'></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_middle'><span>{$ekey}</span></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_right'></td>
		{/if}
	{/foreach}
	</tr>
	</table>
</div>
						{/if}

{*---- съдържание ------------------------------------------*}
					{assign var=abou value=$YEAR|cat:" год."}
			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
							{if $LOGGEDISADMIN}
Aрхивна книга за {$abou} {$txpage}
							{else}
списък на архивираните дела за {$abou} {$txpage}
							{/if}
						{if $FLPRIN}
						{else}
<div style="float:right">
&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' ONCLICK="fuprin('$CURINT');" TITLE="<img src='css/blue/button/printer.gif' alt='' /> Принтирай"}
</div>
<div style="float:right">
&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
							{if $LOGGEDISADMIN}
							{else}
<br>
			{if $ONLYUSER==1}
<span class="text">на деловодител {$USERNAME}</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="link" href="{$LINKALL}"> на целия архив </a>
			{else}
<span class="text">целия архив</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="link" href="{$LINKONLY}"> само на деловодител {$USERNAME} </a>
			{/if}
							{/if}

{*------
			<tr>
				<td class='d_table_button' colspan='20'>
	{if !empty($DATE.date)}
		{if empty($DATE.date2)}
за дата <b>{$DATE.date|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{else}
за периода от <b>{$DATE.date|date_format:"%d.%m.%Y"}</b> до <b>{$DATE.date2|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{/if}
	{else}
	{/if}
	{if empty($DATE.adre)}
	{else}
адресат=<b>{$DATE.adre}</b>
&nbsp;
	{/if}
	{if empty($DATE.bele)}
	{else}
бележки=<b>{$DATE.bele}</b>
&nbsp;
	{/if}
<div style="float:right">
&nbsp;
{include file='_button.tpl' ONCLICK="fuprin('$CURINT');" TITLE="<img src='css/blue/button/printer.gif' alt='' /> Принтирай"}
</div>
</td>
----*}
{*----
<td class='d_table_button' colspan='30'>
&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
----*}
		</tr>
						{/if}
		</thead>
		<tr class='header'>
<td> арх.№ </td>
	{include file="_sepa.tpl"}
<td> изп.дело </td>
	{include file="_sepa.tpl"}
<td> дата архивир </td>
	{include file="_sepa.tpl"}
<td> връзка </td>
	{include file="_sepa.tpl"}
<td> протокол </td>
	{include file="_sepa.tpl"}
{*----
<td> от дата </td>
	{include file="_sepa.tpl"}
----*}
<td> запаз.документи </td>
	{include file="_sepa.tpl"}
<td> том </td>
	{include file="_sepa.tpl"}
<td> забележка </td>
	{include file="_sepa.tpl"}
<td> деловодител </td>
	{include file="_sepa.tpl"}
<td>&nbsp;</td>
		</tr>
		<tbody>

		{foreach from=$LIST item=elem key=ekey}
								{if $elem.serial== -1}
									{if $ONLYUSER==0}
			<tr>
											{if $elem.arch2==$elem.arch1}
<td colspan=9 bgcolor=salmon> ЛИПСВА АРХИВЕН НОМЕР <b>{$elem.arch2}</b>
											{else}
<td colspan=9 bgcolor=salmon> липсват <b>{$elem.archcoun}</b> бр. архивни номера <b>{$elem.arch2} - {$elem.arch1}</b>
											{/if}
									{else}
									{/if}
								{else}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> {$elem.serial}
			{include file="_sepa.tpl"}
<td> {$elem.caseseri|cat:"/"|cat:$elem.caseyear}
			{include file="_sepa.tpl"}
<td> {$elem.date|date_format:"%d.%m.%Y"}
			{include file="_sepa.tpl"}
<td> {$elem.packet}
			{include file="_sepa.tpl"}
								{assign var="protda" value=$elem.protdate|date_format:"%d.%m.%Y"}
<td> {$elem.protocol|cat:"/"|cat:$protda}
			{include file="_sepa.tpl"}
{*----
<td> {$elem.protocol}
			{include file="_sepa.tpl"}
<td> {$protda}
			{include file="_sepa.tpl"}
----*}
<td> {$elem.doculist|nl2br}
			{include file="_sepa.tpl"}
<td> {$elem.volume}
			{include file="_sepa.tpl"}
<td> {$elem.notes|replace:";":"; "}
			{include file="_sepa.tpl"}
<td> {$elem.t2username}
			{include file="_sepa.tpl"}
{*
					{if $elem.isentered}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
					{else}
<td> &nbsp;
					{/if}
*}
<td>
			{if $elem.t2userid==$LOGGEDID or $LOGGEDISADMIN}
<a href="{$elem.edit}" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" title="корегирай"></a>
			{else}
{*
{$elem.t2username}
*}
			{/if}
								{/if}
		{/foreach}

		</tbody>
						{if $FLPRIN}
						{else}
{include file="_pagina.tr.tpl"}
{*
<iframe id="fraint" width=100 height=100 style="visibility:visible">
</iframe>
<script>
function fuprin(p1){ldelim}
	var op= document.getElementById("fraint").src= p1;
{rdelim}
</script>
*}
						{/if}
			</table>
