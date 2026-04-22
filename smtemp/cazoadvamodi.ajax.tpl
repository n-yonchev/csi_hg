{include file="_ajax.header.tpl" ONLOAD="typechan($('#idpatype'));"}

{if $EDIT <= 0}
	{assign var="_title" value='въведи нова вноска'}
{else}
	{assign var="_title" value='корегирай вноска'}
{/if}

{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

{***
сума
<br>
<input type="text" name="amount" id="amount" size=14 {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 
<br>
дата
<br>
<input type="text" name="date" id="date" size=14 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
взискател
<br>
{include file="_select.tpl" FROM=$ARCLAINAME ID="idclaimer" C1="input" C2="inputer"}
<br>
описание
<br>
<textarea name="descrip" id="descrip" rows=4 cols=70 size=255 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}></textarea>
***}
					<table>
					<tr>
<td>
сума
<br>
<input type="text" name="amount" id="amount" size=14 {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 
<td>
дата
<br>
<input type="text" name="date" id="date" size=14 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<td>
взискател
<br>
{include file="_select.tpl" FROM=$ARCLAINAME ID="idclaimer" C1="input" C2="inputer"}
					</table>
описание
<br>
<textarea name="descrip" id="descrip" rows=5 cols=50 size=255 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}></textarea>
<br>
<br>
тип на плащане
{include file="_select.tpl" FROM=$ARPATYPENAME ID="idpatype" C1="input" C2="inputer" ONCH="typechan(this);"}

{*---- скрит контейнер за тип= в-брой ----*}
<div id="t1" class="inputcont" style="display: none; padding: 6px">
				<table align=center>
				<tr>
				<td align=left colspan=6>
	за приходния касов ордер
{*
		{if $EDIT==0}
				<tr>
				<td align=left colspan=6>
<nobr>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер за {$CURRYEAR}г. - евентуално <b>{$NEXTNUMB}</b>
</nobr>
	<div id="seriente" style="display: block;">
<nobr>
<input type="text" name="serinome" id="serinome" size=8 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}>
или въведи тук желания изходящ номер за {$CURRYEAR}г.
</nobr>
	</div>
		{else}
				<tr>
				<td align=right>
	изх.номер/{$CURRYEAR}г.
				<td width=10>
				<td>
<input type="text" name="serinome" id="serinome" class="input" size=12 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}> 
		{/if}
*}
				<tr>
				<td align=right>
изх.номер/{$CURRYEAR}г.
				<td width=10>
				<td>
<input type="text" name="cashseri" id="cashseri" class="input" size=12 {include file="_erelem.tpl" ID="cashseri" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
дата
				<td width=10>
				<td>
<input type="text" name="cashdate" id="cashdate" class="input" size=12 {include file="_erelem.tpl" ID="cashdate" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
вносител
				<td width=10>
				<td>
<input type="text" name="cashname" id="cashname" class="input" size=40 {include file="_erelem.tpl" ID="cashname" C1="input" C2="inputer"}> 
				</table>
</div>

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script type="text/javascript">
function typechan(obje){ldelim}
	var mytype= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
//alert(mycode);
	if (mytype==1){ldelim}
		$("#t1").show();
	{rdelim}else{ldelim}
		$("#t1").hide();
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
