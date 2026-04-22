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
въведи за делото номер/година
<br>
или само номер
	</div>
<br>
<input type="text" name="textnome" id="textnome" size=40 {include file="_erelem.tpl" ID="textnome" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='намери' NAME='submit' ID='submit'}
<br> &nbsp;

<td width=4> &nbsp;
</table>
</form>
