<style>
.head {ldelim}font: normal 10pt verdana;{rdelim}
.text {ldelim}font: normal 8pt verdana; margin-top:8px;{rdelim}
.cont {ldelim}font: bold 8pt verdana; padding:4px; letter-spacing:4pt; border:1px solid black;{rdelim}
.cred {ldelim}font: bold 10pt verdana; letter-spacing:4pt;{rdelim}
</style>

								{counter start=1 assign=coun}
{*---- описи + директно включени ----*}
{foreach from=$ARDATA item=elem key=ekey}
				<div style="height:118mm; padding: 0px 0px 0px 10px; margin: 2px 0px 2px 80px;">
				<table height=100%>
				<tr><td>
							{if isset($elem.idcase)}
<div class="text" align=right>
изп.дело <b>{$elem.caseseri}/{$elem.caseyear}</b>
&nbsp;&nbsp;
деловодител <b>{$elem.username}</b>
</div>
							{else}
							{/if}
{*
<div class="text"> 
КРЕДИТЕН ПРЕВОД от <b>пакет {$IDPACK}</b> създаден <b>{$PACKCREA|date_format:'%d.%m.%Y'}</b>
нареден от банка <b>{$ARBANKPAYM[$IDBANK]}</b>
</div>
<br>
<span class="text"> сума </span>
&nbsp;
<span class="cont"> {$elem.amount|tomo3} </span>
*}
				<table width=100%>
				<tr>
				<td>
<div class="cred"> 
КРЕДИТЕН ПРЕВОД 
</div>
<div class="text"> 
от <b>пакет {$IDPACK}/{$PACKCREA|date_format:'%d.%m.%Y'}</b>
<br>
нареден от банка <b>{$ARBANKPAYM[$IDBANK]}</b>
<br>
създаден от <b>{$elem.usernametran}</b> 
<br>
на <b>{$elem.timetran|date_format:'%d.%m.%Y %H:%M:%S'}</b>
</div>
				<td align=right>
<span class="text"> сума на превода </span>
&nbsp;
<span class="cont"> {$elem.amount|tomo3} </span>
				</table>
				{if $IDBANK==1}
<div class="text"> основание за плащане </div>
<div class="cont"> {$elem.text} </div>
				{else}
<div class="text"> основание </div>
<div class="cont"> {$elem.t1} </div>
<div class="text"> още пояснения </div>
<div class="cont"> {$elem.t2} </div>
				{/if}
<div class="text"> получател </div>
<div class="cont"> {$elem.clainame} </div>
				<table>
				<tr>
				<td>
<div class="text"> IBAN на получателя </div>
<div class="cont"> {$elem.iban} </div>
				<td width=20>
				<td>
<div class="text"> BIC на получателя </div>
<div class="cont"> {$elem.bic} </div>
				</table>
<div class="text"> банка на получателя </div>
<div class="cont"> {$elem.bankname} </div>
							{if $elem.isring}
<br>
<span class="text"> RINGS </span>
&nbsp;
<span class="cont"> да </span>
							{else}
							{/if}
				</table>
				</div>
								{*---- по 2 на страница ----*}
								{counter assign=coun}
								{if $coun %2 ==0}
<br>
	<hr>
<br>
								{else}
<br style="page-break-after: always;">
								{/if}
{/foreach}

