{*
<style>
.he7 {ldelim}font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;{rdelim}
.ro7 {ldelim}font: normal 7pt verdana !important; border-bottom: 1px solid black !important;{rdelim}
.ertype {ldelim}background-color:lightsalmon;cursor:help;{rdelim}
</style>
*}
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
{*
function tocase(p1){ldelim}
alert("func="+p1);
	$("#tocase").attr("href",p1).click();
return false;
{rdelim}
*}
</script>
{*
<a id="tocase" href="#" class="nyroModal" target="_blank" style="display:none">
*}

{*----
<table class="d_table" width='100%' cellspacing='0' cellpadding='0' align=center>
----*}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
	<thead>
{*----
		<tr>
			<td class='d_table_title' colspan='200'>изходящи документи</td>
		</tr>
						{if $FLAGNOCHANGE}
						{else}
		<tr>
			<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			</td>
		</tr>
						{/if}
----*}
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
изходящи документи
</div>
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t6link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
<a href="caseeditzone.php{$ADDNEWFILE}" class="nyroModal" target="_blank">
<img src="images/up.gif" title="качи самостоятелен файл">
</a>
<a href="caseeditzone.php{$DIREADD}" class="nyroModal" target="_blank">
<img src="images/adda.gif" title="добави директно">
</a>
</div>
			{/if}
		</tr>
{*--------*}
	</thead>
	<tbody id="myta">
		<tr class='header'>
<td> изх.номер </td>
			<td class='sep'>&nbsp;</td>
<td> създаден </td>
			<td class='sep'>&nbsp;</td>
<td> тип </td>
			<td class='sep'>&nbsp;</td>
<td> адресат </td>
			<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
{*----
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
----*}
				{if $FLAGNOCHANGE}
				{else}
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
				{/if}
{*---- образ ----*}
			<td class='sep'>&nbsp;</td>
<td>образ
{*---- връчване ----*}
			<td class='sep'>&nbsp;</td>
<td>връч
		</tr>
		{foreach from=$LIST item=elem key=ekey}
{*
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
*}
							{if $elem.regigroup==0}
									{assign var=bgco value=""}
									{assign var=exta value=""}
									{assign var=onic value=""}
											{assign var=come value=true}
							{else}
								{if $elem.serial==0}
									{assign var=bgco value="darkkhaki"}
									{assign var=exta value=""}
									{assign var=onic value="отвори"}
											{assign var=come value=false}
								{else}
									{assign var=bgco value="khaki"}
									{assign var=exta value="rela='g"|cat:$elem.regigroup|cat:"' style='display:none'"}
									{assign var=onic value=""}
											{assign var=come value=false}
								{/if}
							{/if}
{*
			<tr class="myrow" bgcolor="{$bgco}" {$exta}>
*}
<tr class="myrow" bgcolor="{$bgco}" {$exta} 
											{if $come}
{*
oncontextmenu="alert('CONT');tocase('caseeditzone.php{$elem.tocase}'); return false;"
*}
oncontextmenu="$.nyroModalManual({ldelim}url:'caseeditzone.php{$elem.tocase}',forceType:'iframe'{rdelim});return false;"
											{else}
oncontextmenu="return false;"
											{/if}
>
										{assign var=grel value=$GRLIST[$elem.regigroup]}
{*
<td>{$exta}
					{if isset($GRLIST[$elem.regigroup])}
			<td class="contleft"> {$GRLIST[$elem.regigroup].min}-{$GRLIST[$elem.regigroup].max}/{$GRLIST[$elem.regigroup].year}
*}
<td class="contleft"> 
					{if $elem.serial==0}
						{if empty($grel)}
	&nbsp;
						{else}
	{$grel.min}-{$grel.max}/{$grel.year}
						{/if}
					{else}
<nobr>
	{$elem.serial}/{$elem.year}
{if $elem.iduserregi==0}
{else}
	<img style="cursor:help" src="images/info.gif" title="изходен от {$elem.userregi} на {$elem.registered|date_format:"%d.%m.%Y"}">
{/if}
{if empty($elem.notes)}
{else}
	<img style="cursor:help" src="images/view.png" title="бележки: {$elem.notes}">
{/if}
</nobr>
					{/if}
			<td class='sep'>&nbsp;</td>
<td class="contleft"> 
	{$elem.created|date_format:"%d.%m.%Y"}
						{*
						{if empty($grel) or $elem.serial==0}
	{$elem.created|date_format:"%d.%m.%Y"}
						{else}
	&nbsp;
						{/if}
						*}
			<td class='sep'>&nbsp;</td>
<td class="contleft"> {if empty($elem.typetext)}<font color=blue>{$elem.descrip}</font>{else}{$elem.typetext}{/if}
{*----
<td class="contleft"> {if empty($elem.contword)}{else}<font color=red><b>W</b></font>&nbsp;{/if}{$elem.typetext}
----*}
			<td class='sep'>&nbsp;</td>
<td class="contleft"> {if empty($grel) or $elem.serial<>0}{$elem.adresat}{else}{$grel.coun} броя{/if}

			<td class='sep'>&nbsp;</td>

														{*---- ГЛОБАЛЕН ФЛАГ - наблюдател ----*}
														{if $smarty.session.VIEWFLAG_FINANOEDIT}
<td colspan=5> &nbsp;
{if empty($elem.content) and empty($elem.contword)}
{else}
	{if $FLAGNOCHANGE}
		{if empty($onic)}
		{else}
<span style="border-bottom:1px solid black;cursor:pointer;" 
id="g{$elem.regigroup}" onclick="tog2('g{$elem.regigroup}');">отвори</span>
</td>
		{/if}
	{else}
		{if empty($onic)}
		{else}
{*
<td colspan=5>
<span style="border-bottom:1px solid black;cursor:pointer;" 
id="g{$elem.regigroup}" onclick="tog2('g{$elem.regigroup}');">отвори</span>
</td>
*}
		{/if}
	{/if}
{/if}
														{else}

{if empty($elem.content) and empty($elem.contword)}
		{if empty($elem.filename)}
<td colspan=7> <font color=red> празен документ </font>
				<a href="caseeditzone.php{$elem.uplo}" class="nyroModal" target="_blank">
				<img src="images/up.gif" title="качи файл">
				</a>
		{else}
<td colspan=7> 
				<a href="caseeditzone.php{$elem.uplo}" class="nyroModal" target="_blank">
				<img src="images/up.gif" title="качи файл">
				</a>
{*----
				<a href="caseeditzone.php{$elem.down}" class="nyroModal" target="_blank">
				<img src="images/down.gif" title="свали файла">
				</a>
----*}
<img src="images/down.gif" title="свали файла" style="cursor:pointer" onclick="fuprin('{$elem.down}');">
				<a href="caseeditzone.php{$elem.defi}" class="nyroModal" target="_blank">
				<img src="images/delefile.gif" title="изтрий файла">
				</a>
<font color=blue> {$elem.filename} </font>
		{/if}
{else}
			<td>
										{if $elem.regigroup<>0 and $elem.serial==0}
											{assign var=imgtit value="отпечати всички"}
											{assign var=imgsrc value="printmult.gif"}
											{assign var=ellink value=$elem.mult}
										{else}
											{assign var=imgtit value="отпечати"}
											{assign var=imgsrc value="print.gif"}
											{assign var=ellink value=$elem.prnt}
										{/if}
							{if $elem.suff=="html"}
								{if $elem.regigroup<>0 and $elem.serial==0}
<img src="images/{$imgsrc}" title="{$imgtit}" style="cursor:pointer" onclick="fuprin('{$ellink}');">
								{else}
<a href="caseeditzone.php{$ellink}" class="nyroModal" target="_blank">
<img src="images/{$imgsrc}" title="{$imgtit}">
</a>
								{/if}
							{else}
								{if $elem.regigroup<>0 and $elem.serial==0}
<a href="file:///{$LETDOC}:/{$elem.regigroup}group.doc" target="_blank"><img src="images/{$imgsrc}" title="{$imgtit}" style="cursor:pointer; border: 0px;"></a>
								{else}
								{/if}
							{/if}
						{if $FLAGNOCHANGE}
						{else}
			<td class='sep'>&nbsp;</td>
											{*---- ОБИКНОВЕН РЕД - 3 отделни колони - корегирай, изведи, изтрий ----*}
											{if empty($onic)}
											{*----------------------------------------------------------*}
			<td>
							{if $elem.suff=="html"}
				<a href="caseeditzone.php{$elem.docu}" class="nyroModal" target="_blank">
				<img src="images/edit.png" title="корегирай">
				</a>
							{else}
				<a href="file:///{$LETDOC}:/{$elem.id}.doc" target="_blank">
				<img src="images/word.gif" title="корегирай/изведи">
				</a>
							{/if}
					&nbsp;

			<td class='sep'>&nbsp;</td>
			<td>
					{if $elem.serial==0 and $elem.izho}
				<a href="caseeditzone.php{$elem.regi}" class="nyroModal" target="_blank">
				<img src="images/regi.gif" title="изведи">
				</a>
					{else}
					&nbsp;
					{/if}

			<td class='sep'>&nbsp;</td>
			<td>
					{if $elem.serial==0}
{*
				<a href="caseeditzone.php{$elem.dele}" class="nyroModal" target="_blank">
				<img src="images/free.gif" title="изтрий">
				</a>
*}
<img src="images/free.gif" title="изтрий" style="cursor:pointer;" onclick="dele('caseeditzone.php{$elem.dele}');">
{*---- ----------------------- ----*}
					{else}
					&nbsp;
					{/if}
											{*---- ГРУПОВ РЕД - обединяваме 3-те колони ----*}
											{else}
											{*----------------------------------------------------------*}
<td colspan=5>
<span style="border-bottom:1px solid black;cursor:pointer;" 
id="g{$elem.regigroup}" onclick="tog2('g{$elem.regigroup}');">отвори</span>
</td>
											{*---- край ОБИКНОВЕН/ГРУПОВ РЕД ----*}
											{/if}
						{/if}
{/if}
														{/if}
{*---- образ ----*}
		<td class='sep'>&nbsp;</td>
<td align=left>
											{if empty($onic)}
<nobr>
<a href="caseeditzone.php{$elem.scanuplo}" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
					{assign var=iddocu value=$elem.id}
					{assign var=scancoun value=$ARSCANCOUN[$iddocu]}
		{if $scancoun==0}
&nbsp;
		{else}
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('caseeditzone.php{$elem.scanview}','win2');w2.focus();">
			{if $scancoun==1}
			{else}
<sup>{$ARSCANCOUN[$iddocu]}</sup>
			{/if}
		{/if}
</nobr>
											{else}
											{/if}
{*---- връчване ----*}
		<td class='sep'>&nbsp;</td>
											{if empty($onic)}
{include file="deliinfo.ajax.tpl" iddocu=$iddocu}
											{else}
<td>&nbsp;
											{/if}
		{/foreach}
			
	</tbody>
			</table>

{*---- за връчването ----*}
{include file="deliinfobase.ajax.tpl" ISTTIP=false}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
{*---- 15.07.2009 за формиране на doc файлове вместо прозорец NyroModal ----*}
<center>
<iframe id="frarep" width=520 height=40 frameborder=0 scrolling=no style="display:block"></iframe>
</center>
<script>
function fuprin(p1){ldelim}
	document.getElementById("frarep").src= "caseeditzone.php"+p1;
{rdelim}
function tog2(idgr){ldelim}
//alert(idgr);
//alert($("#"+idgr).text());
	var flshow;
	if ($("#"+idgr).text()=="отвори"){ldelim}
		$("#"+idgr).text("затвори");
		flshow= true;
	{rdelim}else{ldelim}
		$("#"+idgr).text("отвори");
		flshow= false;
	{rdelim}
	$(".myrow").each(function(){ldelim}
		if ($(this).attr("rela")==idgr){ldelim}
			if (flshow){ldelim}
				$(this).show();
			{rdelim}else{ldelim}
				$(this).hide();
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim});
{rdelim}
function dele(link){ldelim}
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на изходящия документ');
	if (resu){ldelim}
		jQuery.ajax({ldelim}
			url: link
			,success: function(data){ldelim}
					if (data=="ok"){ldelim}
$('#t6link').click();
					{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
					{rdelim}
			{rdelim}
		{rdelim});
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
$(document).ready(function() {ldelim}
	$("[@rela='ttip']").cluetip({ldelim} width: 460, cursor:'help' {rdelim});
{***
	$('.deliinfo').cluetip({ldelim} width: 460, local:true, cursor:'pointer' {rdelim});
***}
	$('.deliinfo').cluetip({ldelim} width: 660, cursor:'help' {rdelim});
{rdelim});
</script>
