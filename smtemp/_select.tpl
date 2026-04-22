{*----
отгоре :
	FROM - масива със съдържанието
	SIZE - размера
	ID   - id на полето
	C1   - нормалния клас
	C2   - клас при грешка
	ONCH - onchange event action
		LISTER - масива с евент.грешки
		FILIST - масива с дефинициите на полетата
----*}
{*
*}
<span 
		{if isset($LISTER.$ID)}
 class="{$C2}" onmouseover="viewer('{$ID}');" onmouseout="viewer('');"
		{else}
{*class="{$C1}"*}
		{/if}
style="padding:1px 1px 1px 1px"
>
<select name="{$ID}" id="{$ID}" class="{$C1}"
		{assign var="elmeta" value=$FILIST.$ID}
		{if isset($elmeta)}
meta:validator="{$elmeta.validator}"
		{else}
		{/if}
{if isset($SIZE)} size={$SIZE} {else}{/if}
{if isset($ONCH)} onchange="{$ONCH}" {else}{/if}
>
{$FROM} </select></span>
{*
*}
