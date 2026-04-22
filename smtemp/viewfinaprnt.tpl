<style>
.head {ldelim}font:bold 7pt verdana; background-color:silver;{rdelim}
.fina {ldelim}font:normal 8pt verdana; background-color:moccasin;{rdelim}
{*
.case {ldelim}font:normal 8pt verdana; border-bottom: 1px solid blue;{rdelim}
*}
.case {ldelim}font:normal 10pt verdana;{rdelim}
</style>
			<table cellspacing='2' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class="case" colspan='15'> списък на постъпленията по дела
{*
								{if $FLPRIN}
								{else}
	<div align=right class='d_table_button'>
{include file='_button.tpl' ONCLICK="fuprin('$PRNTLINK');" TITLE='Excel'}
	</div>
								{/if}
*}
			</thead>
			<tr>
<td colspan=8>
<td class="head" colspan=7 align=center> разпределение
			<tr>
<td class="head"> дело
<td class="head"> идва от
<td class="head"> образув
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
<td class="head" colspan=2> взискатели

		{foreach from=$CASELIST item=caseelem}
{*
			<tr>
<td colspan=11 bgcolor="moccasin"> 
по дело <b>{$caseelem.serial}/{$caseelem.year}</b> от <b>{$ARFROM[$caseelem.idcofrom]}</b> образув.<b>{$caseelem.created|date_format:"%d.%m.%Y"}</b>
*}
			<tr>
<td class="case"> {$caseelem.serial}/{$caseelem.year} &nbsp;
<td class="case"> {$ARFROM[$caseelem.idcofrom]} &nbsp;
<td class="case"> {$caseelem.created|date_format:"%d.%m.%Y"} &nbsp;
								{counter name=c1 start=0 assign=finacoun}
			{foreach from=$caseelem.fina item=finaelem}
								{counter name=c1 assign=finacoun}
								{if $finacoun==1}
								{else}
			<tr>
<td><td><td>
								{/if}
{*
<td> {$caseelem.serial}/{$caseelem.year} &nbsp;
<td> {$ARFROM[$caseelem.idcofrom]} &nbsp;
<td> {$caseelem.created|date_format:"%d.%m.%Y"} &nbsp;
*}
<td class="fina" align=right> {$finaelem.inco|tomoney2}
<td class="fina"> {$ARTYPE[$finaelem.idtype]}
<td class="fina">
						{if $finaelem.idtype==1}
{$finaelem.timebank}
						{elseif $finaelem.idtype==2}
{$finaelem.cashdate}
						{else}
&nbsp;
						{/if}
<td class="fina" align=center> {if $finaelem.isclosed==1}да{else}&nbsp;{/if}
<td class="fina"> {$finaelem.datebala|date_format:"%d.%m.%Y"} &nbsp;
<td class="head" align=right> {$finaelem.separa|tomoney2} &nbsp;
<td class="head" align=right> {$finaelem.separa2|tomoney2} &nbsp;
<td class="head" align=right> {$finaelem.back|tomoney2} &nbsp;
<td class="head" align=right> {$finaelem.banktax|tomoney2} &nbsp;
<td class="head" align=right> {$finaelem.rest|tomoney2} &nbsp;
{*
<td class="head" align=right> {$finaelem.claisuma|tomoney2}
*}
{*---- взискателите ---*}
								{counter name=c2 start=0 assign=distcoun}
				{foreach from=$finaelem.clailist item=clainame key=idclai}
								{counter name=c2 assign=distcoun}
					{assign var=myamou value=$finaelem.claiamou.$idclai}
					{if $myamou==0}
					{else}
								{if $distcoun==1}
								{else}
			<tr>
<td><td><td>
<td><td><td><td><td><td><td><td><td><td>
								{/if}
<td class="head" align=right> {$myamou} 
<td class="head"> {$clainame}
					{/if}
				{/foreach}

			{/foreach}
{**}
		{/foreach}

{*
								{if $FLPRIN}
								{else}
			<tr>
<td class='d_table_title' colspan='11'> 
{include file="_pagina.tr.tpl"}
								{/if}
*}
			</table>

{include file="_download.tpl"}
