<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
<tr>
<td class='d_table_title' colspan=100> филтър за търсене
	</thead>
	<tbody>

<tr>
<td width=4> &nbsp;
<td>
	{include file="_erform.tpl"}
<br>
	<div style="font: normal 10pt verdana">
въведи една или две дати за търсене на вх.документ
<br>
по време на създаване
	</div>
				<table>
				<tr>
<td> от дата
<td> до дата
				<tr>
<td>
<input type="text" name="date1" id="date1" size=20 {include file="_erelem.tpl" ID="date1" C1="input" C2="inputer"}> 
<td>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
				</table>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='приложи филтъра' NAME='submit' ID='submit'}
<br> &nbsp;

<td width=4> &nbsp;
</table>
</form>
