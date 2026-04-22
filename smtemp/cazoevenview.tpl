<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
събития
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
			{/if}
		</tr>
	</thead>
	<tr class='header'>
<td> дата </td>
			<td class='sep'>&nbsp;</td>
<td> събитие </td>
		{if $FLAGNOCHANGE}
		{else}
			<td class='sep'>&nbsp;</td>	
			<td><span> &nbsp;</span></td>
		{/if}
	</tr>
	<tbody>

		{foreach from=$LIST item=elem key=ekey}
				{assign var="arindx" value=$elem.idsubtype}
			{if empty($ARSUBT.$arindx)}
				{assign var="txsubtype" value=""}
			{else}
				{assign var="txsubtype" value="/"|cat:$ARSUBT.$arindx}
			{/if}
<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td> {$elem.date|date_format:"%d.%m.%Y"}
			<td class='sep'>&nbsp;</td>
<td> {$elem.text} </td>
		{if $FLAGNOCHANGE}
{assign var="cosp" value="0"}
		{else}
{assign var="cosp" value="4"}
			<td class='sep'>&nbsp;</td>
			<td> 
<nobr>
<a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.delrec}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</nobr>
			</td>
		{/if}
		</tr>
		{/foreach}

</tbody>
</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>

{include file='_frame.footer.tpl'}



