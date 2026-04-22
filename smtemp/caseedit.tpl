{*----
={$EDIT}={$MAINPLAN}=
----*}
			{if $FLAGNOCHANGE}
{assign var="scname" value="caseeditzoneno.php"}
				{if $FLAGYESSTAT}
{include file="_tabslist.tpl" LINK=$GOOUT}
				{else}
				{/if}
			{else}
{assign var="scname" value="caseeditzone.php"}
				{if $FLAGNOTABS}
				{else}
{include file="_tabslist.tpl" LINK=$GOOUT}
				{/if}
			{/if}

				{*---- статуса за основ.данни - брояч ----*}
{*----
<span id="region1" style="visibility: hidden">
----*}
<span id="region1" style="display: none">
{*---- 
		ВНИМАНИЕ. 
		Съобщението винаги се извиква чрез caseeditzone.php, никога чрез caseeditzoneно.php - според $FLAGNOCHANGE
<a class="ajaxify" id="tbaselink" href="caseeditzone.php{$URLLIS.base}" target="#tbase"> notfull </a>
		ВЕЧЕ НЕ !
----*}
<a class="ajaxify" id="tbaselink" href="{$scname}{$URLLIS.base}" target="#tbase"> notfull </a>
{*--------*}
<a class="ajaxify" id="t1link" href="{$scname}{$URLLIS[1]}" target="#t1"> var.1 </a>
<a class="ajaxify" id="t2link" href="{$scname}{$URLLIS[2]}" target="#t2"> var.2 </a>
<a class="ajaxify" id="t3link" href="{$scname}{$URLLIS[3]}" target="#t3"> var.3 </a>
<a class="ajaxify" id="t4link" href="{$scname}{$URLLIS[4]}" target="#t4"> var.4 </a>
<a class="ajaxify" id="tpaymlink" href="{$scname}{$URLLIS.paym}" target="#tpaym"> payments </a>
					{*---- януари-2010 актуален дълг ----*}
					<a class="ajaxify" id="tactulink" href="{$scname}{$URLLIS.actu}" target="#tactu"> actu.debt </a>
<a class="ajaxify" id="t5link" href="{$scname}{$URLLIS[5]}" target="#t5"> var.5 </a>
<a class="ajaxify" id="t6link" href="{$scname}{$URLLIS[6]}" target="#t6"> var.6 </a>
{*---- 07.07.2009 финансов баланс [погасяване] ----*}
{*----
<a class="ajaxify" id="t7link" href="{$scname}{$URLLIS[7]}" target="#t7"> var.7 </a>
----*}
{*---- 07.08.2009 извадка от журнала - дневник на изв.действия ----*}
<a class="ajaxify" id="tjourlink" href="{$scname}{$URLLIS.jour}" target="#tjour"> journal </a>
{*---- 22.11.2010 сметки ----*}
<a class="ajaxify" id="tbilllink" href="{$scname}{$URLLIS.bill}" target="#tbill"> сметки </a>
{*---- 12.03.2010 зона-бележки и зона-събития ----*}
<a class="ajaxify" id="tnotelink" href="{$scname}{$URLLIS.note}" target="#tnote"> бележки </a>
<a class="ajaxify" id="tevenlink" href="{$scname}{$URLLIS.even}" target="#teven"> събития </a>
{*---- 18.07.2010 аванс.вноски от взиск. ----*}
<a class="ajaxify" id="tadvalink" href="{$scname}{$URLLIS.adva}" target="#tadva"> аванс.вноски </a>
</span>

<table align=center>

{*---- 07.04.2010 специално за НЕделоводители по филтър ----*}
				{if $FLAGBACK}
<tr><td colspan=10 align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> назад към списъка </a>
				{else}
				{/if}

{*----
			{if $FLAGNOCHANGE}
----*}
				{if isset($PAGEBACKLINK)}
<tr><td colspan=10 align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> {$PAGEBACKTEXT} </a>
{*----
	{if isset($PAGEDATACASE)}
<div style="font: normal 8pt verdana;" align=right> <b>дело {$PAGEDATACASE.serial}/{$PAGEDATACASE.year}</b> </div>
	{else}
	{/if}
----*}
				{else}
				{/if}
			{if $FLAGNOCHANGE or $FLAGNOTABS}
<tr><td colspan=10 align=left>
<div id="caseheader" style="font: normal 8pt verdana;" align=right></div>
			{else}
			{/if}
{*----
			{else}
			{/if}
----*}

									{*---- според общия план - за смяната виж _tabslist.tpl *}
{*----
									{if $smarty.session.mainplan[$EDIT]=="var1"}
----*}
									{if $MAINPLAN=="var1"}

{*------------------------ стар вариант ------------------------------*}

<tr><td>
								
	<table width=100%>
				{*---- статуса за основ.данни - брояч ----*}
				<tr>
<td colspan=20 id="tbase" class="tdzone" valign=top align=left> непълни
{*
	<tr>
<td id="t1" class="tdzone" valign=top align=left> основни
<td width=4>
<td id="t3" class="tdzone" valign=top align=left> взискатели
<td width=4>
<td id="t4" class="tdzone" valign=top align=right> длъжници
*}
	<tr>
<td id="t1" class="tdzone" valign=top align=left rowspan=2> основни
<td width=4 rowspan=2>
<td id="t3" class="tdzone" valign=top align=left> взискатели
<td width=4>
<td id="t4" class="tdzone" valign=top align=right> длъжници
<td width=4>
<td id="tadva" class="tdzone" valign=top align=left> аванс.вноски
	<tr>
<td id="tnote" class="tdzone" valign=top align=left> бележки
<td width=4>
<td id="teven" class="tdzone" valign=top align=left> събития
	</table>

{*---- 07.07.2009 финансов баланс [погасяване] ----*}
{*----
<tr><td>
	<table align=left>
	<tr>
<td id="t7" class="tdzone" valign=top align=left> баланс
	</table>
----*}
{*----------------*}

<tr><td>
	<table width=100%>
	<tr>
<td id="t2" class="tdzone" valign=top align=right> предмет
<td width=4>
{*----
<td id="tpaym" class="tdzone" valign=top align=right> плащания
----*}
					{*---- януари-2010 актуален дълг ----*}
<td class="tdzone" valign=top align=right> 
<div id="tpaym"> плащания </div>
					<br>
					<div id="tactu">актуален дълг</div>
{*---- 07.07.2009 финансов баланс [погасяване] ----*}
<tr><td>
{*----
<a class="payofflink" id="t7link" href="#" onclick="t7link(); return false;"> преизчисли погасяването </a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a class="payofflink" id="t7open" href="#" onclick="t7open(); return false;" style="display:none;"> отвори погасяването </a>
<a class="payofflink" id="t7clos" href="#" onclick="t7clos(); return false;" style="display:none;"> затвори погасяването </a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a class="payofflink" id="t7show" href="#" onclick="t7show(); return false;" style="display:none;"> подробно </a>
<a class="payofflink" id="t7hide" href="#" onclick="t7hide(); return false;" style="display:none;"> кратко </a>
----*}
{include file="caseeditpoff.tpl"}

<tr><td colspan=8>
<span align=left id="t7" class="tdzone" valign=top align=left style="display: none;"> погасяване </span>
{*----------------*}
	</table>
<tr><td>
	<table width=100%>
	<tr>
<td id="t5" class="tdzone" valign=top align=left> входящи
<td width=4>
<td id="t6" class="tdzone" valign=top align=right> изходящи
	</table>

{*---- 07.08.2009 извадка от журнала - дневник на изв.действия ----*}
<tr><td>
	<table width=100%>
	<tr>
<td id="tjour" class="tdzone" valign=top align=left> изв.дейст.
<td width=4>
{*---- 22.11.2010 сметки ----*}
<td id="tbill" class="tdzone" valign=top align=left> сметки
	</table>
									
									{else}

{*------------------------ нов вариант ------------------------------*}
<tr><td align=left> 

						<table>
						<tr>
						<td align=left valign=top>
<div id="tbase">непълни</div>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
			<table cellspacing=0 cellpadding=0>
			<tr>
			<td align=left valign=top rowspan=3>
<div id="t1">основни</div>
			<td align=left valign=top rowspan=3>
&nbsp;
			<td align=left valign=top>
<div id="t3">взискатели</div>
			<tr>
			<td align=left valign=top>
<div id="t4">длъжници</div>
			<tr>
			<td align=left valign=top>
<div id="tadva">аванс.вноски</div>
			</table>
{*---- 12.03.2010 зона-бележки и зона-събития ----*}
			<table cellspacing=0 cellpadding=0>
			<tr>
			<td align=left valign=top bgcolor="#dddddd">
<div id="tnote" alte="ALTE">бележки</div>
{include file="_cazoalte.tpl" P1="tnotealte" P2="tnote" P3="бележки"}
			<td width=4>
			<td align=left valign=top bgcolor="#dddddd">
<div id="teven" alte="ALTE">събития</div>
{include file="_cazoalte.tpl" P1="tevenalte" P2="teven" P3="събития"}
			</table>
{*------------------------------------------------*}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t2" alte="ALTE">предмет</div>
{include file="_cazoalte.tpl" P1="t2alte" P2="t2" P3="предмет на изпълнение"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tpaym" alte="ALTE">постъпления</div>
{include file="_cazoalte.tpl" P1="tpaymalte" P2="tpaym" P3="постъпления"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tactu" alte="ALTE">акт.дълг</div>
{include file="_cazoalte.tpl" P1="tactualte" P2="tactu" P3="актуален дълг"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
{include file="caseeditpoff.tpl"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t7" style="display: none;">погасяване</div>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t5" alte="ALTE">входящи</div>
{include file="_cazoalte.tpl" P1="t5alte" P2="t5" P3="входящи документи"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t6" alte="ALTE">изходящи</div>
{include file="_cazoalte.tpl" P1="t6alte" P2="t6" P3="изходящи документи"}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tjour" alte="ALTE">действия</div>
{include file="_cazoalte.tpl" P1="tjouralte" P2="tjour" P3="извършени действия"}
{*---- 22.11.2010 сметки ----*}
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tbill" alte="ALTE">сметки</div>
{include file="_cazoalte.tpl" P1="tbillalte" P2="tbill" P3="сметки"}
						</table>

									{*---- КРАЙ според общия план ----*}
									{/if}

</table>

<script type="text/javascript">
var t7url= "{$scname}{$URLLIS[7]}";
</script>








<script type="text/javascript">
function toggle(paobje,paeven){ldelim}
var event= (paeven) ? paeven : window.event;
event.cancelBubble= true;
	var node, text= "";
	var pare;
	var obje= paobje;
	while (true){ldelim}
{*
niza= "";
for (prop in obje){ldelim}
			if (prop=="id"){ldelim}
	niza += prop+"="+obje[prop]+'/';
			{rdelim}else{ldelim}
			{rdelim}
			if (prop=="tagName"){ldelim}
	niza += prop+"="+obje[prop]+'/';
			{rdelim}else{ldelim}
			{rdelim}
//	niza += prop+'/';
{rdelim}
alert("niza="+niza);
//alert("IIIIID="+obje['id']);
*}
//		pare= obje.offsetParent;
//		pare= obje.parentElement;
//		pare= obje.parent;
		pare= obje.parentNode;
		if (pare){ldelim}
			obje= pare;
//alert("id="+obje.id);
			if ($(obje).attr("alte")){ldelim}
//alert("alte="+obje.alte);
//alert("alte="+$(obje).attr("alte"));
text= $(obje).attr("alte");
node= obje;
				break;
			{rdelim}else{ldelim}
			{rdelim}
		{rdelim}else{ldelim}
			break;
		{rdelim}
	{rdelim}
	if (text==""){ldelim}
	{rdelim}else{ldelim}
//node.innerHTML= text;
//$(node).html("<a href='#'>"+text+"</a>").bind("click",function(){ldelim}alert('AWECF');{rdelim});
//alert(node.id);
$(node).hide();
$("#"+$(node).attr("id")+"alte").show();
	{rdelim}
{rdelim}
function turnon(paobje,paid){ldelim}
	$(paobje).hide();
	$("#"+paid).show();
{rdelim}
</script>
