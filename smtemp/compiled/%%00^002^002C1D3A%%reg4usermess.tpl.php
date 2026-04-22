<?php /* Smarty version 2.6.9, created on 2020-02-28 19:30:54
         compiled from reg4usermess.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reg4usermess.tpl', 39, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.over {background-color:silver;}
.caselink {font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;}
body {margin:0px 10px;}
</style>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък грешки от ЦРД-2014 по дела <?php echo $this->_tpl_vars['REG4USNAME']; ?>

		<tr class='head2'>
<td> дело
<td> грешка
<td> време
<td> пас
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<tr onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
<td class="caselink" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['edit'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['elem']['caseri']; ?>
/<?php echo $this->_tpl_vars['elem']['cayear']; ?>

<td> 
	<?php $_from = $this->_tpl_vars['elem']['artext']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['textelem']):
?>
		<?php if (empty ( $this->_tpl_vars['textelem'][0] )): ?>
		<?php else: ?>
			<?php echo $this->_tpl_vars['textelem'][0]; ?>

				<?php if (empty ( $this->_tpl_vars['textelem'][1] )): ?>
				<?php else: ?>
<br>
<span style="font:normal 8pt courier;color:blue"><?php echo $this->_tpl_vars['textelem'][1]; ?>
</span>
				<?php endif; ?>
			<br>
					<?php if (isset ( $this->_tpl_vars['elem']['texttip'] )): ?>
<span style="background-color:gold" onmouseover="$('#t<?php echo $this->_tpl_vars['elem']['ekey']; ?>
').show();" onmouseout="$('#t<?php echo $this->_tpl_vars['elem']['ekey']; ?>
').hide();"> 
виж [<?php echo $this->_tpl_vars['elem']['id']; ?>
] </span>
<div id="t<?php echo $this->_tpl_vars['elem']['ekey']; ?>
" style="background-color:silver; font:normal 8pt courier; display:none;">
<pre><?php echo $this->_tpl_vars['elem']['texttip']; ?>
</pre>
</div>
					<?php else: ?>
					<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>

<td> <?php echo $this->_tpl_vars['elem']['idreg4']; ?>

<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>