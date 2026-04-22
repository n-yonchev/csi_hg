{* include file='_frame.header.tpl' TITLE='списък на входящите документи'  *}

<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на входящите документи</td>
		</tr>
		<tr>
			<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			</td>
		</tr>
	</thead>
	<tr class='header'>
		<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
		<td> <span> деловодител </span></td>
		<td class='sep'>&nbsp;</td>
		<td> редакция </td>
	</tr>
	<tbody>
{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
		<td align=right> {$elem.serial}/{$elem.year}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.from}</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
						{if $elem.idcase==-1}
							{assign var="tdtext" value="ново"}
							{assign var="tddire" value="left"}
						{elseif  $elem.idcase==0}
							{assign var="tdtext" value="друго"}
							{assign var="tddire" value="left"}
						{else}
							{assign var="tdtext" value=$elem.caseseri|cat:"/"|cat:$elem.caseyear}
							{assign var="tddire" value="right"}
						{/if}
		</td>
		<td class='sep'>&nbsp;</td>
		<td align="{$tddire}"> {$tdtext}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.username}</td>
		<td class='sep'>&nbsp;</td>
		<td  align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/admin.gif" title="корегирай"></a></td>

	{*----		<td class="none" align=center> <img src="images/delete.png" title="изтрий" onclick="alert('deletion');">----*}
	</tr>

		{/foreach}
		</tbody>

	{include file="_pagina.tr.tpl"}
		
	</table>
{* include file='_frame.footer.tpl' *}
{ *include file="_pagina.tpl" *}

