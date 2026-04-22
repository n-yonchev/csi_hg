<?php /* Smarty version 2.6.9, created on 2020-11-16 17:06:00
         compiled from rep2v2.tpl */ ?>
				<table align=center>
				<tr>
				<td>
<span class="vari" onclick="document.getElementById('idcalc').contentWindow.startbeg();">отначало</span>
&nbsp;
<span class="vari" onclick="document.getElementById('idcalc').contentWindow.document.location.href='<?php echo $this->_tpl_vars['CLEURL']; ?>
';">изчисти</span>
&nbsp;
<span class="vari" onclick="document.getElementById('idcalc').contentWindow.stopon();">спри</span>
&nbsp;
<br> 
<br> 
<iframe id="idcalc" width=740 height=400 src="<?php echo $this->_tpl_vars['GURL']; ?>
" frameborder=0></iframe>
				</table>