{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="обръщение към регистъра" WIDTH=600}
{include file="_erform.tpl"}

{***
<h3>{$MESS}</h3>
			{if isset($ERCONT)}
{$ERCONT}
			{else}
			{/if}
<br>
<br>
***}
{include file="certifv2.inc.tpl"}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
