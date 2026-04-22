{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="прехвърли маркираните документи" WIDTH=400}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
<br>
Всички маркирани {$COUN} бр.документи ще бъдат прехвърлени 
<br>
от списъка на чакащите в нормалния списък.
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='прехвърли' NAME='submyes' ID='submyes'}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='откажи' NAME='submno' ID='submno'}

{*
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
<br>
призовкар
<br>
{include file="_select.tpl" FROM=$ARUSERPOST ID="idpostuser" C1="input" C2="inputer"}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>
*}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
