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
пакет <b><span style="background-color:{$ARPACKCOLO[$ROPACK.idstat]}">&nbsp;&nbsp; {$ROPACK.id} &nbsp;&nbsp;</span></b>
{$ARPACKTEXT[$ROPACK.idstat]} {$ARBANKPAYM[$ROPACK.idbank]}{if $ROPACK.code==$CODEBANKPOST}/бюджетен{else}{/if}
</span>

{$C2VARI}
									</table>
