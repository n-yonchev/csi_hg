{include file="_ajax.header.tpl"}

{assign var='tmp' value=$BANKDATA.AMOUNT_C}

{include file='_window.header.tpl' TITLE="данни за постъплението на сума <i>$tmp</i>"}

{include file="_erform.tpl"}

	<table class="caseview" align=center>

{*---- заглавна част ----------------------*}
	<tr>
<td class="contleft" colspan=10> 
<br> &nbsp;
	<tr>
<td class="contleft"> време
<td class="cont"> {$BANKDATA.POST_DATE} {$BANKDATA.TIME}
	<tr>
<td class="contleft"> описание
<td class="cont"> {$BANKDATA.TR_NAME}
	<tr>
<td class="contleft"> име
<td class="cont"> {$BANKDATA.NAME_R}
	<tr>
<td class="contleft" valign=top> забележка
<td class="cont"> {$BANKDATA.REM_I}<br>{$BANKDATA.REM_II}
	<tr>
<td class="contleft" colspan=10>
сумата е назначена към
	<tr>
<td class="contleft"> дело
<td class="cont"> {$CASEDATA.serial}/{$CASEDATA.year}
	<tr>
<td class="contleft"> взискател
<td class="cont"> {$CLAIDATA.name}

{*---- форма за плащането ----------------------*}
	<tr>
<td class="contleft" colspan=10> 
<br>
данни за изходящо плащане на сума <b>{$BANKDATA.AMOUNT_C}</b> по сметка на взискател
<br> &nbsp;
	<tr>
<td class="contleft"> сума
<td class="cont"> {$BANKDATA.AMOUNT_C}
	<tr>
<td class="contleft"> бенефициент
<td class="cont"> {$CLAIDATA.name}
	<tr>
<td class="contleft"> IBAN
<td class="contleft"> 
<input type="text" name="payiban" id="payiban" size=30 {include file="_erelem.tpl" ID="payiban" C1="input" C2="inputer"}> 
	<tr>
<td class="contleft"> BIC
<td class="contleft"> 
<input type="text" name="paybic" id="paybic" size=30 {include file="_erelem.tpl" ID="paybic" C1="input" C2="inputer"}> 
	<tr>
<td>
<td class="contleft"> 
или избери сметка
{include file="_select.tpl" FROM=$ARACCO ID="iddebtor" C1="input" C2="inputer"}
	<tr>
<td class="contleft" valign=top> основание-1
<td class="contleft">
<textarea name="payrem1" id="payrem1" size=100 rows=2 cols=50 {include file="_erelem.tpl" ID="payrem1" C1="input" C2="inputer"}></textarea>
	<tr>
<td class="contleft" valign=top> основание-2
<td class="contleft">
<textarea name="payrem2" id="payrem2" size=100 rows=2 cols=50 {include file="_erelem.tpl" ID="payrem2" C1="input" C2="inputer"}></textarea>

	<tr>
<td class="contleft" colspan=10> 
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
			{if $NOSUB2}
			{else}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='запиши с грешките' NAME='submit2' ID='submit2'}
			{/if}

	</table>

<script>
//parent.$.nyroModalSettings({ldelim}width:540, height:500{rdelim});
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
