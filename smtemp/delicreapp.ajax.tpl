{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="параметри за придруж.писмо"}
{include file="_erform.tpl"}

				<fieldset class="filtgr">
				<legend align=right> придруж.писмо </legend>
изпраща се до районен съд
<br>
{include file="_select.tpl" FROM=$ARRSNAME ID="idrs" C1="input" C2="inputer"}
<br>
<br>
връчване на придруж.писмо
	<br>
{foreach from=$ARPOSTTYPE item=txty key=idty}
		{if $idty==0}
		{else}
	&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="idmeth" value='{$idty}' id='mt{$idty}'><label for="mt{$idty}">{$txty}</label>
	<br>
		{/if}
{/foreach}
				</fieldset>
				<fieldset class="filtgr">
				<legend align=right> връчената ПДИ </legend>
връчена на длъжник
<br>
<input type="text" name="adresat" id="adresat" size=60 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}> 
{*
<br>
на адрес
<br>
<textarea name="address" id="address" rows=2 cols=50 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}></textarea>
*}
<br>
<input type="checkbox" name="isboss" id="isboss" label="чрез работодателя">
<br>
на дата 
<br>
<input type="text" name="date" id="date" size=20 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
данни за длъжника
<br>
{*
<input type="text" name="debtdata" id="debtdata" size=60 {include file="_erelem.tpl" ID="debtdata" C1="input" C2="inputer"}> 
*}
<textarea name="debtdata" id="debtdata" rows=3 cols=50 {include file="_erelem.tpl" ID="debtdata" C1="input" C2="inputer"}></textarea>
				</fieldset>
			{*
			{if isset($IDDEBT)}
<input type="hidden" name="iddebt" id="iddebt" value="{$IDDEBT}">
			{else}
<hr>
ПДИ връчена на длъжник
{foreach from=$ARDEBT item=dename key=idde}
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="iddebt" value='{$idde}' id='d{$idde}'>
	<label for="d{$idde}">{$dename}</label>
						{assign var=is1 value=false}
{/foreach}
			{/if}
			*}
<br>
{include file='_button.tpl' TYPE='submit' TITLE='готово' NAME='submit' ID='submit'}


{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
