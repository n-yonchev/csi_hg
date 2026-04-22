{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай изх.документ"}
{include file="_erform.tpl"}

<br>
<u>взискатели по дело {$ROCASE.serial}/{$ROCASE.year}</u>
<br>
{foreach from=$ARCLAI item=elem}
{$elem.name}
<br>
<font color=blue> {$elem.address|nl2br} </font>
{/foreach}
<br>
<br>
<u>длъжници по дело {$ROCASE.serial}/{$ROCASE.year}</u>
<br>
{foreach from=$ARDEBT item=elem}
{$elem.name}
<br>
<font color=blue> {$elem.address|nl2br} </font>
{/foreach}

<br>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=80 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}> 
<br>
адрес
<br>
<input type="text" name="adres" id="adres" size=80 {include file="_erelem.tpl" ID="adres" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
