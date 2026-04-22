{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE='корегирай съдържанието на документа'}
{include file="_erform.tpl"}



{*----
<input type="text" name="content" id="content">
----*}
<br>
{$HTMLCONT}

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{*----
<script type="text/javascript">
$(document).ready(function() {ldelim}
	parent.$.nyroModalSettings({ldelim}width:900, height:660{rdelim});
{rdelim});
</script>
----*}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
