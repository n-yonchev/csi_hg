<style>
.he7 {ldelim}font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;{rdelim}
.ro7 {ldelim}font: normal 7pt verdana !important; border-bottom: 1px solid black !important;{rdelim}
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
{*
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
*}
	{if !empty($DATE.date)}
		{if empty($DATE.date2)}
за дата <b>{$DATE.date}</b>
&nbsp;
		{else}
за периода от <b>{$DATE.date}</b> до <b>{$DATE.date2}</b>
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
<span id="buttoure">
{include file='_button.tpl' ONCLICK="fuprinoure('$CURINT');" TITLE="<img src='css/blue/button/printer.gif' alt='' /> Принтирай"}
</span>
<iframe id="framoure" width=100 height=50 frameborder=0 style="display:none">
</iframe>
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
<td>&nbsp</td>
{*+++
	{include file="_sepa.tpl"}
<td>връч</td>
+++*}
	{include file="_sepa.tpl"}
<td>образ
	{include file="_sepa.tpl"}
<td>връчване
		</tr>
		<tbody>

		{foreach from=$LIST item=elem key=ekey}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> {$elem.registered|date_format:"%d.%m.%Y"}
	{include file="_sepa.tpl"}
			<td> 
<nobr>
{$elem.serial}
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
{***
					{if $elem.isentered}
<td> {$elem.descrip}
					{else}
<td> {$elem.descriptype}
					{/if}
***}
					{if empty($elem.descrip)}
<td> {$elem.descriptype}
					{else}
<td> {$elem.descrip}
					{/if}
{*--------*}
	{include file="_sepa.tpl"}
			<td> {$elem.notes|replace:";":"; "}
	{include file="_sepa.tpl"}
{***
					{if $elem.isentered}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
					{else}
<td> &nbsp;
					{/if}
***}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
{*--------*}
{*---- връчване ------------------*}
{*+++
<td class='sep'>&nbsp;</td>
							{assign var=idpt value=$ARDELIMETH[$elem.id]}
		{if isset($ARDELILIST[$elem.id])}
<td align=center bgcolor="khaki" style="cursor:help;" rela="ttip" rel="cazo6post.ajax.php?p={$elem.id}" 
title="връчване на изх.документ с призовкар {$ARDELILIST[$elem.id].outseri}/{$ARDELILIST[$elem.id].outyear}"> виж
		{elseif isset($ARWAITMETH[$elem.id])}
							{assign var=idptwait value=$ARWAITMETH[$elem.id]}
<td style="font-size:7pt;color:red;">{$ARPOSTTYPE[$idptwait]}
		{else}
<td style="font-size:7pt;">{$ARPOSTTYPE[$idpt]}
		{/if}
+++*}
{*---- за сканирания образ ----*}
	{include file="_sepa.tpl"}
<td align=left>
					{assign var=iddocu value=$elem.id}
					{assign var=scancoun value=$ARSCANCOUN[$iddocu]}
		{if $scancoun==0}
&nbsp;
		{else}
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('{$elem.scanview}','win2');w2.focus();">
			{if $scancoun==1}
			{else}
<sup>{$ARSCANCOUN[$iddocu]}</sup>
			{/if}
		{/if}
		
{*---- връчване ----*}
	{include file="_sepa.tpl"}
{include file="deliinfo.ajax.tpl" iddocu=$iddocu}
		{/foreach}
		</tbody>
						{if $FLPRIN}
						{else}
{include file="_pagina.tr.tpl"}

{*---- за връчването ----*}
{include file="deliinfobase.ajax.tpl" ISTTIP=true}

{*
<iframe id="framoure" width=800 height=50 frameborder=0 style="visibility:visible">
</iframe>
*}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$("[@rela='ttip']").cluetip({ldelim} width: 560, cursor:'help' {rdelim});
{rdelim});
function fuprinoure(p1){ldelim}
		prinbegi();
	document.getElementById("framoure").focus();
	document.getElementById("framoure").src= p1;
{rdelim}
function prinbegi(){ldelim}
		document.getElementById("buttoure").style.display= "none";
		document.getElementById("framoure").style.display= "";
{rdelim}
function prinfini(){ldelim}
		document.getElementById("buttoure").style.display= "";
		document.getElementById("framoure").style.display= "none";
{rdelim}
</script>
						{/if}
			</table>
