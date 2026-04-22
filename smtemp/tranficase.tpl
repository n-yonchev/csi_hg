<style>
.link {ldelim}font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.desc {ldelim}font:normal 8pt verdana;{rdelim}
.h2 {ldelim}font: normal 8pt verdana; background-color:#bbbbbb;{rdelim}
.r2 {ldelim}font: normal 8pt verdana; border-bottom:1px solid black;{rdelim}
.case {ldelim}font: normal 10pt verdana{rdelim}
.budg {ldelim}font: normal 8pt verdana; background-color:wheat;cursor:pointer;{rdelim}
.pseu {ldelim}font: normal 8pt verdana; color:red;{rdelim}
.locked {ldelim}font: normal 8pt verdana; background-color:salmon;padding-left:4px;padding-right:4px;{rdelim}
.curr2 {ldelim}cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;background-color:wheat;{rdelim}
.vari2 {ldelim}cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;{rdelim}
.stat1 {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:thistle;{rdelim}
.stat2 {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:magenta;{rdelim}
.stat2ok {ldelim}font:bold 7pt verdana;color:white;{rdelim}
.seye {ldelim}font:normal 8pt verdana;{rdelim}
</style>
									<table align=center>
												{if $CALLFROMALTE}
												{else}
									<tr>
		<form name="myform2" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<td colspan=10>
<a class="link" {include file="_href.tpl" LINK=$GOBACK}>
{$GOTEXT} </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="seye">
постъпления по дело/год &nbsp;
<input type="text" name="seyefina2" id="seyefina2" size=12 autocomplete=off
style="font:bold 7pt verdana; border: 0px solid green; background-color:#dddddd;" onkeyup="autosubm4(event,this.form);">
+enter
				{if isset($ERCASE)}
<font color=red>{$ERCASE}</font>
				{else}
				{/if}
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="seye">
моите преводи
&nbsp;&nbsp;
</span>
<a class="{if $CASEALTE==-1}curr2{else}link{/if}" {include file="_href.tpl" LINK=$LINKWAIT}>
чакащи </a>
&nbsp;
<a class="{if $CASEALTE==-2}curr2{else}link{/if}" {include file="_href.tpl" LINK=$LINKASSI}>
назначени </a>
&nbsp;
<a class="{if $CASEALTE==-3}curr2{else}link{/if}" {include file="_href.tpl" LINK=$LINKDIRE}>
ръчно преведени </a>
		</form>
												{/if}
									<tr>
<td colspan=10 class="case">
<br>
																{*---- моите чакащи преводи ----*}
																{if isset($MYWAIT)}
													{$MYWAIT}
																{else}
дело <b>{$DATACASE.serial}/{$DATACASE.year}</b> деловодител <b>{$DATACASE.username}</b>
									<tr>
						<td valign=top>
						<table align=center>
						<tr>
<td class="h2" colspan=9 align=center> взискатели по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> IBAN
<td class="h2"> BIC
<td class="h2"> банка
<td class="h2"> &nbsp;
<td class="h2"> бюдж
<td class="h2"> опис
				{foreach from=$CLAILIST item=elem}
									<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
			{if empty($elem.iban)}
<td class="no"> липсва
			{else}
<td class="r2"> {$elem.iban}&nbsp;
			{/if}
			{if empty($elem.bic)}
<td class="no"> липсва
			{else}
<td class="r2"> {$elem.bic}&nbsp;
			{/if}
			{if empty($elem.bankname)}
<td class="no"> липсва
			{else}
<td class="r2"> {$elem.bankname}&nbsp;
			{/if}
<td class=""> 
<a href="{$elem.claimodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай сметката"></a>
<td class="budg" align=center title="корегирай" 
{*
{include file="_href.tpl" LINK=$elem.budgmodi}>
*}
onclick="$.nyroModalManual({ldelim}url:'{$elem.budgmodi}',forceType:'iframe'{rdelim});">

{if $elem.isbudg==1}да{else}{/if}
<td class="r2" align=center> {if $elem.islist==1}да{else}&nbsp;{/if}
				{/foreach}
						</table>
						<td width=10>
						<td valign=top>
						<table align=center>
						<tr>
<td class="h2" colspan=6 align=center> длъжници по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
				{foreach from=$DEBTLIST item=elem}
									<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
				{/foreach}
						</table>
									</table>

{include file="_tab2.tpl"}
											{if in_array($IDVARI,array(3,4,5))}
												{assign var=isiban value=false}
											{else}
												{assign var=isiban value=true}
											{/if}
									
									<table align=center>
												{if $CALLFROMALTE}
												{else}
									<tr>
									<td>
{*---- подменю ----*}
				{foreach from=$ARSUBM item=elemvari key=ekeyvari}
<span class="{if $ekeyvari==$IDVARI}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$elemvari.link}> 
{$elemvari.text} [{$ARCOUN.$ekeyvari}] </span>
&nbsp;&nbsp;
				{/foreach}
												{/if}
									<tr>
									<td>
{*---- постъпленията ----*}
											{*
											{if in_array($IDVARI,array(2,3,4))}
												{assign var=istopaym value=false}
											{else}
												{assign var=istopaym value=true}
											{/if}
											*}
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left"> списък на постъпленията по дело {$DATACASE.serial}/{$DATACASE.year} - {$HEADTX}
</div>
		<tr class='head2'>
<td align=center colspan=7> постъпление
											{if $ISTOPAYM}
<td align=center colspan=4> разпределение
<td align=center colspan=1> постъп
											{else}
												{if $EXCOLO}
<td align=center colspan=9> разпределение
<td align=center colspan=1> постъп
												{else}
<td align=center colspan={if $isiban}4{else}2{/if}> разпределение
												{/if}
											{/if}
		<tr class='head2'>
<td align=right> сума
<td> от къде
<td> кога
<td> длъжник
<td align=right> пр1
<td align=right> пр2
<td> статус
<td align=right> сума
<td> взискател
			{if $isiban}
<td> iban
<td> bic
			{else}
			{/if}
											{if $ISTOPAYM}
<td align=center> 
<a href="#" onclick="_cboxaction(futopaym); return false;"> 
<img src="images/topaym.gif" title="маркираните към списъка с преводи">
</a>
											{else}
												{if $EXCOLO}
<td> сума<br>за превод
<td> от<br>банка
<td> опис
<td> пакет
<td> ди<br>рек
<td align=center> изк<br>лючи
												{else}
												{/if}
											{/if}

												{counter start=0 assign=curr}
{foreach from=$LIST item=elem key=ekey}
												{counter assign=curr}
												{if $curr is even}
{*
						{assign var="bgco" value="PaleTurquoise"}
*}
												{else}
						{assign var="bgco" value=""}
												{/if}
						{assign var="myid" value=$elem.id}
						{assign var="idtype" value=$elem.idtype}
						{assign var="myspan" value="rowspan="|cat:$LISTDATACOUN[$myid]}
{***
						{assign var=debtdata value=$DEBTLIST[$elem.iddebtor]}
***}
{*
				{if $elem.idfinastat==3 or $elem.idfinastat==4}
*}
				{if in_array($elem.idfinastat,array(3,4,5))}
						{assign var=isoldway value=true}
				{else}
						{assign var=isoldway value=false}
				{/if}

								<tr bgcolor="{$bgco}">
{*---- описание на постъплението ----*}
<td {$myspan} align=right 
		{if empty($elem.lockname)}
		{else} 
bgcolor=salmon style="cursor:pointer;" title="заключена от {$elem.lockname}, кликни"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.unlockfina}'{rdelim});"
		{/if}
>{$elem.inco|tomoney2}
				{assign var=bankname value=$ARBANK[$elem.codebank]}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$elem.idfinabank|cat:"-"|cat:$bankname}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td {$myspan}> <nobr>{$ARTYPE.$idtype|cat:$finaba}</nobr>
<td {$myspan}>
						{if $idtype==1}
<nobr>{$elem.finadate} {$elem.finahour}</nobr>
						{elseif $idtype==2}
<nobr>{$elem.cashdate}</nobr>
						{else}
&nbsp;
						{/if}
{***
<td {$myspan}> {$debtdata.name}&nbsp;
***}
<td {$myspan}> {$DEBTLIST[$DEBTINDX].name}&nbsp;
<td {$myspan} align=right title="{$elem.visuinco}-{$elem.visutime}"> {$elem.delay1}
<td {$myspan} align=right title="{$elem.visutime}-{$elem.visuclos}"> {$elem.delay2}
<td {$myspan} align=center> 
					{if $elem.idfinastat==3}
<span class="no" title="{$ARFINASTAT[$elem.idfinastat]}">&nbsp;</span>
					{elseif $elem.idfinastat==4}
{*
<span class="stat1" title="{$ARFINASTAT[$elem.idfinastat]}">&nbsp;&nbsp;&nbsp;</span>
<img src="images/clos.gif" title="{$ARFINASTAT[$elem.idfinastat]}">
*}
<a href="{$elem.clos}" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи постарому"></a>
					{elseif $elem.idfinastat==5}
							{assign var=timecl value=$elem.timeclosed|date_format:"%d.%m.%Y %H:%M:%S"}
							{assign var=oktext value=$ARFINASTAT[$elem.idfinastat]|cat:" на "|cat:$timecl}
<span class="yes" title="{$oktext}">&nbsp;</span>
					{elseif $elem.idfinastat==1}
<span class="stat1" title="{$ARFINASTAT[$elem.idfinastat]}">&nbsp;&nbsp;&nbsp;</span>
					{elseif $elem.idfinastat==2}
						{if $ENDDLIST[$myid].isendd==1}
<span class="stat2 stat2ok" title="изцяло преведено">&nbsp;ОК&nbsp;</span>
						{else}
<span class="stat2" title="{$ARFINASTAT[$elem.idfinastat]}">&nbsp;&nbsp;&nbsp;</span>
						{/if}
					{else}
{$ARFINASTAT[$elem.idfinastat]}
					{/if}

								{assign var=first value=true}
		{*---- разпределение на постъплението ----*}
		{foreach from=$LISTDATA[$myid] item=elemdata key=idclai}
								{if $first}
								{else}
					<tr bgcolor="{$bgco}">
								{/if}
<td align=right> {$elemdata.suma|tomoney2}
			{if $idclai<=0}
<td class="pseu"> {$elemdata.clainame}&nbsp;
			{else}
<td> {$elemdata.clainame}
			{/if}
{* *}
							{if $isoldway}
							{else}
			{if $idclai<=0 and $idclai<>-1}
<td class="pseu"> ОК
			{else}
				{if empty($elemdata.iban)}
<td class="no"> липсва
				{else}
<td> {$elemdata.iban}&nbsp;
				{/if}
			{/if}
			{if $idclai<=0 and $idclai<>-1}
<td class="pseu"> ОК
			{else}
				{if empty($elemdata.bic)}
<td class="no"> липсва
				{else}
<td> {$elemdata.bic}&nbsp;
				{/if}
			{/if}
							{/if}
{* *}
{*---- продължение на описанието ----*}
{***
							{if $isoldway}
							{else}
												{if $EXCOLO}
<td align=right> 111
<td align=right> бан
<td align=right> оп
<td align=right> пак
												{else}
												{/if}
								{if $first}
<td {$myspan}>
					{if $elem.idfinastat==1 and empty($elem.lockname)}
						{if $elem.flag}
<a href="{$elem.topaym}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="към списъка с преводи"></a>
<input type=checkbox id="cb{$myid}">
						{else}
<span style="cursor:help;" title="към преводите - след попълване на всички IBAN/BIC">виж</span>
						{/if}
					{else}
					{/if}
								{else}
								{/if}
							{/if}
***}
											{if $ISTOPAYM}
								{if $first}
<td {$myspan} align=center>
					{if $elem.idfinastat==1 and empty($elem.lockname)}
{*
						{if $elem.flag}
<a href="{$elem.topaym}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="към списъка с преводи"></a>
<input type=checkbox id="cb{$myid}">
						{else}
<span style="cursor:help;" title="към преводите - след попълване на всички IBAN/BIC">виж</span>
						{/if}
*}
{***
<a href="{$elem.topaym}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="към списъка с преводи"></a>
<input type=checkbox id="cb{$myid}">
***}
<input type=checkbox id="cb{$myid}" checked>
					{else}
					{/if}
								{else}
								{/if}
											{else}
{*---- доп.полета по превода ----*}
												{if $EXCOLO}
													{assign var=elemrefe value=$EXLIST[$myid][$idclai]}
<td bgcolor=#dddddd align=right> {$elemrefe.amount|tomo3}
<td bgcolor=#dddddd> {$ARBANKPAYM[$elemrefe.idbank]}
						{if $elemrefe.idinve==0}
<td bgcolor=#dddddd>&nbsp;
						{else}
<td align=center bgcolor="{$ARPACKCOLO[$elemrefe.idinvestat]}"> 
{$elemrefe.idinve}
						{/if}
						{if $elemrefe.idinve==0}
		{if $elemrefe.idpack==0}
<td bgcolor=#dddddd>&nbsp;
		{else}
<td align=center bgcolor="{$ARPACKCOLO[$elemrefe.idpackstat]}"> 
{$elemrefe.idpack}
		{/if}
						{else}
		{if $elemrefe.idinvepack==0}
<td bgcolor=#dddddd>&nbsp;
		{else}
<td align=center bgcolor="{$ARPACKCOLO[$elemrefe.idinvepackstat]}"> 
{$elemrefe.idinvepack}
		{/if}
						{/if}
						{if $elemrefe.idstat==9}
<td bgcolor=#dddddd> да
						{else}
<td bgcolor=#dddddd>&nbsp;
						{/if}
								{if $first}
<td bgcolor=#dddddd {$myspan} align=center>
		{if $ARFINAEX[$myid]}
<a href="{$elem.tofina}" class="nyroModal" target="_blank"><img src="images/unmark.gif" title="изключи постъплението от преводите"></a>
		{else}
&nbsp;
		{/if}
								{else}
								{/if}
												{else}
												{/if}
											{/if}
{*---- смяна първи ред----*}
							{if $first}
								{assign var=first value=false}
							{else}
							{/if}
		{/foreach}
{*---- празен ред ----*}
								<tr>
<td style="font-size:2px;" bgcolor="silver" colspan=20> &nbsp;
{/foreach}
																{*---- моите чакащи преводи ----*}
																{/if}
		</table>

{include file="_cbsess.tpl"}
<script>
function futopaym(){ldelim}
	$.nyroModalManual({ldelim}forceType:'iframe', url:'{$CBTOPAYM}'{rdelim});
{rdelim}
function autosubm4(event,form){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
form.submit();
	{rdelim}
{rdelim}
</script>
