<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> списък на сумите в брой<br> {$FILTTX}</td>
		</tr>
		</thead>
					{if count($LIST)==0}
<tr>
<td colspan=5 align=center>
<br>
<b>няма събрани суми</b>
<br>&nbsp;
					{else}
		<tr class='header'>
<td> събрал
		<td class='sep'>&nbsp;</td>
<td align=right> сума 
		</tr>

							{assign var=suma value=0}
{foreach from=$LIST item=elem key=ekey}
{*----
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<tr onmouseover='this.style.backgroundColor="#eeeeff";' onmouseout='this.style.backgroundColor="";' >
----*}
		<tr>
<td> {$elem.person}
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor="#dddddd" title="виж сумите">
<a href="{$elem.pers}" class="nyroModal" target="_blank">
{$elem.suma|tomoney2}</a>
						{math equation="a+b" a=$suma b=$elem.suma assign=suma}
{*----
		{$elem.suma|tomoney2}
----*}
{*
<td align=right class="nyroModal" bgcolor="#dddddd" style="cursor:pointer" onclick="document.location.href='{$elem.pers}';" title="виж сумите">
<a href="{$elem.adda}" class="nyroModal" target="_blank"><img src="images/adda.gif" title="добави сметка за {$elem.name|escape:'html'}"></a>
*}
		</tr>
	{/foreach}
		<tr class='header'>
<td> ОБЩО
		<td class='sep'>&nbsp;</td>
<td align=right>{$suma|tomoney2}
{*
{include file="_pagina.tr.tpl"}
*}
</table>

{*
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.caselist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
{rdelim});
var trcurr;
function trclic(obje){ldelim}
	if (trcurr){ldelim}
		trcurr.className= "";
	{rdelim}else{ldelim}
	{rdelim}
	obje.className= "trdocu";
	trcurr= obje;
{rdelim}
</script>
*}
					{/if}
