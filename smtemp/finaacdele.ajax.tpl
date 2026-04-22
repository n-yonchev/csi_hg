{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE='изтриване на сметка'}
{include file="_erform.tpl"}

<br>
потвърди изтриването на сметка на взискател {$NAME}
<br>
<br>
<font size=+1><b>{$ROCONT.iban}</b></font>
<br>
<font size=+1><b>{$ROCONT.bic}</b></font>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
