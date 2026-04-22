{*
				{if isset($DECI)}
					{assign var=codeci value=$DECI}
				{else}
					{assign var=codeci value=0}
				{/if}
										{if $FLPRIN}
{$VALUE}
										{else}
	{if $VALUE==0}
&nbsp;
	{else}
{$VALUE|number_format:$codeci:".":","}&nbsp;
	{/if}
										{/if}
*}
										{if $FLPRIN}
{$VALUE|number_format:2:",":""}
										{else}
	{if $VALUE==0}
&nbsp;
	{else}
					{if $FLAG==1}
<a href="stmontuser3.ajax.php{$USERLINK.$userid}" class="nyroModal" target="_blank" 
style="border-bottom:0px solid black;font:normal 8pt verdana;cursor:pointer;">
{$VALUE|number_format:0:".":","}&nbsp;
</a>
					{elseif $FLAG==2}
<a href="stmontuser4.ajax.php{$USERLINK.$userid}" class="nyroModal" target="_blank" 
style="border-bottom:0px solid black;font:normal 8pt verdana;cursor:pointer;">
{$VALUE|number_format:0:".":","}&nbsp;
</a>
					{else}
{$VALUE|number_format:0:".":","}&nbsp;
					{/if}
	{/if}
										{/if}
