<style>
td.head {ldelim}
	font: normal 12pt verdana;
	vertical-align: middle;
{rdelim}
td.bord {ldelim}
	font: normal 8pt verdana;
	border: 1px solid black;
	vertical-align: middle;
{rdelim}
td {ldelim}
	font: normal 8pt verdana;
	vertical-align: middle;
{rdelim}
tr.unde {ldelim}
	font: normal 8pt verdana;
	border-bottom: 1px solid black;
{rdelim}
</style>
		<table>
{*---- заглавие ----*}
		<tr>
		<td class="head" align=center colspan=11>
Раздел II - Суми по изпълнителни дела
{*---- антетка ----*}
		<tr>
		<td class="bord" colspan=1 rowspan=2>
Видове изпълнителни дела по характер и произход на вземанията
		<td class="bord" colspan=1 rowspan=2>
Шифър на реда
		<td class="bord" align=center colspan=3>
Дължими суми по изп.дела
		<td class="bord" align=center colspan=4>
Събрана сума
		<td class="bord" colspan=1 rowspan=2>
Несъбрани суми по опрощаване, перемция, изпратени на друг СИ, давност, обезсилване и др.
		<td class="bord" colspan=1 rowspan=2>
Останала несъбрана сума по изпълнителни листове в края на отчетния период
		<tr>
		<td class="bord">
от образуването им до началото на отчетния период
		<td class="bord">
от образувани през отчетния период
		<td class="bord">
всичко кол.1+2 кол.7+8+9
		<td class="bord">
общо кол.5+6+7
{***
		<td class="bord">
такси
		<td class="bord">
допълнителни разноски
		<td class="bord">
приети други разноски
***}
		<td class="bord">
разноски
		<td class="bord">
лихви
		<td class="bord">
суми по изпълнителни листове
{***
		<td class="bord">
сума платена доброволно - от общата кол.4
***}
{*---- колони ----*}
		<tr>
		<td class="bord" align=center> а 
		<td class="bord" align=center width=100> б 
		<td class="bord" align=center width=100> 1 
		<td class="bord" align=center width=100> 2 
		<td class="bord" align=center width=100> 3 
		<td class="bord" align=center width=100> 4 
		<td class="bord" align=center width=100> 5 
		<td class="bord" align=center width=100> 6 
		<td class="bord" align=center width=100> 7 
		<td class="bord" align=center width=100> 8 
		<td class="bord" align=center width=100> 9 
{***
		<td class="bord" align=center width=100> 10
		<td class="bord" align=center width=100> 11 
		<td class="bord" align=center width=100> 12
***}

{*---- съдържание ----*}

{include file="_rep2tr.tpl" ROWNUM="5" T1="Общо (шифър1000=1100+1200+1300+1400)" T2="1000" CLAS="unde"}

{include file="_rep2tr.tpl" ROWNUM="6" T1="I. В ПОЛЗА НА ДЪРЖАВАТА И ОБЩИНИТЕ (ш.1100=1110+1120), в т.ч." T2="1100"}
{include file="_rep2tr.tpl" ROWNUM="7" T1="1. В ПОЛЗА НА ДЪРЖАВНИ ОРГАНИ (ш.1110=1120+1130), в т.ч." T2="1110"}
{include file="_rep2tr.tpl" ROWNUM="8" T1="а) публични вземания" T2="1120"}
{include file="_rep2tr.tpl" ROWNUM="9" T1="б) частни вземания" T2="1130"}
{include file="_rep2tr.tpl" ROWNUM="10" T1="2. В ПОЛЗА НА ОБЩИНИТЕ (ш.1140=1150+1160), в т.ч." T2="1140"}
{include file="_rep2tr.tpl" ROWNUM="11" T1="а) публични вземания" T2="1150"}
{include file="_rep2tr.tpl" ROWNUM="12" T1="б) частни вземания" T2="1160"}
{include file="_rep2tr.tpl" ROWNUM="13" T1="3. В ПОЛЗА НА СЪДИЛИЩАТА" T2="1170" CLAS="unde"}

{include file="_rep2tr.tpl" ROWNUM="14" T1="II. В полза на юридически лица и търговци (ш.1200=1210+1220+1230), в т.ч." T2="1200"}
{include file="_rep2tr.tpl" ROWNUM="15" T1="а) в полза на банки"    T2="1210"}
{include file="_rep2tr.tpl" ROWNUM="16" T1="б) в полза на търговци" T2="1220"}
{include file="_rep2tr.tpl" ROWNUM="17" T1="б) в полза на други ЮЛ" T2="1230" CLAS="unde"}

{include file="_rep2tr.tpl" ROWNUM="18" T1="III. В полза на граждани (ш.1300=1310+1320+1330+1340), в т.ч." T2="1300"}
{include file="_rep2tr.tpl" ROWNUM="19" T1="а) за издръжка"        T2="1310"}
{include file="_rep2tr.tpl" ROWNUM="20" T1="б) по трудови спорове" T2="1320"}
{include file="_rep2tr.tpl" ROWNUM="21" T1="в) предаване на дете"  T2="1330"}
{include file="_rep2tr.tpl" ROWNUM="22" T1="г) други"              T2="1340" CLAS="unde"}

{include file="_rep2tr.tpl" ROWNUM="23" T1="IV. Изпълнение на чуждестранни решения" T2="1400" CLAS="unde"}

		</table>
