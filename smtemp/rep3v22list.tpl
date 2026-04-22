{*
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> {$PAGEBACKTEXT} </a>
*}
{include file="_tab2.tpl"}
<style>
.tab2 tr td {ldelim}cursor:help;{rdelim}
{*
.more {ldelim}background-color:beige;cursor:pointer !important;{rdelim}
.como {ldelim}background-color:linen;{rdelim}
*}
.h7 {ldelim}font:normal 7pt verdana !important;background-color:#cceeff;{rdelim}
.suma {ldelim}background-color:#eeeeee;{rdelim}
</style>
				<table class="tab2" cellspacing='2' cellpadding='2' align=center style="margin:10px;">
				<tr class='head1'>
<td colspan='200'>
данни по дела за взискател {$ARHEAD.name} ЕИК {$ARHEAD.iden}
{*
<br>
			<form name="mynameform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
за търсене въведи част от име или ЕИК/ЕГН
<input type="text" class="inp7bold" name="filtname" id="filtname" size=16 autocomplete=off onkeyup="autonamesubm(event,'filtname');" value="{$FILTNAME}">
+enter
			</form>
*}
				<tr class='h7'>
<td rowspan=3 colspan=1 align=center> дело
{include file="rep3head.tpl" MODE=1}
				<tr class='h7'>
{include file="rep3head.tpl" MODE=2}
				<tr class='h7'>
{include file="rep3head.tpl" MODE=3}
	{foreach from=$AR2 item=elcase key=idcase}
			{include file="_tab2tr.tpl"}
			<td class="como" colspan=1> {$elcase.caseri}/{$elcase.cayear}
			<td align=right class="como" title="{$ARHE.h1}"> {$elcase.c1}
			<td align=right class="como" title="{$ARHE.h2}"> {$elcase.c2}
			<td align=right class="como suma" title="{$ARHE.h3}"> {$elcase.c3}
			<td align=right class="como" title="{$ARHE.h4}"> {$elcase.c4}
			<td align=right class="como" title="{$ARHE.h5}"> {$elcase.c5}
			<td align=right class="como" title="{$ARHE.h6}"> {$elcase.c6}
			<td align=right class="como suma" title="{$ARHE.h7}"> {$elcase.c7}
			<td align=right class="como" title="{$ARHE.h8}"> {$elcase.c8}
			<td align=right class="como" title="{$ARHE.h9}"> {$elcase.c9}
			<td align=right class="como suma" title="{$ARHE.h10}"> {$elcase.c10}
			<td align=right class="como suma" title="{$ARHE.h11}"> {$elcase.c11}
			<td align=right class="como" title="{$ARHE.h12}"> {$elcase.c12}
			<td align=right class="como" title="{$ARHE.h13}"> {$elcase.c13}
			<td align=right class="como" title="{$ARHE.h14}"> {$elcase.c14}
			<td align=right class="como suma" title="{$ARHE.h15}"> {$elcase.c15}
	{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
				</table>
