{include file="_ajax.header.tpl"}
	{assign var="_title" value='маркиране на превод'}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

<br>
{*
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
*}
Всички суми за превод 
<br>
<br>
от пакет <b>{$PACKNO}</b> 
<br>
по сметка <b>{$IBAN} / {$BIC}</b>
<br>
със собственик <b>{$CLAINAME}</b>
<br>
<br>
ще бъдaт маркирани като преведени, след което няма да може да се корегира сметката.

<br>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
