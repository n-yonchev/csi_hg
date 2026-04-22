<style>
.cell {ldelim}font: normal 7pt verdana; border-bottom: 1px solid silver; {rdelim}
</style>
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на пакетите за превод</td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" TITLE='добави' }
		</td>
		</tr>
		</thead>
{*---- съдържание ----------------------*}

		<tr class='header'>
<td align=right>номер</td>
		<td class='sep'>&nbsp;</td>
<td>сума</td>
		<td class='sep'>&nbsp;</td>
<td>създаден</td>
		<td class='sep'>&nbsp;</td>
<td>по дела</td>
		<td class='sep'>&nbsp;</td>
<td>по сметки</td>
		<td class='sep'>&nbsp;</td>
<td>прев</td>
		<td class='sep'>&nbsp;</td>
<td></td>
		</tr>

{foreach from=$LIST item=elem key=ekey}
						{assign var="myid" value=$elem.id}
{*
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' 
		onclick="window.location.href='{$elem.pack}';" style="cursor:pointer;" title="виж съдържанието">
*}
		<tr>
<td align=center><font size=+1><b> {$elem.id} </b></font></td>
		<td class='sep'>&nbsp;</td>
<td align=right><font size=+1><b>{$elem.suma|tomoney2} </b></font></td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}</td>
{*---- по дела ----*}
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.pack}">
<img src="images/edit.png" title="съдържание на пакета по дела<br> кликни за корекция" class="ctip" rel="#cont{$myid}">
</a>
	{*---- съдържание на доп.информация ----*}
	<span id="cont{$myid}" style="display: none">
{if count($elem.listcase)==0}
	няма включени дела в пакета
{else}
				<table>
				<tr>
				<td bgcolor="silver"> дело
				<td bgcolor="silver"> деловодител
				<td bgcolor="silver"> сума
				<td bgcolor="silver"> взискател
	{foreach from=$elem.listcase item=elemlist key=ekeylist}
				<tr>
<td valign=top class="cell"> {$elemlist.caseseri}/{$elemlist.caseyear}
<td valign=top class="cell"> {$elemlist.username}
<td valign=top class="cell" align=right bgcolor="#eeeeee"> &nbsp;<b>{$elemlist.amount}</b>&nbsp;
<td valign=top class="cell"> {$elemlist.clainame}
	{/foreach}
				</table>
{/if}
	</span>
</td>
{*---- по сметки ----*}
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.acco}">
<img src="images/edit.png" title="съдържание на пакета по сметки<br> кликни за корекция" class="ttip" rel="#acco{$myid}">
</a>
	{*---- съдържание на доп.информация ----*}
	<span id="acco{$myid}" style="display: none">
{if count($elem.listcase)==0}
	няма включени дела в пакета
{else}
				<table>
				<tr>
				<td bgcolor="silver"> iban
{*
				<td> <u>bic</u>
*}
				<td bgcolor="silver"> описание
				<td bgcolor="silver"> собственик
				<td bgcolor="silver"> сума
				<td bgcolor="silver"> дело
				<td bgcolor="silver"> деловодител
				<td bgcolor="silver"> пр
{*
				<td> <u>взискател</u>
*}
	{foreach from=$elem.listacco item=elemlist key=ekeylist}
				<tr>
<td valign=top class="cell"> {$elemlist.iban}
{*
<td valign=top class="cell"> {$elemlist.bic}
*}
<td valign=top class="cell"> {$elemlist.descrip}
<td valign=top class="cell"> {$elemlist.clai2name}
<td valign=top class="cell" align=right bgcolor="#eeeeee"> &nbsp;<b>{$elemlist.amount}</b>&nbsp;
<td valign=top class="cell"> {$elemlist.caseseri}/{$elemlist.caseyear}
<td valign=top class="cell"> {$elemlist.username}
			{if $elemlist.isdone==0}
<td valign=top class="cell"> 
			{else}
<td valign=top class="cell" bgcolor="green"> &nbsp;
			{/if}
{*
<td> {$elemlist.clainame}
*}
	{/foreach}
				</table>
{/if}
	</span>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right><b>{$elem.pasuma|tomoney2}</b></td>
		<td class='sep'>&nbsp;</td>
<td align=center>
				{if $elem.suma==$elem.pasuma and $elem.suma<>0}
<img src="images/mark.gif" title="преведен изцяло">
				{elseif $elem.pasuma==0}
<img src="images/block.gif" title="изцяло непреведен">
				{else}
<img src="images/part.gif" title="преведен частично">
				{/if}
		</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ctip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
	$('.ttip').cluetip({ldelim} width: 420, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
