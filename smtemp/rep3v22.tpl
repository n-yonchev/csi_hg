{include file="_tab2.tpl"}
<style>
.more {ldelim}background-color:beige;cursor:pointer !important;{rdelim}
.h22 {ldelim}color:red;{rdelim}
</style>
				<form name="cbform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<center>
				<table class="tab2" cellspacing='2' cellpadding='2' align=center style="margin:10px;">
				<tr>
<td colspan='200' class="h22">
остави маркирани само взискателите, които са съдилища
<br>
				<tr class='head1'>
<td> взискател
<td> тип
<td> ЕИК
<td> ЕГН
<td align=right> брой<br>дела
<td align=right> дъл<br>жими
<td align=right> съб<br>рани
{foreach from=$ARDATA item=elem key=indx}
			{include file="_tab2tr.tpl"}
{*
<td> {$elem.name}
*}
<td>
<input type="checkbox" name="codelist[]" value="{$elem.code}" label="{$elem.name}" onclick="document.forms['cbform'].submit();">
<td>
		{if $elem.type==1}
юрид
		{elseif $elem.type==2}
физ
		{else}
др
		{/if}
<td> {$elem.eik}
<td> {$elem.egn}
{*
<td align=right> {$elem.c3}
<td align=center class="more" pare="e{$indx}" stat="-" onclick="toggle('e{$indx}');" title="подробно"> {$elem.c3}
*}
<td align=center class="more" title="подробно" {include file="_href.tpl" LINK=$elem.link}> {$elem.c3}
<td align=right> {$elem.c10|tomoney2}
<td align=right> {$elem.c11|tomoney2}
{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
				<tr class='head1'>
<td colspan=4> общо
<td align=right> {$ARSUMA.c3}
<td align=right> {$ARSUMA.c10|tomoney2}
<td align=right> {$ARSUMA.c11|tomoney2}
				</table>
</center>
				</form>
