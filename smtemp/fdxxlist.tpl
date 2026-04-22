{*
	източник : docu.tpl
*}

<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък входящи документи {$FILTTX}</td>
	</tr>
</thead>
					{if count($LIST)==0}
<tr>
<td>
няма вх.документи
					{else}
<tr class='header'>
		<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> кога </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
		<td> <span>деловодител</span></td>
		<td class='sep'>&nbsp;</td>
<td> &nbsp; </td>
</tr>

{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
{*----
	<tr onmouseover='this.style.backgroundColor="#eeeeff";' onmouseout='this.style.backgroundColor="";' >
----*}
		<td align=right> {$elem.serial}/{$elem.year}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.from}</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
		<td class='sep'>&nbsp;</td>
		<td> {$elem.u2name} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.created|date_format:"%d.%m.%Y"} 

{include file="_docucase.tpl"}

		<td class='sep'>&nbsp;</td>
<td  align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
	</tr>
	{/foreach}

{include file="_pagina.tr.tpl"}
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.caselist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
{rdelim});
var trcurr;
function trclic(obje){ldelim}
	if (trcurr){ldelim}
		trcurr.className= "";
	{rdelim}else{ldelim}
	{rdelim}
	obje.className= "trdocu";
	trcurr= obje;
{rdelim}
</script>
					{/if}
