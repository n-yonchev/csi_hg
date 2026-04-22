<?php /* Smarty version 2.6.9, created on 2020-11-25 10:06:29
         compiled from scanmass.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'scanmass.ajax.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "масово сканирани вх.документи")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.ok {background-color:lightgreen;cursor:pointer;}
.ok:hover {background-color:green;}
.cancel {background-color:lightcoral;cursor:pointer;}
.cancel:hover {background-color:red;}
.error {font:bold 7pt verdana !important;background-color:red;color:white;cursor:help;}
.calist {font:normal 7pt verdana !important;border:0px solid black !important;}
</style>

							<?php if ($this->_tpl_vars['SMFROMCASE']): ?>
								<?php $this->assign('CANCELALL', ((is_array($_tmp="caseeditzone.php")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['CANCELALL']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['CANCELALL']))); ?>
								<?php $this->assign('OKALL', ((is_array($_tmp="caseeditzone.php")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['OKALL']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['OKALL']))); ?>
							<?php else: ?>
							<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center style="margin:10px;">
		<tr class='head2'>
<td style="cursor:pointer;" title="НЕ ПРИЕМАМ ВСИЧКИ" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['CANCELALL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <img src="images/lock3.gif">
<td align=right> вх<br>ном
<td> описание
<td> подател
<td align=right> брой<br>стр
<td> &nbsp;
<td> дело
<td style="cursor:pointer;" title="приемам всички" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['OKALL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <img src="images/topaym.gif">
<td> гре<br>шка
		</tr>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php if ($this->_tpl_vars['SMFROMCASE']): ?>
								<?php $this->assign('cancel', ((is_array($_tmp="caseeditzone.php")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['cancel']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['cancel']))); ?>
								<?php $this->assign('ok', ((is_array($_tmp="caseeditzone.php")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['ok']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['ok']))); ?>
								<?php $this->assign('scanv2', ((is_array($_tmp="caseeditzone.php")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['scanv2']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['scanv2']))); ?>
							<?php else: ?>
								<?php $this->assign('cancel', $this->_tpl_vars['elem']['cancel']); ?>
								<?php $this->assign('ok', $this->_tpl_vars['elem']['ok']); ?>
								<?php $this->assign('scanv2', $this->_tpl_vars['elem']['scanv2']); ?>
							<?php endif; ?>
<td class="cancel" title="НЕ ПРИЕМАМ" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['cancel'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> &nbsp;&nbsp;&nbsp;
<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>

<td> <?php echo $this->_tpl_vars['elem']['text']; ?>

<td> <?php echo $this->_tpl_vars['elem']['from']; ?>

<td align=center> <?php echo $this->_tpl_vars['elem']['pageco']; ?>

<td> 
<img src="images/view.png" style="cursor:pointer" title="виж" onclick="w2=window.open('<?php echo $this->_tpl_vars['scanv2']; ?>
','win2');w2.focus();">
<td> 
			<table class="" cellspacing='0' cellpadding='0'>
		<?php $_from = $this->_tpl_vars['elem']['caselist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['caelem']):
?>
			<tr class="">
			<td class="calist"> <nobr><?php echo $this->_tpl_vars['caelem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['caelem']['caseyear']; ?>
</nobr>
			<td class="calist"> <nobr><?php echo $this->_tpl_vars['caelem']['username']; ?>
</nobr>
		<?php endforeach; endif; unset($_from); ?>
			</table>
<td class="ok" title="приемам" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ok'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> &nbsp;&nbsp;&nbsp;
				<?php if ($this->_tpl_vars['elem']['ider'] == 0): ?>
<td> &nbsp;
				<?php else: ?>
<td align=center class="error" title="<?php echo $this->_tpl_vars['ARSCANER'][$this->_tpl_vars['elem']['ider']]; ?>
 [<?php echo $this->_tpl_vars['elem']['iddocu']; ?>
]"> <?php echo $this->_tpl_vars['elem']['ider']; ?>

				<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		</table>
<script>
$(document).ready(function(){
	$("div.wclose_normal").bind("click",function(){
//parent.$(document).hide();
//parent.$(document.body).hide();
//++++parent.$("body").hide();
			<?php if ($this->_tpl_vars['SMFROMCASE']): ?>
parent.$('#t5link').click();
			<?php else: ?>
parent.$("body").css({opacity:0.2});
parent.location.reload(true);
			<?php endif; ?>
	});
					<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
	$("div.wclose_normal").click();
					<?php else: ?>
					<?php endif; ?>
});
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>