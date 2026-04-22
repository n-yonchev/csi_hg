							{if $YEARFLAG}
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
							{else}
							{/if}

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='18'>
списък на делата с непълни основни данни
<br>
на деловодител {$USERDATA.name} за {$YEAR} година 
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
		<td class='sep'>&nbsp;</td>	
<td> взем.вид-размер </td>
		<td class='sep'>&nbsp;</td>	
<td> взем.произход </td>
		
		<tbody>
{foreach from=$LIST item=elem key=ekey}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'
		onclick="window.location.href='{$elem.edit}';" style="cursor:pointer;">
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
<td align=left> {$ARREPO[$elem.idrepo]}
		<td class='sep'>&nbsp;</td>
<td align=left> {$ARCHAR[$elem.idchar]}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.claimdescrip}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.origname}
{/foreach}
		</tbody>
{include file="_pagina.tr.tpl"}
		</table>
