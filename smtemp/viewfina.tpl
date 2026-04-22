<style>
.head {ldelim}font:bold 7pt verdana; background-color:#eeeeee;{rdelim}
</style>
			<table class="d_table" cellspacing='2' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='11'> списък на постъпленията по дела
	<div align=right class='d_table_button'>
{include file='_button.tpl' ONCLICK="fuprin('$PRNTLINK');" TITLE='Excel'}
	</div>
			</thead>
			<tr>
<td colspan=5>
<td class="head" colspan=6 align=center> разпределение
			<tr>
<td class="head" align=right> сума
<td class="head"> тип
<td class="head"> дата
<td class="head"> приключ
<td class="head"> дата-погас
<td class="head"> ЧСИ-неол
<td class="head"> ЧСИ-т.26
<td class="head"> връщане
<td class="head"> банк.такси
<td class="head"> неразпред
<td class="head"> взискатели

		{foreach from=$CASELIST item=caseelem}
			<tr>
<td colspan=11 bgcolor="moccasin"> 
по дело <b>{$caseelem.serial}/{$caseelem.year}</b> от <b>{$ARFROM[$caseelem.idcofrom]}</b> образув.<b>{$caseelem.created|date_format:"%d.%m.%Y"}</b>
{**}
			{foreach from=$caseelem.fina item=finaelem}
			<tr>
<td align=right> {$finaelem.inco|tomoney2}
<td> {$ARTYPE[$finaelem.idtype]}
<td>
						{if $finaelem.idtype==1}
{$finaelem.timebank}
						{elseif $finaelem.idtype==2}
{$finaelem.cashdate}
						{else}
&nbsp;
						{/if}
<td align=center> {if $finaelem.isclosed==1}да{else}&nbsp;{/if}
<td> {$finaelem.datebala|date_format:"%d.%m.%Y"} &nbsp;
<td class="head" align=right> {$finaelem.separa|tomoney2}
<td class="head" align=right> {$finaelem.separa2|tomoney2}
<td class="head" align=right> {$finaelem.back|tomoney2}
<td class="head" align=right> {$finaelem.banktax|tomoney2}
<td class="head" align=right> {$finaelem.rest|tomoney2}
{*
<td class="head" align=right> {$finaelem.claisuma|tomoney2}
*}
{*---- взискателите ---*}
<td class="head">
				{foreach from=$finaelem.clailist item=clainame key=idclai}
					{assign var=myamou value=$finaelem.claiamou.$idclai}
					{if $myamou==0}
					{else}
{$myamou} {$clainame}
<br>
					{/if}
				{/foreach}

			{/foreach}
{**}
		{/foreach}

			<tr>
<td class='d_table_title' colspan='11'> 
{include file="_pagina.tr.tpl"}
			</table>

{include file="_download.tpl"}
