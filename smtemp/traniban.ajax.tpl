{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корекция на сметка за превод" WIDTH=360}
{include file="_erform.tpl"}

										{if $CONF}

Сумата <b>{$ARDATA.amount|tomo3}</b> ще бъдe преведена 
				{if $ARDATA.idclaimer<=0}
				{else}
<br>
на взискател <b>{$CLAINAME}</b>
				{/if}
<br>
по сметка <b>{$smarty.post.iban}</b>
<br>
в банка <b>{$NEWBANK}</b>
<br>
<br>
ОБАЧЕ 
<br>
Тази сметка се различава от {if empty($CLAIIBAN)}празната сметка{else}сметката <b>{$CLAIIBAN}</b><br>в банка <b>{$OLDBANK}</b>{/if}
<br>
записана в данните на взискателя.
<br>
<br>
АКО ПОТВЪРДИТЕ,
<br>
сметката за превода <b>{$smarty.post.iban}</b>
<br>
в банка <b>{$NEWBANK}</b>
<br>
ще бъде записана като сметка на взискателя.
<br>
<br>
<input type=hidden name="iban" id="iban" value="{$smarty.post.iban}">
<input type=hidden name="bic" id="bic" value="{$smarty.post.bic}">
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

										{else}

<br>
Сумата <b>{$ARDATA.amount|tomo3}</b> ще бъдe преведена 
				{if $ARDATA.idclaimer<=0}
				{else}
<br>
на взискател <b>{$CLAINAME}</b>
				{/if}
по сметка
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=30 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
{*
<br>
BIC
<br>
<input type="text" name="bic" id="bic" size=10 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
*}
		{if $ISPOSTBANK}
<br>
банка
<br>
<input disabled type="text" name="bankname" id="bankname" size=100 {include file="_erelem.tpl" ID="bankname" C1="input" C2="inputer"}> 
		{else}
		{/if}
				{if isset($ARIBAN)}
<br>
<br>
<style>
.iban {ldelim}font:normal 8pt verdana;{rdelim}
.ibhe {ldelim}background-color:khaki;{rdelim}
.note {ldelim}color:red;{rdelim}
</style>
		<table>
		<tr>
<td class="iban ibhe" colspan=3> сметки за връщане на длъжници
{foreach from=$ARIBAN item=elem}
		<tr>
<td class="iban"> {$elem.name}
<td width=20>
			{if empty($elem.iban)}
<td class="iban note"> липсва
			{else}
<td class="iban"> <b>{$elem.iban}</b>
			{/if}
{/foreach}
		</table>
				{else}
				{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

										{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
