<script type="text/javascript">
$($.fn.nyroModal.settings.openSelector).nyroModal();
</script>
		<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>изходящи документи TTTT</td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
		</td>
		</tr>
		</thead>
		<tr class='header'>
<td> изх.номер&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td> създаден&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td> тип&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
</tr>
	{foreach from=$LIST item=elem key=ekey}
	<tr>
		{if $elem.serial==0}
<td class="contleft"> 
		{else}
<td class="contleft"> {$elem.serial}/{$elem.year}
		{/if}
<td class="contleft"> {$elem.created|date_format:"%d.%m.%Y"}
<td class="contleft"> {$elem.typetext}
<td>
		{if $elem.serial==0}
<a href="caseeditzone.php{$elem.docu}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
		{else}
<a href="caseeditzone.php{$elem.view}" class="nyroModal" target="_blank"><img src="images/view.png" title="разгледай"></a>
		{/if}
<td>
		{if $elem.serial==0}
<a href="caseeditzone.php{$elem.regi}" class="nyroModal" target="_blank"><img src="images/regi.gif" title="изведи"></a>
		{else}
		{/if}
<td>
		{if $elem.serial==0}
<a href="caseeditzone.php{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
		{else}
		{/if}
	{/foreach}
		</table>