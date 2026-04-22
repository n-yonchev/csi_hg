							{if $OK}
<center style="font:normal 10pt verdana;">
<br>
данните са записани
</center>
							{else}
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100> данни за достъп до регистър-2014
	</thead>
	<tbody>
<tr>
<td colspan=2 align=center>
{include file="_erform.tpl"}

			<tr>
<td> входно име
<td> 
<input type="text" name="regi14user" id="regi14user" size=30 {include file="_erelem.tpl" ID="regi14user" C1="input" C2="inputer"}> 
			<tr>
<td> вх.парола
<td> 
<input type="text" name="regi14pass" id="regi14pass" size=30 {include file="_erelem.tpl" ID="regi14pass" C1="input" C2="inputer"}> 
			<tr>
<td colspan=2 align=center>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>&nbsp;
</table>
</form>
							{/if}
