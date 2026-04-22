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
{*----
<td class='d_table_title' colspan='30'> Изходящ регистър за {$YEAR} год. {$txpage}
<td class='d_table_title' colspan='30'> Изходящ регистър за {$abou} {$txpage}
----*}
<td class='d_table_title' colspan='30'> 
Изходящ регистър за {$abou} {$txpage}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			<tr>
				<td class='d_table_button' colspan='20'>
						{if $FLPRIN}
						{else}
{*----
	{if isset($DATE.date)}
----*}
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
{*----
<a href="{$DATE.linkget}" class="nyroModal" target="_blank">
<img src="images/date.gif" title='избери дата'>
</a>
----*}
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="филтър"}
{*--------*}
&nbsp;
	{if isset($DATE.linkall)}
<a href="{$DATE.linkall}">
<img src="images/all.gif" title='всички редове'>
</a>
&nbsp;
	{else}
	{/if}
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
<td> дата </td>
	{include file="_sepa.tpl"}
<td> изх.номер </td>
	{include file="_sepa.tpl"}
<td> изп.дело </td>
	{include file="_sepa.tpl"}
<td> адресат </td>
	{include file="_sepa.tpl"}
<td> описание </td>
	{include file="_sepa.tpl"}
<td> бележки </td>
	{include file="_sepa.tpl"}
<td></td>
		</tr>
		<tbody>

		{foreach from=$LIST item=elem key=ekey}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> {$elem.registered|date_format:"%d.%m.%Y"}
	{include file="_sepa.tpl"}
<nobr>
			<td> {$elem.serial}
{if $elem.iduserregi==0}
{else}
	<img style="cursor:help" src="images/info.gif" title="изходен от {$elem.userregi} на {$elem.registered|date_format:"%d.%m.%Y"}">
{/if}
</nobr>
						{*----
							{if $elem.idcase==-1}
								{assign var="tdtext" value="ново"}
								{assign var="tddire" value="left"}
							{elseif  $elem.idcase==0}
						----*}
							{if $elem.idcase==0}
								{assign var="tdtext" value=""}
								{assign var="tddire" value="left"}
							{else}
								{assign var="tdtext" value=$elem.caseseri|cat:"/"|cat:$elem.caseyear}
								{assign var="tddire" value="right"}
							{/if}
	{include file="_sepa.tpl"}
			<td align="{$tddire}"> {$tdtext}
	{include file="_sepa.tpl"}
			<td> {$elem.adresat}
	{include file="_sepa.tpl"}
					{if $elem.isentered}
<td> {$elem.descrip}
					{else}
<td> {$elem.descriptype}
					{/if}
	{include file="_sepa.tpl"}
			<td> {$elem.notes|replace:";":"; "}
	{include file="_sepa.tpl"}
					{if $elem.isentered}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
					{else}
<td> &nbsp;
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
