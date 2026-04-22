{include file="_tab2.tpl"}
<style>
body {ldelim}font: normal 8pt verdana; padding: 1px 8px 1px 8px;{rdelim}
.h1 {ldelim}font: normal 8pt verdana; background-color:tan; padding:2px; 4px; 2px; 4px;padding:6px;{rdelim}
.link {ldelim}font: normal 8pt verdana; cursor: pointer; background-color:aquamarine; padding:2px 6px 2px 6px; margin:2px; 2px; 2px; 2px;float:left;{rdelim}
.curr {ldelim}background-color:khaki;{rdelim}
.fon7 {ldelim}font: normal 7pt verdana !important;{rdelim}
.doinpu {ldelim}font:normal 7pt verdana !important; color:black !important;{rdelim}
.butt {ldelim}padding:8px 10px 8px 10px;{rdelim}
.sort {ldelim}font:normal 7pt verdana !important; color:black !important;border-bottom: 1px solid black;cursor:pointer;{rdelim}
.sortcurr {ldelim}background-color:khaki !important;padding-left:6px;padding-right:6px; {rdelim}
.case {ldelim}background-color:khaki !important;cursor:pointer;{rdelim}
{*---- -------------------------------- ----*}
.stat0 {ldelim}background-color:lightgreen;{rdelim}
.stat1 {ldelim}background-color:#ff9999;{rdelim}
.toli {ldelim}cursor:pointer;{rdelim}
.tohe {ldelim}cursor:help;{rdelim}
.link3 {ldelim}font: normal 8pt verdana; cursor: pointer; border-bottom:1px solid black; padding:2px 6px 2px 6px;{rdelim}
.curr3 {ldelim}background-color:khaki;cursor:pointer;{rdelim}
</style>
{include file="deliinfobase.ajax.tpl" ISTTIP=false}

					<table align=center>
					<tr>
{foreach from=$ARMETH item=txmeth key=inmeth}
<td align=center> {$txmeth}
					<td width=10>
{/foreach}
					<tr>
{foreach from=$ARMETH item=txmeth key=inmeth}
<td class="h1" align=center>
	{foreach from=$ARVARILINK[$inmeth] item=culink key=codevari}
			{if $codevari=="filt_11"}
<div class="link ctip{if $codevari==$VARI} curr{else}{/if}" 
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$culink}'{rdelim});"
rel="#filtcont" title="съдържание на филтъра">
			{else}
<div class="link{if $codevari==$VARI} curr{else}{/if}" 
{include file="_href.tpl" LINK=$culink}> 
			{/if}
{$ARVARI.$codevari}
{if $ARCOUN[$codevari]==0}{else}&nbsp;[{$ARCOUN[$codevari]}]{/if}
</div>
	{/foreach}
					<td width=10>
{/foreach}

{*---- съдържание на филтъра ----*}
<span id="filtcont" style="display: none">
				{if empty($ARVIEWFILT)}
няма въведен филтър
				{else}
	<table>
{foreach from=$ARVIEWFILT item=fico key=fina}
	<tr>
<td> {$ARELEM.$fina.text}
<td> <b>{$fico}</b>
{/foreach}
	</table>
<hr>
<font color=blue>клик за корекция</font>
				{/if}
</span>
					</table>

