<style>
.link {ldelim}font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.desc {ldelim}font:normal 8pt verdana;{rdelim}
</style>
									<table align=center>
									<tr>
									<td>
<a class="link" {include file="_href.tpl" LINK=$GOBACK}>
{$GOTEXT} </a>

<br>&nbsp;
<br>
<span  class="desc">
{*
опис <b>{$ROINVE.id}</b>
*}
опис <b><span style="background-color:{$ARPACKCOLO[$ROINVE.idstatinve]}">&nbsp;&nbsp; {$ROINVE.id} &nbsp;&nbsp;</span></b>
{$ARPACKTEXT[$ROINVE.idstatinve]} {$ARBANKPAYM[$ROINVE.idbank]}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
описание  <b>{$ROINVE.desc}</b>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
iban  <b>{$ROINVE.iban}</b>
			{if $ROINVE.idpack==0}
			{else}
<br>
включен в пакет <b><span style="background-color:{$ARPACKCOLO[$ROINVE.idstat]}">&nbsp;&nbsp; {$ROINVE.idpack} &nbsp;&nbsp;</span></b>
{$ARPACKTEXT[$ROINVE.idstat]} {$ARBANKPAYM[$ROINVE.idbankpack]}{if $ROINVE.codepack==$CODEBANKPOST}/бюджетен{else}{/if}
			{/if}
</span>

{$C2VARI}
									</table>
