<?php /* Smarty version 2.6.9, created on 2020-03-04 10:28:53
         compiled from delienve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'delienve.tpl', 56, false),array('modifier', 'truncate', 'delienve.tpl', 57, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<table align=center>
					<tr>
<td>
<?php $_from = $this->_tpl_vars['ARV3LINK']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['codevari'] => $this->_tpl_vars['culink']):
?>
	<span class="link3<?php if ($this->_tpl_vars['codevari'] == $this->_tpl_vars['V3']): ?> curr3<?php else:  endif; ?>" 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['culink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<?php echo $this->_tpl_vars['ARV3'][$this->_tpl_vars['codevari']]; ?>

	<?php if ($this->_tpl_vars['ARV3COUN'][$this->_tpl_vars['codevari']] == 0):  else: ?>&nbsp;[<?php echo $this->_tpl_vars['ARV3COUN'][$this->_tpl_vars['codevari']]; ?>
]<?php endif; ?>
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
<?php endforeach; endif; unset($_from); ?>
					</table>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на документи за връчване по поща
				<tr class='head2'>
<td> изх.номер
<td> изходен
<td> тип
<td> дело
<td> деловодител
<td> адресат
<td> адрес
<td> статус
<td> бел
<td colspan=3 align=center> плик

<?php $_from = $this->_tpl_vars['ARPOST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idpost'] => $this->_tpl_vars['elem']):
?>
				<tr>
<td title="<?php echo $this->_tpl_vars['idpost']; ?>
">
<nobr>
<?php echo $this->_tpl_vars['elem']['d2seri']; ?>
/<?php echo $this->_tpl_vars['elem']['d2year']; ?>

							<?php if ($this->_tpl_vars['elem']['isdoc'] == 0): ?>
<img src="images/view.png" style="cursor:pointer" title="виж съдържанието" onclick="w2=window.open('<?php echo $this->_tpl_vars['elem']['viewcont']; ?>
','win2');w2.focus();">
			<?php else: ?>
<img src="images/word.gif" style="cursor:pointer" title="виж документа" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['viewcont']; ?>
');">
			<?php endif; ?>
</nobr>
<td class="fon7" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
 от <?php echo $this->_tpl_vars['elem']['postuser']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td style="cursor:help;" title="<?php echo $this->_tpl_vars['elem']['d2text']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['d2text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

					<?php if (empty ( $this->_tpl_vars['elem']['caseri'] )): ?>
<td> &nbsp;
					<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['caseri']; ?>
/<?php echo $this->_tpl_vars['elem']['cayear']; ?>

					<?php endif; ?>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

<td> <?php echo $this->_tpl_vars['elem']['adresat']; ?>

<td> <?php echo $this->_tpl_vars['elem']['address']; ?>

<td <?php if ($this->_tpl_vars['elem']['isertype']): ?>class="ertype" title="статуса не отговаря на метода"<?php else:  endif; ?>> <?php echo $this->_tpl_vars['elem']['statname']; ?>

					<?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
<td> &nbsp;
					<?php else: ?>
<td align=center style="cursor:help;" title="<?php echo $this->_tpl_vars['elem']['notes']; ?>
"><img src="images/info.gif">
					<?php endif; ?>
				<?php if (empty ( $this->_tpl_vars['elem']['idenve'] )): ?>
<td align=center class="curr3" title="включи в нов плик"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tonew'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> &nbsp;нов&nbsp;
<td align=center class="" style="cursor:pointer;" title="включи в съществуващ плик"
onclick="$.nyroModalManual({forceType:'iframe',url:'<?php echo $this->_tpl_vars['elem']['toexi']; ?>
'});"
> &nbsp;с&nbsp;
<td> &nbsp;
				<?php else: ?>
					<?php if ($this->_tpl_vars['elem']['idstatenve'] == 0): ?>
<td align=center class="stat0 tohe" title="чакащ плик"
> #<?php echo $this->_tpl_vars['elem']['idenve']; ?>

<td align=center class="" style="cursor:pointer;" title="включи в съществуващ плик"
onclick="$.nyroModalManual({forceType:'iframe',url:'<?php echo $this->_tpl_vars['elem']['toexi']; ?>
'});"
> &nbsp;с&nbsp;
<td class="toli" title="изключи от плик #<?php echo $this->_tpl_vars['elem']['idenve']; ?>
"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['noenve'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> <img src="images/ignore.gif">
					<?php else: ?>
<td align=center class="stat1 tohe" title="изпратен плик"> #<?php echo $this->_tpl_vars['elem']['idenve']; ?>

<td> &nbsp;
<td> &nbsp;
					<?php endif; ?>
				<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>