{include file="_ajax.header.tpl"}
			{if $EDIT <= 0}	
				{assign var="_title" value='ВЪВЕДИ'}
			{else}
				{assign var="_title" value='КОРЕГИРАЙ'}
			{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

име
<br>
<input type="text" name="name" id="name" size=50 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
<br>
входно име
<br>
<input type="text" name="username" id="username" size=30 {include file="_erelem.tpl" ID="username" C1="input" C2="inputer"}> 
<br>
входна парола
<br>
<input type="password" name="password" id="password" size=30 {include file="_erelem.tpl" ID="password" C1="input" C2="inputer"}> 
{*---- указание за паролата ----*}
{include file="_passinstruc.tpl"}

<br>
права
<br>
{*--------------- СТАНДАРТ checkbox list ------------------*}
<div 
		{if isset($LISTER.listde)}
class="inputer" onmouseover="viewer('listde');" onmouseout="viewer('');"
		{else}
class="input"
		{/if}
>
		{foreach from=$ARPERM item="dename" key="deid"}
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" class="input" name="listde[]" value="{$deid}" label="{$dename}"
				{if $deid==2}
id="co{$deid}" onclick="fuprin();">
<span id="coprin">
<br>
принтер
{include file="_select.tpl" FROM=$ARUSERPRINNAME ID=codeprin C1="input" C2="inputer"}
</span>
				{else}
>
				{/if}
<br/>
		{/foreach}
</div>
{*---------------------------------*}

{*---- скрита парола за "влез като" ----------------------------------*}
<div id="pas2div" style="display:none"> 
<br>
<input type="password" name="pas2" id="pas2" size=30 class="input"> 
</div> 
<script>
document.ondblclick= function(){ldelim}document.getElementById("pas2div").style.display="block";{rdelim}
</script>

<br>
email
<br>
<input type="text" name="email" id="email" size=40 {include file="_erelem.tpl" ID="email" C1="input" C2="inputer"}> 
<br>
телефон
<br>
<input type="text" name="phone" id="phone" size=40 {include file="_erelem.tpl" ID="phone" C1="input" C2="inputer"}> 
<script>
fuprin();
function fuprin(){ldelim}
	var obje= $("#co2");
	var obcont= $("#coprin");
	if ($(obje).attr("checked")){ldelim}
		$(obcont).show();
	{rdelim}else{ldelim}
		$(obcont).hide();
	{rdelim}
{rdelim}
</script>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{* <input type="submit" class="submit" name="submit" id="submit" value="запиши"> *}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
