<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
	<td class='d_table_title' colspan='200'>списък на жалбите </td>
		</tr>
{*----
		<tr>
			<td class='d_table_button_center' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			</td>
		</tr>
----*}
	</thead>
		<tr class='header'>
<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> постъпила </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
<td> <span>деловодител</span></td>
{*----
		<td class='sep'>&nbsp;</td>
<td> статус </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td> променил </td>
		<td class='sep'>&nbsp;</td>
<td> на дата </td>
----*}
		<td class='sep'>&nbsp;</td>
<td> статус </td>
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td> бележки </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
		<tbody>
{foreach from=$LIST item=elem key=ekey}
{*----
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
----*}
	<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
		<td align=right> {$elem.serial}/{$elem.year}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.docucrea|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
		<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.from}</td>
		<td class='sep'>&nbsp;</td>
{*----
<td> {$elem.notes|replace:";":"; "}
----*}
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
		<td class='sep'>&nbsp;</td>
<td align=center>
{*
<img src="images/view.png" title='{$elem.u2name} {$elem.created|date_format:"%d.%m.%Y"}'>
*}
<img src="images/view.png" title='{$elem.u2name}'>

{include file="_docucase.tpl"}

{*----
		<td class='sep'>&nbsp;</td>
				{if $elem.status==0}
		<td  align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="промени"></a></td>
		<td class='sep'>&nbsp;</td>
		<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
		<td>&nbsp;</td>
				{else}
					{assign var=stin value=$elem.status}
		<td> {$ARSTAT.$stin}
		<td class='sep'>&nbsp;</td>
		<td> {$elem.statname}
		<td class='sep'>&nbsp;</td>
		<td> {$elem.created|date_format:"%d.%m.%Y"}
				{/if}
----*}
{*----
					{assign var=stin value=$elem.status}
		<td class='sep'>&nbsp;</td>
<td> {$ARSTAT.$stin}
		<td class='sep'>&nbsp;</td>
<td  align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="промени"></a>
</td>
				{if $stin==0}
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
				{else}
		<td class='sep'>&nbsp;</td>
<td> {$elem.statname}
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"}
				{/if}
----*}
		<td class='sep'>&nbsp;</td>
<td> {$ARSTAT[$elem.currstat]} {$stin}
		<td class='sep'>&nbsp;</td>
<td> {$elem.currdate|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td> {$elem.notes|nl2br}
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="промени"></a>
		</tr>

		{/foreach}
		</tbody>

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

