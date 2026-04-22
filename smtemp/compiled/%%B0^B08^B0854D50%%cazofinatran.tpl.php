<?php /* Smarty version 2.6.9, created on 2020-02-27 14:30:01
         compiled from cazofinatran.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'cazofinatran.tpl', 17, false),array('modifier', 'date_format', 'cazofinatran.tpl', 59, false),)), $this); ?>
				<table align=center>
				<tr>
<td class="he4" align=right> разпред<br>сума
<td class="he4"> взискател
<td class="he4" align=right> сума<br>за превод
<td class="he4"> от<br>банка
<td class="he4"> опис
<td class="he4"> пакет
<td class="he4"> ръчен<br>превод
<td class="he4"> преведена
		<?php $_from = $this->_tpl_vars['EXLIST'][$this->_tpl_vars['myid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elclai']):
?>
				<tr>
<td class="ro4" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elclai']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

				<?php if ($this->_tpl_vars['idclai'] < 0): ?>
<td class="ro4"> <?php echo $this->_tpl_vars['PSEUCLAINAME'][$this->_tpl_vars['idclai']]; ?>

				<?php else: ?>
<td class="ro4"> <?php echo $this->_tpl_vars['CLAILIST'][$this->_tpl_vars['idclai']]; ?>

				<?php endif; ?>
<td class="ro4" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elclai']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class="ro4"> <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elclai']['idbank']]; ?>

						<?php if ($this->_tpl_vars['elclai']['idinve'] == 0): ?>
<td class="ro4">&nbsp;
						<?php else: ?>
<td class="ro4" align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elclai']['idinvestat']]; ?>
"> 
<?php echo $this->_tpl_vars['elclai']['idinve']; ?>

						<?php endif; ?>
						<?php if ($this->_tpl_vars['elclai']['idinve'] == 0): ?>
		<?php if ($this->_tpl_vars['elclai']['idpack'] == 0): ?>
<td class="ro4">&nbsp;
		<?php else: ?>
<td class="ro4" align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elclai']['idpackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elclai']['idpack']; ?>

		<?php endif; ?>
						<?php else: ?>
		<?php if ($this->_tpl_vars['elclai']['idinvepack'] == 0): ?>
<td class="ro4">&nbsp;
		<?php else: ?>
<td class="ro4" align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elclai']['idinvepackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elclai']['idinvepack']; ?>

		<?php endif; ?>
						<?php endif; ?>
<td class="ro4" align=center>
						<?php if ($this->_tpl_vars['elclai']['idstat'] == 9): ?>
преведена
						<?php elseif ($this->_tpl_vars['elclai']['idstat'] == 6): ?>
отложена
						<?php else: ?>
&nbsp;
						<?php endif; ?>
<td class="ro4">
						<?php if ($this->_tpl_vars['elclai']['idstat'] == 9): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elclai']['finastatmodi'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>

						<?php elseif ($this->_tpl_vars['elclai']['idpackstat'] == 2): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elclai']['packstatmodi'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>

						<?php elseif ($this->_tpl_vars['elclai']['idinvepackstat'] == 2): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elclai']['invepackstatmodi'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>

						<?php else: ?>
не
						<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
				</table>