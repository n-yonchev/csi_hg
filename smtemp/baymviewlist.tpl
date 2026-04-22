<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

<center>{include file="_button.tpl" HREF=$PAGEBACKLINK TITLE="към стр. $PAGEBACK от извлеченията" }</center>
<br />

{if $VIEWLIST=="all"}
	{assign var=tex2 value="всички"}
{elseif $VIEWLIST=="ready"}
	{assign var=tex2 value="готови"}
{else}
	{assign var=tex2 value="????"}
{/if}
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>плащания за експорт ({$tex2})</td>
		</tr>
	</thead>
		<tr class='header'>
			<td colspan=5 align=center> постъпление </td>
			<td class='sep'>&nbsp;</td>
			<td colspan=9 align=center> плащане </td>
		</tr>
		<tr class='header'>
			<td> сума </td>
			<td class='sep'>&nbsp;</td>
			<td> име </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> дело </td>
			<td class='sep'>&nbsp;</td>
			<td> взискател </td>
			<td class='sep'>&nbsp;</td>
			<td> основание </td>
			<td class='sep'>&nbsp;</td>
			<td> готово </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
		</tr>

			<tr>
{*---- съдържание ----------------------*}
	{foreach from=$DATA item=elem key=ekey}
			<tr valign=top>
				<td> {$elem.AMOUNT_C}</td>
				<td class='sep'>&nbsp;</td>
				<td class="t8bord"> {$elem.NAME_R}</td>
				<td class='sep'>&nbsp;</td>
								{assign var="myid" value=$elem.id}
				<td> <img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация"></td>
				<td class='sep'>&nbsp;</td>
				<td class="t8bord"> {$elem.caseseri}/{$elem.caseyear}</td>
				<td class='sep'>&nbsp;</td>
				<td class="t8bord"> {$elem.clainame}</td>
				<td class='sep'>&nbsp;</td>
				<td class="t8bord"> {$elem.payrem1}; {$elem.payrem2}</td>
				<td class='sep'>&nbsp;</td>
							{if $elem.isready==1}
				<td class="t8bord" align=center bgcolor="#ddffdd" valign=middle> да </td>
				<td class='sep'>&nbsp;</td>
							{else}
				<td class="t8bord" align=center> &nbsp; </td>
				<td class='sep'>&nbsp;</td>
							{/if}
				<td class="t8bord" valign=middle> <a href="{$elem.editpaym}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
				{*---- съдържание на доп.информация ----*}
					<span id="cont{$myid}" style="display: none">
					получено : <b>{$elem.POST_DATE} {$elem.TIME}</b>
					<br>
					описание : <b>{$elem.TR_NAME}</b>
					<br>
					забележка : <b>
					<br>
					{$elem.REM_I}
					<br>
					{$elem.REM_II}
					</b>
					</span>
			</tr>
		{/foreach}

{include file="_pagina.tr.tpl"}
			</table>
<br>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 270, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
