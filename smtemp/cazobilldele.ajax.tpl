{include file="_ajax.header.tpl"}
	{assign var="_title" value='изтриване на сметка'}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

<br>
<nobr>
потвърди изтриването на сметка
<br>
<br>
от дата <b>{$ROCONT.date|date_format:"%d.%m.%Y"}</b> 
<br>
за взискател <b>{$ROCONT.clainame}</b> 
<br>
на стойност <b>{$ROCONT.suma|tomoney2}</b> лв
</nobr>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
