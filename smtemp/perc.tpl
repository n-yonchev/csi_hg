{*
			<table align=center border=1>
			<tr>
			<td class='d_table_button' colspan='10'>
			<tr>
			<td valign=top>
*}
		<table align=center>
		<tr>
<td colspan=10 align=center> <b>списък на лихвените периоди</b>
		<tr>
<td>
		</tr>
		</thead>
		<tr>
		<td>
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
						{counter start=$STEP assign=coun}
{foreach from=$ARPERC item=elem key=ekey}
						{if $coun==$STEP}
							{counter start=1 assign=coun}
		</table>
			<td width=20>
		<td valign=top>
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<tr class='header'>
<td> нач.дата </td>
	{include file="_sepa.tpl"}
<td> кр.дата </td>
	{include file="_sepa.tpl"}
<td> ОЛП </td>
		</tr>
						{else}
							{counter assign=coun}
						{/if}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.begin}
	{include file="_sepa.tpl"}
<td> {$elem.end}
	{include file="_sepa.tpl"}
<td> {$elem.bnb}
		</tr>
{/foreach}
		</table>
			<td width=20>
		</table>

{*----
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='10'> история на обновяванията
</td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
	{include file="_sepa.tpl"}
<td> час </td>
	{include file="_sepa.tpl"}
<td> статус </td>
{foreach from=$ARLOG item=elem key=ekey}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
	{foreach from=$elem item=e2}
<td> {$e2}
	{include file="_sepa.tpl"}
	{/foreach}
{/foreach}
			</table>
----*}
{*
<script>
function refrlist(){ldelim}
	document.getElementById("relist").innerHTML= "<h2>почакай...</h2>";
	window.location.href= "{$BUTREF}";
{rdelim}
</script>
*}