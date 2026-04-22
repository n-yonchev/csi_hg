{*
	$ARDATA 
*}
	<table>
	<tr>
<td> вид плащане
<td><b>{$ARDATA.codepaym}</b>
	<tr>
<td> вид и номер на документа
<td><b>{$ARDATA.typedoc}</b>
	<tr>
<td> дата на документа
<td><b>{$ARDATA.docdate|date_format:"%d.%m.%Y"}</b>
	<tr>
<td> дата начало на период
<td><b>{$ARDATA.fromdate|date_format:"%d.%m.%Y"}</b>
	<tr>
<td> дата край на период
<td><b>{$ARDATA.todate|date_format:"%d.%m.%Y"}</b>
{*
	<tr>
<td> задължено лице
<td><b>{$ARDATA.debtname}</b>
*}
	<tr>
<td colspan=4> <hr>
	<tr>
<td colspan=4> <font color=blue>ляв клик за КОРЕКЦИЯ </font>
	</table>
