		{if isset($LISTER.$ID)}
class="{$C2}" onmouseover="viewer('{$ID}');" onmouseout="viewer('');"
		{else}
class="{$C1}"
		{/if}
		{assign var="elmeta" value=$FILIST.$ID}
		{if isset($elmeta)}
meta:validator="{$elmeta.validator}"
		{else}
		{/if}
		
		
		
