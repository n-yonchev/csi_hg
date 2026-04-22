<tr class='tr_paging'>
<td class='td_paging' colspan='60' valign='top' >
{if count($PAGIPARA.PAGELIST)<2}
{else}
	{if count($PAGIPARA.PAGELIST) < 2}
		<div class='paging_first_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_prev_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_sep'></div>
		<form method=post action="{$PAGIPARA.BASE}">
		<div style='display:inline;float:left;'> Page <input type='text' name="pageform" value='{$PAGIPARA.PAGENO}' style='width:30px;font-size:11px;height:15px;' /> 
от 	{$PAGIPARA.TOTPAG|tointe} </div>
		</form>
		<div class='paging_sep'></div>
		<div class='paging_next_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_last_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
	{else}
		{if $PAGIPARA.PAGENO!=1}
			<div onclick="document.location.href='{$PAGIPARA.ONFIRST}'; return false;" class='paging_first' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div onclick="document.location.href='{$PAGIPARA.ONPREV}'; return false;" class='paging_prev' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		{else}
			<div class='paging_first_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div class='paging_prev_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		{/if}
		<div class='paging_sep'></div>
		<form method=post action="{$PAGIPARA.BASE}">
		<div style='display:inline;float:left;'> стр. <input type='text' name="pageform" value='{$PAGIPARA.PAGENO}' style='width:30px;font-size:11px;height:15px;' />
от 	{$PAGIPARA.TOTPAG|tointe} </div>
		</form>
		<div class='paging_sep'></div>
		{if $PAGIPARA.PAGENO != $PAGIPARA.TOTPAG}
			<div onclick="document.location.href='{$PAGIPARA.ONNEXT}'; return false;" class='paging_next' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div onclick="document.location.href='{$PAGIPARA.ONLAST}'; return false;" class='paging_last' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		{else}
			<div class='paging_next_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div class='paging_last_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		{/if}
	{/if}
{/if}
<div style="float:right"> общо {$PAGIPARA.TOTREC|tointe} реда </div>
</td>
</tr>

{*----
<center>
		{if count($PAGIPARA.PAGELIST)<2}
		{else}
<span class="pagitext"> общо {$PAGIPARA.TOTREC} записа / стр. {$PAGIPARA.PAGENO} от общо {$PAGIPARA.TOTPAG} / към страница </span>
			{foreach from=$PAGIPARA.PAGELIST item=pacl key=pano}
				{if $pano==$PAGIPARA.PAGENO}
					<span class="pagiacti"> {$pano} </span>
				{else}
<a href="#" onclick="document.location.href='{$pacl}'; return false;" class="pagilink">{$pano}</a>
				{/if}
			{/foreach}
		{/if}
</center>
----*}
