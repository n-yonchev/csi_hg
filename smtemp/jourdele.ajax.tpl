{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="изтриване на запис"}
{include file="_erform.tpl"}

<br>
ВНИМАНИЕ.
<br>
<nobr>
Потвърди изтриването на ръчно въведен запис с описание
<br>
<br>
<b>{$JOURDATA.descrip}</b>
</nobr>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='изтрий' NAME='submit' ID='submit'}
<br>
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
