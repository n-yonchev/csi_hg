<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
<thead>
			<tr>
			<td class='d_table_title' colspan=10 onclick="toggle(this,event);">
<div style="float:left">
бележки
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
			{if $FLAGNOCHANGE}
			{else}
<div style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$URLMOD" CLASS='nyroModal' TARGET='_blank' TITLE='корегирай'}
</div>
			{/if}
</thead>
			<tr>
			<td>
			<td class="cont">
{$DATA.notes|nl2br}

			</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>
