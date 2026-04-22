<?php /* Smarty version 2.6.9, created on 2020-02-27 12:56:52
         compiled from _pagina.tr.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tointe', '_pagina.tr.tpl', 11, false),)), $this); ?>
<tr class='tr_paging'>
<td class='td_paging' colspan='60' valign='top' >
<?php if (count ( $this->_tpl_vars['PAGIPARA']['PAGELIST'] ) < 2):  else: ?>
	<?php if (count ( $this->_tpl_vars['PAGIPARA']['PAGELIST'] ) < 2): ?>
		<div class='paging_first_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_prev_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_sep'></div>
		<form method=post action="<?php echo $this->_tpl_vars['PAGIPARA']['BASE']; ?>
">
		<div style='display:inline;float:left;'> Page <input type='text' name="pageform" value='<?php echo $this->_tpl_vars['PAGIPARA']['PAGENO']; ?>
' style='width:30px;font-size:11px;height:15px;' /> 
от 	<?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTPAG'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 </div>
		</form>
		<div class='paging_sep'></div>
		<div class='paging_next_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<div class='paging_last_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
	<?php else: ?>
		<?php if ($this->_tpl_vars['PAGIPARA']['PAGENO'] != 1): ?>
			<div onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONFIRST']; ?>
'; return false;" class='paging_first' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONPREV']; ?>
'; return false;" class='paging_prev' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<?php else: ?>
			<div class='paging_first_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div class='paging_prev_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<?php endif; ?>
		<div class='paging_sep'></div>
		<form method=post action="<?php echo $this->_tpl_vars['PAGIPARA']['BASE']; ?>
">
		<div style='display:inline;float:left;'> стр. <input type='text' name="pageform" value='<?php echo $this->_tpl_vars['PAGIPARA']['PAGENO']; ?>
' style='width:30px;font-size:11px;height:15px;' />
от 	<?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTPAG'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 </div>
		</form>
		<div class='paging_sep'></div>
		<?php if ($this->_tpl_vars['PAGIPARA']['PAGENO'] != $this->_tpl_vars['PAGIPARA']['TOTPAG']): ?>
			<div onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONNEXT']; ?>
'; return false;" class='paging_next' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONLAST']; ?>
'; return false;" class='paging_last' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<?php else: ?>
			<div class='paging_next_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
			<div class='paging_last_disabled' onmouseover="paging_button(this)" onmouseout="paging_button(this)" ></div>
		<?php endif; ?>
	<?php endif;  endif; ?>
<div style="float:right"> общо <?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTREC'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 реда </div>
</td>
</tr>
