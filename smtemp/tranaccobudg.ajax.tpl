{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="състояние на сметка" WIDTH=500}
{include file="_erform.tpl"}

					{if empty($ARDATA)}
Сметката IBAN=<b>{$IBAN}</b> BIC=<b>{$BIC}</b> 
<br>
не влиза в списъка на бюджетните сметки.
<br>
<br>
Може да я запишете в списъка като сметка за преводи към бюджета с описание
<input type="text" name="desc" id="desc" size=40 {include file="_erelem.tpl" ID="desc" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submyes' ID='submyes'}
					{else}
						{if $ISBUDG}
Сметката IBAN=<b>{$IBAN}</b> BIC=<b>{$BIC}</b> 
<br>
влиза в списъка на бюджетните сметки с описание <b>{$ARDATA.desc}</b>
<br>
<br>
Може да я ИЗТРИЕТЕ от списъка на сметките за преводи към бюджета
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='изтрий' NAME='submno' ID='submno'}
						{else}
Сметката IBAN=<b>{$IBAN}</b> BIC=<b>{$BIC}</b> 
<br>
вече е маркирана като сметка <b>{$ARACCOTYPE[$ARDATA.code]}</b>
<br>
с описание <b>{$ARDATA.desc}</b>
<br>
<br>
Поради това НЕ МОЖЕ да я запишете в списъка като сметка за преводи към бюджета.
						{/if}
					{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
