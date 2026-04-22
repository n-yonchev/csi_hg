{include file="rep2detaheadelem.tpl" CODE="1" TEXT="[1a]" 
	D1="дължимо по изп.лист преди началото на периода" D2="<span class='c3desc'><b>изчислява се</b></span> само за образувани преди периода"}
{include file="rep2detaheadelem.tpl" CODE="2" TEXT="[1b]" 
	D1="събрано по изп.лист преди началото на периода" D2="<span class='c3desc'><b>изчислява се</b></span> само за образувани преди периода"}
{include file="rep2detaheadelem.tpl" CODE="3" TEXT="кол.1" 
	D1="подлежи на събиране по изп.лист към началото на периода" D2="<span class='c3desc'><b>= [1a] - [1b]</b></span> само за образувани преди периода"}
{include file="rep2detaheadelem.tpl" CODE="4" TEXT="кол.2" 
	D1="дължимо по изп.лист общо" D2="<span class='c3desc'><b>изчислява се</b></span> само за образувани ПРЕЗ периода"}
{include file="rep2detaheadelem.tpl" CODE="5" TEXT="кол.3" 
	D1="всичко дължимо по изп.лист" D2="<span class='c3desc'><b>= кол.1 + кол.2</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="6" TEXT="кол.9" 
	D1="събрано по изп.лист през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="7" TEXT="кол.11" 
	D1="НЕДОсъбрано по изп.лист поради прекратяване през периода" 
	D2="<span class='c3desc'><b>= кол.3 - кол.9</b></span> за прекратени през периода<br><span class='c3desc'><b>= 0 </b></span>за продължаващи след периода"}
{include file="rep2detaheadelem.tpl" CODE="8" TEXT="кол.12" 
	D1="несъбрано по изп.лист към края на периода" 
	D2="<span class='c3desc'><b>=0 </b></span>за прекратени през периода<br><span class='c3desc'><b>= кол.3 - кол.9 </b></span>за продължаващи след периода"}
				<td> &nbsp;
{include file="rep2detaheadelem.tpl" CODE="9" TEXT="кол.5" 
	D1="събрани такси през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="10" TEXT="кол.6" 
	D1="събрани доп.разноски през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="11" TEXT="кол.7" 
	D1="събрани др.разноски през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="12" TEXT="кол.8" 
	D1="събрани лихви през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="13" TEXT="кол.4" 
	D1="общо събрани през периода" D2="<span class='c3desc'><b>кол.5 + кол.6 + кол.7 +кол.8 + кол.9</b></span>"}
{include file="rep2detaheadelem.tpl" CODE="14" TEXT="кол.10" 
	D1="втч събрани доброволно през периода" D2="<span class='c3desc'><b>изчислява се</b></span>"}
