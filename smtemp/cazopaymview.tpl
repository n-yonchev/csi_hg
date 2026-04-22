<script type="text/javascript">
	$('a.nyroModal').nyroModal({ldelim}width:520, height:400{rdelim});
</script>

{*----
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
----*}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
	<thead>
{*----
		<tr>
			<td class='d_table_title' colspan='200'>прих.касови ордери</td>
		</tr>
				{if $FLAGNOCHANGE}
				{else}
		<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
		</tr>
				{/if}
----*}
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
прих.касови ордери
</div>
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
			{/if}
		</tr>
{*--------*}
	</thead>
		<tr CLASS='header'>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>	
			<td><span> номер</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> сума</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> дата</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> вносител</span></td>
				{if $FLAGNOCHANGE}
				{else}
			<td class='sep'>&nbsp;</td>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> &nbsp;</span></td>
				{/if}
		</tr>
	<tbody>
		{foreach from=$LIST item=elem key=ekey}
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> <img src="images/view.png" title="{$elem.text}"></td>
			<td class='sep'>&nbsp;</td>
			<td> {$elem.serial}/{$elem.year}</td>
			<td class='sep'>&nbsp;</td>
			<td> {$elem.amount|tomoney2}</td>
			<td class='sep'>&nbsp;</td>	
			<td> {$elem.date|date_format:"%d.%m.%Y"}</td>
			<td class='sep'>&nbsp;</td>
			<td> {$elem.name}</td>
				{if $FLAGNOCHANGE}
				{else}
			<td class='sep'>&nbsp;</td>
			<td> <a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
			<td class='sep'>&nbsp;</td>	
			<td> <a href="caseeditzone.php{$elem.prin}" class="nyroModal" target="_blank"><img src="images/print.gif" title="печат"></a> </td>
			<td class='sep'>&nbsp;</td>
			<td> <a href="caseeditzone.php{$elem.dist}" class="nyroModal" target="_blank"><img src="images/distrib.gif" title="разпределение"></a></td>
				{/if}
		</tr>
		{/foreach}	
	</tbody>
</table>
