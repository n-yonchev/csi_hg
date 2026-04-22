{include file="_ajax.header.tpl"}{if $EDIT==0}	{assign var='_title' value='ВЪВЕДИ НОВО ПЛАЩАНЕ'}{else}	{assign var='_title' value='КОРЕГИРАЙ ПЛАЩАНЕ'}{/if}
{include file="_window.header.tpl" TITLE="$_title" WIDTH='300'}{include file="_erform.tpl"}

<script>
//parent.$.nyroModalSettings({ldelim}width:420, height:300{rdelim});
</script>

<center class="n10">

</center>

	<br>
	дата
	<br>
<input type="text" name="date" id="date" class="input" size=12 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
	<br>
	сума за погасяване на главницата
	<br>
<input type="text" name="tocapi" id="tocapi" class="input" size=12 {include file="_erelem.tpl" ID="tocapi" C1="input" C2="inputer"}> 
	<br>
	сума за погасяване на лихвата
	<br>
<input type="text" name="tointe" id="tointe" class="input" size=12 {include file="_erelem.tpl" ID="tointe" C1="input" C2="inputer"}> 
	<br>
	<br>{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{* <input type="submit" class="submit" name="submit" id="submit" value="запиши">  *}

{*---- скрипт за js календара --------------------------------*}
{include file="_jscale.tpl" FIELD="date"}

{include file="_window.footer.tpl"}{include file="_ajax.footer.tpl"}
