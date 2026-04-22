<?php /* Smarty version 2.6.9, created on 2020-02-28 11:21:17
         compiled from collmo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'collmo.tpl', 40, false),)), $this); ?>
			<table class="d_table" cellspacing='0' cellpadding='0' align=center>
			<thead>
			<tr>
<td class='d_table_title' colspan='200'>събрани суми за ЧСИ по месеци
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php if (isset ( $this->_tpl_vars['NEXTMOYE'] )): ?>
<a href="<?php echo $this->_tpl_vars['NEXTLINK']; ?>
" style="font: bold 12pt verdana; color: red" title="следващи месеци"> &lt; </a>
		<?php else: ?>
		<?php endif; ?>
&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['PREVLINK']; ?>
" style="font: bold 12pt verdana; color: red" title="предишни месеци"> &gt; </a>
					<?php if ($this->_tpl_vars['FILTMOYE'] == 'all'): ?>
					<?php else: ?>
<br>
<br>
<a style="font: normal 8pt verdana; color:black;">само делата със суми през месец <b><?php echo $this->_tpl_vars['FILTMOYE']; ?>
</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKALL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> всички дела </a>
					<?php endif; ?>
</td>
			</thead>
			<tr class='header'>
<td> <b>общо</b> </td>
	<?php $_from = $this->_tpl_vars['LISTMOYE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
			<td class='sep'>&nbsp;</td>
<td align=right>
		<?php if ($this->_tpl_vars['FILTMOYE'] == $this->_tpl_vars['elem']): ?>
<a href="#" onclick="fuprin('collmoex.ajax.php?moye=<?php echo $this->_tpl_vars['elem']; ?>
');"><img src="images/excel.gif" title="изход Excel" border=0></a>
		<?php else: ?>
		<?php endif; ?>
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMOYE'][$this->_tpl_vars['elem']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> 
</td>
	<?php endforeach; endif; unset($_from); ?>
			<tr class='header'>
<td> дело </td>
	<?php $_from = $this->_tpl_vars['LISTMOYE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['elem']):
?>
			<td class='sep'>&nbsp;</td>
<td align=right style="border-bottom: 1px solid <?php if ($this->_tpl_vars['FILTMOYE'] == $this->_tpl_vars['elem']): ?>red<?php else: ?>blue<?php endif; ?>"> 
<a href="<?php echo $this->_tpl_vars['LISTMOYELINK'][$this->_tpl_vars['mkey']]; ?>
"><b><?php echo $this->_tpl_vars['elem']; ?>
</b></a>
</td>
	<?php endforeach; endif; unset($_from); ?>
			<tbody>

	<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['caseelem']):
?>
					<?php $this->assign('caseid', $this->_tpl_vars['caseelem']['id']); ?>
			<tr>
<td> <?php echo $this->_tpl_vars['caseelem']['serial']; ?>
/<?php echo $this->_tpl_vars['caseelem']['year']; ?>
 </td>
		<?php $_from = $this->_tpl_vars['LISTMOYE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['moye']):
?>
			<td class='sep'>&nbsp;</td>
<td align=right style="border:1px solid white;" 
onmouseover= "this.style.border='1px solid black';this.style.cursor='help';" onmouseout="this.style.border='1px solid white';"> 
<span class="suma" rel="collmo.ajax.php?caid=<?php echo $this->_tpl_vars['caseid']; ?>
&moye=<?php echo $this->_tpl_vars['moye']; ?>
" 
title="формиране на сумите за ЧСИ по дело <?php echo $this->_tpl_vars['caseelem']['serial']; ?>
/<?php echo $this->_tpl_vars['caseelem']['year']; ?>
 от постъпленията през месец <?php echo $this->_tpl_vars['moye']; ?>
"> 
<?php echo ((is_array($_tmp=$this->_tpl_vars['GENEDATA'][$this->_tpl_vars['caseid']][$this->_tpl_vars['moye']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

</span>
		<?php endforeach; endif; unset($_from); ?>
	<?php endforeach; endif; unset($_from); ?>

			</tbody>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.suma').cluetip({ width: 560 });
});
</script>