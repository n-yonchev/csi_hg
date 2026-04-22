{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов елемент идва от'}
{else}
	{assign var='_title' value='КОРЕГИРАЙ'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}


наименование
<br>
<input type="text" name="name" id="name" size=50 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{*  <input type="submit" class="submit" name="submit" id="submit" value="запиши"> *}
<br>
{*----
<script type="text/javascript">
	parent.$.nyroModalSettings({ldelim}
//	width:640, height:500
	bgColor: 'aqua'
	,modal: false
	,titleFromIframe: false
//	,title: null
	,autoSizable: false
	,resizable: false
	{rdelim});
</script>
----*}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
