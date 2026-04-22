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
<div style="float:left">списък на редовете от XML файла за ОББ, получен от пакет {$IDPACK}
{*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
*}
</div>
<div style="float:right">
<a class="link" href="#" onclick="fuprin('{$LINKCREA}'); return false;"> 
формирай XML </a>
</div>
		<tr class='head2'>
<td colspan=5 align=center style="font-size:7pt;"> за кредитен превод
<td colspan=5 align=center style="font-size:7pt;"> допълнително за превод към бюджета
		<tr class='head2'>
<td> име на бенефициента
<td> IBAN на бенефициента
<td> сума
<td> основание за плащане
<td> още пояснения
<td> вид плащане
<td> вид и номер на документа
<td> дата на документа
<td> дата начало период
<td> дата край период
		</tr>
{foreach from=$LIST item=elem key=ekey}
		{include file="_tab2tr.tpl"}
											{assign var="myid" value=$elem.id}
<td> {$elem.NAME_R}
<td> {$elem.IBAN_R}
<td> {$elem.JSUM}
<td> {$elem.REM_I}
<td> {$elem.REM_II}&nbsp;
<td> {$elem.PAY_R}&nbsp;
<td> {$elem.TYPEDOC}&nbsp;
<td> {$elem.DOCDATE}&nbsp;
<td> {$elem.FROMDATE}&nbsp;
<td> {$elem.TODATE}&nbsp;
{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
		</table>
									</table>
