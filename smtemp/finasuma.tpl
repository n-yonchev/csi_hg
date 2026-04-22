<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

										<table align=center>
{*
				{if $PAGEBACKLINK}
										<tr><td>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> назад към стр.{$PAGE} от списъка пакети </a>
				{else}
				{/if}
*}
										<tr><td>
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на разпределените суми за превод </td>
		</tr>
		</thead>

{*---- съдържание ----------------------*}
		<tr class='header'>
{*
<td>iban</td>
		<td class='sep'>&nbsp;</td>
<td>bic</td>
		<td class='sep'>&nbsp;</td>
<td>описание</td>
		<td class='sep'>&nbsp;</td>
<td>собственик</td>
		<td class='sep'>&nbsp;</td>
*}
<td>време</td>
		<td class='sep'>&nbsp;</td>
<td>сума</td>
		<td class='sep'>&nbsp;</td>
<td>взискател</td>
		<td class='sep'>&nbsp;</td>
<td>дело</td>
		<td class='sep'>&nbsp;</td>
<td>деловодител</td>
		<td class='sep'>&nbsp;</td>
<td>пакет</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
{*
		<td class='sep'>&nbsp;</td>
<td>iban</td>
		<td class='sep'>&nbsp;</td>
<td>bic</td>
		<td class='sep'>&nbsp;</td>
<td>описание</td>
		<td class='sep'>&nbsp;</td>
<td>собственик</td>
*}
		<td class='sep'>&nbsp;</td>
<td>превод</td>
		</tr>

							{assign var=curracnt value=""}
{foreach from=$LIST item=elem key=ekey}
{*
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' onclick="window.location.href='{$elem.view}';" style="cursor:pointer;">
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
*}
{*
</td>
							{/if}
*}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
{*
		<tr>
<td></td>
		<td class='sep'>&nbsp;</td>
<td></td>
		<td class='sep'>&nbsp;</td>
<td></td>
		<td class='sep'>&nbsp;</td>
<td></td>
		<td class='sep'>&nbsp;</td>
*}
<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"} </td>
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor="#dddddd"> {$elem.amount|tomoney2}</td>
{*---- ----*}
		<td class='sep'>&nbsp;</td>
					{if $elem.idclaimer<0}
<td color=red><font color=red> {$PSCLAI[$elem.idclaimer]} </font></td>
					{else}
<td> {$elem.clainame}</td>
					{/if}
		<td class='sep'>&nbsp;</td>
<td> {$elem.caseseri}/{$elem.caseyear} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.username}</td>
		<td class='sep'>&nbsp;</td>
<td align=center> {if $elem.idfinatranpack==0}{else}{$elem.idfinatranpack}{/if}</td>
		<td class='sep'>&nbsp;</td>
<td> 
						{assign var="myid" value=$elem.id}
							{if empty($elem.iban) and empty($elem.bic) and empty($elem.descrip) and empty($elem.clai2name)}
							{else}
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="сметка за превода">
<span id="cont{$myid}" style="display: none">
	<table>
	<tr>
<td align=right> iban
<td width=4>
<td><b>{$elem.iban}</b>
	<tr>
<td align=right> bic
<td>
<td><b>{$elem.bic}</b>
	<tr>
<td align=right> опис
<td>
<td><b>{$elem.descrip}</b>
	<tr>
<td align=right> собст
<td>
<td><b>{$elem.clai2name}</b>
	</table>
</span>
							{/if}
</td>
{*
		<td class='sep'>&nbsp;</td>
<td> {$elem.iban}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.bic}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.descrip}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.clai2name}</td>
*}
		<td class='sep'>&nbsp;</td>
<td align=center>
{*----------
				{if $elem.isdone==0 and $elem.idfinatranpack==0}
<a href="{$elem.mark}" class="nyroModal" target="_blank">
<img src="images/payy.gif" title="маркирай като преведена">
</a>
				{elseif $elem.isdone<>0}
<img src="images/mark.gif" title="преведена">
				{elseif $elem.isclosed<>0}
<img src="images/delefile.gif" title="преведено постъплението">
				{else}
&nbsp;
				{/if}
----------*}
				{if 0}
				{elseif $elem.isdone<>0}
<img src="images/mark.gif" title="преведена">
				{elseif $elem.isclosed<>0}
<img src="images/delefile.gif" title="преведено постъплението">
				{elseif $elem.idfinatranpack==0}
<a href="{$elem.mark}" class="nyroModal" target="_blank">
<img src="images/payy.gif" title="маркирай като преведена">
</a>
				{else}
&nbsp;
				{/if}
</td>
{*
		<td class='sep'>&nbsp;</td>
<td> {$elem.casecrea|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.cofrname}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$elem.suma|tomoney2}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.caseid}" class="nyroModal" target="_blank"><img src="images/edit.png" title="виж постъпленията"></a></td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.view}"><img src="images/edit.png" title="съдържание"></a></td>
*}
		</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>
										</table>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 260, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
