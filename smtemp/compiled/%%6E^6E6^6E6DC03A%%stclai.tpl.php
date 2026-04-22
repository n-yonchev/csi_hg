<?php /* Smarty version 2.6.9, created on 2025-04-11 16:18:50
         compiled from stclai.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'stclai.tpl', 14, false),)), $this); ?>
									<?php if ($this->_tpl_vars['FLPRIN']): ?>
<style>
td {font: normal 8pt verdana;}
.hetext {background-color:#d0d0d0; text-align:center;}
</style>
				<table align=center border=1>
				<tr>
<td class="hetext" colspan=5> &nbsp; взискатели и брой дела &nbsp;
<br>
образувани през 
		<?php if (! empty ( $this->_tpl_vars['MONT'] )): ?>
месец <?php echo $this->_tpl_vars['MONT']; ?>
-<?php echo $this->_tpl_vars['YEAR']; ?>

		<?php else: ?>
периода <?php echo ((is_array($_tmp=$this->_tpl_vars['D1'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['D2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<?php endif; ?>
				<tr>
<td class="hetext" align=center> взискател
<td class="hetext" align=center> тип
<td class="hetext" align=center> булстат
<td class="hetext" align=center> егн
<td class="hetext" align=center> дела
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['elem']):
?>
				<tr>
<td class="sttext"> <?php if (empty ( $this->_tpl_vars['elem']['name'] )): ?><font color=red>няма взискател</font><?php else:  echo $this->_tpl_vars['elem']['name'];  endif; ?>
<td class="sttext"> 
				<?php if ($this->_tpl_vars['elem']['idtype'] == 1): ?>
юрид
				<?php elseif ($this->_tpl_vars['elem']['idtype'] == 2): ?>
физ
				<?php else: ?>
др
				<?php endif; ?>
<td class="sttext"> <?php echo $this->_tpl_vars['elem']['bulstat']; ?>
&nbsp;
<td class="sttext"> <?php echo $this->_tpl_vars['elem']['egn']; ?>
&nbsp;
<td class="sttext" align=right> <?php echo $this->_tpl_vars['elem']['coun']; ?>

		<?php endforeach; endif; unset($_from); ?>
				</table>
									<?php else: ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<tr>
<td>
<center>
<h2>формиране</h2>
</center>
</table>

<iframe id="frarep" width=800 height=400 frameborder=0 style="visibility:visible"></iframe>
<script>
	document.getElementById("frarep").src= "<?php echo $this->_tpl_vars['URLCREATE']; ?>
";
</script>
									<?php endif; ?>