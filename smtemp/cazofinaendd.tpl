{*--------------------------- икони за приключване ---------------------------*}
													{assign var=isoldway value=false}

					{if $elem.idcase<>0 and $elem.rest==0}
						{*---- изравнено ----*}
						{if $elem.isclosed==1}
							{*---- изравнено и приключено ----*}
							{*---- но как ? ----*}
							{if $elem.istran==0}
								{*---- не е прехвърлено в списъка с преводи ----*}
								{*---- приключено постарому ----*}
<span class="yes" title="ПРИКЛЮЧЕНО на {$elem.timeclosed|date_format:'%d.%m.%Y'}"
								{if $ADMINLOGGED}
oncontextmenu="proc4('{$elem.id}');return false;"
								{else}
								{/if}
>&nbsp;</span>
							{elseif $elem.istran==2}
								{*---- 12.11.2012 - старо приключено ----*}
{*
<span class="yes" title="ПРИКЛЮЧЕНО на {$elem.timeclosed|date_format:'%d.%m.%Y'}">с</span>
<a href="{$pref}{$elem.clos}" class="nyroModal" target="_blank"><img src="images/f3.gif" title="СТАРО ПРИКЛЮЧЕНО"></a>
*}
<img src="images/finish.gif" title="СТАРО ПРИКЛЮЧЕНО на {$elem.timeclosed|date_format:'%d.%m.%Y'}">
							{else}
								{*---- прехвърлено е в списъка с преводи ----*}
{*---- извеждаме състоянието в списъка с преводи ----*}
{*------------------------------------------------------------------------------*}
								{if $ENDDLIST[$myid].isendd==1}
<span class="stat2aaa stat2ok" rel="#tran{$myid}" title="разпределенията от постъпление <b>{$elem.inco|tomoney2}</b> са ИЗЦЯЛО ПРЕВЕДЕНИ">&nbsp;ОК&nbsp;</span>
								{else}
<span class="stat2aaa" rel="#tran{$myid}" title="разпределенията от постъпление <b>{$elem.inco|tomoney2}</b> са в процес на превод">&nbsp;&nbsp;&nbsp;</span>
								{/if}
<span id="tran{$myid}" style="display: none">
{include file="cazofinatran.tpl"}
</span>
{*------------------------------------------------------------------------------*}
							{/if}
						{else}
							{*---- изравнено, но не е приключено ----*}
							{if $elem.istran==0}
								{*---- изравнено, НЕприключено, извън списъка с преводи - подлежи на приключване ----*}
								{*---- подлежи ли на приключване с новия подход ----*}
{***
								{if ($elem.idtype==1 and !empty($elem.idfinabank) or $elem.idtype==2)}
***}
								{if ($elem.idtype==1 or $elem.idtype==2 or $elem.idtype==7)}
									{*---- истинско банково [1] или кеш [2] или старо [7] - да ----*}
									{assign var=cannew value=true}
								{else}
									{*---- останалите типове - на-взискател [9] - не ----*}
									{assign var=cannew value=false}
								{/if}
								{*---- ИНФО : дали е включен новия подход $FLAGBANKMASS ----*}
								{*---- според дали подлежи на приключване с новия подход и дали той е включен ----*}
								{if $cannew and $FLAGBANKMASS}
									{*---- подлежи  ----*}
{*---- готово за превод по новому ----*}
{*------------------------------------------------------------------------------*}
{*
<span class="stat1" title="{$ARFINASTAT[1]}">&nbsp;&nbsp;&nbsp;</span>
<span class="stat1" title="готово за превод">&nbsp;&nbsp;&nbsp;</span>
*}
		{if $INCASE}
			{assign var=pref value="caseeditzone.php"}
		{else}
			{assign var=pref value=""}
		{/if}
{*---- 12.11.2012 - маркиране като : старо приключено или готово за превод ----*}
{*
<nobr>
<a href="{$pref}{$elem.markclos}" class="nyroModal" target="_blank"><img src="images/tranclos.gif" title="маркирай като старо приключено"></a>
<a href="{$pref}{$elem.marktran}" class="nyroModal" target="_blank"><img src="images/tran1.gif" title="маркирай като готово за превод"></a>
</nobr>
*}
<a href="{$pref}{$elem.markclos}" class="nyroModal" target="_blank"><img src="images/tran1.gif" title="приключване/превод"></a>
{*------------------------------------------------------------------------------*}
								{else}
									{*---- не подлежи ----*}
{*---- приключване постарому - и деловодителя, и финансиста ----*}
		{if $INCASE}
			{assign var=pref value="caseeditzone.php"}
		{else}
			{assign var=pref value=""}
		{/if}
<a href="{$pref}{$elem.clos}" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи"></a>
													{assign var=isoldway value=true}
									{*
									{if $FINALOGGED}
												{assign var=grclos value=true}
									{else}
									{/if}
									*}
								{/if}
							{elseif $elem.istran==2}
<span class="stat1" title="ГОТОВО ЗА ПРЕВОД">&nbsp;&nbsp;&nbsp;</span>
							{else}
								{*---- изравнено, НЕприключено, но в списъка с преводи ИЛИ старо приключено - НЕВЪЗМОЖНО ----*}
<font color=red> ???????? </font>
							{/if}
						{/if}
					{else}
						{*---- неизравнено ----*}
<span class="no" title="приключването е невъзможно">&nbsp;</span>
					{/if}


{*---- 07.01.2011 групово приключване - източник:_fina.tpl ----*}
							{if $INCASE}
	<td class='sep'>&nbsp;</td>
<td align=center>
								{if $isoldway}
<input type=checkbox id="cbfina{$elem.id}" rela="cbfina" onclick="setgrimg();">
								{else}
								{/if}
							{else}
							{/if}
