				<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
				<thead>
				<tr>
<td class='d_table_title' colspan='20'>списък на молбите за удостоверения за вписване
{*
				<tr>
<td class='d_table_button' colspan='20'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
*}
				</thead>
				<tr class='header'>
<td> вх.номер 
				<td class='sep'>&nbsp;</td>
<td> описание
				<td class='sep'>&nbsp;</td>
<td> изх.номер 
				<td class='sep'>&nbsp;</td>
<td> подател
				<td class='sep'>&nbsp;</td>
<td> адресат
				<td class='sep'>&nbsp;</td>
<td> бел
				<td class='sep'>&nbsp;</td>
<td> въвел 
				<td class='sep'>&nbsp;</td>
<td> кога 
				<td class='sep'>&nbsp;</td>
<td> посл.корекция
				<td class='sep'>&nbsp;</td>
<td> &nbsp;
				<tbody>
{foreach from=$LIST item=elem key=ekey}
				<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
<td align=right> {$elem.serial}/{$elem.year}
				<td class='sep'>&nbsp;
<td> {$elem.text}
				<td class='sep'>&nbsp;
<td align=right> {$elem.seriout}/{$elem.yearout}
				<td class='sep'>&nbsp;
<td> {$elem.from}
				<td class='sep'>&nbsp;
<td> {$elem.adresat}
				<td class='sep'>&nbsp;
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
		<td class='sep'>&nbsp;</td>
<td> {$elem.u2name} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"} 
		<td class='sep'>&nbsp;</td>
<td> {$elem.lastname} {$elem.lastmodi|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
{*
<td align=center>
<nobr>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="{$elem.view}" class="nyroModal" target="_blank"><img src="images/bg5.gif" title="документа"></a>
</nobr>
*}
<td>
<nobr>
{*
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="{$elem.view}" class="nyroModal" target="_blank"><img src="images/bg5.gif" title="към сървъра"></a>
<a href="#" onclick="toggle('{$elem.id}','{$elem.tose}');return false;"><img src="images/dire.gif" title="към сървъра"></a>
*}
			{if empty($elem.response)}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="#" onclick="toggle('{$elem.id}','{$elem.tose}');return false;"><img src="images/bg5.gif" title="към сървъра"></a>
			{else}
<a href="{$elem.resp}" class="nyroModal" target="_blank"><img src="images/word.gif" 
title="резултата от {$elem.resptime|date_format:"%d.%m.%Y"} в {$elem.resptime|date_format:"%H:%M:%S"}"></a>
			{/if}
</nobr>
		</tr>
{*---- допълнителен ред ----*}
		<tr id='tr{$elem.id}' style="display:none">
<td id='td{$elem.id}' colspan=30 align=center>
{*
обръщение към сървъра, почакай ...
*}
<iframe id="if{$elem.id}" width=800 height=200 frameborder=0></iframe>
		</tr>

		{/foreach}
		</tbody>

	{include file="_pagina.tr.tpl"}
		
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
//$(document).ready(function() {ldelim}
//	$('.caselist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
//{rdelim});
var trcurr;
function trclic(obje){ldelim}
	if (trcurr){ldelim}
		trcurr.className= "";
	{rdelim}else{ldelim}
	{rdelim}
	obje.className= "trdocu";
	trcurr= obje;
{rdelim}
function toggle(pid,plink){ldelim}
//alert(pid+'/'+plink);
	var trobje= document.getElementById("tr"+pid);
	var tdobje= document.getElementById("td"+pid);
	var ifobje= document.getElementById("if"+pid);
	var curdis= (trobje.style.display=="");
	if (curdis){ldelim}
		trobje.style.display= "none";
	{rdelim}else{ldelim}
		trobje.style.display= "";
//		ifobje.src= encodeURI("certifinit.if.php?p="+plink);
		ifobje.src= plink;
	{rdelim}
{rdelim}
</script>
