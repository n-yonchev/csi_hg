<?php /* Smarty version 2.6.9, created on 2020-02-27 13:00:35
         compiled from cazo6prnt.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo6prnt.ajax.tpl', 9, false),)), $this); ?>
				<?php if (isset ( $this->_tpl_vars['ARLINK'] )):  ob_start(); ?>
	<?php $_from = $this->_tpl_vars['ARLINK']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pano'] => $this->_tpl_vars['elem']):
?>
&nbsp;
<a href="#" onclick="window.location.href='caseeditzone.php<?php echo $this->_tpl_vars['elem']; ?>
';"> <?php echo $this->_tpl_vars['pano']; ?>
</a>
	<?php endforeach; endif; unset($_from);  $this->_smarty_vars['capture']['listlink'] = ob_get_contents(); ob_end_clean();  $this->assign('list', ((is_array($_tmp="група")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_smarty_vars['capture']['listlink']) : smarty_modifier_cat($_tmp, $this->_smarty_vars['capture']['listlink']))); ?>
				<?php else:  $this->assign('list', ""); ?>
				<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="отпечатване ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['list']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['list'])))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<?php if (isset ( $this->_tpl_vars['URLPAR'] )): ?>
							<?php if ($this->_tpl_vars['WORDTRAN']): ?>
може да корегирате и разпечатвате doc файла,
<br>
но евентуалните корекции не може да бъдат съхранявани на сървъра
<iframe id="interdiv" frameborder="0" style="width:300px;height:100px">
</iframe>

<script type="text/javascript">
$(document).ready(function() {
document.getElementById("interdiv").src= "cazo6word.ajax.php?name=<?php echo $this->_tpl_vars['URLPAR']; ?>
";
});
</script>
							<?php else: ?>
почакай...
след появата на документа натисни бутона Print за отпечатване
<iframe id="interdiv" frameborder="0" style="width:800px;height:800px">
</iframe>

<script type="text/javascript">
$(document).ready(function() {
//	parent.$.nyroModalSettings({width:1000, height:800});
var newurl=
//'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F<?php echo $this->_tpl_vars['URLPAR']; ?>
&pixels=860&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen&leftmargin=25&rightmargin=10&topmargin=10&bottommargin=10&encoding=utf-8&headerhtml=&footerhtml=<?php echo $this->_tpl_vars['FOOTER']; ?>
&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F<?php echo $this->_tpl_vars['URLPAR']; ?>
'
+'&pixels=760&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen'
+'&leftmargin=10&rightmargin=10&topmargin=10&bottommargin=10&encoding=utf-8&headerhtml=&footerhtml=<?php echo $this->_tpl_vars['FOOTER']; ?>
'
+'&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
document.getElementById("interdiv").src= newurl;
});
</script>
							<?php endif; ?>

				<?php else: ?>

					<?php if (isset ( $this->_tpl_vars['ARLINK'] )): ?>
избери група банки за отпечатване
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (isset ( $this->_tpl_vars['ARBRAN'] )): ?>
<font color="red">
При избор на повече от 15 клона извеждането може да приключи аварийно.
</font>
<br>
<br>
избери клонове за извеждане
&nbsp;&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazo6bran.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
														<?php if ($this->_tpl_vars['ISREGITAX']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazo6tax.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
						<?php endif; ?>
				<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'готово','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>

<script>
			var retax= <?php echo $_POST['regitax']; ?>
 +0;
			var retext= "<?php echo $this->_tpl_vars['TEMPTEXT']; ?>
";
			var tempmark= "<?php echo $this->_tpl_vars['TEMPMARK']; ?>
";
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>