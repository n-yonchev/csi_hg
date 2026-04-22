<form name="myform" method=post enctype="multipart/form-data">
			<table align=center>
			<tr>
			<td>
<input type="text" name="ipaddr" id="ipaddr" size=20 {include file="_erelem.tpl" ID="ipaddr" C1="input" C2="inputer"}> 
			<td>
<input class="submit" type="submit" name="submit" id="submit" value="add"> 
		{foreach from=$DATA item=elem key=ekey}
			<tr>
			<td>
{$elem.ipaddr}
			<td>
<a href="{$elem.dele}"> delete </a>
		{/foreach}
			</table>
</form>
