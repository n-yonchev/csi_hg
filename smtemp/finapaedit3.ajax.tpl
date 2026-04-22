добави нова сметка и нов собственик
<br>
за превеждане на сумата <b>{$ROTRAN.amount|tomoney2}</b>
			<table align=center>
			<tr>
<td align=right> собственик
<td>
<input type="text" name="c2name" id="c2name" class="input" size=40 {include file="_erelem.tpl" ID="c2name" C1="input" C2="inputer"}> 
			<tr>
<td align=right> булстат
<td> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="bulstat" id="bulstat" class="input" size=20 {include file="_erelem.tpl" ID="bulstat" C1="input" C2="inputer"}> 
			<tr>
<td align=right> егн
<td> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="egn" id="egn" class="input" size=20 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}> 
			<tr>
<td align=right> iban
<td> 
<input type="text" name="iban" id="iban" class="input" size=50 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
			<tr>
<td align=right> bic
<td>
<input type="text" name="bic" id="bic" class="input" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
			<tr>
<td align=right> описание
<td> 
<input type="text" name="descrip" id="descrip" class="input" size=40 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}> 
			<tr>
<td>
<td> 
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
			</table>
