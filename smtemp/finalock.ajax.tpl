{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="блокирано постъпление"}
{include file="_erform.tpl"}

<br>
В момента {$LOCKNAME} променя данните за това постъпление.
<br>
Те ще бъдат достъпни след освобождаването им.
<br>
<br>
{*----
{include file='_button.tpl' HREF=$URLAGAIN TITLE='опитай отново' NAME='again' ID='again'}
----*}
{include file='_button.tpl' ONCLICK="document.location.reload();" TITLE='опитай отново' NAME='again' ID='again'}
{include file='_button.tpl' ONCLICK="freefina();" TITLE='освободи' NAME='free' ID='free'}
<div id="erfree"></div>

<script>
function freefina(){ldelim}
//alert(p1.checked+'/'+p1.value);
	jQuery.ajax({ldelim}
		url: "finaunlock.ajax.php?idfina={$EDIT}",
		success: function(data){ldelim}
			if (data=="OK"){ldelim}
document.location.reload();
			{rdelim}else{ldelim}
$('#erfree').text("грешка=f1");
			{rdelim}
		{rdelim}
	{rdelim});
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
