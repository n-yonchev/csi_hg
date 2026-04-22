					{if 0}
					{elseif $VARI=="move"}
			{if $elem.move.taxamo==0}
			{else}
<tr>
<td class="tdbalasuma" colspan=3> към сумата за т.26
<td class="tdbalasuma" align=right> 
{include file="cazobalastatelem.tpl" CONT=$elem.move.taxamo}
			{/if}
					{elseif $VARI=="plus"}
			{if $elem.plus.taxamo==0}
			{else}
<tr>
<td class="tdbalasuma" colspan=3> сума за т.26
<td class="tdbalasuma" align=right> 
{include file="cazobalastatelem.tpl" CONT=$elem.plus.taxamo}
			{/if}
{*---- специфичен подход - въпроса, стила, елемента ----*}
{***
					{elseif $VARI=="resu" and $mycoun==count($LIST)}
***}
					{*---- 13.05.2011 акт.дълг се извежда за всяко движение ----*}
					{elseif $VARI=="resu"}
<tr>
<td class="tdbalasuma" colspan=4> актуален дълг
<td class="tdbala" align=right 
		{if $ACTUDEBT}
{*---- извеждане на подробна таблица за актуалния дълг ----*}
onclick="$('#actudebtinfo').load('cazoactuinfo.ajax.php?edit={$IDCASE}');"
oncontextmenu="$('#actudebtinfo').html(''); return false;"
		{else}
		{/if}
> 
													{if $ACTUDEBT}
											<font size=+1>
													{else}
													{/if}
												{if $elem.tosuma<0}
													<span class="red7bg"> <b>{$elem.tosuma|tomoney2}</b> </span>
												{else}
													{$elem.tosuma|tomoney2} €
													{math assign="suma_leva" equation="x * y" x=$elem.tosuma y=1.95583}
													<span style="white-space: nowrap;">{$suma_leva|tomoney2} лв</span>
												{/if}
													{if $ACTUDEBT}
											</font>
													{else}
													{/if}
{*---- функция актуален дълг ----*}
<script>
function getacdebt(){ldelim}
return "{$elem.tosuma|tomoney2}";
{rdelim}
function getacdebt_list(){ldelim}
return "{$ACDEBT_LIST}";
{rdelim}
</script>
					{else}
					{/if}
					