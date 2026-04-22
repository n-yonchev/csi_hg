<?php /* Smarty version 2.6.9, created on 2020-03-27 17:57:32
         compiled from delisendprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'delisendprnt.tpl', 46, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
														<?php $this->assign('bord', ""); ?>

<body style="<?php echo $this->_tpl_vars['bord']; ?>
"
onload="window.focus();window.print();">

<div style="<?php echo $this->_tpl_vars['bord']; ?>
margin-top:11.5cm;margin-right:0.5cm;float:right;">
	<span style="font:normal 10pt tahoma;">#<?php echo $this->_tpl_vars['ARENVE']['id']; ?>
</span>
</div>
<div style="<?php echo $this->_tpl_vars['bord']; ?>
margin-top:9cm;margin-right:0.2cm;height:3cm;width:8cm;float:right;"> 
			<span style="font:normal 10pt tahoma;">
ДО
<br>
<?php echo $this->_tpl_vars['ARENVE']['adresat']; ?>

<br>
<?php echo $this->_tpl_vars['ARENVE']['address']; ?>

			</span>
</div>

										<?php if ($this->_tpl_vars['ISENVEONLY']): ?>
					<?php else: ?>
<div style="page-break-after:always;"></div>
<img src="delimess2.jpg" style="margin-left:30mm;margin-top:1cm;">
<div style="position:absolute;left:109.5mm;top:174mm;font:normal 12pt verdana;">
X </div>
<div style="<?php echo $this->_tpl_vars['bord']; ?>
position:absolute;left:109mm;top:187mm;font:normal 8pt verdana;">
#<?php echo $this->_tpl_vars['ARENVE']['id']; ?>
 </div>
<table cellspacing=0 cellpadding=0 style="<?php echo $this->_tpl_vars['bord']; ?>
position:absolute;left:45mm;top:193mm;width:62mm;height:36mm;">
<tr>
<td style="padding:2mm;font:normal 8pt verdana;"> 
Подписаният получател <b><?php echo $this->_tpl_vars['ARENVE']['adresat']; ?>
</b><?php if (empty ( $this->_tpl_vars['ARENVE']['address'] )):  else: ?>, адрес <b><?php echo $this->_tpl_vars['ARENVE']['address']; ?>
</b><?php endif; ?> 
удостоверявам, че получих 
								<?php echo smarty_function_counter(array('start' => 0,'assign' => 'coun'), $this);?>

	<?php $_from = $this->_tpl_vars['ARDOUT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
								<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

<b>писмо</b> изх.№ <b><?php echo $this->_tpl_vars['elem']['doutinfo']; ?>
</b> по изп.дело <b><?php echo $this->_tpl_vars['elem']['caseinfo']; ?>
</b><?php if ($this->_tpl_vars['coun'] == count ( $this->_tpl_vars['ARDOUT'] )):  else: ?>,<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</table>
<table cellspacing=0 cellpadding=0 style="<?php echo $this->_tpl_vars['bord']; ?>
position:absolute;left:116mm;top:193mm;width:56mm;height:35mm;">
<tr align=center>
<td style="padding:2mm;font:normal 8pt verdana;"> 
Кантора на <br>Частен съдебен изпълнител <br>№ <?php echo $this->_tpl_vars['ROOFFI']['serial']; ?>
 
<br><?php echo $this->_tpl_vars['ROOFFI']['shortname']; ?>
 <br><?php echo $this->_tpl_vars['ROOFFI']['adres2']; ?>
 
</table>
					<?php endif; ?>

</body>
</html>