<?php /* Smarty version 2.6.9, created on 2026-03-10 15:42:06
         compiled from base.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'base.tpl', 97, false),)), $this); ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100> основни данни за ЧСИ
	</thead>
	<tbody>
<tr>
<td colspan=3 align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

									<tr><td valign=top style="border-right: 1px solid silver;">
								<table>
								<tr><td>
									<table>

				<?php $this->assign('bor0', "style='border:0px'"); ?>
				<?php $this->assign('spac', "&nbsp;&nbsp;&nbsp;&nbsp;"); ?>
<tr>
	<td style='border:0px' align=right> наименование
	<td style='border:0px'> <?php echo $this->_tpl_vars['spac']; ?>

		<input type="text" name="text" id="text" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> номер
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="serial" id="serial" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serial','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<tr>
	<td style='border:0px' align=right> булстат
	<td style='border:0px'> <?php echo $this->_tpl_vars['spac']; ?>

		<input type="text" name="bulstat" id="bulstat" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bulstat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> район на действие
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="region" id="region" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'region','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> пълно име
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="fullname" id="fullname" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'fullname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> късо име
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="shortname" id="shortname" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'shortname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> адрес
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="address" id="address" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'address','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> ИССИ apikey
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="issiapikey" id="issiapikey" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'issiapikey','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> ел партида - AppKey
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="epep_app_key" id="epep_app_key" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'epep_app_key','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=right> ел партида - AppSecret
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="epep_app_secret" id="epep_app_secret" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'epep_app_secret','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>  
									</table>


	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
> банкови сметки
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'добави','NAME' => 'plusac','ID' => 'plusac')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<?php $_from = $this->_tpl_vars['ACLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ackey'] => $this->_tpl_vars['acelem']):
?>
	<tr><td colspan=3 style="padding: 8px; border: none">
	<table class="" style="border-left: 6px solid #dfe8f6;" align=center>
	<tr>
<td align=right> описание
<td>
<input type="text" name="listac[<?php echo $this->_tpl_vars['ackey']; ?>
][desc]" id="desc_<?php echo $this->_tpl_vars['ackey']; ?>
" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => ((is_array($_tmp='desc_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ackey']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ackey'])),'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td align=right> IBAN
<td>
<input type="text" name="listac[<?php echo $this->_tpl_vars['ackey']; ?>
][iban]" id="iban_<?php echo $this->_tpl_vars['ackey']; ?>
" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => ((is_array($_tmp='iban_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ackey']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ackey'])),'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td align=right>
BIC
<td>
<input type="text" name="listac[<?php echo $this->_tpl_vars['ackey']; ?>
][bic]" id="bic_<?php echo $this->_tpl_vars['ackey']; ?>
" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => ((is_array($_tmp='bic_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ackey']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ackey'])),'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td align=right>
банка
<td>
<input type="text" name="listac[<?php echo $this->_tpl_vars['ackey']; ?>
][bank]" id="bank_<?php echo $this->_tpl_vars['ackey']; ?>
" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => ((is_array($_tmp='bank_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ackey']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ackey'])),'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	</table>
				<?php endforeach; endif; unset($_from); ?>
				<?php if (isset ( $_POST['accosele'] )): ?>
<tr><td>
банк.сметка за автоматичен избор при генериране на изх.документи
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARACCONAME'],'ID' => 'accosele','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>

				<tr><td colspan=4>
				<table>
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left colspan=8 bgcolor=silver> за сметките по чл.79 ЗЧСИ и за фактурите
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=right>
адрес на ЧСИ
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=left>
<input type="text" name="bill[address]" id="bill_address" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bill_address','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
банк.сметка за такси и разноски
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=right>
IBAN
<td>
<input type="text" name="bill[iban]" id="bill_iban" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bill_iban','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=right>
BIC
<td>
<input type="text" name="bill[bic]" id="bill_bic" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bill_bic','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=right>
банка
<td>
<input type="text" name="bill[bank]" id="bill_bank" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bill_bank','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
само за фактурите
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=right>
МОЛ 
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=2 align=left>
<input type="text" name="invopers" id="invopers" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invopers','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>

									</table>
									<td valign=top>
									<table>
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> нач.номер входящ документ
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="begidocu" id="begidocu" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'begidocu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> нач.номер изпълнит.дело
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="begicase" id="begicase" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'begicase','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> нач.номер изходящ документ
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="begidocuout" id="begidocuout" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'begidocuout','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
след вземане на дело директно <br>да се въвеждат основните данни на делото
<input type="checkbox" name="isdirect" id="isdirect" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isdirect','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuyear']):
?>
									<tr>
<td align=right valign=top> брой дела за <?php echo $this->_tpl_vars['cuyear']; ?>
 год.
<td>
			<?php $this->assign('nameyear', ((is_array($_tmp='coun')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['cuyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['cuyear']))); ?>
<input type="text" name="<?php echo $this->_tpl_vars['nameyear']; ?>
" id="<?php echo $this->_tpl_vars['nameyear']; ?>
" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['nameyear'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="document.getElementById('link<?php echo $this->_tpl_vars['cuyear']; ?>
').style.display='none';"> 
&nbsp;
<a id="link<?php echo $this->_tpl_vars['cuyear']; ?>
" href="#" onclick="checkyear('<?php echo $this->_tpl_vars['cuyear']; ?>
');">
<img src="images/check.gif" title="проверка">
</a>
<div id="span<?php echo $this->_tpl_vars['cuyear']; ?>
" style="background:lightblue;"></div>
			<?php endforeach; endif; unset($_from); ?>

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
ограничена корекция на входящите документи
<input type="checkbox" name="isdoculimi" id="isdoculimi" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isdoculimi','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
ограничена корекция на изходящите документи
<input type="checkbox" name="isdocuoutlimi" id="isdocuoutlimi" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isdocuoutlimi','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> буква за редактиране на Word шаблони
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="letteredit" id="letteredit" size=1 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'letteredit','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> буква за редактиране на Word изходящи документи
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="letterdocu" id="letterdocu" size=1 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'letterdocu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> интервал за стари постъпления (дни)
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="finainterval" id="finainterval" size=4 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'finainterval','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
изпълнит.дела нямат постоянни деловодители
<input type="checkbox" name="isnopermuser" id="isnopermuser" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isnopermuser','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
забранено ръчното въвеждане на банкови постъпления 
<input type="checkbox" name="isnomanual" id="isnomanual" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isnomanual','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
от кои банки ще постъпват файлове с банкови постъпления 
<?php $_from = $this->_tpl_vars['ARBANKNAME']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['code'] => $this->_tpl_vars['bank']):
?>
	<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" name="banklist[]" value="<?php echo $this->_tpl_vars['code']; ?>
" label="<?php echo $this->_tpl_vars['bank']; ?>
">
<?php endforeach; endif; unset($_from); ?>

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
при изходяване на документ автоматично да се добавя таксата <br>като предмет на изпълнение
<input type="checkbox" name="isregitax" id="isregitax" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isregitax','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> банкова такса за превод на разпределена сума (€)
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="banktax" id="banktax" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'banktax','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
в дневника на изв.действия да се формира отделен номер за всяко дело 
<input type="checkbox" name="isjoursepa" id="isjoursepa" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isjoursepa','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 colspan=4 align=left>
в данните за регистъра да участват взискателите
<input type="checkbox" name="isregiclai" id="isregiclai" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isregiclai','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

	<tr>
<td <?php echo $this->_tpl_vars['bor0']; ?>
 align=left> минимална работна заплата
<td <?php echo $this->_tpl_vars['bor0']; ?>
> <?php echo $this->_tpl_vars['spac']; ?>

<input type="text" name="minsal" id="minsal" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'minsal','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
									</table>
	<tr>
	<td colspan=100 align=center  style='border:0px'>
<br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>

</form>

<script>
function checkyear(p1,p2){
			if (p2){
	$("#span"+p1).load("baseyear.ajax.php?year="+p1+"&coun="+$("#coun"+p1).attr("value")+"&crea=yes");
			}else{
	$("#span"+p1).load("baseyear.ajax.php?year="+p1+"&coun="+$("#coun"+p1).attr("value"));
			}
}
</script>