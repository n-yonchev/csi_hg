{include file="_ajax.header.tpl"}
	{assign var="_title" value='ДЕмаркиране на директен превод'}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

<br>
{*
<nobr>
тази сума ще бъде маркирана
<br>
<b>{$TEXT}</b>
</nobr>
*}
<nobr>
разпределена сума <b>{$ROTRAN.amount|tomoney2}</b>
към взискател <b>{$CLAINAME}</b>
</nobr>
<br>
<nobr>
по дело <b>{$SUIT}</b> 
с деловодител <b>{$USERNAME}</b>
</nobr>
<br>
<br>
Тази сума ще бъде ДЕмаркирана като преведена ДИРЕКТНО <br>след което ще стане ЧАКАЩА.

<br>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
