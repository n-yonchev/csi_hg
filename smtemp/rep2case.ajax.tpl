<style>
.he {ldelim}font: bold 7pt verdana; background-color:#bbbbbb;{rdelim}
.ro {ldelim}font: bold 7pt verdana; background-color:#dddddd;{rdelim}
.ro2 {ldelim}font: bold 7pt verdana; background-color:#cccccc; color:blue;{rdelim}
.roplus, .more {ldelim}font: bold 7pt verdana; background-color:#dddddd; color:sienna{rdelim}
.moreov {ldelim}font: bold 7pt verdana; background-color:#87876a;{rdelim}
.hemo {ldelim}font: bold 7pt verdana;{rdelim}
</style>

{*-------- дължими суми --------*}
						{assign var="isdesc" value="<sup><b><font color=red>o</font></b></sup>"}
						{assign var="cudesc" value="style='cursor:help'"}
				<table align=left cellspacing=1 cellpadding=0>
				<tr>
<td class="he" colspan=20> дължими суми
				<tr>
<td class="he" align=right> сума
<td class="he"> тип
<td class="he"> описание 
{*
<td class="he"> от-до дата
*}
<td class="he" align=right> [1a]
<td class="he" align=right> кол.2
		{foreach from=$LIST item=elem key=ekey}
				{assign var="arindx" value=$elem.idsubtype}
{*
			{if empty($ARSUBT.$arindx)}
*}
			{if empty($ARSUBT.$arindx) or $elem.idtype<>2}
				{assign var="txsubtype" value=""}
			{else}
				{assign var="txsubtype" value="/"|cat:$ARSUBT.$arindx}
			{/if}
				<tr>
<td class="ro" align=right> {$elem.amount|tomoney2}
<td class="ro" {if $elem.ismont==1}{$cudesc} title="от {$elem.fromdate|date_format:"%d.%m.%Y"} до {$elem.todate|date_format:"%d.%m.%Y"}"{else}{/if}> 
	{$ARTYPE[$elem.idtype]}{$txsubtype} {if $elem.ismont==1}{$isdesc}{else}{/if}
<td class="ro"> {$elem.text} [{$elem.clainame}]
{*
<td class="ro"> {$elem.fromdate|date_format:"%d.%m.%Y"} - {$elem.todate|date_format:"%d.%m.%Y"}
*}
					{if $elem.ok1==0}
{*
<td class="ro" colspan=30> <font color=red>не е по изпълнит.лист</font>
*}
<td class="ro" colspan=30> <font color=red>не е олихв.или по ИЛ</font>
					{elseif $elem.ok2==0}
{*
<td class="ro" colspan=30> <font color=red>за присъединен взискател</font>
*}
<td class="ro" colspan=30> <font color=red>непървичен взискател НАП/община</font>
					{else}
<td class="ro" align=right> {$elem.c1full|tomoney2}
<td class="ro" align=right> {$elem.c2|tomoney2}
					{/if}
{*
[{$elem.ok1}][{$elem.ok2}]
*}
		{/foreach}
				<tr>
<td class="he" colspan=3> общо
{*
<td class="he" align=right> {$ARSUMA[$elem.idcase].c1full|tomoney2}
<td class="he" align=right> {$ARSUMA[$elem.idcase].c2|tomoney2}
<td class="he" align=right> {$CALCSUMA.c1full|tomoney2}
<td class="he" align=right> {$CALCSUMA.c2|tomoney2}
*}
<td class="he" align=right> {include file="rep2casesuma.tpl" CALC=$CALCSUMA.c1full DATA=$ARSUMA.c1full}
<td class="he" align=right> {include file="rep2casesuma.tpl" CALC=$CALCSUMA.c2 DATA=$ARSUMA.c2}
				</table>


{*-------- събрани суми --------*}
{*
<br>
*}
				<table align=left cellspacing=1 cellpadding=0>
				<tr>
<td class="he" colspan=20> събрани суми
				<tr>
<td class="he"> дата
<td class="he"> операция
<td class="he" align=right> сума
<td class="he"> &nbsp;
<td class="he" align=right> <font color=blue>[1b]<br>събрИЛ</font>
			{foreach from=$TEXTCOLOHE item=teco key=ecol}
<td class="he" align=right> [{$ecol}]<br>{$teco}
			{/foreach}
<td class="he" align=right> [10]<br>добров
<td class="he" align=right> &nbsp;
		{foreach from=$CALC item=elem key=ekey}
					{if $elem.oper==$OPERMINU}
						{assign var="clas" value="ro"}
					{else}
						{assign var="clas" value="roplus"}
					{/if}
				<tr>
<td class="{$clas}"> {$elem.date|date_format:"%d.%m.%Y"}
<td class="{$clas}"> {$OPERTEXT[$elem.oper]}
<td class="{$clas}" align=right> {$elem.amou|tomo3}
					{if $elem.oper==$OPERMINU}
{assign var="stbefo" value="<span style='background:gold;cursor:help;' title='събрано ПРЕДИ периода - само кол.1b'><b>&lt;</b></span>"}
{assign var="stduri" value="<span style='background:green;cursor:help;' title='събрано през периода - кол.5,6,7,8,9'>&nbsp;&nbsp;</span>"}
{assign var="stafte" value="<span style='background:tomato;cursor:help;' title='събрано СЛЕД периода - игнорира се'><b>&gt;</b></span>"}
{*---- статус ----*}
<td class="{$clas}" align=right> 
						{if $elem.idvari==1}
{$stbefo}
				{assign var="clas" value="roplus"}
						{elseif $elem.idvari==2}
{$stduri}
						{elseif $elem.idvari==3}
{$stafte}
				{assign var="clas" value="roplus"}
						{else}
???
						{/if}
{*---- кол.1b ----*}
<td class="{$clas}" align=right> <font color=blue>{$elem.c1paym|tomo3}</font>
			{foreach from=$TEXTCOLOHE item=teco key=ecol}
				{assign var=indx value="m"|cat:$ecol}
<td class="{$clas}" align=right> {$elem.$indx|tomo3}
			{/foreach}
<td class="{$clas}" align=right> {$elem.m10|tomo3}
					{else}
<td class="{$clas}" colspan=8> <font color=red>не е събиране</font>
					{/if}
{*** ------------------ ***}
{*---- последна колона ----*}
							{assign var="myid" value=$elem.id}
<td class="more" {$cudesc} rel="#more{$myid}" title="подробно" 
onmouseover="this.className='moreov';" onmouseout="this.className='more';"> {$isdesc}
</td>
				</tr>
		{/foreach}
				<tr>
<td class="he" colspan=4> общо
<td class="he" align=right> {$CALCSUMA.c1paym|tomoney2}
<td class="he" align=right> {$CALCSUMA.c5|tomoney2}
<td class="he" align=right> {$CALCSUMA.c6|tomoney2}
<td class="he" align=right> {$CALCSUMA.c7|tomoney2}
<td class="he" align=right> {$CALCSUMA.c8|tomoney2}
<td class="he" align=right> {$CALCSUMA.c9|tomoney2}
<td class="he" align=right> {$CALCSUMA.c10|tomoney2}
<td class="he"> &nbsp;
				</table>

{*---- доп.инфо ----*}
		{foreach from=$CALC item=elem key=ekey}
							{assign var="myid" value=$elem.id}
<span id="more{$myid}" style="display: none">
	<table>
	<tr>
<td class="hemo"> &nbsp;
			{foreach from=$TEXTCOLO item=teco key=ecol}
<td class="hemo" align=right> {if $ecol+0==0}&nbsp;{else}[{$ecol}]{/if}<br>{$teco}
			{/foreach}
<td class="hemo" align=right> <br>общо
							{assign var="oldekey" value="`$ekey-1`"}
							{if $oldekey== -1}
{include file="rep2casemore.tpl" PREF="r" TEXT="предиш.дълг" DATA=$AREMPTY}
							{else}
{include file="rep2casemore.tpl" PREF="r" TEXT="предиш.дълг" DATA=$CALC[$oldekey]}
							{/if}
					{if $elem.oper==$OPERMINU}
{include file="rep2casemore.tpl" PREF="m" TEXT="минус"}
				<tr>
<td> <hr>
<td class="hemo" align=center colspan=3> в т.ч. по взискатели
<td colspan=5> <hr>
		{foreach from=$CLAILIST item=nameclai key=idclai}
{*
{include file="rep2casemore.tpl" PREF="???" TEXT=$nameclai CLAS="ro2"}
*}
{include file="rep2casemore.tpl" PREF="" TEXT=$nameclai DATA=$elem.rep2move[$idclai]}
		{/foreach}
				<tr>
<td colspan=20> <hr>
					{else}
{include file="rep2casemore.tpl" PREF="p" TEXT="корекция"}
					{/if}
{*
				<tr>
<td> &nbsp;
*}
{include file="rep2casemore.tpl" PREF="r" TEXT="текущ дълг"}
{*
				<tr>
<td> &nbsp;
*}
				<tr>
<td colspan=6>
<td class="hemo" colspan=2> общо дълг
							{assign var="sumadebt" value=0}
							{foreach from=$TEXTCOLOHE item=teco key=ecol}
								{assign var=indx value="r"|cat:$ecol}
								{assign var="sumaelem" value=$elem.$indx}
								{assign var="sumadebt" value=`$sumadebt+$sumaelem`}
							{/foreach}
<td class="he" align=right> {$sumadebt|tomo3}
	</table>
<br>
</span>
		{/foreach}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$('.more').cluetip({ldelim} width: 580, local:true, cursor:'help', positionBy:'bottomTop', topOffset:30 {rdelim});
{rdelim});
</script>
