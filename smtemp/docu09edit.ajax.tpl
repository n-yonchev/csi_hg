{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="ВНИМАНИЕ. ЛЕПЕНКА ЗА АДМИНИСТРИРАНЕ."}
{include file="_erform.tpl"}

<nobr>
		{if $NEWCASE}
въведи номера на новото дело за {$CASEYEAR} год.
		{else}
ако е грешен, корегирай този номер на съществуващо дело за {$CASEYEAR} год.
		{/if}
<input type="text" name="caseserial" id="caseserial" size=10 {include file="_erelem.tpl" ID="caseserial" C1="input" C2="inputer"}>
</nobr>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
