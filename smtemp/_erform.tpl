		{if isset($LISTER)}
<div id="error" class="former" align=left style="visibility:hidden">&nbsp;</div>
<script>
var erlist= new Array();
	{foreach from=$LISTER item=erelem key=elid}
erlist["{$elid}"]= "{$erelem}";
	{/foreach}
</script>
		{else}
		{/if}