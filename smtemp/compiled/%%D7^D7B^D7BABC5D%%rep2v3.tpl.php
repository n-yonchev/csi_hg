<?php /* Smarty version 2.6.9, created on 2020-11-16 17:07:19
         compiled from rep2v3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tointe', 'rep2v3.tpl', 12, false),)), $this); ?>
<style>
.c1 {font: normal 8pt verdana; border-bottom: 1px solid silver !important; padding: 2px 2px 2px 2px;}
.c1link {font: normal 8pt verdana; background-color:#dddddd; padding: 2px 2px 2px 2px; cursor:pointer;}
.c1head {font: bold 8pt verdana; background-color:#dfe8f6; padding: 2px 2px 2px 2px; letter-spacing:2;}
</style>
						<?php $this->assign('sp', "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); ?>
				<table align=center>
				<tr>
<td class="c1head" align=center colspan=9> брой на делата за отчета
				<tr>
<td class="c1"> общо
<td class="c1" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['COUNTOTA']['tota'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>

<td class="c1" width=30> &nbsp;

				<tr>
<td class="c1"> не влизат, по причини :
<td class="c1" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['COUNTOTA']['out'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>

<td class="c1"> &nbsp;
		<?php $_from = $this->_tpl_vars['ARMESS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['txmess']):
?>
				<tr>
<td class="c1"> <?php echo $this->_tpl_vars['sp']; ?>
 <?php echo $this->_tpl_vars['txmess']; ?>

<td colspan=2 class="c1link" align=right onclick="document.location.href='<?php echo $this->_tpl_vars['ERLINK'][$this->_tpl_vars['ekey']]; ?>
';"> <?php echo $this->_tpl_vars['sp']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LISTCOUN'][$this->_tpl_vars['ekey']])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>

		<?php endforeach; endif; unset($_from); ?>

				<tr>
<td class="c1"> влизат, по редове :
<td class="c1" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['COUNTOTA']['in'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>

<td class="c1"> &nbsp;
		<?php $_from = $this->_tpl_vars['ARROTYPE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
				<tr>
<td class="c1"> <?php echo $this->_tpl_vars['sp']; ?>
 [<?php echo $this->_tpl_vars['REPOCODE'][$this->_tpl_vars['elem']]; ?>
] <?php echo $this->_tpl_vars['VIEWREPO'][$this->_tpl_vars['elem']]; ?>

<td colspan=2 class="c1link" align=right onclick="document.location.href='<?php echo $this->_tpl_vars['ROLINK'][$this->_tpl_vars['elem']]; ?>
';"> <?php echo $this->_tpl_vars['sp']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LISTINRE'][$this->_tpl_vars['elem']])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>

		<?php endforeach; endif; unset($_from); ?>
				</table>
				