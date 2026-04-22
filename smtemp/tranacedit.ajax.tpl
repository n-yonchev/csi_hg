{include file="_ajax.header.tpl"}
			{if $EDIT <= 0}	
				{assign var="_title" value='въведи нова сметка'}
			{else}
				{assign var="_title" value='корегирай сметка'}
			{/if}
{include file='_window.header.tpl' TITLE=$_title WIDTH=360}
{include file="_erform.tpl"}

IBAN
<br>
<input type="text" name="iban" id="iban" size=30 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
<br>
BIC
<br>
<input type="text" name="bic" id="bic" size=10 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
<br>
тип
<br>
{include file="_select.tpl" FROM=$ARACCOTYPENAME ID="code" C1="input" C2="inputer"}
<br>
{*
взискател/бенефициент
*}
описание
<br>
<input type="text" name="desc" id="desc" size=40 {include file="_erelem.tpl" ID="desc" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
