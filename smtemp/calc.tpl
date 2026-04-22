<style>
.resu {ldelim}font: bold 14px verdana; background-color: #dfe8f6; padding: 4px;{rdelim}
</style>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br/>
		<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
		<thead>
		<tr>
<td class='d_table_title' colspan=100> Лихвен калкулатор
		</thead>
		<tbody>
		<tr>
		<td style='border:0px' width=10>
		<td style='border:0px' width=180>
{include file="_erform.tpl"}

сума
<br/>
<input type="text" name="amou" id="amou" size=20 {include file="_erelem.tpl" ID="amou" C1="input" C2="inputer"}> 

<br/>
начална дата (д.м.г)
<br/>
<input type="text" name="dat1" id="dat1" size=20 {include file="_erelem.tpl" ID="dat1" C1="input" C2="inputer"}> 

<br/>
крайна дата (д.м.г)
<br/>
<input type="text" name="dat2" id="dat2" size=20 {include file="_erelem.tpl" ID="dat2" C1="input" C2="inputer"}> 

<br/>
<br/>
<div {include file="_erelem.tpl" ID="type" C1="input" C2="inputer"}>
<input type="radio" name="type" id="type" value="0"> ОЛП лв
<br/>
<input type="radio" name="type" id="type" value="1"> 3-мес.LIBOR USD
<br/>
<input type="radio" name="type" id="type" value="2"> 3-мес.LIBOR евро
<br/>
<input type="radio" name="type" id="type" value="3"> 3-мес.EURIBOR
</div>

<br/>
<br/>
{include file='_button.tpl' TYPE='submit' TITLE='изчисли' NAME='submit' ID='submit'}
<br/> &nbsp;
		<td style='border:0px' valign=top>

			{if isset($INTELIST)}
<br/>
	<span class="resu">
	{$INTETOTA|tomoney}
	</span>
&nbsp;
<br/>
обща лихва за периода
<br/>
<br/>
	<span class="resu">
	{$AMOUTOTA|tomoney}
	</span>
&nbsp;
<br/>
общo дължима сума
<br/>
<br/>
{include file='_button.tpl' ONCLICK='vilist();' TITLE='подробно'}
			{else}
				{if isset($ERRORTEXT)}
<div style="font:bold 10pt verdana; color:red;"> {$ERRORTEXT} </div>
				{else}
				{/if}
			{/if}
<br/> &nbsp;

		</table>
</form>

			{if isset($INTELIST)}
<span id="folist" style="display: none;">
<br/>
{include file="_calcperc.tpl"}
<br/> &nbsp;
</span>
			{else}
			{/if}

{*----
{include file="_jscale.tpl" FIELD="dat1"}
{include file="_jscale.tpl" FIELD="dat2"}
----*}

<script>
function vilist(){ldelim}
	var o1= document.getElementById("folist");
	var newdis= (o1.style.display=="none") ? "" : "none";
	o1.style.display= newdis;
{rdelim}
</script>
