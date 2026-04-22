{include file="_ajax.header.tpl"}
	{assign var="_title" value='изтриване на постъпление'}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

				{*---- ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления ----*}
				{*---- не може да се изтрие банково постъпление ----*}
{***
				{if $NODELETE}
<br>
не може да се изтрива банково постъпление
<br>
<br>
***}
				{if $ISBANKORIG}
<br>
сума <b>{$DATA.inco}</b>
<br>
описание <b>{$DATA.descrip}</b>
<br>
<br>
Това постъпление е част от банково извлечение.
<br>
Затова не може да бъде изтрито.
<br>
Може само да премахнете постъплението от това дело.
<br>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='премахни' NAME='submigno' ID='submigno'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}
				{else}
<br>
потвърди изтриването на постъпление
<br>
сума 
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>{$DATA.inco}</b>
<br>
описание 
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>{$DATA.descrip}</b>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

				{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
