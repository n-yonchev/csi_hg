{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="изтриване на изходящ документ"}
{include file="_erform.tpl"}

<br>
ВНИМАНИЕ.
<br>
<nobr>
Потвърди изтриването на изходящ документ <b>{$OUTDDATA.serial}/{$OUTDDATA.year}</b>
</nobr>
<br>
<b> {$OUTDDATA.typetext} </b>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='изтрий' NAME='submit' ID='submit'}
<br>
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
