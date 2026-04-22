{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="създаване на входящ/изходящ документ" WIDTH=400}
{include file="_erform.tpl"}
<style>
td {ldelim}font:normal 8pt verdana;{rdelim}
.tdtext {ldelim}font:normal 7pt verdana;background-color:silver;padding:2px 16px 2px 6px;{rdelim}
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
.data {ldelim}font:normal 8pt verdana;{rdelim}
.dloc {ldelim}font:normal 8pt verdana;color:blue;{rdelim}
.h2 {ldelim}font:bold 7pt verdana;background-color:lightcyan;{rdelim}
.h3 {ldelim}font:normal 8pt verdana;background-color:moccasin;{rdelim}
</style>
<script>
nyremo= function(){ldelim}parent.location.reload();{rdelim}
</script>

{if $ISLO}<b>ЛОКАЛНО</b> {else}{/if}
искане номер <b>{$CODE}</b>
<br>

{*---- данни от сървъра ----*}
<br>
<div class="h3" align=center>проверете следните данни, върнати от сървъра</div>
{assign var=V1 value=true}
{assign var=V2 value=true}
{include file="cer2info.inc.tpl"}

{*---- данни за входящ/изходящ документ ----*}
<br>
<span class="tose"> вариант 1.
<br>
Ако ще издавате справка от ЦРД
</span>
<br>
						<div style="border:1px solid black;padding:10px;">
<div class="h3" align=center>въведете следните данни за нови документи</div>
							<table>
			<tr>
<td class="tdtext"> за нов входящ документ
<td> 
подател 
<br>
<input type="text" name="from" id="from" size=50 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>
<br> 
описание 
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
			<tr>
<td class="tdtext"> за нов изходящ документ
<td>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
<br>
описание 
<br>
<input type="text" name="descrip" id="descrip" size=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
							</table>
{include file='_button.tpl' TYPE='submit' TITLE='създай' NAME='createdoc' ID='createdoc'}
&nbsp;
<span class="contcase">входящ и изходящ документ за справката</span>
						</div>

<br>
<span class="tose"> вариант 2.
<br>
Ако НЯМА да издавате справка от ЦРД,
</span>
<br>
						<div style="border:1px solid black;padding:10px;">
НАПУСНЕТЕ ТОЗИ ПРОЗОРЕЦ
						</div>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
