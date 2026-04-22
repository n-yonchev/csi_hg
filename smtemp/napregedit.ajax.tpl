{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов клон на НАП'}
{else}
	{assign var='_title' value='корегирай клон на НАП'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

наименование
<br>
<input type="text" name="name" id="name" size=50 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
