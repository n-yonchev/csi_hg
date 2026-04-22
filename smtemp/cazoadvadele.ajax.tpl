{include file="_ajax.header.tpl"}
	{assign var="_title" value='изтриване на аванс.вноска'}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

<br>
<nobr>
потвърди изтриването на вноска
<br>
<b>{$ROCONT.amount|tomoney2}</b> € от взискател <b>{$ROCONT.clainame}</b> на дата <b>{$ROCONT.date|date_format:"%d.%m.%Y"}</b>
</nobr>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
