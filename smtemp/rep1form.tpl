<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
<tr>
<td class='d_table_title' colspan=100> избор на период
	</thead>
	<tbody>

<tr>
<td>
	{include file="_erform.tpl"}
<br>
	<div style="font: normal 10pt verdana">
избери период за отчета раздел 1
	</div>
<br>
{include file="_select.tpl" FROM=$ARPERINAME ID="period" C1="input" C2="inputer" ONCH="document.forms['myform'].submit();"}
<br> &nbsp;

</table>
</form>
