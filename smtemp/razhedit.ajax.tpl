{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов РКО'}
{else}
	{assign var='_title' value='корегирай РКО '|cat:$RAZHNUMB}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

	сума
<br>
<input type="text" name="amount" id="amount" {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 
	<br>
	дата
<br>
<input type="text" name="cashdate" id="cashdate" {include file="_erelem.tpl" ID="cashdate" C1="input" C2="inputer"}> 
	<br>
	изплаща се на
<br>
<input type="text" name="cashname" id="cashname" size=40 {include file="_erelem.tpl" ID="cashname" C1="input" C2="inputer"}> 
	<br>
	основание за изплащането
<br>
<textarea name="descrip" id="descrip" rows=3 cols=50 size=255 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}></textarea>
	<br>
	адрес
<br>
<textarea name="address" id="address" rows=2 cols=50 size=120 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}></textarea>
	<br>
	лична карта, издадена на, от 
<br>
<textarea name="pass" id="pass" rows=2 cols=50 size=120 {include file="_erelem.tpl" ID="pass" C1="input" C2="inputer"}></textarea>
	<br>
	представител на
<br>
<input type="text" name="repres" id="repres" size=60 {include file="_erelem.tpl" ID="repres" C1="input" C2="inputer"}> 
	<br>
	пълномощно/дата
<br>
<input type="text" name="letter" id="letter" size=40 {include file="_erelem.tpl" ID="letter" C1="input" C2="inputer"}> 
	<br>
	изп.дело 
<br>
<input type="text" name="casenumb" id="casenumb" {include file="_erelem.tpl" ID="casenumb" C1="input" C2="inputer"}> 
	<br>
	касиер
<br>
<input type="text" name="cashier" id="cashier" size=40 {include file="_erelem.tpl" ID="cashier" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
