<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table cellspacing=0 cellpadding=0 align=center border=0>
{*
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
<tr>
<td class='d_table_title' colspan=100> търсене на постъпления в брой
	</thead>
	<tbody>
*}
<tr>
<td width=4> &nbsp;
<td>
	{include file="_erform.tpl"}
<br>
	<div style="font: normal 10pt verdana">
въведи една или две дати за търсене
<br>
на постъпления в брой за период
	</div>
				<table>
				<tr>
<td style="font: normal 8pt verdana"> от дата
<td style="font: normal 8pt verdana"> до дата
				<tr>
<td>
<input type="text" name="date1" id="date1" size=20 {include file="_erelem.tpl" ID="date1" C1="input" C2="inputer"}> 
<td>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
<td>
{*
{include file='_button.tpl' TYPE='submit' TITLE='приложи филтъра' NAME='submit' ID='submit'}
*}
{include file='_button.tpl' TYPE='submit' TITLE='търси' NAME='submit' ID='submit'}
				</table>
{*
<br>
{include file='_button.tpl' TYPE='submit' TITLE='приложи филтъра' NAME='submit' ID='submit'}
<br> &nbsp;
*}

<td width=4> &nbsp;
</table>
</form>

<br>