{*
		$ELEM, $CODE, $COLO    ,$COL2 
*}
<td align=center> 
			{if isset($ELEM)}
				{if is_array($ELEM)}
					{if isset($ELEM.text)}
						{assign var=cutx value=$ELEM.text}
					{else}
						{assign var=cutx value="виж"}
					{/if}
					{if isset($ELEM.link)}
<a href="{$ELEM.link}" class="norm" style="background:{$COLO};{if $CODE==$SUBMOD}border: 2px solid aqua{else}{/if}"> {$cutx} </a>
					{else}
<span class="norm" style="background:{$COL2}"> {$cutx} </span>
					{/if}
				{else}
{$ELEM}
				{/if}
			{else}
-
			{/if}
			