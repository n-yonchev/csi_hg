{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай маркираните екземпляри"}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
Попълнете желаните полета.
<br>
Съдържанието на всички попълнени полета ще бъде записано
<br>
във всичките маркирани {$COUN} бр.документи.

<br>
<br>
{*
							{if $VARITT==1}
дата 
<br>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
<br>
текущ статус
<br>
{include file="_select.tpl" FROM=$ARSTATPOST ID="idpoststat" C1="input" C2="inputer"}
							{else}
призовкар
<br>
{include file="_select.tpl" FROM=$ARUSERPOST ID="idpostuser" C1="input" C2="inputer"}
<br>
*}
дата на вземане
<br>
<input type="text" name="date1" id="date1" size=20 {include file="_erelem.tpl" ID="date1" C1="input" C2="inputer"}> 
<br>
дата на връчване
<br>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
<br>
дата на връщане
<br>
<input type="text" name="date3" id="date3" size=20 {include file="_erelem.tpl" ID="date3" C1="input" C2="inputer"}> 
<br>
текущ статус
<br>
{include file="_select.tpl" FROM=$ARSTATPOST ID="idpoststat" C1="input" C2="inputer"}
{*
							{/if}
					{if $ISEXTE}
<br>
смяна на източника
<br>
{include file="_select.tpl" FROM=$ARSOURPOSTNAME ID="iddelisour" C1="input" C2="inputer"}
					{else}
					{/if}
*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
