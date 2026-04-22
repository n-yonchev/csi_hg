{*----
Същото като _select.tpl, но без параметър $FROM
отгоре :
	FROM - масива със съдържанието
	SIZE - размера
	ID   - id на полето
	C1   - нормалния клас
	C2   - клас при грешка
		LISTER - масива с евент.грешки
		FILIST - масива с дефинициите на полетата

----*}
<span 
		{if isset($LISTER.$ID)}
class="{$C2}" onmouseover="viewer('{$ID}');" onmouseout="viewer('');"
		{else}
		{/if}
>
<select name="{$ID}" id="{$ID}" class="{$C1}"
		{assign var="elmeta" value=$FILIST.$ID}
		{if isset($elmeta)}
meta:validator="{$elmeta.validator}"
		{else}
		{/if}
{if isset($SIZE)} size={$SIZE} {else}{/if}
>
</select></span>
