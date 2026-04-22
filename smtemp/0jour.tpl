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

{*---- съдържание ------------------------------------------*}
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> Дневник на извършените действия за {$YEAR} год.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
		</tr>
{*----
		<tr>
<td class='d_table_button' colspan='30'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
		</tr>
----*}
			<tr>
			<td class='d_table_button' colspan='20'>
						{if $FLPRIN}
						{else}
	{if isset($DATE.date)}
		{if empty($DATE.date2)}
за дата <b>{$DATE.date|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{else}
за периода от <b>{$DATE.date|date_format:"%d.%m.%Y"}</b> до <b>{$DATE.date2|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{/if}
	{else}
	{/if}
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="период"}
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
						{/if}
		</td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
	{include file="_sepa.tpl"}
<td> пор.№ </td>
	{include file="_sepa.tpl"}
<td> изп.дело </td>
	{include file="_sepa.tpl"}
<td> описание </td>
	{include file="_sepa.tpl"}
<td> задължено лице </td>
	{include file="_sepa.tpl"}
<td> тип </td>
	{include file="_sepa.tpl"}
<td> рег. </td>
	{include file="_sepa.tpl"}
<td></td>
		</tr>
		<tbody>

{include file="_jour.tpl" PRIN=false}

		</tbody>
	{if $FLPRIN}
	{else}
{include file="_pagina.tr.tpl"}
		<iframe id="fraint" width=1 height=1 style="visibility:hidden"></iframe>
		<script>
		function fuprin(p1){ldelim}
			var op= document.getElementById("fraint").src= p1;
		{rdelim}
		</script>
	{/if}

			</table>
