<?php /* Smarty version 2.6.9, created on 2020-02-28 11:21:39
         compiled from collmoex.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'collmoex.ajax.tpl', 21, false),array('modifier', 'tomoney2', 'collmoex.ajax.tpl', 35, false),)), $this); ?>

								<?php if (isset ( $this->_tpl_vars['MONT'] )): ?>
						<?php $this->assign('text', "месеца"); ?>
								<?php else: ?>
						<?php $this->assign('text', "периода"); ?>
								<?php endif; ?>
<style>
td {font: normal 12pt verdana;}
.hetext {background-color:#d0d0d0; }
</style>
					<table border=1>
					<tr>
<td colspan=5> 
Месечен доклад 
	<br> на деловодител <b><?php echo $this->_tpl_vars['USERNAME']; ?>
</b>
	<br> за <b><?php if (isset ( $this->_tpl_vars['MONT'] )): ?>месец <?php echo $this->_tpl_vars['MONT']; ?>
-<?php echo $this->_tpl_vars['YEAR']; ?>
</b>
	<?php else: ?>периода <?php echo ((is_array($_tmp=$this->_tpl_vars['D1'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['D2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"));  endif; ?>
<br> Събрани суми за ЧСИ по изпълнителни дела 
					<tr>
<td class="hetext"> дело
<td class="hetext" align=right> сума<br>с ДДС
<td class="hetext" align=right> сума<br>без ДДС
<td class="hetext"> дата
<td class="hetext"> тип
			<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
					<tr>
<td class="sttext" align=left> '<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

<td class="sttext" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class="sttext" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['novat'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class="sttext" align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td class="sttext" align=left> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['elem']['idtype']]; ?>

			<?php endforeach; endif; unset($_from); ?>
					<tr>
<td class="hetext"> общо
<td class="hetext" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['TOTA'][1])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class="hetext" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['TOTA'][2])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

					</table>
