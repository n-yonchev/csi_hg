{include file="_ajax.header.tpl"}

{if $EDIT <= 0}
	{assign var="_title" value='въведи ново събитие'}
{else}
	{assign var="_title" value='корегирай събитие'}
{/if}

{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

дата
<br>
<input type="text" name="date" id="date" size=14 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
описание
<br>
<textarea name="text" id="text" rows=4 cols=70 size=255 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}></textarea>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
