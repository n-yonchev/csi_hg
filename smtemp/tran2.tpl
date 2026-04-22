{include file="_tab2.tpl"}
<style>
.over {ldelim}cursor:pointer;background-color:aqua;{rdelim}
.curr {ldelim}cursor:pointer;background-color:wheat;padding:4px;border: 1px solid silver;{rdelim}
.vari {ldelim}cursor:pointer;padding:4px;border: 1px solid silver;{rdelim}
.coun {ldelim}font:normal 16pt verdana;padding-right:8px;{rdelim}
.dire {ldelim}cursor:pointer;background-color:wheat;{rdelim}
.cluehead {ldelim}font:normal 8pt verdana; background-color:silver;{rdelim}
.cluero {ldelim}font:normal 8pt verdana; border-bottom:1px solid silver;{rdelim}
.banklink {ldelim}font:normal 7pt verdana;cursor:pointer;padding:0px 4px 0px 4px;border-bottom:1px solid black;color:black;{rdelim}
.usna {ldelim}font:normal 7pt verdana !important;{rdelim}
.bankcurr {ldelim}background-color:#dddddd;{rdelim}
.date {ldelim}font:bold 7pt verdana !important;background-color:lightcyan;{rdelim}
.ext2 {ldelim}background-color:#dddddd;padding-left:8px;padding-right:8px;{rdelim}
{*
.coun {ldelim}font:normal 14pt verdana;{rdelim}
.mini {ldelim}font:normal 7pt verdana;{rdelim}
.toin {ldelim}font:normal 7pt verdana;cursor:pointer;padding:0px 8px 0px 8px;color:black;background-color:lightgreen;{rdelim}
*}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

										<table align=center>
										<tr>
														{if $ISPERM}
										<td valign=top>

{*---- разпределения за превод  ----*}
										<td width=20> &nbsp;
														{else}
														{/if}
										<td valign=top>

{*---- списък с филтри ----*}
							{if isset($ARSCEN)}
<table align=center cellspacing=1 cellpadding=0>
			{foreach from=$ARSCEN item=elem key=ekey}
									{if $elem=="=0"}
<tr><td class="mini ext2"> всички
<td width=10><td>
									{elseif $elem=="=0end"}
</tr>
									{elseif $elem=="=1"}
<tr><td class="mini ext2"> готови за описи
<td width=10><td>
				{foreach from=$ARV2LINKINVE item=eleminve key=ekeyinve}
<nobr>
<span class="{if $ekeyinve==$V2}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$eleminve.link}> 
{$eleminve.text} [{$eleminve.coun}] </span>
&nbsp;
</nobr>
				{/foreach}
									{elseif $elem=="=1end"}
</tr>
									{elseif $elem=="=2"}
<tr><td class="mini ext2"> други готови
<td width=10><td>
									{elseif $elem=="=2end"}
</tr>
									{else}
										{if $ARV2LINK.$elem.coun==0}
										{else}
											{if $elem==$INDXPROB}
												{assign var=elemclas value="prob2"}
											{else}
												{assign var=elemclas value="vari2"}
											{/if}
<nobr>
<span class="{if $elem==$V2}curr2{else}{$elemclas}{/if}" {include file="_href.tpl" LINK=$ARV2LINK.$elem.link}> 
{$ARV2LINK.$elem.text} [{$ARV2LINK.$elem.coun}] </span>
&nbsp;
</nobr>
										{/if}
									{/if}
			{/foreach}
</table>
<br>
							{else}
							{/if}

		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
{*
<div style="float:left">списък на сумите за превод {$HEADTX}
*}
<div style="float:left">списък на {$HEADTX}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
{***
							{if isset($ARV2COUN)}
			{foreach from=$ARV2COUN item=elem key=ekey}
									{if $elem.text=="**"}
<br> <span class="mini"> готови за описи : </span>
									{else}
<sup>
<span class="{if $ekey==$V2}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$elem.link}> 
{$elem.text} [{$elem.coun}] </span>
</sup>&nbsp;
									{/if}
			{/foreach}
***}			
{*****
							{if isset($ARSCEN)}
			{foreach from=$ARSCEN item=elem key=ekey}
									{if $elem=="=0"}
<div style="float:left"><nobr> 
									{elseif $elem=="=0end"}
</nobr></div>
									{elseif $elem=="=1"}
<div style="float:left"><nobr> <span class="mini"> готови за описи : </span>
				{foreach from=$ARV2LINKINVE item=eleminve key=ekeyinve}
<sup>
<span class="{if $ekeyinve==$V2}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$eleminve.link}> 
{$eleminve.text} [{$eleminve.coun}] </span>
</sup>&nbsp;
				{/foreach}
									{elseif $elem=="=1end"}
</nobr></div>
									{elseif $elem=="=2"}
<div style="float:left"><nobr> <span class="mini"> други готови : </span>
									{elseif $elem=="=2end"}
</nobr></div>
									{else}
<sup>
<span class="{if $elem==$V2}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$ARV2LINK.$elem.link}> 
{$ARV2LINK.$elem.text} [{$ARV2LINK.$elem.coun}] </span>
</sup>&nbsp;
									{/if}
			{/foreach}
							{else}
							{/if}
*****}


							{if isset($ARSCEN)}
{*---- описи за назначаване ----*}
								{if isset($ARINVE)}
						<tr>
<td colspan=20 bgcolor=white> 
<div style="float:left">
<span class="mini"> назначи преводи от списъка към опис </span>
			{foreach from=$ARINVE item=elem key=ekey}
					{if $ekey==0}
<a href="#" onclick="indeinve('новия опис','{$elem.link}',0); return false;"> 
&nbsp;
<span class="toin"> 
нов </span>
</a>
					{else}
<a href="#" bank="{$elem.idbank}" onclick="indeinve('опис {$ekey}','{$elem.link}',{$elem.idbank}); return false;"> 
&nbsp;
<span class="toin" title="{$ARBANKPAYM[$elem.idbank]} {if isset($elem.coun)}{$elem.coun}{else}0{/if} превода"> 
{$ekey} </span>
</a>
					{/if}
			{/foreach}
</div>
								{else}
								{/if}
							{if isset($INVEER)}
&nbsp;&nbsp;
<font color=red>{$INVEER}</font>
							{else}
							{/if}
								{if isset($ARINVE)}
<div style="float:right">
<a id="bali0" class="banklink" href="#" onclick="bankfilt(0);"> всички </a>
&nbsp;&nbsp;&nbsp;
			{foreach from=$ARBANKPAYM item=namebank key=idbank}
<a id="bali{$idbank}" class="banklink" href="#" onclick="bankfilt({$idbank});"> само {$namebank} </a>
&nbsp;
			{/foreach}
</div>
								{else}
								{/if}
{*---- пакети за назначаване ----*}
								{if isset($ARPACK)}
						<tr>
<td colspan=20 bgcolor=white> 
<div style="float:left">
<span class="mini"> назначи преводи от списъка към ПАКЕТ </span>
			{foreach from=$ARPACK item=elem key=ekey}
					{if $ekey==0}
<a href="#" onclick="indepack('новия ПАКЕТ','{$elem.link}',0); return false;"> 
&nbsp;
<span class="toin"> 
нов </span>
</a>
					{else}
<a href="#" bank="{$elem.idbank}" onclick="indepack('ПАКЕТ {$ekey}','{$elem.link}',{$elem.idbank}); return false;"> 
&nbsp;
<span class="toin" title="{$ARBANKPAYM[$elem.idbank]}{if $elem.code==$CODEBANKPOST}/бюджетен{else}{/if} {if isset($elem.coun)}{$elem.coun}{else}0{/if} превода"> 
{$ekey} </span>
</a>
					{/if}
			{/foreach}
</div>
								{else}
								{/if}
{*
<br>
*}
							{else}
							{/if}
						{if isset($PACKER)}
&nbsp;&nbsp;
<font color=red>{$PACKER}</font>
						{else}
						{/if}
								{if isset($ARPACK)}
<div style="float:right">
<a id="bali0" class="banklink" href="#" onclick="bankfilt(0);"> всички </a>
&nbsp;&nbsp;&nbsp;
			{foreach from=$ARBANKPAYM item=namebank key=idbank}
<a id="bali{$idbank}" class="banklink" href="#" onclick="bankfilt({$idbank});"> само {$namebank} </a>
&nbsp;
			{/foreach}
</div>
								{else}
								{/if}

{*---- съдържание ----------------------*}
		<tr class='head2'>
<td>
<td valign=top align=center>
<td valign=top align=center> <img src="images/print.gif" title="отпечати маркираните" style="cursor:pointer" onclick="fuprincode();">
<td align=right>сума
{*
<td>разрешена
*}
{include file="tran2iban.tpl" VARI="head"}
{*
{include file="tran2bicc.tpl" VARI="head"}
*}
{include file="tran2buac.tpl" VARI="head"}
<td>дело
{*
<td>взискател
*}
{include file="tran2clai.tpl" VARI="head"}
{include file="tran2reci.tpl" VARI="head"}
{include file="tran2debt.tpl" VARI="head"}
{include file="tran2bank.tpl" VARI="head"}
{include file="tran2text.tpl" VARI="head"}
{include file="tran2full.tpl" VARI="head"}
{*
<td>деловодител
*}
{include file="tran2edit.tpl" VARI="head"}
{include file="tran2ring.tpl" VARI="head"}
{include file="tran2budg.tpl" VARI="head"}
{include file="tran2back.tpl" VARI="head"}
{include file="tran2inve.tpl" VARI="head"}
	{include file="tran2pack.tpl" VARI="head"}
{include file="tran2dire.tpl" VARI="head"}
{include file="tran2cbox.tpl" VARI="head"}
<td>&nbsp;
		</tr>

							{assign var=currfina value=0}
							{assign var=currdate value=""}
{foreach from=$LIST item=elem key=ekey}
											{assign var="myid" value=$elem.id}
											{if empty($elem.idlist) and empty($elem.idpack) and empty($elem.idconf)}
												{assign var="emptypoint" value=true}
											{else}
												{assign var="emptypoint" value=false}
											{/if}
{*
							{if $elem.idfinance==$currfina}
							{else}
								{assign var=currfina value=$elem.idfinance}
								{if isset($ARFINA)}
						<tr bgcolor=wheat>
<td colspan=20> от постъпление <b>{$ARFINA[$elem.idfinance].inco}</b>
разрешено {$ARFINA[$elem.idfinance].timeclosed|date_format:"%d.%m.%Y %H:%M:%S"}
			{if $ARFINACOUN[$elem.idfinance].coun==0}
&nbsp;&nbsp;
<a href="{$ARFINACOUN[$elem.idfinance].goprep}" style="color:red;border-bottom:1px solid red;" 
title='цялото разпределение обратно в списъка "разрешени за превод"'>
ВЪРНИ
</a>
			{else}
			{/if}
								{else}
								{/if}
							{/if}
*}
							{if $elem.created|date_format:'%d.%m.%Y'==$currdate}
							{else}
		<tr>
		<td class="date" colspan=20>{$elem.created|date_format:'%d.%m.%Y'}
								{assign var=currdate value=$elem.created|date_format:'%d.%m.%Y'}
							{/if}
		{include file="_tab2tr.tpl"}
{*
<td align=right bgcolor="#dddddd"> {$elem.amount|tomoney2}
<td style="cursor:help;" title="{$elem.created|date_format:"%H:%M:%S"}"> {$elem.created|date_format:"%d.%m.%Y"} 
*}
{***
<td align=right bgcolor="#dddddd" title="разрешена на {$elem.created|date_format:'%d.%m.%Y'} в {$elem.created|date_format:'%H:%M:%S'}"> 
{$elem.amount|tomoney2}
						{foreach from=$ARREFE[$myid] item=elrefe}
							[{$elrefe.inco}|{$elrefe.suma}]
						{/foreach}
***}
<td width=10 title="{$elem.id}">
<td valign=top align=center> <img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('{$elem.id}/');">
<td valign=top align=center> <input class="tranprntchck" type=checkbox id="{$elem.id}">

<td align=right bgcolor="#dddddd" class="suma" rel="#suma{$myid}" style="cursor:help;"
{*
title="състав на сума за превод <b>{$elem.amount|tomoney2}</b> 
<br>генерирана {$elem.created|date_format:'%d.%m.%Y'} в {$elem.created|date_format:'%H:%M:%S'}"> 
*}
title="<table width=100%><tr><td>състав на сума за превод <b>{$elem.amount|tomoney2}</b> 
<br>генерирана <b>{$elem.created|date_format:'%d.%m.%Y'}</b> в {$elem.created|date_format:'%H:%M:%S'} от <b>{$elem.usernametran}</b>
<td class='coun' align=right>{$ARREFECOUN[$myid]}</table>"
>{$elem.amount|tomoney2}
				{*---- състав на сумата ----*}
<span id="suma{$myid}" style="display: none">
	<table>
	<tr>
<td class="cluehead" align=right> разпре<br>делена<br>сума
<td class="cluehead" align=right> постъ<br>пила<br>сума
<td class="cluehead" align=center> от
<td class="cluehead" align=center> на
						{foreach from=$ARREFE[$myid] item=elrefe}
	<tr>
<td class="cluero" align=right bgcolor=silver> {$elrefe.suma|tomo3}
<td class="cluero" align=right> {$elrefe.inco|tomo3}
				{assign var=bankname value=$ARBANK[$elrefe.codebank]}
				{if $elrefe.idtype==1}
					{assign var="finaba" value="/"|cat:$elrefe.idfinabank|cat:"-"|cat:$bankname}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td class="cluero"> <nobr>{$ARTYPE[$elrefe.idtype]|cat:$finaba}</nobr>
<td class="cluero">
						{if $elrefe.idtype==1}
<nobr>{$elrefe.finadate} {$elrefe.finahour}</nobr>
						{elseif $idtype==2}
<nobr>{$elrefe.cashdate}</nobr>
						{elseif $idtype==7}
<nobr>{$elrefe.created|date_format:'%d.%m.%Y'}</nobr>
						{else}
&nbsp;
						{/if}
						{/foreach}
	</table>
</span>
				{*---- край състав на сумата ----*}

{*---- сметка ----*}
{*
				{if empty($elem.iban)}
<td bgcolor="salmon" style="cursor:help;" title="липсва сметка"> 
{$elem.iban}
				{elseif $elem.iban==str_repeat("0",22)}
<td bgcolor="salmon" style="cursor:help;" title="грешна сметка"> 
{$elem.iban}
				{elseif strlen($elem.iban)<>22}
<td bgcolor="salmon" style="cursor:help;" title="грешна дължина"> 
{$elem.iban}
				{else}
<td bgcolor="#dddddd"> 
{$elem.iban}
				{/if}
*}
{include file="tran2iban.tpl" VARI="cont"}
{*---- банков код ----*}
{*
{include file="tran2bicc.tpl" VARI="cont"}
*}
{*---- бюджетна сметка ----*}
{include file="tran2buac.tpl" VARI="cont"}
{*---- дело, деловодител ----*}
<td class="case" rel="#case{$myid}" title="доп.информация за делото" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.gotocase}
>{$elem.caseseri}/{$elem.caseyear}
<span id="case{$myid}" style="display: none">
деловодител {$elem.username}
			{if empty($elem.casenote)}
			{else}
<br> бележки
<div style="margin-left:20px;"> {$elem.casenote|nl2br} </div>
			{/if}
<hr>
<font color=blue>ляв клик - виж всички преводи за делото </font>
</span>
{*
<td style="cursor:help" title="деловодител {$elem.username}"> {$elem.caseseri}/{$elem.caseyear} 
<td> {$elem.username}
*}
{*---- взискател ----*}
{include file="tran2clai.tpl" VARI="cont"}
{*
					{if $elem.idclaimer<0}
<td><font color=red> {$PSCLAI[$elem.idclaimer]} </font>
					{else}
<td> {$elem.clainame}
					{/if}
*}
{*---- получател ----*}
{include file="tran2reci.tpl" VARI="cont"}
{*---- длъжник ----*}
{include file="tran2debt.tpl" VARI="cont"}
{*
<td> {$elem.debtname}
/{$ARCOUNDEBT[$elem.idcase]}
*}
{*---- банка ----*}
{*
<td> {$ARBANKPAYM[$elem.idbank]}
*}
{include file="tran2bank.tpl" VARI="cont"}
{*---- основание ----*}
{include file="tran2text.tpl" VARI="cont"}
{*---- пълно погасяване ----*}
{include file="tran2full.tpl" VARI="cont"}
{*---- корекция сметка ----*}
{*
<td align=center>
				{if $emptypoint}
<a href="{$elem.editiban}" class="nyroModal" target="_blank">
<img src="images/edit.png" title="корегирай сметката">
</a>
				{else}
&nbsp;
				{/if}
*}
{include file="tran2edit.tpl" VARI="cont"}
{*---- rings ----*}
{include file="tran2ring.tpl" VARI="cont"}
{*---- доп.данни за бюджетен превод ----*}
{*
				{if isset($elem.editbudg)}
					{assign var=myindx value=$elem.idtranbudget}
					{assign var=ARDATA value=$ARBUDATA[$myindx]}
							{if $ARDATA.isempty or !isset($ARDATA)}
								{assign var=bgco value="salmon"}
							{else}
								{assign var=bgco value=""}
							{/if}
<td align=center class="budg" rel="#budg{$myid}" title="доп.данни към бюджета" bgcolor="{$bgco}">
<a href="{$elem.editbudg}" class="nyroModal" target="_blank">
<img src="images/correct.gif" title="корегирай данните">
</a>
<span id="budg{$myid}" style="display: none">
{include file="tranbudg.tpl"}
</span>
				{else}
<td>
&nbsp;
				{/if}
*}
{include file="tran2budg.tpl" VARI="cont"}
{*---- върнат ----*}
{*
<td align=center>
					{if $elem.idstat==3}
върн
					{else}
&nbsp;
					{/if}
*}
{include file="tran2back.tpl" VARI="cont"}
{*---- за опис ----*}
{include file="tran2inve.tpl" VARI="cont"}

{*---- пакет ----*}
{include file="tran2pack.tpl" VARI="cont"}

{*---- маркиране/демаркиране за директен превод ----*}
{include file="tran2dire.tpl" VARI="cont"}

{*---- чекбокс ----*}
{include file="tran2cbox.tpl" VARI="cont"}
{*
<td align=center>
<input type=checkbox id="cb{$elem.cbcode}">
{$elem.cbcode}
*}
{*---- създал ----*}
<td class="usna" title="{$elem.usernametran}"> {$elem.usnatran}

		</tr>
	{/foreach}
<tr bgcolor="beige">
	<td colspan=""></td>
	<td colspan=""></td>
	<td colspan=""><input id="tranprntall" type="checkbox" onclick="select_all()" title="маркирай/размаркирай всички" /> </td>
	<td align="right"> <b> {$MAINSUMA|tomoney2}</b></td>
	<td ><font color=red> общо </font></td>
	<td colspan="160"></td>
</tr>
{*include file="_tab2pagi.tpl"*}
{include file="_tab2pagiwosuma.tpl"}
</table>
										</table>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ibac').cluetip({ldelim} width: 460, local:true, cursor:'pointer' {rdelim});
	$('.osno').cluetip({ldelim} width: 460, local:true, cursor:'pointer' {rdelim});
	$('.suma').cluetip({ldelim} width: 460, local:true, cursor:'pointer' {rdelim});
	$('.ttip').cluetip({ldelim} width: 360, local:true, cursor:'pointer' {rdelim});
	$('.budg').cluetip({ldelim} width: 360, local:true, cursor:'pointer' {rdelim});
	$('.buac').cluetip({ldelim} width: 320, local:true, cursor:'pointer' {rdelim});
	$('.case').cluetip({ldelim} width: 520, local:true, cursor:'pointer' {rdelim});
		$("#bali0").addClass("bankcurr");
{rdelim});
{literal}
function fup2(p1){
	fuprin("tranprnt.php?para="+p1);
}
function fuprincode(){
	var list= $("input[class='tranprntchck']");
	var lico= "";
	for (var i=0; i<list.length; i++) {
		if (list[i].checked) {
			lico += list[i].id + "/";
		} else {
		}
	}
	fuprin("tranprnt.php?para=" + lico);
}
function select_all() {
	var el = document.getElementById("tranprntall");
	var list= $("input[class='tranprntchck']");
	for (var i=0; i<list.length; i++) {
		list[i].checked = el.checked;
	}
}
{/literal}
function autocaseyear(event){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//alert("code="+code);
	if (code==13){ldelim}
{***
			lipara= {ldelim}caseyear:$("#caseyear").attr("value"){rdelim};
alert($("#caseyear").attr("value"));
			jQuery.ajax({ldelim}
				url: document.location.href
				,data: lipara
				,type: "post"
				,success: function(data){ldelim}
alert(data);
//document.location.href= data;
				{rdelim}
			{rdelim});
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
***}
document.forms['formcaye'].submit();
	{rdelim}
{rdelim}

{*
function fucbox(){ldelim}
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
			coun ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
return lico+"^"+coun;
{rdelim}
function fuexdegrou(){ldelim}
	var para= fucbox();
	var arpa= para.split("^");
	var lico= arpa[0];
	var coun= arpa[1];
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
		var retu= confirm("От описа ще бъдат изключени \\n"+text);
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
		var retu= confirm("От описа ще бъдат изключени \\n"+text);
	{rdelim}
	if (retu){ldelim}
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
*}

function bankfilt(idbank){ldelim}
	$(".banklink").each(function(){ldelim}
		if ($(this).attr("id")=="bali"+idbank){ldelim}
			$(this).addClass("bankcurr");
		{rdelim}else{ldelim}
			$(this).removeClass("bankcurr");
		{rdelim}
	{rdelim});
	var list= $("input[@type='checkbox']");
				if (idbank==0){ldelim}
	$(list).each(function(){ldelim}
		$(this).show().attr("checked",false);
	{rdelim});
				{rdelim}else{ldelim}
	$(list).each(function(){ldelim}
		if ($(this).attr("bank")==idbank){ldelim}
			$(this).show().attr("checked",true);
		{rdelim}else{ldelim}
			$(this).hide().attr("checked",false);
		{rdelim}
	{rdelim});
				{rdelim}
	var list= $("a[@bank]");
				if (idbank==0){ldelim}
	$(list).each(function(){ldelim}
		$(this).show();
	{rdelim});
				{rdelim}else{ldelim}
	$(list).each(function(){ldelim}
		if ($(this).attr("bank")==idbank){ldelim}
			$(this).show();
		{rdelim}else{ldelim}
			$(this).hide();
		{rdelim}
	{rdelim});
				{rdelim}
//$("tr[@rel=tr"+pid+"]").show();
//$("input[@type='checkbox']");
{rdelim}

</script>

{include file="tran2cbacti.tpl"}
