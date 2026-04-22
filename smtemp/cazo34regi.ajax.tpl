{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="справка от регистъра" WIDTH=400}
{include file="_erform.tpl"}
{*----
<h3>{$ARCONT[0]}</h3>
{$ARCONT[1]}
----*}

<h3>{$MESS}</h3>
			{if isset($ERCONT)}
{$ERCONT}
			{else}
{$OKRESU}
за <b>{$DEBTNAME}</b>
<br>
				{if count($OKLIST)==0}
няма регистрирани дела при други ЧСИ 
				{else}
има <b>{$OKCOUN} {if $OKCOUN==1}брой{else}броя{/if}</b> регистрирани дела при други ЧСИ
<style>
.trow {ldelim}border-bottom: 1px solid black;{rdelim}
</style>
						<table align=center>
						<tr bgcolor=silver>
<td> ЧСИ
<td> име
<td> изп.дело
		{foreach from=$OKLIST item=elem}
						<tr>
<td class="trow"> {$elem.enforcernumber}
<td class="trow"> {$elem.enforcerfullname}
<td class="trow"> {"`$elem.execcasenumber+0`"}/{$elem.execcaseyear}
		{/foreach}
						</table>
				{/if}
			{/if}
<br>
<br>

{*
				{if isset($TOWORD)}
<script>
parent.fuprin("{$TOWORD}");
</script>
				{else}
				{/if}
*}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
