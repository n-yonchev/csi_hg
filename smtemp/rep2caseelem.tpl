{*
	$PREF 
	$ecol
	$CONT 
*}
{*
{$PREF}={$ecol}=[{$CONT|tomo3}]
*}
				{if $PREF=="p" and !empty($CONT)}
{*
SPEC
*}
					{if $ecol=="c5fee"}
<nobr>= &nbsp;{$CONT|tomo3}</nobr>
					{else}
<nobr>+ &nbsp;{$CONT|tomo3}</nobr>
					{/if}
				{else}
{$CONT|tomo3}
				{/if}
