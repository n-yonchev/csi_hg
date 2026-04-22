{include file="delihead.tpl"}

<br>
														{if isset($CONT3)}
{$CONT3}
														{else}
				
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на изх.документи и екземплярите за връчване
{*---- сортировка ----*}
{*
&nbsp;&nbsp;&nbsp;&nbsp;
{foreach from=$ARSORT item=txso key=inso}
	&nbsp;
	<span class="sort{if $inso==$SORT} sortcurr{else}{/if}"{include file="_href.tpl" LINK=$ARSORTLINK[$inso]}>{$txso}</span>
{/foreach}
*}
								{if $ISLIST}
				<div style="float:right" class="doinpu">
<a style="cursor:pointer;border-bottom:1px solid black;" href="#" onclick="delelist('{$LINKDELELIST}');"> изчисти списъка </a>
&nbsp;&nbsp;&nbsp;&nbsp;
					<form method="post" onsubmit="return false;"
					style="float:right;margin:0px 0px 0px 6px;padding:0px;width:auto;white-space:nowrap;">
добави изх.номер/год или #плик
<input type="text" name="doutinpu" id="doutinpu" size=16 autocomplete=off
style="font:normal 7pt verdana; border: 0px solid green;" onkeydown="autosubm8(event,this.form);">
+enter
					{if isset($ERDOUT)}
<font color=red>{$ERDOUT}</font>
					{else}
					{/if}
					</form>
				</div>
								{else}
								{/if}
				<tr class='head2'>
<td colspan=5> изходящ документ
<td>&nbsp;
<td colspan=14> екземпляри
				<tr class='head2'>
<td> номер
<td> тип
<td> дело
<td> деловодител
<td> образ
<td>&nbsp;
<td> изходен
<td> адресат
<td> адрес
<td> метод
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> бел
<td class="head3"> &nbsp;
<td class="head3"> <input class="cbox" type=checkbox name="cball" id="cball" onclick="cbtran($(this).attr('checked'));">
<td class="head3"> 417
<td class="head3"> свързан док.
<script>
function cbtran(flag){ldelim}
	if (flag){ldelim}
		$("input[@name='cbdeli[]']").attr("checked",true);
	{rdelim}else{ldelim}
		$("input[@name='cbdeli[]']").attr("checked",false);
	{rdelim}
{rdelim}
</script>

											{assign var=bgco value="*"}
{foreach from=$ARDOUT item=eldout key=iddout}
				{*
				<tr onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
				*}
				<tr>
											{if empty($bgco)}
												{assign var=bgco value="bgcolor='#dddddd'"}
											{else}
												{assign var=bgco value=""}
											{/if}
				{assign var=docoun value=$ARPOSTCOUN[$iddout]}
				{assign var=rs2 value="rowspan="|cat:$docoun}
<td {$bgco} {$rs2} class="spec" title="{$iddout}">
<nobr>
{$eldout.d2seri}/{$eldout.d2year}
				<a href="file:///{$LETDOC}:/{$iddout}.doc" target="_blank">
				<img src="images/word.gif" title="корегирай/изведи">
				</a>
</nobr>
<td {$bgco} {$rs2} class="spec" title="{$eldout.d2text}"> {$eldout.d2text|truncate:30:"...":true}
					{if empty($eldout.caseri)}
<td {$bgco} {$rs2} class="spec"> 
&nbsp;
					{else}
<td {$bgco} {$rs2} class="case" {include file="_href.tpl" LINK=$eldout.tocase} title="виж изх.документи по делото"> 
{$eldout.caseri}/{$eldout.cayear}
					{/if}
<td {$bgco} {$rs2} class="spec"> {$eldout.username}
		{*---- качи образ ----*}
<td {$bgco} {$rs2} class="spec">
<nobr>
<a href="{$eldout.scanuplo}" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
{*
[{$iddout}]
*}
		{* от телефон *}
{*
<a href="{$eldout.a1scan}" class="nyroModal" target="_blank"><img src="images/clone.gif" title="снимай от телефон"></a>
*}
					{assign var=iddocu value=$eldout.iddout}
					{assign var=scancoun value=$eldout.coundout}
		{*---- списък образи ----*}
		{if $scancoun==0}
&nbsp;
		{else}
<img src="images/tranclos.gif" style="cursor:pointer" title="изображения за {$eldout.d2text} {$eldout.d2seri}/{$eldout.d2year}" 
onclick="w2=window.open('{$eldout.scanview}','win2');w2.focus();">
			{if $scancoun==1}
			{else}
<sup class="fon7">{$scancoun}</sup>
			{/if}
		{/if}
</nobr>
		{* разделител *}
<td {$rs2} class="spec">&nbsp;
				{assign var=isfirst value=true}
	{foreach from=$ARPOST[$iddout] item=elpost key=idpost}
				{if $isfirst}
				{else}
					<tr>
				{/if}
{*
<td class="fon7 mark" title="{$elpost.created|date_format:"%d.%m.%Y %H:%M:%S"} от {$elem.postuser}"> {$elpost.created|date_format:"%H:%M:%S"}
*}
<td {$bgco} class="fon7 mark" title="{$elpost.created|date_format:"%d.%m.%Y %H:%M:%S"} от {$elpost.postuser}"> {$elpost.created|date_format:"%d.%m.%Y"}
{*
[{$idpost}][{$elpost.idpp}]
*}
<td {$bgco}> {$elpost.adresat}&nbsp;
<td {$bgco}> {$elpost.address}&nbsp;
<td {$bgco}> {$ARPOSTTYPE_2[$elpost.idposttype]}&nbsp;
			{*---- 18.10.2018 призовкар - името ----*}
			{*
			{if $elpost.idposttype==$DELITYPE2}
<br> <nobr><font color=red>{$ARUSERPOST[$elpost.idus2]}</font></nobr>
			{else}
			{/if}
			*}
<td {$bgco} class="fon7"> {$elpost.date1|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} class="fon7"> {$elpost.date2|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} class="fon7"> {$elpost.date3|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} {if $elpost.isertype}class="ertype" title="статуса не отговаря на метода"{else}{/if}> {$elpost.statname}&nbsp;
<td {$bgco} class="ctip" align=center style="cursor:pointer"
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$elpost.postnote}'{rdelim});"
rel="#note{$idpost}" title="бележки"> 
					{if empty($elpost.notes)}
-
					{else}
<img src="images/info.gif">
					{/if}
</td>
<span id="note{$idpost}" style="display: none">
			{if empty($elpost.notes)}
няма бележки
			{else}
{$elpost.notes|nl2br}
			{/if}
<hr>
<font color=blue>клик за корекция</font>
</span>
{*
				{if $elpost.isertype}
EEE[{$elpost.idposttype}][{$elpost.pstype}]
				{else}
				{/if}
*}
		{*---- икони ----*}
<td>
<nobr>
{*
									{if $elpost.nopostdata}
<a href="{$elpost.postedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			{if $elpost.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdubl} title="дублирай екземпляра"> 
			{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdele} title="изтрий дублирания екземпляр"> 
			{/if}
									{else}
									{/if}
*}
			{if $elpost.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdubl} title="дублирай екземпляра"> 
			{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdele} title="изтрий дублирания екземпляр"> 
			{/if}
									{if $elpost.nopostdata}
<a href="{$elpost.postedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
									{else}
									{/if}
&nbsp;
</nobr>
		{*---- чекбокс ----*}
<td align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="{$idpost}" id="{$idpost}">
		{*---- чл.417 ----*}
{*
{if $isfirst}F{else}nf{/if}
*}
			{if $isfirst}
<td {$bgco} {$rs2} align=center class="head2" style="cursor:help;"
onmouseover="this.style.backgroundColor='aquamarine';" onmouseout="this.style.backgroundColor='';"
title="дело {$eldout.d2seri}/{$eldout.d2year} &#013;идва от {$eldout.rsname} &#013;
титул {$ARTITU[$eldout.casetitu]} &#013;подтитул {$ARSUBT[$eldout.casesubt]} &#013;тип {$eldout.d2text}">
<span style="{if $eldout.isinterest==0}{else}background-color:orange !important;{/if}"> 
&nbsp;&diams;&nbsp;</span>
{*
<td {$rs2} align=center class="head2" style="cursor:help;{if $eldout.isinterest==0}{else}background-color:orange !important;{/if}"
title="идва от {$eldout.rsname} &#013;титул {$ARTITU[$eldout.casetitu]} &#013;подтитул {$ARSUBT[$eldout.casesubt]} &#013;тип {$eldout.d2text}"> &diams;
*}
			{else}
			{/if}
{*
<td align=center class="head2" style="cursor:help;{if $eldout.isinterest==0}{else}background-color:orange !important;{/if}"
title="идва от {$eldout.rsname} &#013;титул {$ARTITU[$eldout.casetitu]} &#013;подтитул {$ARSUBT[$eldout.casesubt]} &#013;тип {$eldout.d2text}"> &diams;
*}
		{*---- свързан изх.документ ----*}
<td {$bgco} class="head2 fon7"> 
	{if $eldout.isinterest==0}
		{* основен запис - НЕ Е ПДИ_чл.417 *}
					{assign var=idpp value=$elpost.idpp}
					{assign var=ropd value=$ARPP[$idpost]}
		{if empty($ropd)}
&nbsp;
		{else}
			{* основен запис - ПридрПисмо, свързан - ПДИ_чл.417 *}
ПДИ {$ropd.doutseri}/{$ropd.doutcrea|date_format:"%d.%m.%Y"}
{$ARPOSTTYPE[$ropd.idmeth]}
		{/if}
	{else}
		{* основен запис - ПДИ_чл.417, свързан - ПридрПисмо *}
		{if empty($elpost.p2id)}
			{if $elpost.idpoststat==0}
<span style="cursor:help;" title="може да формирате ПП след връчване">п</span>
			{else}
<a href="{$elpost.creapp}" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="формирай придруж.писмо"></a>
			{/if}
		{else}
ПП {$elpost.doutseri}/{$elpost.doutcrea|date_format:"%d.%m.%Y"}
{$ARPOSTTYPE[$elpost.idmeth]}
		{/if}
	{/if}
{***
					{if empty($elem.dout)}
						{if $eldout.isinterest==0}
&nbsp;
						{else}
<a href="{$elem.creapp}" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="формирай придруж.писмо"></a>
						{/if}
					{else}
						{if $elem.iddocutype==$BPTYPEPP}
							{if empty($elem.dout)}
??????
							{else}
ПДИ {$elem.dout}
{include file="bpdatapp.inc.tpl" PARA=$elem.idmeth}
<img src="images/tranclos.gif" style="cursor:pointer" title="изображения за ПДИ {$elem.dout}" onclick="w2=window.open('{$elem.scanview2}','win2');w2.focus();">
							{/if}
						{else}
ПП {$elem.dout}
{include file="bpdatapp.inc.tpl" PARA=$elem.idmeth}
						{/if}
					{/if}
***}
					{assign var=isfirst value=false}
	{/foreach}
{/foreach}
{include file="_tab2pagi.tpl"}
				<tr>
<td colspan=20>
	<div style="float:right">
	само в маркираните документи
<br>
<div class="link butt" onclick="fubegi('{$LINKEDIT}');"> корегирай полета </div>
<div class="link butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </div>
	</div>
{*
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKEDIT}');"> корегирай полета </button>
<br>
в маркираните документи
	</div>
	<div style="float:right">
&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </button>
<br>
в маркираните документи
	</div>
*}

				</table>
														{*---- {if isset($CONT3)} ----*}
														{/if}
{include file="deli.inc.tpl"}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
function delelist(link){ldelim}
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на целия списък');
	if (resu){ldelim}
		document.location.href= link;
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
function autosubm8(event,form){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
form.submit();
	{rdelim}else if(code==17 || code==74){ldelim}
		event.preventDefault();
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
$(document).ready(function() {ldelim}
	$('.ctip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
								{if $ISLIST}
	$("#doutinpu").focus();
								{else}
								{/if}
{rdelim});
</script>

