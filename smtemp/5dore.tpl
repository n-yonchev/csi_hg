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
				<td class='d_table_title' colspan='200'>Входящ регистър за {$abou} {$txpage}</td>
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
{*----
<a href="{$DATE.linkget}" class="nyroModal" target="_blank">
<img src="images/date.gif" title='избери дата'>
</a>
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="<img src='images/date.gif' alt='' /> период"}
----*}
{include file='_button.tpl' HREF=$DATE.linkget CLASS='nyroModal' TARGET='_blank' TITLE="период"}
{*--------*}
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
{*----
<a href="{$CURINT}" class="nyroModal" target="_blank">
<img src="images/print.gif" title="отпечати">
</a>
&nbsp;&nbsp;&nbsp;
----*}
{*--------*}
				{/if}
				</td>
			</tr>
		</thead>
			<tr class='header'>	
				<td><span> дата </span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> вх.номер</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> изп.дело</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> подател</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> описание</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> бележки</span></td>
			</tr>
		<tbody>
		{foreach from=$LIST item=elem key=ekey}
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
				<td valign=top> {$elem.created|date_format:"%d.%m.%Y"}</td>
				<td class='sep'>&nbsp;</td>
				<td valign=top> {$elem.serial}
						{*----
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
						----*}
						</td>
				<td class='sep'>&nbsp;</td>
{*----
				<td align="{$tddire}"> {$tdtext}</td>
----*}
						{if $FLPRIN}
							<td align="left" valign=top>
						{foreach from=$elem.caselist item=cuca}
							{$cuca}&nbsp;
						{/foreach}
							</td>
						{else}
<td valign=top align=center>
	{if empty($elem.caselist)}
&nbsp;
	{elseif count($elem.caselist)==1}
{$elem.caselist[0]}
	{else}
<img src="images/view.png" title='{foreach from=$elem.caselist item=cuca}{$cuca}&nbsp;{/foreach}'>
	{/if}
						{/if}
				<td class='sep'>&nbsp;</td>
				<td valign=top> {$elem.from}</td>
				<td class='sep'>&nbsp;</td>
				<td valign=top> {$elem.text}</td>
				<td class='sep'>&nbsp;</td>
{*----
				<td> {$elem.notes|replace:";":"; "}</td>
----*}
						{if $FLPRIN}
							<td valign=top align=left>
							{$elem.notes|replace:";":"; "|replace:",":", "}
						{else}
<td valign=top align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
						{/if}
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
