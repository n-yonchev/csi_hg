{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="игнорирай постъпление"}
{include file="_erform.tpl"}

сума <b>{$DATA.inco}</b>
<br>
<br>
описание
<br>
<b>{$DATA.descrip}</b>
<br>
<br>
ВНИМАНИЕ.
<br>
Ако игнорирате това постъпление, то повече няма да се извежда в общия списък на постъпленията.
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='игнорирай' NAME='submit' ID='submit'}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='откажи' NAME='submit2' ID='submit2'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
