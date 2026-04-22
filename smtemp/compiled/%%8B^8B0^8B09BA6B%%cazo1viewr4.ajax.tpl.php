<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:39
         compiled from cazo1viewr4.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazo1viewr4.ajax.tpl', 5, false),)), $this); ?>
		<?php if (empty ( $this->_tpl_vars['RODATA'] )): ?>
<h3><center>няма грешки</center></h3>
		<?php else: ?>
<br>
<u>грешки от <?php echo ((is_array($_tmp=$this->_tpl_vars['RODATA']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
 &nbsp;&nbsp;[<?php echo $this->_tpl_vars['RODATA']['idreg4']; ?>
] </u>
<?php $_from = $this->_tpl_vars['ARTEXT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
<br>
<nobr><?php echo $this->_tpl_vars['elem'][0]; ?>
</nobr>
			<?php if (empty ( $this->_tpl_vars['elem'][1] )): ?>
			<?php else: ?>
<br>
<span style="font:normal 8pt courier;color:blue"><?php echo $this->_tpl_vars['elem'][1]; ?>
</span>
			<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
				<?php if ($this->_tpl_vars['RODATA']['idbegitoserv'] == 0): ?>
				<?php else: ?>
<br>
<font color=red>
последно данните са предадени на сървъра на <?php echo ((is_array($_tmp=$this->_tpl_vars['RODATA']['timebegitoserv'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
 [id=<?php echo $this->_tpl_vars['RODATA']['idbegitoserv']; ?>
]
<br>
но още не е получен отговор
</font>
				<?php endif; ?>
<br>&nbsp;