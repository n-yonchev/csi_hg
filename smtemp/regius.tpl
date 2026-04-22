<style>
{*
.head {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-top: 1px solid #cdcdcd;{rdelim}
.head2 {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd;{rdelim}
*}
td {ldelim}font:normal 8pt verdana;{rdelim}
a.norm {ldelim}font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;{rdelim}
a.curr {ldelim}font: bold 7pt verdana; color: black; border-bottom: 0px solid black; cursor: pointer;{rdelim}
.h3 {ldelim}font: bold 10pt verdana; color: black;{rdelim}
</style>
<br>
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> за регистъра
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
		<td width=20>
<td>
{include file="regiustose.tpl"}
		<td width=20>
			</table>
<br>
