{include file="_ajax.header.tpl"}
	{assign var=txdocu value="<b>"|cat:$DOCU.serial|cat:"/"|cat:$DOCU.year|cat:"</b>"}
{include file='_window.header.tpl' TITLE="списък дела за документ "|cat:$txdocu}

				<table class="d_table" cellspacing='0' cellpadding='0' align=center>
				<tr class='header'>
			<td><span> номер </span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> деловодител </span></td>
	{foreach from=$LIST item=elem}
				<tr>
<td align=right> <b>{$elem.caseseri}/{$elem.caseyear}</b>
			<td class='sep'>&nbsp;</td>
<td> {$elem.username}
	{/foreach}
				</table>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
