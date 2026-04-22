<style>
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:bold 10pt verdana;color:green;{rdelim}
.pdfview {ldelim}font:normal 8pt verdana;padding:2px 4px 2px 4px;background-color:khaki;cursor:pointer;{rdelim}
</style>
				<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
				<thead>
				<tr>
<td class='d_table_title' colspan='30'>Списък на исканията за справки от Регистъра на длъжниците
{*
&nbsp;
{include file='_button.tpl' HREF="$LINKCODETO" CLASS='nyroModal' TARGET='_blank' TITLE='справка'}
*}
				<tr>
<td class='d_table_button' colspan='30'>
{*
			<form method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
*}
		<div align=left style="float:left">
<sup>
<span style="font:normal 8pt verdana;">
въведи номер-искане за обработка &nbsp;
<input type="text" name="requ" id="requ" size=14 autocomplete=off
style="font:bold 7pt verdana;background-color:white; border: 0px solid green;" onkeyup="autorequ(event,this.form);">
+enter
</span>
</sup>
		</div>
		<div align=right style="float:right;">
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави ново искане'}
		</div>
{*
			</form>
*}
				</thead>
				<tr class='header'>
<td> дата
				<td class='sep'>&nbsp;</td>
<td> лок
				<td class='sep'>&nbsp;</td>
<td> подател 
{*
				<td class='sep'>&nbsp;</td>
<td> ЕГН/ЕИК
*}
				<td class='sep'>&nbsp;</td>
<td> факт 
				<td class='sep'>&nbsp;</td>
<td> за кого
				<td class='sep'>&nbsp;</td>
<td> бел
{*****
				<td class='sep'>&nbsp;</td>
<td> въвел 
				<td class='sep'>&nbsp;</td>
<td> посл.корекция
*****}
				<td class='sep'>&nbsp;</td>
<td> № искане
				<td class='sep'>&nbsp;</td>
<td> сверка
				<td class='sep'>&nbsp;</td>
<td> вх.номер
				<td class='sep'>&nbsp;</td>
<td> изх.номер
				<td class='sep'>&nbsp;</td>
<td> справка
				<td class='sep'>&nbsp;</td>
<td> фактура
				<tbody>
{foreach from=$LIST item=elem key=ekey}
{*
				<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
*}
				<tr onmouseover='$(this).addClass("trdocu");' onmouseout='$(this).removeClass("trdocu");'>
<td> {$elem.lastmodi|date_format:"%d.%m.%Y"}
				<td class='sep'>&nbsp;
						{if $elem.islocal==0}
<td align=center> &nbsp;
						{else}
<td align=center style="cursor:help;" bgcolor="#dddddd" 
title='посл.корекция {$elem.lastname} {$elem.lastmodi|date_format:"%d.%m.%Y"}'> да
						{/if}
				<td class='sep'>&nbsp;
<td> {$elem.name}
{*
				<td class='sep'>&nbsp;
<td> {$elem.egneik}
*}
				<td class='sep'>&nbsp;
						{if $elem.isinvo==0}
<td align=center> &nbsp;
						{else}
<td align=center style="cursor:help;" bgcolor="#dddddd" rela="ttip" rel="cer2invo.ajax.php?p={$elem.id}" 
title="данни за фактурата" style="cursor:help;"> да
						{/if}
				<td class='sep'>&nbsp;
<td> {$elem.name2}
							{if 0}
							{elseif $elem.idtype2==1}
[ЕГН] {$elem.param}
							{elseif $elem.idtype2==2}
[ЕИК] {$elem.param}
							{elseif $elem.idtype2==3}
[чужд] {$elem.param}
							{else}
?????
							{/if}
				<td class='sep'>&nbsp;
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
{*****
		<td class='sep'>&nbsp;</td>
<td> {$elem.creaname} {$elem.created|date_format:"%d.%m.%Y"} 
		<td class='sep'>&nbsp;</td>
<td> {$elem.lastname} {$elem.lastmodi|date_format:"%d.%m.%Y"}
*****}
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
{*****
			{if empty($elem.response)}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="#" onclick="toggle('{$elem.id}','{$elem.tose}');return false;"><img src="images/bg5.gif" title="към сървъра"></a>
			{else}
<a href="{$elem.resp}" class="nyroModal" target="_blank"><img src="images/word.gif" 
title="резултата от {$elem.resptime|date_format:"%d.%m.%Y"} в {$elem.resptime|date_format:"%H:%M:%S"}"></a>
			{/if}
*****}
			{if empty($elem.coderequ)}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
&nbsp;
<a href="{$elem.getcoderequ}" class="nyroModal" target="_blank"><img src="images/exclude.gif" title="получи номер на искането"></a>
			{else}
{$elem.coderequ}
			{/if}
</nobr>
{*
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if empty($elem.coderequ)}
&nbsp;
			{else}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="към сървъра"></a>
			{/if}
*}
{**}
{*---- сверка ----*}
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if $elem.vari==1}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="свери данните от сървъра"></a>
			{else}
				{if empty($elem.coderequ)}
&nbsp;
				{else}
да
				{/if}
			{/if}
{**}
{*---- сверка ----*}
{***
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if !empty($elem.coderequ)}
да
			{elseif $elem.vari==1}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="свери данните от сървъра"></a>
			{else}
&nbsp;
			{/if}
***}
{*
		<td class='sep'>&nbsp;</td>
			{if $elem.vari==2}
<td align=center>
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="създай вх/изх документи"></a>
			{else}
<td align=right>
				{if empty($elem.docuseri)}
&nbsp;
				{else}
{$elem.docuseri}/{$elem.docuyear}
				{/if}
			{/if}
*}
{*---- входящ номер ----*}
		<td class='sep'>&nbsp;</td>
			{if !empty($elem.docuseri)}
<td align=right> 
{$elem.docuseri}/{$elem.docuyear}
			{elseif $elem.vari==2}
<td align=center>
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="създай вх/изх документи"></a>
			{else}
<td>
&nbsp;
			{/if}
{*
		<td class='sep'>&nbsp;</td>
			{if $elem.vari==2}
<td align=center>
&nbsp;
			{else}
<td align=right>
				{if empty($elem.outseri)}
&nbsp;
				{else}
{$elem.outseri}/{$elem.outyear}
				{/if}
			{/if}
*}
{*---- изходящ номер ----*}
		<td class='sep'>&nbsp;</td>
<td align=right>
			{if !empty($elem.outseri)}
{$elem.outseri}/{$elem.outyear}
			{elseif $elem.vari==2}
&nbsp;
			{else}
&nbsp;
			{/if}
{*
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if $elem.vari==3}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="получи справката от сървъра"></a>
			{else}
				{if empty($elem.response)}
&nbsp;
				{else}
<a href="{$elem.resp}" class="nyroModal" target="_blank"><img src="images/word.gif" 
title="справката от {$elem.resptime|date_format:"%d.%m.%Y"} в {$elem.resptime|date_format:"%H:%M:%S"}"></a>
				{/if}
			{/if}
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if $elem.vari==4}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="получи фактурата от сървъра"></a>
			{else}
&nbsp;
			{/if}
*}
{*---- справка ----*}
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if !empty($elem.response)}
<a href="{$elem.resp}" class="nyroModal" target="_blank"><img src="images/word.gif" 
title="отвори справката от {$elem.resptime|date_format:"%d.%m.%Y"} в {$elem.resptime|date_format:"%H:%M:%S"}"></a>
<a href="{$elem.sec3}" class="nyroModal" target="_blank"><span class="tose" title="получи справката след анулиране">&raquo;</span></a>
			{elseif $elem.vari==3}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="получи справката от сървъра"></a>
			{else}
&nbsp;
			{/if}
{*---- фактура ----*}
		<td class='sep'>&nbsp;</td>
<td align=center>
			{if $elem.isinvo==0}
&nbsp;
			{elseif $elem.vari==4}
<a href="{$elem.code}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="получи фактурата от сървъра"></a>
			{elseif $elem.vari==5}
<span class="pdfview" title="виж фактурата" onclick="parent.fuprin('{$elem.pdfview}');">
виж</span>
<a href="{$elem.sec4}" class="nyroModal" target="_blank"><span class="tose" title="получи фактурата повторно">&raquo;</span></a>
			{else}
&nbsp;
			{/if}
		{/foreach}
		</tbody>

	{include file="_pagina.tr.tpl"}
		
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$("[@rela='ttip']").cluetip({ldelim} width: 400, cursor:'help' {rdelim});
{rdelim});
{*
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
*}

function autorequ(event,obform){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13 && $("#requ").attr("value")!=""){ldelim}
			lipara= {ldelim}requ:$("#requ").attr("value"){rdelim};
			jQuery.ajax({ldelim}
				url: "{$TRANCODETO}"
				,data: lipara
				,type: "post"
				,success: furequ
			{rdelim})
	{rdelim}
{rdelim}
function furequ(data){ldelim}
	$.nyroModalManual({ldelim}url:data,forceType:'iframe'{rdelim});
{rdelim}
</script>
