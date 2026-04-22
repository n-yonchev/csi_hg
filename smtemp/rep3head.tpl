{*
	$MODE = 1, 2, 3 
*}
					{if $MODE==1}
<td class='h7' align=center colspan=7> движение на делата
<td class='h7' align=center colspan=3> дължими суми по изп.дела
<td class='h7' align=center colspan=3> събрана сума за периода
<td class='h7' align=center rowspan=2> {$ARHE.h14}
<td class='h7' align=center rowspan=2> {$ARHE.h15}
					{elseif $MODE==2}
<td class='h7' align=center> {$ARHE.h1}
<td class='h7' align=center> {$ARHE.h2}
<td class='h7' align=center> {$ARHE.h3}
<td class='h7' align=center> {$ARHE.h4}
<td class='h7' align=center> {$ARHE.h5}
<td class='h7' align=center> {$ARHE.h6}
<td class='h7' align=center> {$ARHE.h7}
<td class='h7' align=center> {$ARHE.h8}
<td class='h7' align=center> {$ARHE.h9}
<td class='h7' align=center> {$ARHE.h10}
<td class='h7' align=center> {$ARHE.h11}
<td class='h7' align=center> {$ARHE.h12}
<td class='h7' align=center> {$ARHE.h13}
					{elseif $MODE==3}
<td class='h7' align=center> 1
<td class='h7' align=center> 2
<td class='h7' align=center> 3
<td class='h7' align=center> 4
<td class='h7' align=center> 5
<td class='h7' align=center> 6
<td class='h7' align=center> 7
<td class='h7' align=center> 8
<td class='h7' align=center> 9
<td class='h7' align=center> 10
<td class='h7' align=center> 11
<td class='h7' align=center> 12
<td class='h7' align=center> 13
<td class='h7' align=center> 14
<td class='h7' align=center> 15
					{else}
					{/if}
