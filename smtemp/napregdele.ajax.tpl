{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE='изтриване клон на НАП'}
{include file="_erform.tpl"}

<br>
<nobr>
потвърди изтриването на клон на АДВ
<br>
<b>{$NAME}</b>
</nobr>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
