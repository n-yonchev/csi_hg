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
