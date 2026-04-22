{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='добави сметка'}
{else}
	{assign var='_title' value='корегирай сметка'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

{if $EDIT==0}добави{else}корегирай{/if} сметка на взискателя <br>{$NAME}
<br>
<br>
iban
<br>
<input type="text" name="iban" id="iban" size=50 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
<br>
bic
<br>
<input type="text" name="bic" id="bic" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
<br>
описание
<br>
<input type="text" name="descrip" id="descrip" size=40 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
