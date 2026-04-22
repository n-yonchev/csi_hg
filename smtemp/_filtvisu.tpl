{*----
		{if isset($FILTVISU.$GROUP)}	
{$TEXT}	
{foreach from=$FILTVISU.$GROUP item=filtelem}		
	{$filtelem[0]}	[{$filtelem[1]}]	
{/foreach}
		{else}
		{/if}
----*}
{*
	$GROUP - групата полета от филтъра 
	$TEXT  - заглавен текст за групата
*}
		{if isset($FILTVISU.$GROUP)}
<td class="filtvisu" valign=top> 
{$TEXT}
<br>
	{foreach from=$FILTVISU.$GROUP item=filtelem}
&nbsp;&nbsp;&nbsp;
{$filtelem[0]}
[{$filtelem[1]}]
<br>
	{/foreach}
		{else}
		{/if}