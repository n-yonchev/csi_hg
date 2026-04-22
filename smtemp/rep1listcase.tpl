											<table align=center>
											<tr>
											<td>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$BACKLINK}> назад към статистиката
</a>
											<tr>
											<td>

<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
					{assign var=txperi value=$ARPERI[0]|cat:" год."}
					{if empty($ARPERI[1])}
					{else}
						{assign var=txperi value=$txperi|cat:" полугодие "|cat:$ARPERI[1]}
					{/if}
	<tr>
<td class='d_table_title' colspan='200'> отчет раздел 1 за {$txperi}
{*
			<div align=right>
				{assign var=fuexurl value="fuex('"|cat:$URLCREATE|cat:"');"}
				{include file='_button.tpl' ONCLICK=$fuexurl TITLE="формирай отчета"}
			</div>
*}
<br>
списък на делата 
<br>
{$HETEXT}
</td>
	</tr>
</thead>
		<tr class='header'>
<td align=left> дело
		<td class='sep'>&nbsp;</td>	
<td> образувано </td>
		<td class='sep'>&nbsp;</td>	
<td> идва от </td>
		<td class='sep'>&nbsp;</td>	
<td> титул </td>
		<td class='sep'>&nbsp;</td>	
<td> вид </td>
		<td class='sep'>&nbsp;</td>	
<td> ред за отчета </td>
		<td class='sep'>&nbsp;</td>	
<td> характер </td>
{*
		<td class='sep'>&nbsp;</td>	
<td> взем.вид-размер </td>
		<td class='sep'>&nbsp;</td>	
<td> взем.произход </td>
*}
		<td class='sep'>&nbsp;</td>	
<td align=center> год </td>
{*
		<td class='sep'>&nbsp;</td>	
<td align=center> 2 </td>
		<td class='sep'>&nbsp;</td>	
<td align=center> 3 </td>
*}
		<td class='sep'>&nbsp;</td>	
<td></td>
		
		<tbody>
{foreach from=$LIST item=elem key=ekey}
{*
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'
		onclick="window.location.href='{$elem.edit}';" style="cursor:pointer;">
*}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=left> {$elem.serial}/{$elem.year}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.created|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td align=left> {$ARFROM[$elem.idcofrom]}
		<td class='sep'>&nbsp;</td>
<td align=left> {$ARTITU[$elem.idtitu]}
		<td class='sep'>&nbsp;</td>
<td align=left> {$ARSORT[$elem.idsort]}
		<td class='sep'>&nbsp;</td>
<td align=left> 
					{if $elem.idrepo==0}
<img src="images/block.gif" title="не е избран ред за отчета">
					{else}
{$ARREPO[$elem.idrepo]}
					{/if}
		<td class='sep'>&nbsp;</td>
<td align=left> 
					{if $elem.idchar==0}
<img src="images/block.gif" title="не е избран характер на изпълнението">
					{else}
{$ARCHAR[$elem.idchar]}
					{/if}
{*
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.claimdescrip}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.origname}
*}
		<td class='sep'>&nbsp;</td>
<td align=center> 
				{if $elem.flyear}
<img src="images/block.gif" title="датата на образуване не съвпада с годината на делото">
				{else}
&nbsp;
				{/if}
{*
		<td class='sep'>&nbsp;</td>
<td align=center> 
				{if $elem.flyear}
<img src="images/block.gif" title="датата на образуване не съвпада с годината на делото">
				{else}
-
				{/if}
		<td class='sep'>&nbsp;</td>
<td align=center> 
				{if $elem.flrepo}
<img src="images/block.gif" title="не е избран ред за отчета">
				{else}
-
				{/if}
		<td class='sep'>&nbsp;</td>
<td align=center> 
				{if $elem.flchar}
<img src="images/block.gif" title="не е избран характер на изпълнението">
				{else}
-
				{/if}
*}
		<td class='sep'>&nbsp;</td>
<td align=center> 
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
</td>
{/foreach}
		</tbody>

{include file="_pagina.tr.tpl"}
</table>

											</table>
