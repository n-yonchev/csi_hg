{include file="_base.header.tpl"}
<style>
th, .th {ldelim}
	border: 1px solid black;
	background-color: #dddddd;
{rdelim}
</style>
	<table align=center>
<!--
	<tr>
	<th> номер
	<th> начало
	<th> край
	<th> ОЛП
	<th> нач.щамп
	<th> кра.щамп
	<th> дневно
-->
		<tbody id="tbody">
{counter start=0 assign=coun}
{foreach from=$DATA item=elem}
{counter assign=coun}
	<tr id="m{$coun}">
	<td> {$coun}
	<td> {$elem.begin}
	<td> {$elem.end}
	<td> {$elem.bnb}
	<td> {$elem.begstamp}
	<td> {$elem.endstamp}
	<td> {$elem._daily}
	</tr>
{/foreach}
		</tbody>
	</table>

<button onclick="getp();"> getp </button>

<script>

/****
var o1,s1,indx;
indx= 0;
while (true){ldelim}
	indx ++;
	o1= document.getElementById("m"+indx);
	if (o1){ldelim}
	{rdelim}else{ldelim}
		break;
	{rdelim}
	s1= o1.offsetTop;
	document.write("<br>"+indx+"/"+s1);
{rdelim}
****/

function puthead(orow){ldelim}
var head= new Array("номер","начало","край","ОЛП","нач.щамп","кра.щамп","дневно");
	var indx, newc;
	for (indx=0; indx<head.length; indx++){ldelim}
		newc= orow.insertCell(indx);
//		newc.setAttribute("class","th");
//		newc.setAttribute("className","th");
		newc.className= "th";
		newc.innerHTML= head[indx];
	{rdelim}
{rdelim}

function getp(){ldelim}
var step= 600;
var o1,s1,indx;
indx= 0;
	var tbody= document.getElementById("tbody");
		var newtr= tbody.insertRow(0);
		puthead(newtr);
	var tc= abscoord(tbody);
	var myhe= step - tc.top;
//alert(myhe);
var tradded= 0;
while (true){ldelim}
	indx ++;
	o1= document.getElementById("m"+indx);
	if (o1){ldelim}
	{rdelim}else{ldelim}
//alert(indx);
		break;
	{rdelim}
	s1= o1.offsetTop;
//alert(myhe+'/'+s1);
	if (s1<=myhe){ldelim}
	{rdelim}else{ldelim}
//alert('event='+myhe+'/'+s1);
		var newtr= tbody.insertRow(indx+tradded);
//		newtr.innerHTML= "<td><hr></td><td>"+myhe+"</td><td><hr></td>";
		puthead(newtr);
		myhe += step;
		tradded ++;
//alert('aaa='+tradded);
			o1= document.getElementById("m"+indx);
			var newoff= o1.offsetTop;
			var newc= o1.insertCell(7);
			newc.innerHTML= "<td>"+newoff+"</td>";
		indx --;
	{rdelim}
{rdelim}
{rdelim}

function abscoord(obje){ldelim}
	var to= parseInt(obje.offsetTop);
	var le= parseInt(obje.offsetLeft);
	var pa= obje.offsetParent;
	while(pa){ldelim}
//alert(to+'/'+le+'/'+pa.tagName);
		to= to + parseInt(pa.offsetTop);
		le= le + parseInt(pa.offsetLeft);
		pa= pa.offsetParent;
		if (pa.tagName=="BODY"){ldelim}
			break;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
return {ldelim}left:le,top:to{rdelim};
{rdelim}

</script>
			
{include file="_base.footer.tpl"}
