{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нова банка'}
{else}
	{assign var='_title' value='КОРЕГИРАЙ'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

наименование
<br>
<input type="text" name="name" id="name" size=60 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}>

BIC код
<br>
<input type="text" name="bic" id="bic" size=8 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}>
{*
<br>
адрес
<br>
<input type="text" name="address" id="address" size=80 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}> 
*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
