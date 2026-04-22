{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов текст за произход на вземане'}
{else}
	{assign var='_title' value='корегирай произход на вземане'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}


текст
<br>
<input type="text" name="name" id="name" size=50 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{*  <input type="submit" class="submit" name="submit" id="submit" value="запиши"> *}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
