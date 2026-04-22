<?php /* Smarty version 2.6.9, created on 2023-03-18 12:44:32
         compiled from collmo.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'collmo.ajax.tpl', 18, false),array('modifier', 'date_format', 'collmo.ajax.tpl', 31, false),)), $this); ?>
								<table align=center>
								<tr>
<td align=right bgcolor="#eeeeee"> постъп<br>ление
<td align=left bgcolor="#eeeeee"> тип
<td align=left bgcolor="#eeeeee"> постъпило
<td align=left bgcolor="#eeeeee"> посл.корек
<td align=left bgcolor="#eeeeee"> за взискателите
<td align=left bgcolor="#eeeeee" colspan=2> за ЧСИ
<td align=left bgcolor="#eeeeee"> нераз<br>пред
<td align=left bgcolor="#eeeeee"> приключ
<td align=left bgcolor="#eeeeee"> на дата
<td align=left bgcolor="#eeeeee"> дата погас
			<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
								<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td align=left> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['elem']['idtype']]; ?>

<td align=left> 
						<?php if ($this->_tpl_vars['elem']['idtype'] == 1):  echo $this->_tpl_vars['elem']['bankdate']; ?>

						<?php elseif ($this->_tpl_vars['elem']['idtype'] == 2):  echo $this->_tpl_vars['elem']['cashdate']; ?>

						<?php else: ?>
&nbsp;
						<?php endif; ?>
<td align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['finatime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td align=left> 
		<?php $_from = $this->_tpl_vars['elem']['unseclai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiamou']):
 echo ((is_array($_tmp=$this->_tpl_vars['claiamou'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
&nbsp;&nbsp;
		<?php endforeach; endif; unset($_from); ?>
<td align=right><font color="<?php if ($this->_tpl_vars['elem']['mark']): ?>red<?php else:  endif; ?>"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </font>
<td align=right><font color="<?php if ($this->_tpl_vars['elem']['mark']): ?>red<?php else:  endif; ?>"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa2'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </font>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['rest'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 
<td align=center> <?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>да<?php else: ?>-<?php endif; ?>
<td align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['finaclos'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<?php endforeach; endif; unset($_from); ?>
								</table>