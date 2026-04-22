<?php /* Smarty version 2.6.9, created on 2020-03-04 12:27:11
         compiled from tranoutf4.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'tranoutf4.tpl', 59, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
	.link {font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;}
	.desc {font:normal 8pt verdana;}
</style>
<table align=center width=94%>
	<tr>
		<td>
			<a class="link" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['GOBACK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
				<?php echo $this->_tpl_vars['GOTEXT']; ?>
 </a>
			<br>&nbsp;
	<tr>
		<td>
			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
					<td colspan='200'>
						<div style="float:left">списък на редовете от изходящия <?php echo $this->_tpl_vars['ARBANKPAYMSUFF'][$this->_tpl_vars['IDBANK']]; ?>
 файл за банка <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['IDBANK']]; ?>
, получен от пакет <?php echo $this->_tpl_vars['IDPACK']; ?>

													</div>
						<div style="float:right">
														<a class="link" href="#" onclick="fuprin('<?php echo $this->_tpl_vars['LINKCREA']; ?>
'); return false;"
							   title="формирай <?php echo $this->_tpl_vars['ARBANKPAYMSUFF'][$this->_tpl_vars['IDBANK']]; ?>
 файл"> <?php echo $this->_tpl_vars['ARBANKPAYMSUFF'][$this->_tpl_vars['IDBANK']]; ?>
</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<img src="images/print.gif" title="отпечати всички преводи" style="cursor:pointer" onclick="fuprin('<?php echo $this->_tpl_vars['LINKPRNT']; ?>
');">
							&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
				<tr class='head2'>
					<td colspan=7 align=center style="font-size:7pt;"> за кредитен превод
										<tr class='head2'>
					<td> име на получателя
					<td> IBAN
					<td> банка
					<td> сума
					<td> основание за плащане
					<td> пс
										</tr>
				<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
				<td> <?php echo $this->_tpl_vars['elem']['destName']; ?>

				<td> <?php echo $this->_tpl_vars['elem']['destIBAN']; ?>

				<td> <?php echo $this->_tpl_vars['elem']['bankto']; ?>

				<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

				<td> <?php echo $this->_tpl_vars['elem']['text1']; ?>

				<td> <?php echo $this->_tpl_vars['elem']['ps']; ?>
&nbsp;
										<?php endforeach; endif; unset($_from); ?>
										<tr class='head1'>
						<td colspan=3> <?php echo $this->_tpl_vars['SUMATOTA']['coun']; ?>
 реда общо
						<td> обща сума
						<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMATOTA']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

						<td colspan=2>
			</table>
</table>