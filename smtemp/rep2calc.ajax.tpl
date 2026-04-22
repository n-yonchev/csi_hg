{include file="_base.header.tpl"}
<style>
{*
.c3he {ldelim}font: bold 7pt verdana; background-color:#dfe8f6; padding: 1px 4px;{rdelim}
*}
.c3he {ldelim}font: bold 7pt verdana; background-color:skyblue; padding: 1px 4px;{rdelim}
.c3li {ldelim}font: bold 7pt verdana; background-color:wheat; padding: 1px 4px; cursor:pointer;{rdelim}
.c3lino {ldelim}font: bold 7pt verdana; background-color:#dddddd; padding: 1px 4px; cursor:pointer;{rdelim}
.c3licu {ldelim}font: bold 7pt verdana; background-color:tomato; padding: 1px 4px; cursor:pointer;{rdelim}
.c3liov {ldelim}font: bold 7pt verdana; background-color:aqua; padding: 1px 4px; cursor:pointer;{rdelim}
.c3la {ldelim}font: bold 7pt verdana; background-color:#dddddd; border: 1px solid black; padding: 1px 4px; cursor:pointer;{rdelim}
</style>

					<table align=center>
					{foreach from=$LIST item=culist key=cuyear}
					<tr>
<td class="c3he" colspan=20> {$cuyear}
					<tr>
								{counter start=1 assign=coun}
						{foreach from=$culist item=cuidcase key=cuseri}
									{if isset($CALCLIST[$cuidcase])}
										{assign var="xclas" value="c3li"}
									{else}
										{assign var="xclas" value="c3lino"}
									{/if}
<td id="t{$cuidcase}" class="{$xclas}" align=right 
onmouseover="window.oldc=this.className;this.className='c3liov';" onmouseout="this.className=window.oldc;"
onclick="window.oldc='c3li';start('{$cuidcase}');"
oncontextmenu="window.oldc='c3li';proc2('{$cuidcase}');return false;"
> {$cuseri}
								{counter assign=coun}
								{if $coun>20}
					<tr>
									{counter start=1 assign=coun}
								{else}
								{/if}
						{/foreach}
					{/foreach}
					</table>

<script>
var stopped= true;
function start(p1){ldelim}
	if (stopped){ldelim}
		stopped= false;
		process(p1);
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
function process(p1){ldelim}
//alert(stopped);
	if (stopped){ldelim}
	{rdelim}else{ldelim}
		jQuery.ajax({ldelim}
			url: "rep2calc2.ajax.php?p={$PERIOD}&c="+p1
			,success: fusucc
			{rdelim});
	{rdelim}
{rdelim}
function fusucc(data){ldelim}
//alert("data="+data);
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
	{rdelim}else{ldelim}
stopped= true;
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
	var c1= arre[1];
	var c2= arre[2];
	document.getElementById("t"+c1).className= 'c3li';
//window.oldc='c3li';
	if (c2==""){ldelim}
		stopped= true;
	{rdelim}else{ldelim}
var ot= document.getElementById("t"+c2).offsetTop;
var oh= (document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
	if (ot-200<oh){ldelim}
	{rdelim}else{ldelim}
window.scrollTo(0,ot-200);
	{rdelim}
		document.getElementById("t"+c2).className= (stopped) ? 'c3la' : 'c3licu';
		process(c2);
	{rdelim}
{rdelim}
function stopon(){ldelim}
	stopped= true;
{rdelim}
{*
function stopoff(){ldelim}
	stopped= false;
{rdelim}
*}
function startbeg(){ldelim}
	start('{$IDBEGI}');
{rdelim}

function proc2(p1){ldelim}
//alert(stopped);
//	if (stopped){ldelim}
//	{rdelim}else{ldelim}
		jQuery.ajax({ldelim}
			url: "rep2calc2.ajax.php?p={$PERIOD}&c="+p1
			,success: succ2
			{rdelim});
//	{rdelim}
{rdelim}
function succ2(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
	{rdelim}else{ldelim}
//stopped= true;
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
	var c1= arre[1];
//	var c2= arre[2];
	document.getElementById("t"+c1).className= 'c3li';
{rdelim}
</script>

{include file="_ajax.footer.tpl"}
