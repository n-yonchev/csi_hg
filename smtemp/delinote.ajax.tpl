{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нови бележки'}
{else}
	{assign var='_title' value='корегирай бележки'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}


текст
<br>
<textarea rows=4 cols=70 name="notes" id="notes" size=255 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
