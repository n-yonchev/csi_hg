{include file="_base.header.tpl"}
<style>
th {ldelim}
	border: 1px solid black
{rdelim}
</style>
	<table align=center>
	<tr>
	<th> номер
	<th> начало
	<th> край
	<th> ОЛП
	<th> нач.щамп
	<th> кра.щамп
	<th> дневно
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
/*****
var o1,s1,indx;
indx= 0;
while (true){ldelim}
	indx ++;
	o1= document.getElementById("m"+indx);
	if (o1){ldelim}
	{rdelim}else{ldelim}
		break;
	{rdelim}
	s1= o1.clientHeight;
	document.write("<br>["+indx+"/"+o1.clientHeight+"/"+o1.offsetHeight+"/"+o1.scrollHeight+"]");
{rdelim}
*****/

/****
function getp(){ldelim}
	var o1= document.getElementById("m2");
	niza= "";
	for (prop in o1){ldelim}
		subs= prop.substr(0,4);
		if (subs=="clie" || subs=="scro" || subs=="offs"){ldelim}
			niza += prop+'='+o1[prop]+'/';
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
alert(niza);
{rdelim}
****/

/****
function getp(){ldelim}
	var table= document.getElementById("table");
	niza= "";
	for (prop in table){ldelim}
		//subs= prop.substr(0,4);
		//if (subs=="clie" || subs=="scro" || subs=="offs"){ldelim}
			niza += prop+'/';
		//{rdelim}else{ldelim}
		//{rdelim}
	{rdelim}
alert(niza);
	var taelem= document.getElementById("m20");
	var elem= document.createElement("tr");
	elem.innerHTML= "<td><hr></td>";
	table.insertBefore(elem,taelem);
	table.appendChild(elem);
{rdelim}
****/

/****/
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
/****/

/****
function getp(){ldelim}
	var tbody= document.getElementById("tbody");
	var newtr= tbody.insertRow(20);
	newtr.innerHTML= "<td><hr></td><td><hr></td><td><hr></td>";
{rdelim}
****/

function getp(){ldelim}
var step= 200;
var o1,s1,indx;
indx= 0;
	var tbody= document.getElementById("tbody");
var myhe= step;
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
		newtr.innerHTML= "<td><hr></td><td>"+myhe+"</td><td><hr></td>";
		myhe += step;
		tradded ++;
			o1= document.getElementById("m"+indx);
			var newoff= o1.offsetTop;
			var newc= o1.insertCell(7);
			newc.innerHTML= "<td>"+newoff+"</td>";
		indx --;
	{rdelim}
{rdelim}
{rdelim}

</script>
			
{include file="_base.footer.tpl"}
