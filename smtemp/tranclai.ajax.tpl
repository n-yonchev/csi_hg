{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корекция получател на превод" WIDTH=360}
{include file="_erform.tpl"}

<br>
Сумата <b>{$ARDATA.amount|tomo3}</b> ще бъдe преведена на получател с наименование [35 символа]
<br>
<input type="text" name="clainame" id="clainame" size=70 {include file="_erelem.tpl" ID="clainame" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
