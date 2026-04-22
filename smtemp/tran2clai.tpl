{*
		$FLCLAI 
		$VARI =head =cont 
		$myid 
*}
				{if $FLCLAI==0}
				{elseif $FLIBAN==1 or $FLIBAN==5}
					{if $VARI=="head"}
<td>взискател
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
{*
						{if $elem.idclaimer<0}
<td><font color=red> {$PSCLAI[$elem.idclaimer]} </font>
						{else}
				{if empty($elem.clainame)}
		{assign var=mysu value="липсва взискател, корегирай"}
		{assign var=bgco value="salmon"}
				{elseif strlen($elem.clainame)>35}
		{assign var=mysu value="дължината > 35 симв, корегирай получателя"}
		{assign var=bgco value="salmon"}
				{else}
		{assign var=mysu value="корегирай получателя"}
				{/if}
<td bgcolor="{$bgco}" title="{$mysu}" 
							{if $FLCLAI==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editclai}'{rdelim});"
>{$elem.clainame}
							{else}
>{$elem.clainame}
							{/if}
						{/if}
*}
						{if $elem.idclaimer<0 and $elem.idclaimer<>-1}
<td><font color=red> {$PSCLAI[$elem.idclaimer]} </font>
						{elseif $elem.idclaimer==-1}
<td><font color=red> {$PSCLAI[$elem.idclaimer]} </font>
							{if $elem.coundebt>1}
<span style="background-color:lightgreen;cursor:pointer;"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editdebt}'{rdelim});">
&nbsp; на {$elem.clainame} &nbsp;
</span>
							{else}
на {$elem.clainame}
							{/if}
						{else}
<td>{$elem.clainame}
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
