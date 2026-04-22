<style>
.head {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-top: 1px solid #cdcdcd;{rdelim}
.head2 {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd;{rdelim}
td {ldelim}font:normal 8pt verdana;{rdelim}
a.norm {ldelim}font: bold 8pt verdana; border-bottom: 0px solid black; cursor: pointer; padding: 2px 6px 2px 6px;{rdelim}
span.norm {ldelim}font: bold 8pt verdana; padding: 2px 6px 2px 6px;{rdelim}
{*
a.norm {ldelim}font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;{rdelim}
a.curr {ldelim}font: bold 7pt verdana; color: black; border-bottom: 0px solid black; cursor: pointer;{rdelim}
.h3 {ldelim}font: bold 10pt verdana; color: black;{rdelim}
*}
</style>

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> последен резултат от регистъра
{***
&nbsp;&nbsp;&nbsp;&nbsp;
			{foreach from=$ARLINK item=elem key=ekey}
&nbsp;
<a class="{if $ekey==$CODESUB}curr{else}norm{/if}" href="{$elem}">{$SUBTEX.$ekey}</a>
			{/foreach}
***}		
		</tr>
		</thead>
		<tr>
<td colspan='200'>
за всички дела на деловодител <b>{$USNAMEREGI}</b>
<br>

		<tr>
							{if empty($ARINFO)}
<td align=center>
<br>
<h3>няма резултат</h3>
<br>
							{else}
<td class="head"> продълж </td>
<td class="head"> време </td>
<td class="head"> грешка-1 </td>
<td class="head"> грешка-2 </td>
<td class="head"> грешка-3 </td>
<td class="head"> резултат </td>
<td class="head"> протокол </td>
		<tr>
<td> {$ARINFO.dura} сек.
<td> {$ARINFO.time}
{*
{include file="regilaelem.tpl" INDX="e1" COLO="#fa8072"}
*}
{include file="regilaelem.tpl" ELEM=$ARINFO.e1 CODE="e1" COLO="#fa8072"}
{include file="regilaelem.tpl" ELEM=$ARINFO.e2 CODE="e2" COLO="#fa8072"}
{include file="regilaelem.tpl" ELEM=$ARINFO.e3 CODE="e3" COLO="#fa8072"}
{include file="regilaelem.tpl" ELEM=$ARINFO.resu CODE="resu" COLO="#fa8072" COL2="lightgreen"}
{include file="regilaelem.tpl" ELEM=$ARINFO.ok CODE="ok" COLO=""}
							{/if}

			</table>
<br>

{$RECONT}