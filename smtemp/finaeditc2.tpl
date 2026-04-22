{*
$ARDISAFIEL 
	$FINAME	
*}
		{if $ARDISAFIEL.$FINAME}
{*
disabled="disabled" style="background-image: none; background-color: #bbffbb;"
*}
style="background-image: none; background-color: #bbffbb;"
onfocus="alert('сумата '+this.value+' е преведена. не може да променяте това поле'); return false;"
		{else}
		{/if}