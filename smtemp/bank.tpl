<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на банките</td>
	</tr>
	<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
	</td>
	</tr>
</thead>
{*---- съдържание ----------------------*}

<tr class='header'>
<td> име
		<td class='sep'>&nbsp;</td>
<td> BIC
	<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
</tr>

	{foreach from=$LIST item=elem key=ekey}
<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
<td {if $BIC_COUNT[$elem.bic] > 1}style="background-color: salmon; color: white; font-weight: bold;" title="{if $elem.bic == ''}BIC кода липсва{else}BIC кода трябва да е уникален за всяка банка от списъка{/if}"{/if}> {$elem.bic}
	<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</td>

		<td class='sep'>&nbsp;</td>
	{if isset($smarty.session.reorderget)}
		{if $smarty.session.reorderget==$elem.id}
<td>
		{else}
<td align=center>
<a href="{$elem.put}"><img src="images/put.gif" title='спусни текста "{$smarty.session.reordertext}" преди този'></a></td>
		{/if}
	{else}
<td align=center>
<a href="{$elem.get}"><img src="images/get.gif" title="вземи този ред"></a></td>
	{/if}

	{/foreach}

</table>



