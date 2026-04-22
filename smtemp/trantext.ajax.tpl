{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корекция основание за превод" WIDTH=360}
{include file="_erform.tpl"}

<br>
Сумата <b>{$ARDATA.amount}</b> ще бъдe преведена 
				{if $ARDATA.idclaimer<=0}
				{else}
<br>
на взискател <b>{$CLAINAME}</b>
				{/if}
		{if $ISPOSTBANK}
<br>
с основание [70 символа]
<br>
<input type="text" name="text" id="text" size=90 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 
		{else}
<br>
с основание [35 символа]
<br>
<input type="text" name="text1" id="text1" size=90 {include file="_erelem.tpl" ID="text1" C1="input" C2="inputer"}> 
<br>
и още пояснения [35 символа]
<br>
<input type="text" name="text2" id="text2" size=90 {include file="_erelem.tpl" ID="text2" C1="input" C2="inputer"}> 
		{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
