<?php /* Smarty version 2.6.9, created on 2020-03-09 12:40:33
         compiled from finainvoword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'finainvoword.tpl', 41, false),array('modifier', 'tomo3ex', 'finainvoword.tpl', 43, false),)), $this); ?>
<style>
body td {font: normal 8pt verdana; margin: 1px 6px 1px 6px;}
.header {font: bold 7pt verdana; background-color:#bbbbbb; margin: 1px 6px 1px 6px;}
</style>
				<table>
				<tr>
<td colspan='8'>
списък на фактурите <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

		<tr>
<td class='header'> номер
<td class='header'> дата
<td class='header' align=right> сума
<td class='header' align=right> ДДС
<td class='header' align=right> общо
<td class='header'> получател
<td class='header'> ЕГН/ЕИК
<td class='header'> сметка
<td class='header'> дата
<td class='header'> дело
<td class='header'> деловодител

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php $this->assign('myinvo', $this->_tpl_vars['elem']['id']); ?>
										<?php if ($this->_tpl_vars['myinvo'] == 0): ?>
										<?php else: ?>
		<tr>
<td align=right>
					<?php if (empty ( $this->_tpl_vars['elem']['seriinvo'] )): ?>
&nbsp;
					<?php else: ?>
<?php echo $this->_tpl_vars['elem']['seriinvo']; ?>

					<?php endif; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['dateinvo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>


<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['s0'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>


<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['svat'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>


<td id="suma<?php echo $this->_tpl_vars['myinvo']; ?>
" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>


<td> <?php echo $this->_tpl_vars['elem']['name']; ?>


			<?php if (empty ( $this->_tpl_vars['elem']['egn'] )): ?>
<td> <?php echo $this->_tpl_vars['elem']['eik']; ?>

			<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['egn']; ?>

			<?php endif; ?>

<td> 
					<?php if ($this->_tpl_vars['elem']['serial'] <= 0): ?>
-
					<?php else: ?>
<?php echo $this->_tpl_vars['elem']['serial']; ?>

					<?php endif; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>


<td> 
					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
-
					<?php else: ?>
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

					<?php endif; ?>

<td> 
					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
-
					<?php else: ?>
<?php echo $this->_tpl_vars['elem']['username']; ?>

					<?php endif; ?>
																				<?php endif; ?>
		</tr>
<?php endforeach; endif; unset($_from); ?>

		<tr class="header">
<td colspan=2> общо за периода
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUYEAR']['s0'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUYEAR']['svat'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUYEAR']['suma'])) ? $this->_run_mod_handler('tomo3ex', true, $_tmp, $this->_tpl_vars['ISEXCE']) : smarty_modifier_tomo3ex($_tmp, $this->_tpl_vars['ISEXCE'])); ?>

<td colspan=4> &nbsp;

				</table>
				