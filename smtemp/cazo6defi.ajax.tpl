{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="изтриване на файл"}
{include file="_erform.tpl"}

<br>
<nobr>
потвърди изтриването на файла <b>{$FILENAME}</b>
</nobr>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
