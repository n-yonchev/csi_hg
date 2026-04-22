<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazobalastat.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'cazobalastat.tpl', 13, false),array('modifier', 'date_format', 'cazobalastat.tpl', 30, false),)), $this); ?>
				<table cellspacing=0 cellpadding=0 bgcolor="<?php echo $this->_tpl_vars['BGCO']; ?>
">
				<tr>
<td class="tdbalahead" align=right width=40> глав
<td class="tdbalahead" align=right width=40> лихви
<td class="tdbalahead" align=right width=40> неол
<td class="tdbalahead" align=right width=40> т.26
<td class="tdbalahead" align=right width=60 title="<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['tosuma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
"> общо
	<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiid'] => $this->_tpl_vars['clainame']):
?>
				<tr>
<td class="tdbala" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]['capi'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td class="tdbala" align=right>
				<?php $this->assign('elemperc', $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]['perc']); ?>
				<?php if ($this->_tpl_vars['VARI'] == 'move' && ! empty ( $this->_tpl_vars['elemperc'] ) && $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']]['intelink']): ?>
					<?php $this->assign('vid1', ((is_array($_tmp=$this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][0])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
					<?php $this->assign('vid2', ((is_array($_tmp=$this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][1])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
					<?php $this->assign('visu', ((is_array($_tmp=$this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][2])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
<span class="finahist" rel="cazobalaperc.ajax.php?para=<?php echo $this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][0]; ?>
^<?php echo $this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][1]; ?>
^<?php echo $this->_tpl_vars['elem']['para'][$this->_tpl_vars['claiid']][2]; ?>
" 
title="олихвяване на сума <b><?php echo $this->_tpl_vars['visu']; ?>
</b> за периода <b><?php echo $this->_tpl_vars['vid1']; ?>
&nbsp;-&nbsp;<?php echo $this->_tpl_vars['vid2']; ?>
</b>" style="cursor:help"> 
<?php echo ((is_array($_tmp=$this->_tpl_vars['elemperc'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </span>
				<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elemperc'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
<td class="tdbala" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]['tax'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td class="tdbala" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]['fee'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td class="tdbalasuma" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]['total'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalaexte.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				</table>
				