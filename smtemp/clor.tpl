<table class="d_table" width='350px' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на текстовете за произход на вземане</td>
	</tr>
	<tr>
		<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
		</td>
	</tr>
</thead>
{*---- съдържание ----------------------*}

<tr class='header'>
	<td>текст </td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
{*----
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
----*}
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
		<td align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
{*----
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.view}" class="nyroModal" target="_blank"><img src="images/view.png" title="подробно"></a></td>
----*}
		<td class='sep'>&nbsp;</td>
	{if isset($smarty.session.getclor)}
		{if $smarty.session.getclor==$elem.id}
<td>
		{else}
<td align=center><a href="{$elem.put}"><img src="images/put.gif" title='спусни текста "{$smarty.session.getclorname}" преди този'></a></td>
		{/if}
	{else}
<td align=center><a href="{$elem.get}"><img src="images/get.gif" title="вземи"></a></td>
	{/if}
	</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>



