{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="история на корекциите за постъпление"}
{include file="_erform.tpl"}

	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
{include file="_fina.tpl" HIST=true}
	</table>

{*--------
<script type="text/javascript">
parent.$.nyroModalSettings({ldelim}
	modal: false
	,title: null
	,titleFromIframe: false
{rdelim});
</script>
--------*}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
