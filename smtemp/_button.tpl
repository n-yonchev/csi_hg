{if isset($HREF)}
	<a href='{$HREF}' target='{$TARGET}' class='{$CLASS}'>
	<table class='button' cellspacing='0' cellpadding='0' border='0' >
	<tr onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
{/if}

{if isset($TYPE)}
	<button value="{$TITLE}" class="submit" style='width:auto;' type="{$TYPE}" name="{$NAME}" id="{$ID}" tabindex="0" onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
	<table class='button' cellspacing='0' cellpadding='0' border='0'>
	<tr>
{/if}

{if isset($ONCLICK) }
	<table class='button' cellspacing='0' cellpadding='0' border='0' >
	<tr onclick="{$ONCLICK}" onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
{/if}

<td class='left' >&nbsp;</td>
<td class='middle' ><nobr>{$TITLE}</nobr></td>
<td class='right' >&nbsp;</td>

</tr>
</table>

{if isset($TYPE)}
</button>
{/if}

{if isset($HREF)}
	</a>
{/if}