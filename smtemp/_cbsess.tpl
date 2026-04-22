<script>
var _funcname;
function _cboxaction(funcname){ldelim}
	_funcname= funcname;
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+",";
			coun += 1;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (coun==0){ldelim}
	{rdelim}else{ldelim}
		lico= lico.substring(0,lico.length-1);
		jQuery.ajax({ldelim}
			url: "cbsess.ajax.php?p="+lico
			,success: _cboxsuccess
			{rdelim});
	{rdelim}
{rdelim}
function _cboxsuccess(data){ldelim}
//alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
_funcname();
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
