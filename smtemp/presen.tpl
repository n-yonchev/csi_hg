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
<span style="font: normal 8pt verdana;">
въведи дата за представянето
</span>
				<table>
				<tr>
<td>
<input type="text" name="date" id="date" size=20 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"} autocomplete=off> 
<td>
{include file='_button.tpl' TYPE='submit' TITLE='готово' NAME='submit' ID='submit'}
				</table>

<td width=4> &nbsp;
</table>
</form>

<br>

					{if isset($ARUSER)}
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<tr class='header'>
<td> деловодител
		<td class='sep'>&nbsp;</td>
<td align=right> входени<br>документи
		<td class='sep'>&nbsp;</td>
<td align=right> изходени<br>документи
		<td class='sep'>&nbsp;</td>
<td align=right> извършени<br>действия
{foreach from=$ARUSER item=name key=iduser}
		<tr>
<td> {$name}
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARDOCU[$iduser]} &nbsp;
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARDOUT[$iduser]} &nbsp;
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARJOUR[$iduser]} &nbsp;
{/foreach}
		</table>
					{else}
					{/if}