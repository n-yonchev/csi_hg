<form name="myform" method=post enctype="multipart/form-data">
			<table align=center>
			<tr>
			<td>
ip filter
<br>
{include file="_select.tpl" FROM=$ARIPNAME ID="ippara" C1="he8" C2="inputer"}
			<td>
user filter
<br>
{include file="_select.tpl" FROM=$ARUSERNAME ID="uspara" C1="he8" C2="inputer"}
			<td>
date filter
<br>
<input type="text" name="dapara" id="dapara" size=16 {include file="_erelem.tpl" ID="dapara" C1="he8" C2="inputer"}> 
			<td valign=bottom>
<input class="submit" type="submit" name="submit" id="submit" value="search"> 
			</table>
</form>
		
			<table align=center>
			<tr>
			<td class="he8" align=center> ip
			<td class="he8" align=center> user
			<td class="he8" align=center> time
			<td class="he8" align=center> error
		{foreach from=$LIST item=elem key=ekey}
			<tr onmouseover="this.style.backgroundColor='#dddddd';" onmouseout="this.style.backgroundColor='';">
			<td class="td8">
{$elem.ipaddr}
			<td class="td8">
{assign var=myindx value=$elem.iduser}
{$ARUSER.$myindx}
			<td class="td8">
{$elem.time|date_format:"%d.%m.%Y [%H:%M:%S]"}
	{assign var=myindx value=$elem.errtype}
	{assign var=ertx value=$ARVISU.$myindx.0}
	{assign var=erco value=$ARVISU.$myindx.1}
	{assign var=erbg value=$ARVISU.$myindx.2}
			<td class="td8" bgcolor={$erbg}>
<font color="{$erco}">
<b>{$ertx}</b>
</font>
		{/foreach}
			<tr>
			<td class="he8" colspan=12>
{include file="_paginaip.tpl"}
			</table>

{include file="_jscale.tpl" FIELD="dapara"}
