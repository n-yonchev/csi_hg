{*
		$CLAS 
	$PREF 
	$TEXT 
	$DATA ? 
*}
				<tr>
		{if isset($CLAS)}
<td class="{$CLAS}" align=right> {$TEXT}
		{else}
<td class="hemo"> {$TEXT}
		{/if}
											{assign var="sumrow" value=0}
								{if !isset($DATA)}
			{foreach from=$TEXTCOLO item=teco key=ecol}
				{assign var=indx value=$PREF|cat:$ecol}
											{if isset($TEXTCOLOHE[$ecol])}
												{assign var="sumrow" value=`$sumrow+$elem.$indx`}
												{assign var="clas" value="he"}
											{else}
												{assign var="clas" value="ro2"}
											{/if}
<td class="{$clas}" align=right> {include file="rep2caseelem.tpl" CONT=$elem.$indx}
			{/foreach}
								{else}
			{foreach from=$TEXTCOLO item=teco key=ecol}
				{assign var=indx value=$PREF|cat:$ecol}
											{if isset($TEXTCOLOHE[$ecol])}
												{assign var="sumrow" value=`$sumrow+$DATA.$indx`}
												{assign var="clas" value="he"}
											{else}
												{assign var="clas" value="ro2"}
											{/if}
<td class="{$clas}" align=right> {include file="rep2caseelem.tpl" CONT=$DATA.$indx}
			{/foreach}
								{/if}
<td class="ro2" align=right> {$sumrow|tomo3}
