{include file="_ajax.header.tpl"}
{include file="_erform.tpl"}

<center class="n10">
{if $VIEW==0}ВЪВЕДИ{else}КОРЕГИРАЙ{/if}
</center>

описание
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 
<br>
идва от
<br>
{include file="_select.tpl" FROM=$ARFROMNAME ID="idcofrom" C1="input" C2="inputer"}
{*--------*}
<br>
<br>
<input type="submit" class="submit" name="submit" id="submit" value="запиши"> 

{include file="_ajax.footer.tpl"}
