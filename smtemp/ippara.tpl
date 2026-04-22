<form name="myform" method=post enctype="multipart/form-data">
			<table align=center>
			<tr>
<td align=right> email to
			<td>
<input type="text" name="mail" id="mail" size=50 {include file="_erelem.tpl" ID="mail" C1="input" C2="inputer"}> 
			<td class="error"> {$LISTER.mail}
			<tr>
<td align=right> htaccess text
			<td>
<input type="text" name="mes1" id="mes1" size=50 {include file="_erelem.tpl" ID="mes1" C1="input" C2="inputer"}> 
			<td class="error"> {$LISTER.mes1}
			<tr>
<td align=right> login text
			<td>
<input type="text" name="mes2" id="mes2" size=50 {include file="_erelem.tpl" ID="mes2" C1="input" C2="inputer"}> 
			<td class="error"> {$LISTER.mes2}
			<tr>
<td align=right> email from
			<td>
<input type="text" name="from" id="from" size=50 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}> 
			<td class="error"> {$LISTER.from}

			<tr>
			<td>
			<td>
<input class="submit" type="submit" name="submit" id="submit" value="submit"> 
			</table>
</form>
