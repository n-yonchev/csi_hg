<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

{*----
<table class="d_table" width='100%' cellspacing='0' cellpadding='0' align=center>
----*}
{*----
<table class="d_table" cellspacing='0' cellpadding='0' align=left>
----*}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
<thead>
	<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">извършени действия
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			{/if}
	</tr>
	
</thead>
	<tr class='header'>
		<td><span> дата </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> задълж.лице</span></td>
	</tr>
<tbody>
	{foreach from=$LIST item=elem key=ekey}		
	<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
		<td> {$elem.created|date_format:"%d.%m.%Y"}</td>
		<td class='sep'>&nbsp;</td>			
		<td> {$elem.descrip}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.person}</td>
		<td class='sep'>&nbsp;</td>
	</tr>
	{/foreach}
</tbody>
</table>
