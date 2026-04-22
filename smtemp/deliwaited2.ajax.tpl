{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай маркираните документи"}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
Попълнете желаните полета.
<br>
Съдържанието на всички попълнени полета ще бъде записано
<br>
във всичките маркирани {$COUN} бр.документи.

<br>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=80 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}> 
<br>
адрес
<br>
<input type="text" name="address" id="address" size=80 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}> 
<br>
метод
<br>
{include file="_select.tpl" FROM=$ARPOSTTYPENAME ID="idposttype" C1="input" C2="inputer"}
{***
<br>
призовкар
<br>
{include file="_select.tpl" FROM=$ARUSERPOST ID="idpostuser" C1="input" C2="inputer"}
***}
{*
<br>
текущ статус
<br>
{include file="_select.tpl" FROM=$ARSTATPOST ID="idpoststat" C1="input" C2="inputer"}
*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
