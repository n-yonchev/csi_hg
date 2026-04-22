{include file="_ajax.header.tpl"}
{include file="_erform.tpl"}

<center class="n10">
избери оформление
</center>

<br>
{include file="_select.tpl" FROM=$LISTVISUNAME ID="viname" C1="input" C2="inputer"}
<script>
	$("#viname").change(function(){ldelim}document.forms[0].submit();{rdelim});
</script>

{include file="_ajax.footer.tpl"}
