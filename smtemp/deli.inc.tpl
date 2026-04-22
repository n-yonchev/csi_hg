
<script>
var currlink;
function fubegi(p1){ldelim}
currlink= p1;
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
//alert(i);
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
//alert(i+'='+lico);
			coun ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
//return lico+"^"+coun;
//alert(coun);
	if (coun==0){ldelim}
	{rdelim}else{ldelim}
		jQuery.ajax({ldelim}
			url: "delidocucbox.ajax.php?list="+lico
			,success: succedit
			{rdelim});
	{rdelim}
{rdelim}
function succedit(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
$.nyroModalManual({ldelim}forceType:'iframe', url:currlink{rdelim});
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
{*
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 420, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
*}
