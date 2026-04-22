{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="избери неизпратен плик" WIDTH=700}
{include file="_erform.tpl"}
<style>
td {ldelim}font:normal 8pt verdana;border-bottom: 1px solid white;border-right: 1px solid white;{rdelim}
.head {ldelim}background-color:silver !important;{rdelim}
.enve {ldelim}background-color:beige !important;{rdelim}
.link {ldelim}background-color:khaki !important;cursor:pointer;{rdelim}
.mark {ldelim}color:red;{rdelim}

{*
.ertype {ldelim}background-color:lightsalmon;cursor:help;{rdelim}
*}
</style>

за документ <b>{$ROPOST.d2seri}/{$ROPOST.d2year}</b>
<br>
с адресат <b>{$ROPOST.adresat}</b>
<br>
и адрес <b>{$ROPOST.address}</b>

<br>
<br>
					<table align=center>
					<tr>
<td class="head" colspan=3> плик
<td class="head" colspan=3> включени документи
					<tr>
<td class="head" align=center> #
<td class="head"> адресат
<td class="head"> адрес
<td class="head"> изх.
<td class="head"> адресат
<td class="head"> адрес
{foreach from=$ARENVE item=elenve key=idenve}
	{assign var=encoun value=$ARCOUN[$idenve]}
				{assign var=isfirst value=true}
	{foreach from=$elenve item=elem key=idpost}
					<tr>
				{if $isfirst}
<td rowspan={$encoun} align=center {include file="_href.tpl" LINK=$ARLINK[$idenve]} class="enve" 
onmouseover="$(this).addClass('link');" onmouseout="$(this).removeClass('link');"
> &nbsp;&nbsp;#{$idenve}&nbsp;&nbsp;
<td rowspan={$encoun}> {$elem.enveasat}
<td rowspan={$encoun}> {$elem.enveaddr}
				{else}
				{/if}
		{if $idpost==0}
<td class="mark" colspan=3> няма включени документи
		{else}
<td> {$elem.d2seri}/{$elem.d2year}
<td> {$elem.postasat}
<td> {$elem.postaddr}
		{/if}
				{assign var=isfirst value=false}
	{/foreach}
{/foreach}
					<tr>
					</table>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
