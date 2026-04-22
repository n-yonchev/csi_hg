<?php /* Smarty version 2.6.9, created on 2020-02-27 13:49:57
         compiled from _docucase.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_docucase.tpl', 8, false),)), $this); ?>
					<?php $this->assign('cali', $this->_tpl_vars['elem']['caselist']); ?>
					<?php if ($this->_tpl_vars['elem']['casecoun'] == 0): ?>
						<?php $this->assign('tdtext', ""); ?>
						<?php $this->assign('tddire', 'left'); ?>
						<?php $this->assign('tdtite', ""); ?>
						<?php $this->assign('usname', ""); ?>
					<?php elseif ($this->_tpl_vars['elem']['casecoun'] == 1): ?>
						<?php $this->assign('tdtext', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cali'][0]['caseseri'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['cali'][0]['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['cali'][0]['caseyear']))); ?>
						<?php $this->assign('tddire', 'right'); ?>
						<?php $this->assign('tdtite', ""); ?>
						<?php $this->assign('usname', $this->_tpl_vars['cali'][0]['username']); ?>
					<?php elseif ($this->_tpl_vars['elem']['casecoun'] <= 12): ?>
						<?php $this->assign('tdtext', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="<span class='caselist' rel='#cont")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ekey']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ekey'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "' title='списък дела'>") : smarty_modifier_cat($_tmp, "' title='списък дела'>")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['casecoun']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['casecoun'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</span>") : smarty_modifier_cat($_tmp, "</span>"))); ?>
						<?php $this->assign('tddire', 'center'); ?>
						<?php $this->assign('tdtite', ""); ?>
						<?php $this->assign('usname', ""); ?>
<span id="cont<?php echo $this->_tpl_vars['ekey']; ?>
" style="display: none">
	<table cellspacing=0 cellpadding=0>
	<?php $_from = $this->_tpl_vars['elem']['caselist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['caseelem']):
?>
		<tr>
		<td align=right> <b><?php echo $this->_tpl_vars['caseelem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['caseelem']['caseyear']; ?>
</b>
		<td width=10>
		<td> <?php echo $this->_tpl_vars['caseelem']['username']; ?>

	<?php endforeach; endif; unset($_from); ?>
	</table>
</span>
					<?php else: ?>
						<?php $this->assign('tdtext', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="<a href='")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['viewlist']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['viewlist'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "' class='nyroModal' target='_blank'><span class='caselist'>") : smarty_modifier_cat($_tmp, "' class='nyroModal' target='_blank'><span class='caselist'>")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['casecoun']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['casecoun'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</span></a>") : smarty_modifier_cat($_tmp, "</span></a>"))); ?>
						<?php $this->assign('tddire', 'center'); ?>
						<?php $this->assign('tdtite', "кликни за списъка"); ?>
						<?php $this->assign('usname', ""); ?>
					<?php endif; ?>
		<td class='sep'>&nbsp;</td>
		<td align=<?php echo $this->_tpl_vars['tddire']; ?>
 title="<?php echo $this->_tpl_vars['tdtite']; ?>
"> <?php echo $this->_tpl_vars['tdtext']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['usname']; ?>
</td>