{include file="_ajax.header.tpl"}
<style>
body {ldelim}font:normal 8pt verdana;background-color:lightgreen; padding:14px;overflow:hidden;{rdelim}
.inpu2 {ldelim}font:normal 7pt verdana;border:0px solid black;{rdelim}
.inpu2er {ldelim}font:normal 7pt verdana;border:0px solid black;background-color:salmon;{rdelim}
</style>

корегирай +enter
<br>
{*
<input type="text" name="amou" id="amou" size=12 {include file="_erelem.tpl" ID="amou" C1="input" C2="inputer"}> 
*}
<input type="text" name="amou" id="amou" size=12 autocomplete=off value="{$smarty.post.amou}" 
	{if isset($TXER)}
class="inpu2er" style="cursor:help;" title="{$TXER}"
	{else}
class="inpu2"
	{/if}
> 
<br>
<a style="cursor:pointer;border-bottom:1px solid black;" href="#" onclick="parent.$('#fihide').click();">отказ</a>

<script>
$(document).ready(function() {ldelim}
	document.getElementById('amou').focus();
{rdelim});
</script>

{include file="_ajax.footer.tpl"}
