{*---- сметка на взискателя от делото ----*}
{*---- сметки на собственика по булстат, егн или име ----*}
				<table>
				<tr>
<td colspan=20>
избери една от сметките
		{foreach from=$ACLIST item=acelem key=ackey}
							{if $acelem.id== -1}
				<tr>
<td colspan=20>
сметка на взискателя от делото 
							{else}
							{/if}
				<tr bgcolor="silver">
								{if empty($acelem.iban) and empty($acelem.bic)}
<td colspan=20> няма
								{else}
{*
<td> <input type="radio" name="idiban" id="idiban" value="{$acelem.id}" {if $acelem.flag}checked{else}{/if} onclick="$('#submit').click();">
*}
<td> <input type="radio" name="idiban" value="{$acelem.id}" {if $acelem.flag}checked{else}{/if} onclick="document.forms[0].submit();">
<td> {$acelem.iban}
<td> {$acelem.bic}
<td> {$acelem.descrip}
<td> {$acelem.c2name}
								{/if}
							{if $acelem.id== -1}
				<tr>
<td colspan=20>
сметки на собственик тип <b>{$COTYPE}</b> с {$COTEXT} <b>{$COCONT}</b>
								{if $ackey==count($ACLIST)-1}
				<tr bgcolor="silver">
<td colspan=20> няма
								{else}
								{/if}
							{else}
							{/if}
		{/foreach}
				</table>
{*
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
*}
