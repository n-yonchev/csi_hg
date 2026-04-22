{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай маркираните документи"}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
Изберете желаните полета.
<br>
Съдържанието на всички избрани полета ще бъде ИЗЧИСТЕНО
<br>
във всичките маркирани {$COUN} бр.документи.

<br>
{*
<br>
<input class="cbox" type=checkbox name="cbfiel[]" value="adresat" label="адресат">
*}
<br>
<input class="cbox" type=checkbox name="cbfiel[]" value="address" label="адрес">
<br>
<input class="cbox" type=checkbox name="cbfiel[]" value="idposttype" label="метод">
<br>
<input class="cbox" type=checkbox name="cbfiel[]" value="idpostuser" label="призовкар">
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='изчисти' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
