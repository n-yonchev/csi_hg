{*
		$FLBUDG 
		$VARI =head =cont 
*}
				{if $FLBUDG==0}
{***
				{elseif $FLBUDG==5}
					{if $VARI=="head"}
<td>бюдж<br>прев
					{elseif $VARI=="cont"}
						{if isset($elem.editbudg)}
<td align=center> да
						{else}
<td>&nbsp;
						{/if}
					{/if}
				{elseif $FLBUDG==1}
***}
				{elseif $FLBUDG==1 or $FLBUDG==5}
					{if $VARI=="head"}
{*
<td>бюд<br>жетен
*}
<td>бюдж<br>прев
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
						{if isset($elem.editbudg)}
							{assign var=myindx value=$elem.idtranbudget}
							{assign var=ARDATA value=$ARBUDATA[$myindx]}
							{if $ARDATA.isempty or !isset($ARDATA)}
								{assign var=bgco value="salmon"}
							{else}
								{assign var=bgco value=""}
							{/if}
<td align=center class="budg" rel="#budg{$myid}" title="доп.данни за превод към бюджета" bgcolor="{$bgco}">
									{if $FLBUDG==1}
<a href="{$elem.editbudg}" class="nyroModal" target="_blank">
<img src="images/correct.gif" title="корегирай данните">
</a>
									{else}
<img src="images/correct.gif" style="cursor:help;">
									{/if}
<span id="budg{$myid}" style="display: none">
{include file="tranbudg.tpl"}
</span>
						{else}
<td>&nbsp;
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
