<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
							{*
							{assign var=bord value="border:1px solid black;"}
							*}
							{assign var=bord value=""}

<body style="{$bord}"
onload="window.focus();window.print();">

{*---- номер плик ----*}
<div style="{$bord}margin-top:11.5cm;margin-right:0.5cm;float:right;">
	<span style="font:normal 10pt tahoma;">#{$ARENVE.id}</span>
</div>
{*---- адреса ----*}
<div style="{$bord}margin-top:9cm;margin-right:0.2cm;height:3cm;width:8cm;float:right;"> 
			<span style="font:normal 10pt tahoma;">
ДО
<br>
{$ARENVE.adresat}
<br>
{$ARENVE.address}
			</span>
</div>

					{*---- евент.известие ----*}
					{if $ISENVEONLY}
					{else}
<div style="page-break-after:always;"></div>
{*---- подложка ----*}
<img src="delimess7.jpg" style="margin-left:5mm;margin-top:1cm;">
{*---- Х за доставяне ----*}
<div style="position:absolute;left:113.5mm;top:160mm;font:normal 10pt verdana;">
X </div>
{*---- номер плик ----*}
<div style="{$bord}position:absolute;left:169mm;top:162mm;font:normal 8pt verdana;">
#{$ARENVE.id} </div>
{*---- получател ----*}
<table cellspacing=0 cellpadding=0 style="{$bord}position:absolute;left:12mm;top:165mm;width:100mm;height:36mm;">
<tr>
<td style="padding:2mm;font:normal 8pt verdana;"> 
Подписаният получател <b>{$ARENVE.adresat}</b>{if empty($ARENVE.address)}{else},<br><br> адрес <b>{$ARENVE.address}</b>{/if} 
<br>удостоверявам, че получих 
								{counter start=0 assign=coun}
	{foreach from=$ARDOUT item=elem}
								{counter assign=coun}
<b>писмо</b> изх.№ <b>{$elem.doutinfo}</b> по изп.дело <b>{$elem.caseinfo}</b>{if $coun==count($ARDOUT)}{else},{/if}
	{/foreach}
</table>
{*---- подател ----*}
<table cellspacing=0 cellpadding=0 style="{$bord}position:absolute;left:103mm;top:214mm;width:100mm;height:35mm;">
<tr align=center>
<td style="padding:2mm;font:normal 8pt verdana;"> 
Кантора на Частен съдебен изпълнител № {$ROOFFI.serial} 
<br><br>{$ROOFFI.shortname} <br>{$ROOFFI.adres2} 
</table>
					{/if}
{***
<div style="page-break-after: always;"></div>
<img src="bpdelimess.php?fn={$ARDATA.bcfilename}&c2={$ARDATA.barc2}" style="margin-left:35mm;margin-top:1cm;" />

<table cellspacing=0 cellpadding:0 style="position:absolute;left:50mm;top:280mm;width:61mm;height:35mm">
<tr>
<td style="background-color:white;padding:2mm;font:normal 8pt verdana;"> 
Подписаният получател <b>{$ARDATA.adresat}</b>{if empty($ARDATA.address)}{else}, адрес <b>{$ARDATA.address}</b>{/if} 
удостоверявам, че получих <b>писмо</b> изх.№ <b>{$ARDATA.doutinfo}</b> по изп.дело <b>{$ARDATA.caseinfo}</b>
</table>
***}

</body>
</html>
