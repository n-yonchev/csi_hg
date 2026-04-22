{*
		$FLDEBT 
		$VARI =head =cont 
*}
				{if $FLDEBT==0}
				{elseif $FLDEBT==1}
					{if $VARI=="head"}
{***
<td>длъжник
***}
<td>длъж<br>ник
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
						{if empty($elem.debtname)}
<td> няма
						{else}
							{if $elem.idclaimer<=0 and $elem.idclaimer<>-1}
<td><font color=red>ОК</font>
							{else}
<td style="cursor:help;" bgcolor="#dddddd" title="{$elem.debtname}"> виж
							{/if}
						{/if}
{***
						{if empty($elem.debtname)}
<td bgcolor="salmon" title="липсва длъжник за превода, избери"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editdebt}'{rdelim});"
>&nbsp;
						{else}
							{if $elem.idclaimer<=0 and $elem.idclaimer<>-1}
<td><font color=red>ОК</font>
							{else}
								{assign var=coundebt value=$ARCOUNDEBT[$elem.idcase]}
								{if $coundebt==0}
<td title="по делото няма длъжници"> {$elem.debtname}
								{elseif $coundebt==1 and $elem.iddebtor<>0}
<td title="по делото има само 1 длъжник"> {$elem.debtname}
								{else}
<td title="по делото има {$coundebt} длъжници, промени длъжника" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editdebt}'{rdelim});"
>{$elem.debtname}
								{/if}
							{/if}
						{/if}
***}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{elseif $FLDEBT==5}
					{if $VARI=="head"}
<td>длъж<br>ник
					{elseif $VARI=="cont"}
<td bgcolor="#dddddd" title="{$elem.debtname}"> 
					{else}
					{/if}
{***
					{if $VARI=="head"}
<td>длъжник
					{elseif $VARI=="cont"}
<td> {$elem.debtname}
					{else}
					{/if}
***}
				{else}
				{/if}
