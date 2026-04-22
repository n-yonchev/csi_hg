<?php /* Smarty version 2.6.9, created on 2020-02-28 11:23:42
         compiled from pere.tpl */ ?>
<style>
.link {font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;}
.culink {font:normal 8pt verdana;cursor:pointer;padding:1px 6px;border-bottom: 1px solid brown;color:brown;background-color:khaki;}
.poin {cursor:pointer;}
.mark {background-color:lightgreen;}
</style>
				
					<table align=center>
								<?php if ($this->_tpl_vars['NOVARI']): ?>
								<?php else: ?>
					<tr>
					<td>
<?php $_from = $this->_tpl_vars['ARVARI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
&nbsp;
<a class="<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['VARI']): ?>culink<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARLINK'][$this->_tpl_vars['ekey']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['elem']; ?>
 
<?php if (isset ( $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['ekey']] )): ?>[<span id="coun<?php echo $this->_tpl_vars['ekey']; ?>
"><?php if ($this->_tpl_vars['ARCOUN'][$this->_tpl_vars['ekey']] == 0): ?><font color=red size=+1>ÕﬂÃ¿</font><?php else:  echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['ekey']];  endif; ?></span>]<?php else:  endif; ?> 
</a>
<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
					<tr>
					<td>
<br>
<?php echo $this->_tpl_vars['VARICONT']; ?>

					</table>