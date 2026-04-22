{include file="_tab2.tpl"}
<style>
.mark3 {ldelim}color:red;{rdelim}
</style>

					<table align=center>
					<tr>
<td>
{foreach from=$ARV3LINK item=culink key=codevari}
	<span class="link3{if $codevari==$V3} curr3{else}{/if}" 
	{include file="_href.tpl" LINK=$culink}> 
	{$ARV3.$codevari}
	{if $ARV3COUN[$codevari]==0}{else}&nbsp;[{$ARV3COUN[$codevari]}]{/if}
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
{/foreach}
					</table>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на пликове и документи за изпращане по поща
					<tr class="head1">
<td colspan=5> плик
<td colspan=4> включени документи
					<tr class="head2">
<td align=center> #
<td> адресат
<td> адрес
<td> 
<td> 
<td> изх.
<td> адресат
<td> адрес
<td> 
{foreach from=$ARENVE item=elenve key=idenve}
	{assign var=encoun value=$ARCOUNENVE[$idenve]}
				{assign var=isfirst value=true}
	{foreach from=$elenve item=elem key=idpost}
					<tr>
				{if $isfirst}
<td rowspan={$encoun} align=center 
					{if $idpost==0}
					{elseif $elem.idstat==0}
class="stat0 toli" title="направи го изпратен" {include file="_href.tpl" LINK=$elem.tostat1}
					{else}
class="stat1 toli" title="направи го чакащ" {include file="_href.tpl" LINK=$elem.tostat0}
					{/if}
> &nbsp;&nbsp;#{$idenve}&nbsp;&nbsp;

<td rowspan={$encoun}> {$elem.enveasat}
<td rowspan={$encoun}> {$elem.enveaddr}
					{if $idpost==0}
<td rowspan={$encoun}> &nbsp;
<td rowspan={$encoun}> &nbsp;
					{else}
<td rowspan={$encoun} class="sortcurr toli" title="отпечати плик и известие" onclick="fup4('{$elem.prnt}');"> <b>пи</b>
<td rowspan={$encoun} class="sortcurr toli" title="отпечати само плик" onclick="fup4('{$elem.prntenve}');"> <b>п</b>
					{/if}
				{else}
				{/if}
		{if $idpost==0}
<td class="mark3" colspan=4> няма включени документи
		{else}
<td> {$elem.d2seri}/{$elem.d2year}
<td> {$elem.postasat}
<td> {$elem.postaddr}
			{if $elem.idstat==0}
<td class="toli" title="изключи от плик #{$idenve}"
{include file="_href.tpl" LINK=$elem.noenve}
> <img src="images/ignore.gif">
			{else}
<td> &nbsp;
			{/if}
		{/if}
				{assign var=isfirst value=false}
	{/foreach}
{/foreach}
{include file="_tab2pagi.tpl"}
				</table>

<iframe id="idp4" width=1 height=1 frameborder=0 style="display:block"></iframe>
{*
<iframe id="idp4" width=900 height=400 frameborder=1 style="display:block"></iframe>
*}
<script>
function fup4(p1){ldelim}
	document.getElementById("idp4").focus();
	document.getElementById("idp4").src= p1;
{rdelim}
</script>
