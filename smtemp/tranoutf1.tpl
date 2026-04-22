{include file="_tab2.tpl"}
<style>
.link {ldelim}font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.desc {ldelim}font:normal 8pt verdana;{rdelim}
</style>
									<table align=center width=94%>
									<tr>
									<td>
<a class="link" {include file="_href.tpl" LINK=$GOBACK}>
{$GOTEXT} </a>
<br>&nbsp;
									<tr>
									<td>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left">списък на редовете от изходящия {$ARBANKPAYMSUFF[$IDBANK]} файл за банка {$ARBANKPAYM[$IDBANK]}, получен от пакет {$IDPACK}
{*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
*}
</div>
<div style="float:right">
{*
<a class="link" href="#" onclick="fuprin('{$LINKCREA}'); return false;"> 
формирай {$ARBANKPAYMSUFF[$IDBANK]} файл </a>
*}
<a class="link" href="#" onclick="fuprin('{$LINKCREA}'); return false;" 
title="формирай {$ARBANKPAYMSUFF[$IDBANK]} файл"> {$ARBANKPAYMSUFF[$IDBANK]}</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/print.gif" title="отпечати всички преводи" style="cursor:pointer" onclick="fuprin('{$LINKPRNT}');">
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
		<tr class='head2'>
<td colspan=7 align=center style="font-size:7pt;"> за кредитен превод
{*
<td colspan=5 align=center style="font-size:7pt;"> допълнително за превод към бюджета
*}
		<tr class='head2'>
<td> име на получателя
<td> BIC
<td> IBAN
<td> банка
<td> сума
<td> основание за плащане
<td> пс
{*
<td> вид плащане
<td> вид и номер на документа
<td> дата на документа
<td> дата начало период
<td> дата край период
*}
		</tr>
{foreach from=$LIST item=elem key=ekey}
		{include file="_tab2tr.tpl"}
											{assign var="myid" value=$elem.id}
<td> {$elem.nameto}
<td> {$elem.bicto}
<td> {$elem.ibanto}
<td> {$elem.bankto}
<td align=right> {$elem.suma|tomo3}
<td> {$elem.textto}
<td> {$elem.ring}&nbsp;
{*
<td> {$elem.PAY_R}&nbsp;
<td> {$elem.TYPEDOC}&nbsp;
<td> {$elem.DOCDATE}&nbsp;
<td> {$elem.FROMDATE}&nbsp;
<td> {$elem.TODATE}&nbsp;
***}
{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
		<tr class='head1'>
<td colspan=3> {$SUMATOTA.coun} реда общо
<td> обща сума 
<td> {$SUMATOTA.suma|tomo3}
<td colspan=2> 
		</table>
									</table>
