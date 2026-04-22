<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на входящите документи</td>
		</tr>
		<tr>
			<td class='d_table_button_center' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			</td>
		</tr>
	</thead>
	<tr class='header'>
		<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> кога </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
		<td> <span>деловодител</span></td>
		<td class='sep'>&nbsp;</td>
{*
		<td> редакция </td>
*}
<td> външ
		<td class='sep'>&nbsp;</td>
<td>&nbsp;
		<td class='sep'>&nbsp;</td>
<td>образ
							{if empty($USERPRIN)}
							{else}
		<td class='sep'>&nbsp;</td>
<td id="scanwaitcoun" align=center style="background:gold;cursor:pointer;font:bold 8pt verdana;" onclick="scanclic(1);">&nbsp;
							{/if}
	</tr>
	<tbody>
{foreach from=$LIST item=elem key=ekey}
{*----
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
----*}
	<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
		<td align=right> {$elem.serial}/{$elem.year}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.from}</td>
		<td class='sep'>&nbsp;</td>
{*----
<td> {$elem.notes|replace:";":"; "}
----*}
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

{include file="_docucase.tpl"}

		<td class='sep'>&nbsp;</td>
				{if $elem.idpost==0}
<td align=center> &nbsp;
				{else}
<td align=center style="cursor:help;" 
title="източник {$elem.exname}&#xA;метод {$ARPOSTTYPE_2[$elem.idposttype]}&#xA;адресат {$elem.adresat|escape:'html'}&#xA;адрес {$elem.address|escape:'html'}"> 
<font color=red>виж</font>
				{/if}
		<td class='sep'>&nbsp;</td>
		<td  align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
<td align=left>
<a href="{$elem.scanuplo}" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
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
							{if empty($USERPRIN)}
							{else}
		<td class='sep'>&nbsp;</td>
{*
								{if $elem.iduser==$smarty.session.iduser and $ARMASSSCANCOUN[$elem.id]==0}
*}
								{if $elem.iduser==$smarty.session.iduser}
<td align=center>
<img src="images/print.gif" title="отпечати етикет" style="cursor:pointer" onclick="plabel('{$elem.id}');">
								{else}
<td>&nbsp;
								{/if}
							{/if}
	</tr>

		{/foreach}
		</tbody>

	{include file="_pagina.tr.tpl"}
		
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.caselist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
												{*---- upload на сканиран файл ----*}
												{if isset($LINKDOCUUPLO)}
							$.nyroModalManual({ldelim}forceType:'iframe', url:'{$LINKDOCUUPLO}'{rdelim});
												{else}
												{/if}
							{if empty($USERPRIN)}
							{else}
						scanclic(0);
							{/if}
{rdelim});
							{if empty($USERPRIN)}
							{else}
function scanclic(isfull){ldelim}
window.fullacti= isfull;
window.countext= $("#scanwaitcoun").text();
	$("#scanwaitcoun").html("<img src='ajaxload.gif'>");
	jQuery.ajax({ldelim}
		url: "scan.inc.php?u={$smarty.session.iduser}"
		,success: scansu
		{rdelim});
{rdelim}
function scansu(data){ldelim}
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
		var coun= arre[1];
		if (coun=="0"){ldelim}
			$("#scanwaitcoun").text("").attr("title","провери за сканирани документи");
		{rdelim}else{ldelim}
			$("#scanwaitcoun").text(coun).attr("title","виж списъка със сканираните документи");
			if (window.fullacti==1 && window.countext!=""){ldelim}
				$.nyroModalManual({ldelim}forceType:'iframe', url:'{$SCANMASSLINK}'{rdelim});
			{rdelim}else{ldelim}
			{rdelim}
		{rdelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
							{/if}
var trcurr;
function trclic(obje){ldelim}
	if (trcurr){ldelim}
		trcurr.className= "";
	{rdelim}else{ldelim}
	{rdelim}
	obje.className= "trdocu";
	trcurr= obje;
{rdelim}

function plabel(iddo){ldelim}
	jQuery.ajax({ldelim}
		url: "scan.inc.php?d="+iddo
		,success: plabsu
		{rdelim});
{rdelim}
function plabsu(data){ldelim}
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>

{* include file='_frame.footer.tpl' *}
{ *include file="_pagina.tpl" *}

