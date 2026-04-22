{include file="_ajax.header.tpl"}{if $EDIT <= 0}	{assign var="_title" value='ВЪВЕДИ НОВ ОРДЕР'}{else}	{assign var="_title" value='КОРЕГИРАЙ СЪЩЕСТВУВАЩ ОРДЕР'}{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}
<center class="n10">

</center>

				{if $EDIT <= 0}
<br>
дата
<br>
<input type="text" name="date" id="date" class="input" size=12 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
				{else}
<br>
номер <b>{$SERIYEAR}</b>
&nbsp;&nbsp;&nbsp;
от дата <b>{$DATE|date_format:"%d.%m.%Y"}</b>
<input type="hidden" name="date" id="date"> 
<br>
				{/if}

<br>
сума
<br>
<input type="text" name="amount" id="amount" class="input" size=12 {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 

<br>
вносител
<br>
<input type="text" name="name" id="name" size=50 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 

<br>
описание
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 

<br>
по дълга на длъжник
<br>
{include file="_select.tpl" FROM=$ARDEBTNAME ID="iddebtor" C1="input" C2="inputer"}

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{* <input type="submit" class="submit" name="submit" id="submit" value="запиши">  *}

{*---- скрипт за js календара --------------------------------*}
{include file="_jscale.tpl" FIELD="date"}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
