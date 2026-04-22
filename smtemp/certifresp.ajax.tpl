{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="справка от регистъра" WIDTH=600}
{include file="_erform.tpl"}

<br>
за <b>{$ADRESAT}</b>
<br>
				{if count($QURESU)==0}
няма регистрирани дела в регистъра на длъжниците 
				{else}
има следните регистрирани дела в регистъра на длъжниците
<style>
.trow {ldelim}border-bottom: 1px solid black;{rdelim}
</style>
						<table align=center>
						<tr bgcolor=silver>
<td> ЧСИ
<td> изп.дело
<td> характер
		{foreach from=$QURESU item=elem}
						<tr>
<td class="trow"> {$elem.enforcerdesc}
<td class="trow"> {$elem.execcasenumber}/{$elem.execcaseyear}
<td class="trow"> {$elem.caseoriginsdesc}
		{/foreach}
						</table>
				{/if}
<br>
<br>
<br>
<br>

<script>
				{if $FROMVIEW}
nyremo= function(){ldelim}parent.location.reload();{rdelim}
				{else}
parent.fuprin("{$TOWORD}");
				{/if}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
