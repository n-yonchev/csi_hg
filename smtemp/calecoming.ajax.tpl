{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="списък на събитията" WIDTH=500}

		<table class="d_table" cellspacing='0' cellpadding='0' align=left>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> предстоящи събития в близките 10 дни </td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td align=left> дело </td>
		<td class='sep'>&nbsp;</td>
<td align=left> деловодител </td>
		<td class='sep'>&nbsp;</td>
<td align=left> събитие </td>
		<tbody>
{foreach from=$LIST item=elem key=mkey}
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td> {$elem.date|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.caseseri}/{$elem.caseyear}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.username}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.text}
{/foreach}
		</tbody>
		</table>

{*
<script type="text/javascript">
$(document).ready(function() {ldelim}
	window.inte= setInterval("nyrowidth()",200);
	function nyrowidth(){ldelim}
		if (parent.$.nyroModalSettings){ldelim}
alert('yes');
			parent.$.nyroModalSettings({ldelim}width:600, height:300{rdelim});
			clearInterval(window.inte);
		{rdelim}else{ldelim}
alert('NO');
		{rdelim}
	{rdelim};
{rdelim});
</script>
*}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
