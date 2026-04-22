{if $FLPRIN}
	{assign var=txpage value="стр."|cat:$PAGENO}
{else}
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	{foreach from=$YEARLIST item=elem key=ekey}
		<td class='tabs_sep'>&nbsp;</td> 
		{if $YEAR==$ekey}
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span>{$ekey}</span></td>
			<td class='tabs_right_selected'></td>
		{else}	
			<td onclick='document.location.href="{$elem}"' class='tabs_left'></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_middle'><span>{$ekey}</span></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_right'></td>
		{/if}
	{/foreach}
	</tr>
	</table>
</div>
{/if}


				{if isset($DATE.date) and $FLPRIN}
					{assign var=abou value=$DATE.date|date_format:"%d.%m.%Y"}
				{else}
					{assign var=abou value=$YEAR|cat:" год."}
				{/if}
	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
			<tr>
<td class='d_table_title' colspan='200'> Регистър на заведените дела за {$abou} {$txpage}</td>
			</tr>
			<tr>
				<td class='d_table_button' colspan='200'>
				{if $FLPRIN}
				{else}
	{if isset($DATE.date)}
		{if empty($DATE.date2)}
за дата <b>{$DATE.date|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{else}
за периода от <b>{$DATE.date|date_format:"%d.%m.%Y"}</b> до <b>{$DATE.date2|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{/if}
	{else}
	{/if}
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="период"}
&nbsp;
	{if isset($DATE.linkall)}
<a href="{$DATE.linkall}">
<img src="images/all.gif" title='всички редове'>
</a>
&nbsp;
	{else}
	{/if}
&nbsp;
{include file='_button.tpl' ONCLICK="fuprin('$CURINT');" TITLE="<img src='css/blue/button/printer.gif' alt='' /> Принтирай"}
				{/if}
				</td>
			</tr>
		</thead>
			<tr class='header'>	
<td> изп.дело </td>
				<td class='sep'>&nbsp;</td>
<td> молба образуване </td>
				<td class='sep'>&nbsp;</td>
<td> дело източник </td>
				<td class='sep'>&nbsp;</td>
												{if $FLPRIN}
<td> име на ЧСИ </td>
				<td class='sep'>&nbsp;</td>
<td> № ЧСИ </td>
				<td class='sep'>&nbsp;</td>
												{else}
												{/if}
<td> взискател </td>
				<td class='sep'>&nbsp;</td>
<td> длъжник </td>
				<td class='sep'>&nbsp;</td>
<td> вид размер вземане </td>
				<td class='sep'>&nbsp;</td>
<td> произход вземане </td>
				<td class='sep'>&nbsp;</td>
<td> дата </td>
			</tr>
		<tbody>
		{foreach from=$LIST item=elem key=ekey}
			<tr  onmouseover='this.className="trdocu";' onmouseout='this.className="";'>

{*---- пълния номер ----*}
<td valign=top> {$elem.fullnumb}
				<td class='sep'>&nbsp;</td>
{*---- първия входящ документ ----*}
<td valign=top> 
	{if empty($elem.firstdocu.seri)}
&nbsp;
	{else}
{$elem.firstdocu.seri}/{$elem.firstdocu.year}-{$elem.firstdocu.crea|date_format:"%d.%m.%Y"} 
	{/if}
</td>
				<td class='sep'>&nbsp;</td>
{*---- делото източник - източник : cazo1view.tpl ----*}
<td valign=top>
	{if empty($elem.conome) and empty($elem.coyear)}
&nbsp;
	{else}
{$ARSORT[$elem.idsort]} {$elem.conome}/{$elem.coyear} 
	{/if}
	{if empty($elem.idcofrom)}
&nbsp;
	{else}
{$ARFROM[$elem.idcofrom]}
	{/if}
				<td class='sep'>&nbsp;</td>
												{if $FLPRIN}
{*---- ЧСИ име, номер ----*}
<td valign=top> {$ROOFFI.shortname}</td>
				<td class='sep'>&nbsp;</td>
<td valign=top align=center> {$ROOFFI.serial}</td>
				<td class='sep'>&nbsp;</td>
												{else}
												{/if}
{*---- списък взискатели - източник : cazo34view.tpl ----*}
			{assign var=idcase value=$elem.id}
<td valign=top>
{include file="_recaseelem.tpl" DATALIST=$DATACLAI.$idcase}
				<td class='sep'>&nbsp;</td>
{*---- списък длъжници - източник : cazo34view.tpl ----*}
<td valign=top>
{include file="_recaseelem.tpl" DATALIST=$DATADEBT.$idcase}
				<td class='sep'>&nbsp;</td>
{*---- вид и размер на вземането ----*}
<td valign=top>
{$elem.claimdescrip}
				<td class='sep'>&nbsp;</td>
{*---- произход на вземането ----*}
<td valign=top>
{$ARCLAIORIG[$elem.idclaimorig]}
				<td class='sep'>&nbsp;</td>
{*---- специфичен статус - дата ----*}
<td valign=top>
	{if empty($elem.statdate)}
&nbsp;
	{else}
			{assign var=mystin value=$elem.statdate.indx}
			{assign var=mystda value=$elem.statdate.time}
{$TXTRANSTAT.$mystin} {$mystda|date_format:"%d.%m.%Y"}
	{/if}
{*----
			{assign var= value=}
		{foreach from=$TXTRANSTAT item=txstat key=instat}
			
		{/foreach}
----*}

			</tr>
		{/foreach}
		</tbody>
	
	{if $FLPRIN}
	{else}
{include file="_pagina.tr.tpl"}
		<iframe id="fraint" width=1 height=1 style="visibility:hidden"></iframe>
		<script>
		function fuprin(p1){ldelim}
			var op= document.getElementById("fraint").src= p1;
		{rdelim}
		</script>
	{/if}
			</table>
