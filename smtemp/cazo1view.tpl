{*----
<table class="d_table" align=center width=100% cellspacing='0' cellpadding='0'>
----*}
<style>
.cont {ldelim}background-color:#dddddd;{rdelim}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
<thead>
			<tr>
			<td class='d_table_title' colspan=10>
<div style="float:left">
основни данни
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t1link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
</div>
			{if $FLAGNOCHANGE}
			{else}
<div style="float:right">
{*----
<a href="caseeditzone.php{$URLMOD}" class="nyroModal" target="_blank">
<img src="images/edit.png" title="корегирай">
</a>
----*}
{*---- ЦРД-2014 -----------------*}
{include file='reg4case.tpl' EDIT=$EDIT}
{*---- -------------------- ----*}
{include file='_button.tpl' HREF="caseeditzone.php$URLMOD" CLASS='nyroModal' TARGET='_blank' TITLE='корегирай'}
{*--------*}
</div>
			{/if}
</thead>
{*----
			<tr>
			<td>
номер/год
			<td class="cont">
{$DATA.conome}/{$DATA.coyear}
----*}
												<tr>
												<td>
											<table><tr>
											<td valign=top>
												<table>
			<tr>
			<td>
образувано на
			<td class="cont">
{$DATA.created|date_format:"%d.%m.%Y"}
			<tr>
			<td>
описание
			<td class="cont">
{$DATA.text}
			<tr>
			<td>
идва от
			<td class="cont">
{*
						{assign var="arindx" value=$DATA.idcofrom}
{$ARFROM.$arindx}
*}
{$ARFROM[$DATA.idcofrom]}
	{if empty($DATA.cogrou)}
	{else}
/ състав {$DATA.cogrou}
	{/if}
{*----
			<tr>
			<td>
състав
			<td class="cont">
{$DATA.cogrou}
----*}
			<tr>
			<td>
изп.титул
			<td class="cont">
						{assign var="arindx" value=$DATA.idtitu}
{$ARTITU.$arindx}
						{if $DATA.idtitu==1}
от {$DATA.dateexec}
						{else}
						{/if}
{*----
			<tr>
			<td>
вид
			<td class="cont">
						{assign var="arindx" value=$DATA.idsort}
{$ARSORT.$arindx}
----*}
			<tr>
			<td>
вид, номер/год
			<td class="cont">
						{assign var="arindx" value=$DATA.idsort}
{$ARSORT.$arindx}, {$DATA.conome}/{$DATA.coyear}
{*--------*}
			<tr>
			<td>
текущ статус
			<td class="cont">
						{assign var="arindx" value=$DATA.idstat}
{$ARSTAT.$arindx} 
<nobr>
{$DATA.timestat|date_format:"%d.%m.%Y %H:%M:%S"}
</nobr>
			<tr>
			<td>
схема погасяване
			<td class="cont">
						{assign var="arindx" value=$DATA.idpayoff}
{$ARPAYOFF.$arindx}
			<tr>
			<td>
ред за отчета
			<td class="cont">
						{assign var="arindx" value=$DATA.idrepo}
{$ARREPO.$arindx}
			<tr>
			<td>
характер на изп.
			<td class="cont">
						{assign var="arindx" value=$DATA.idchar}
{$ARCHAR.$arindx}
												</table>
											<td valign=top>
												<table>
{***
			<tr>
			<td>
ред за отчета
			<td class="cont">
						{assign var="arindx" value=$DATA.idrepo}
{$ARREPO.$arindx}
***}
{*
			<tr>
			<td>
текущ статус
			<td class="cont">
						{assign var="arindx" value=$DATA.idstat}
{$ARSTAT.$arindx}
*}
{***
			<tr>
			<td>
характер на изп.
			<td class="cont">
						{assign var="arindx" value=$DATA.idchar}
{$ARCHAR.$arindx}
***}
{*----
			<tr>
			<td>
номер
			<td class="cont">
{$DATA.conome}
			<tr>
			<td>
година
			<td class="cont">
{$DATA.coyear}
			<tr>
			<td>
схема погасяване
			<td class="cont">
						{assign var="arindx" value=$DATA.idpayoff}
{$ARPAYOFF.$arindx}
----*}
			<tr>
			<td>
вземане вид размер
			<td class="cont">
{$DATA.claimdescrip}
			<tr>
			<td>
вземане произход
			<td class="cont">
{$DATA.origtext}
{***
			<tr>
			<td>
представител
			<td class="cont">
{$DATA.agent}
***}
			<tr>
			<td>
надбавка ОЛП %
			<td class="cont">
{$DATA.extraint}
{*---- ЦРД-2014 ----*}
			<tr>
			<td colspan=2>
<u>ЦРД-2014 вземане</u>
			<tr>
			<td>
тип
			<td class="cont">
{$AR4TYPE[$DATA.idtypereg4]}
			<tr>
			<td>
вид
			<td class="cont">
{$AR4VARI[$DATA.idvarireg4]}
			<tr>
			<td>
произход
			<td class="cont">
{$AR4ORIG[$DATA.idorigreg4]}

{if $EPEP_PROCESS}
<tr>
	<td colspan="2" style="text-align: center; border: none; padding-top: 3px;">
		<table style="border: 2px solid black; width: 100%">
			<thead>
				<tr>
					<td style="font-weight: bold;">Файлове от ел. изпълнителен лист</td>
					<td onclick="files_show()" style="cursor: pointer;"><img src="images/down.gif" title="Покажи всички файлове"/></td>
				</tr>
			</thead>
			<tbody class="files-table-body" style="display: none;">
				{foreach from=$EPEP_PROCESS item=item}
					<tr>
						<td colspan="2">
							<a style="color: blue; text-decoration: underline;" target="_blank" href="{$item.fileurl}">{$item.name}</a>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
{/if}
												</table>
											</table>
			</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
		var heob= document.getElementById("caseheader");
		if (heob){ldelim}
$("#caseheader").load("caseheader.ajax.php?para={$DATA.id+10597}");
		{rdelim}else{ldelim}
		{rdelim}

	{literal}
		function files_show() {
			if($('.files-table-body').is(":visible")) {
				$('.files-table-body').hide();
			} else {
				$('.files-table-body').show();
			}
		}
	{/literal}
</script>
