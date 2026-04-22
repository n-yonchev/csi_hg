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
				{if isset($DATE.date) and $FLPRIN}
					{assign var=abou value=$DATE.date|date_format:"%d.%m.%Y"}
				{else}
					{assign var=abou value=$YEAR|cat:" год."}
				{/if}
			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
Архивна книга за {$abou} {$txpage}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			<tr>
				<td class='d_table_button' colspan='20'>
						{if $FLPRIN}
						{else}
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
{*
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="филтър"}
&nbsp;
	{if isset($DATE.linkall)}
<a href="{$DATE.linkall}">
<img src="images/all.gif" title='всички редове'>
</a>
&nbsp;
	{else}
	{/if}
*}
&nbsp;
{include file='_button.tpl' ONCLICK="fuprin('$CURINT');" TITLE="<img src='css/blue/button/printer.gif' alt='' /> Принтирай"}
{*----
<img src="images/print.gif" title="отпечати текущата страница" style="cursor:pointer;float:right" onclick="fuprin('{$CURINT}');">
----*}
</td>
						{/if}
{*----
<td class='d_table_button' colspan='30'>
&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
----*}
		</tr>
		</thead>
		<tr class='header'>
<td> арх.№ </td>
	{include file="_sepa.tpl"}
<td> изп.дело </td>
	{include file="_sepa.tpl"}
<td> дата архивир </td>
	{include file="_sepa.tpl"}
<td> протокол </td>
	{include file="_sepa.tpl"}
{*----
<td> от дата </td>
	{include file="_sepa.tpl"}
----*}
<td> забележка </td>
	{include file="_sepa.tpl"}
<td></td>
		</tr>
		<tbody>

		{foreach from=$LIST item=elem key=ekey}
										{if $elem.serial== -1}
			<tr>
											{if $elem.arch2==$elem.arch1}
<td colspan=8 bgcolor=salmon> ЛИПСВА АРХИВЕН НОМЕР <b>{$elem.arch2}</b>
											{else}
<td colspan=8 bgcolor=salmon> липсват архивни номера <b>{$elem.arch2} - {$elem.arch1}</b>
											{/if}
										{else}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> {$elem.serial}
			{include file="_sepa.tpl"}
<td> {$elem.caseseri|cat:"/"|cat:$elem.caseyear}
			{include file="_sepa.tpl"}
<td> {$elem.date|date_format:"%d.%m.%Y"}
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
<td> {$elem.notes|replace:";":"; "}
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
<a href="{$elem.edit}" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" title="корегирай"></a>
										{/if}
		{/foreach}

		</tbody>
						{if $FLPRIN}
						{else}
{include file="_pagina.tr.tpl"}

<iframe id="fraint" width=1 height=1 style="visibility:hidden">
</iframe>
<script>
function fuprin(p1){ldelim}
	var op= document.getElementById("fraint").src= p1;
{rdelim}
</script>
						{/if}
			</table>
