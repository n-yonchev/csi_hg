{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай бележките"}
{include file="_erform.tpl"}

<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}>
<br><br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
