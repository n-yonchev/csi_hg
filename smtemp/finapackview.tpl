										<table align=center>
				{if $PAGEBACKLINK}
										<tr><td>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> назад към стр.{$PAGE} от списъка пакети </a>
				{else}
				{/if}
										<tr><td>
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на делата от пакет за превод <font size=+1>{$PACKNO}</font> </td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200'>
{*
{include file='_button.tpl' HREF="$ADDNEW" TITLE='добави това дело' }
*}
<form method=post>
<input class="inp7bold" type=text name="packcase" id="packcase" size=12>
{include file='_button.tpl' TYPE='submit' TITLE='добави това дело' NAME='submit' ID='submit'}
</form>
		</td>
		</tr>
		</thead>
{*---- съдържание ----------------------*}

		<tr class='header'>
<td>дело</td>
		<td class='sep'>&nbsp;</td>
<td>деловодител</td>
		<td class='sep'>&nbsp;</td>
<td>създадено</td>
		<td class='sep'>&nbsp;</td>
<td>идва от</td>
		<td class='sep'>&nbsp;</td>
<td>сума</td>
		<td class='sep'>&nbsp;</td>
<td></td>
{*
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
*}
		</tr>

{foreach from=$LIST item=elem key=ekey}
{*
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' onclick="window.location.href='{$elem.view}';" style="cursor:pointer;">
*}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.caseseri}/{$elem.caseyear} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.username}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.casecrea|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.cofrname}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$elem.suma|tomoney2}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.caseid}" class="nyroModal" target="_blank"><img src="images/edit.png" title="виж постъпленията"></a></td>
{*
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.view}"><img src="images/edit.png" title="съдържание"></a></td>
*}
		</tr>
	{/foreach}
</table>
										</table>

{$FORCENYRO}
