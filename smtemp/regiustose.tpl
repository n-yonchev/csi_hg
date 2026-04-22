<br>
към регистъра се предават данни 
<br>
за всички дела <b>{$USNAMEREGI}</b>
<br>
<br>
<span class="h3" id="ajcont"></span>
<br>
<br>

<script>
ajcall(1);
function ajcall(p1){ldelim}
	if (p1==0){ldelim}
		var expa= "";
	{rdelim}else{ldelim}
		var expa= "&acti=yes";
	{rdelim}
	jQuery.ajax({ldelim}
		url: "regiustose.ajax.php?uniq={$UNIQ}"+expa
		,success: fusucc
		{rdelim});
{rdelim}
function fusucc(data){ldelim}
//alert("data="+data);
	var arre= data.split("^");
	var mode= arre[0];
	var csec= arre[1];
//alert(arre[1]+'/'+typeof(arre[1]));
	if (mode=="wait"){ldelim}
		var texsec= (typeof(csec)=="undefined") ? "" : csec+" сек.";
//		$("#ajcont").html("<h3>предаване... "+texsec+"</h3>");
		$("#ajcont").text("предаване... "+texsec);
		setTimeout("ajcall(0)",2000);
	{rdelim}else{ldelim}
		if(mode=="OK"){ldelim}
{***
			$("#ajcont").html("<h3>има резултат "+csec+" сек"+"</h3>");
			for(var i=2; i<arre.length; i++){ldelim}
//alert(arre[i]);
$("#"+arre[i]).show();
			{rdelim}
***}
			$("#ajcont").text("готово "+csec+" сек.");
document.location.href= "{$LINKLAST}";
		{rdelim}else{ldelim}
alert(data);
		{rdelim}
	{rdelim}
{rdelim}
</script>
