					{if count($LIST)==0}
-
					{else}
			{foreach from=$LIST item=elem}
		{if 0}
		{elseif $elem.idtype==1}
<span class="membtype">‏כ</span> <font color=blue><b>{$elem.bulstat}</b></font> {$elem.name}
		{elseif $elem.idtype==2}
<span class="membtype">פכ</span> <font color=blue><b>{$elem.egn}</b></font> {$elem.name}
		{else}
<span class="membtype">הנ</span> {$elem.name}
		{/if}
<br>
			{/foreach}
					{/if}
