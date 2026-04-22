{include file="_ajax.header.tpl"}
{assign var='_title' value='данни за съдилище'}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

<nobr>
				<table align=center>
				<tr>
<td> име
<td> <b>{$DATA.name}</b>
				<tr>
<td> град
<td> <b>{$DATA.city}</b>
				<tr>
<td> съд.окръг
<td> <b>{$DATA.region}</b>
				<tr>
<td> адрес
<td> <b>{$DATA.address}</b>
				<tr>
<td> ел.поща
<td> <u><a href="mailto:{$DATA.email}"> <b>{$DATA.email}</b> </a></u>
				<tr>
<td> интернет стр.
<td> <u><a href="{$DATA.webpage}" target="_blank"> <b>{$DATA.webpage}</b> </a></u>
				<tr>
<td> банка
<td> <b>{$DATA.bank2}</b>
				<tr>
<td> сметка
<td> <b>{$DATA.bank2acc}</b>
				<tr>
<td colspan=2> държавни такси
				<tr>
<td> банка
<td> <b>{$DATA.bank1}</b>
				<tr>
<td> код
<td> <b>{$DATA.bank1bic}</b>
				<tr>
<td> сметка
<td> <b>{$DATA.bank1acc}</b>
				</table>
</nobr>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
