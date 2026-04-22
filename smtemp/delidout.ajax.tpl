{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="създаване на нов изходящ документ"}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
За всичките маркирани {$COUN} бр.външни документи
<br>
ще създадете нов изходящ документ,
<br>
който съдържа отговор към източника 
<br>
<b>{$HEAD}</b>.
<br>
Попълнете полета за новия изх.документ.
<br>
<br>

описание
<br>
<input type="text" name="descrip" id="descrip" size=60 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=60 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}>

{***
призовкар
<br>
{include file="_select.tpl" FROM=$ARUSERPOST ID="idpostuser" C1="input" C2="inputer"}
<br>
дата на вземане
<br>
<input type="text" name="date1" id="date1" size=20 {include file="_erelem.tpl" ID="date1" C1="input" C2="inputer"}> 
<br>
дата на връчване
<br>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
<br>
дата на връщане
<br>
<input type="text" name="date3" id="date3" size=20 {include file="_erelem.tpl" ID="date3" C1="input" C2="inputer"}> 
<br>
текущ статус
<br>
{include file="_select.tpl" FROM=$ARSTATPOST ID="idpoststat" C1="input" C2="inputer"}
***}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
