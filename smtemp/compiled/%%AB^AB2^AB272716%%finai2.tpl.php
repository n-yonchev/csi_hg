<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:19
         compiled from finai2.tpl */ ?>
<style>
.trow {font:normal 8pt verdana; background-color:#dddddd;}
.cell {font:normal 8pt verdana;}
.link {font:normal 8pt verdana; background-color:wheat; cursor:pointer;}
</style>
				<table class="d_table" cellspacing='0' cellpadding='0' align=center>
				<thead>
				<tr>
<td class='d_table_title' colspan='200'> суми от фактури по години и месеци
				</thead>
				<tr class='header'>
<td> година
				<td class='sep'>&nbsp;</td>
<td> &nbsp;
<?php $_from = $this->_tpl_vars['LISTMONT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mont']):
?>
				<td class='sep'>&nbsp;</td>
<td align=center width=40> <?php echo $this->_tpl_vars['mont']; ?>
 
<?php endforeach; endif; unset($_from); ?>
				<td class='sep'>&nbsp;</td>
<td align=center> общо
				<td class='sep'>&nbsp;</td>
<td align=center> неизхо<br>дени
				<td class='sep'>&nbsp;</td>
<td align=center> всичко

<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
				<tr>
<td class="trow" rowspan=4> <?php echo $this->_tpl_vars['year']; ?>

				<td class='sep' rowspan=4>&nbsp;</td>
<td class="trow"> сума
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finai2year.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['DATA'][$this->_tpl_vars['year']],'FIEL' => 'suma')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td class="trow"> втч ддс
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finai2year.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['DATA'][$this->_tpl_vars['year']],'FIEL' => 'svat')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td class="trow"> бр.факт
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finai2year.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['DATA'][$this->_tpl_vars['year']],'FIEL' => 'coun')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td colspan=40> <hr>
<?php endforeach; endif; unset($_from); ?>

	
				</table>


