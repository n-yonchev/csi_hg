{include file="_ajax.header.tpl"}{if $EDIT==0}	{assign var="_title" value="въведи заделената сума"}{else}	{assign var="_title" value="КОРЕГИРАЙ заделената сума"}{/if}{include file='_window.header.tpl' TITLE=$_title WIDTH=300}
{include file="_erform.tpl"}

<center class="n10">общата сума е <b>{$AMOU|tomoney}</b>
</center>

<br>
заделена сума
<br>
<input type="text" name="amountsep" id="amountsep" size=20 {include file="_erelem.tpl" ID="amountsep" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{* <input type="submit" class="submit" name="submit" id="submit" value="запиши">  *}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
