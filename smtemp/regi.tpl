<style>
.nyroModal {ldelim} font: normal 8pt verdana; cursor:pointer; border-bottom: 1px solid black; {rdelim}
</style>
<br>
<br>
<br>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'> предаване данни към регистъра</td>
	</tr>
</thead>

<tr>
			<td width=20>&nbsp;
{*
<td align=center> формиране файла за регистъра
*}
<td align=center id="ajcont"> 
<h3>подготовка</h3>
			<td width=20>&nbsp;
<tr>
			<td width=20>&nbsp;
<td>
			{foreach from=$ARLINK item=culink key=codeli}
<div id="{$codeli}" align=center style="display:none">
<br>
<a href="{$culink}" class="nyroModal" target="_blank"> виж {$ARCALL.$codeli} </a>
</div>
			{/foreach}
<br>
			<td width=20>&nbsp;

</table>

<script>
ajcall(1);
function ajcall(p1){ldelim}
	if (p1==0){ldelim}
		var expa= "";
	{rdelim}else{ldelim}
		var expa= "&acti=yes";
	{rdelim}
	jQuery.ajax({ldelim}
		url: "regi.ajax.php?uniq={$UNIQ}"+expa
		,success: fusucc
		{rdelim});
{rdelim}
{*----
function fusucc(data){ldelim}
//alert("data="+data);
	if (data=="wait"){ldelim}
		$("#ajcont").html("<h3>предаване ...</h3>");
//		$("#ajcont").html("<h3>предаване ..."+data+"</h3>");
		setTimeout("ajcall(0)",1000);
	{rdelim}else{ldelim}
		var arre= data.split("^");
		if(arre[0]=="OK"){ldelim}
			$("#ajcont").html("<h3>има резултат</h3>");
			for(var i=1; i<arre.length; i++){ldelim}
//alert(arre[i]);
$("#"+arre[i]).show();
			{rdelim}
		{rdelim}else{ldelim}
alert(data);
		{rdelim}
	{rdelim}
{rdelim}
----*}
{*----
function fusucc(data){ldelim}
alert("data="+data);
	var arre= data.split("^");
//alert(arre[1]+'/'+typeof(arre[1]));
	if (arre[0]=="wait"){ldelim}
		var texsec= (typeof(arre[1])=="undefined") ? "" : arre[1]+" сек";
		$("#ajcont").html("<h3>предаване... "+texsec+"</h3>");
		setTimeout("ajcall(0)",2000);
	{rdelim}else{ldelim}
		if(arre[0]=="OK"){ldelim}
			$("#ajcont").html("<h3>има резултат "+arre[1]+" сек"+"</h3>");
			for(var i=2; i<arre.length; i++){ldelim}
//alert(arre[i]);
$("#"+arre[i]).show();
			{rdelim}
		{rdelim}else{ldelim}
alert(data);
		{rdelim}
	{rdelim}
{rdelim}
----*}
function fusucc(data){ldelim}
//alert("data="+data);
	var arre= data.split("^");
	var mode= arre[0];
	var csec= arre[1];
//alert(arre[1]+'/'+typeof(arre[1]));
	if (mode=="wait"){ldelim}
		var texsec= (typeof(csec)=="undefined") ? "" : csec+" сек";
		$("#ajcont").html("<h3>предаване... "+texsec+"</h3>");
		setTimeout("ajcall(0)",2000);
	{rdelim}else{ldelim}
		if(mode=="OK"){ldelim}
			$("#ajcont").html("<h3>има резултат "+csec+" сек"+"</h3>");
			for(var i=2; i<arre.length; i++){ldelim}
//alert(arre[i]);
$("#"+arre[i]).show();
			{rdelim}
		{rdelim}else{ldelim}
alert(data);
		{rdelim}
	{rdelim}
{rdelim}
</script>
