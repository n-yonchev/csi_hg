<style>
table.caus td {ldelim}font: normal 7pt verdana; border-bottom: 1px solid black{rdelim}
.tdmain {ldelim}font: normal 8pt verdana; border-bottom: 0px solid black{rdelim}
</style>

						{if isset($PRNTLINK)}
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
						{else}
						{/if}

{*---- колко реда в колона за екрана ----*}
{assign var=pagecoun value=70}
					<table align=center>
					<tr>
<td class="tdmain" colspan=6>
разпределение на делата за {$YEAR} год. към {$smarty.now|date_format:"%d.%m.%Y %H:%M"}
						{if isset($PRNTLINK)}
{*----
<span onclick="fuprin('{$PRNTLINK}');"> отпечати </span>
{include file='_button.tpl' ONCLICK="fuprin('$PRNTLINK');" TITLE='изведи'}
----*}
<form name="foro" method=post action="{$PRNTLINK}">
със <input type=text name=rowspc size=4 class="input" value=50> реда в колона 
{include file='_button.tpl' ONCLICK="document.forms['foro'].submit();;" TITLE='изведи'}
</form>
						{else}
{*---- колко реда в колона за отпечатване ----*}
{assign var=pagecoun value=$ROWSPC}
						{/if}
					<tr>
<td class="tdmain" valign=top>
							{counter start=1 assign=coun}
			<table class="caus" border=1 style="border-collapse:collapse;">
{foreach from=$ARLIST item=elem}
			<tr>
<td>
<nobr>
	{if $elem.ser1==$elem.ser2}
'{$elem.ser1}
	{else}
'{$elem.ser1}-{$elem.ser2}
	{/if}
</nobr>
<td><nobr> {$USERLIST[$elem.iduser]} </nobr>
							{counter assign=coun}
						{if $coun>$pagecoun}
			</table>
<td class="tdmain" valign=top>
			<table class="caus" border=1 style="border-collapse:collapse;">
							{counter start=1 assign=coun}
						{else}
						{/if}
{/foreach}
			</table>
					</table>
