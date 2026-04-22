function getcblist(pref){
	var code= "input[@type='checkbox'][@name^='"+pref+"']:checked";
	var list= $(code);
	var liid= "";
	$(code).each(function(){
		var arre= $(this).attr("name").split("_");
		liid += ","+arre[1];
//alert($(this).attr("name"));
		});
	if (liid==""){
	}else{
		liid= liid.substring(1);
	}
return liid;
}
