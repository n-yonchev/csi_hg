{include file="_ajax.header.tpl"}
			{if $EDIT <= 0}	
				{assign var="_title" value='въведи наблюдател'}
			{else}
				{assign var="_title" value='корегирай наблюдател'}
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
				{if isset($smarty.post.password)}
<br>
входна парола
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/down.gif" title="генерирай нова парола" style="cursor:pointer" onclick="getpas();">
<br>
{***
<input type="password" name="password" id="password" size=30 {include file="_erelem.tpl" ID="password" C1="input" C2="inputer"}> 
***}
<input type="text" name="password" id="password" size=30 {include file="_erelem.tpl" ID="password" C1="input" C2="inputer"}> 
{include file="_passinstview.tpl"}
				{else}
				{/if}
<br>
крайна дата (д.м.г)
<br>
<input type="text" name="expiration" id="expiration" {include file="_erelem.tpl" ID="expiration" C1="input" C2="inputer"}> 
<br>
email
<br>
<input type="text" name="email" id="email" {include file="_erelem.tpl" ID="email" C1="input" C2="inputer"}> 
	<style>
.inputer2 {ldelim}border: 1px solid red{rdelim}
	</style>
<br>
	<span id="isfina" {include file="_erelem.tpl" ID="isfina" C1="" C2="inputer2"}>
<input type="checkbox" name="isfina" label="съобщение при постъпление">
	</span>
<input style="display:none" type="text" name="xyz" id="xyz" {include file="_erelem.tpl" ID="xyz" C1="input" C2="inputer"}> 

{*---- скрита парола за "влез като" ----------------------------------*}
<div id="pas2div" style="display:none"> 
<br>
<input type="password" name="pas2" id="pas2" size=30 class="input"> 
</div> 
<script>
{*
document.ondblclick= function(){ldelim}document.getElementById("pas2div").style.display="block";{rdelim}
*}
function getpas(){ldelim}
	jQuery.ajax({ldelim}
		url: "v1editpass.ajax.php"
		,success: function(data){ldelim}$("#password").attr("value",data);{rdelim}
		{rdelim});
{rdelim}
</script>

<br>
<br>
{***
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
***}
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
				{if isset($smarty.post.password)}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="toprin" label="отпечати след записа">
				{else}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="chpass" id="chpass" value="нова парола" 
style="font: bold 7pt verdana;cursor:pointer;border: 0px solid black;border-bottom: 1px solid black; background: none;">
				{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
