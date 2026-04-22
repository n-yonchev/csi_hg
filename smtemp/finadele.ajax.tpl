{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="потвърди изтриването на постъпление"}
{include file="_erform.tpl"}

<br>
		<table align=center>
		<tr>
<td> тип
			{assign var=myindx value=$DATA.idtype}
<td> <b> {$ARTYPE.$myindx} </b>
		<tr>
<td> сума
<td> <b>{$DATA.inco}</b>
		<tr>
<td valign=top> описание
<td> <b>{$DATA.descrip}</b>
		<tr>
<td valign=top> дело
<td> <b>
	{if empty($DATA.caseseri) and empty($DATA.caseyear)}
	{else}
{$DATA.caseseri}/{$DATA.caseyear}
	{/if}
</b>
		<tr>
<td colspan=2>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='изтрий' NAME='dele' ID='dele'}
		</table>
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
