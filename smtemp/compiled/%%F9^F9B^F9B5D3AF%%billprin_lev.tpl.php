<?php /* Smarty version 2.6.9, created on 2026-01-05 18:19:55
         compiled from billprin_lev.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'billprin_lev.tpl', 80, false),array('modifier', 'tomo3', 'billprin_lev.tpl', 101, false),array('function', 'counter', 'billprin_lev.tpl', 95, false),)), $this); ?>
<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<style>
.tabl {border-top: 1px solid black; border-right: 1px solid black;}
.cell {font: normal 9pt Verdana,Tahoma,Arial; padding:4px; border-bottom: 1px solid black; border-left: 1px solid black;}
.cont2 {font: bold 9pt verdana;}
body, td {font: normal 9pt verdana;}
</style>
</head>
<body style='margin-left:10mm;'>

					<?php $this->assign('BGCO', "bgcolor=#dddddd"); ?>
					<?php $this->assign('NBSP', "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); ?>
		<table align=center class="tabl" width=90%>
		<tr>
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
 width=45%> ЗАДЪЛЖЕНО ЛИЦЕ
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> СЪСТАВИТЕЛ
		<tr>
<td valign=top class="cell"> 
					<table>
						<?php if (empty ( $this->_tpl_vars['ROBILL']['eik'] )): ?>
					<tr>
<td valign=top> име 
<td class="cont2"> <?php echo $this->_tpl_vars['ROBILL']['name']; ?>
 
					<tr>
<td valign=top> ЕГН 
<td class="cont2"> <?php echo $this->_tpl_vars['ROBILL']['egn']; ?>
 
						<?php else: ?>
					<tr>
<td valign=top> Наименование 
<td class="cont2"> <?php echo $this->_tpl_vars['ROBILL']['name']; ?>
 
					<tr>
<td valign=top> ЕИК 
<td class="cont2"> <?php echo $this->_tpl_vars['ROBILL']['eik']; ?>
 
						<?php endif; ?>
					<tr>
<td valign=top> Адрес 
<td class="cont2"> <?php echo $this->_tpl_vars['ROBILL']['address']; ?>
 
					</table>

<td valign=top class="cell"> 
					<table>
					<tr>
<td valign=top> ЧСИ 
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['shortname']; ?>
 
					<tr>
<td valign=top> Район </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['region']; ?>
 
					<tr>
<td valign=top> ЕИК </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['bulstat']; ?>
 
					<tr>
<td valign=top> Адрес </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['address']; ?>
 
					<tr>
<td valign=top> IBAN </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['iban']; ?>
 
					<tr>
<td valign=top> BIC </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['bic']; ?>
 
					<tr>
<td valign=top> Банка </span>
<td class="cont2"> <?php echo $this->_tpl_vars['RODATA']['bank']; ?>
 
					</table>
		</table>

<center>
<h3> СМЕТКА № <?php echo $this->_tpl_vars['RODATA']['seribill']; ?>
</h3>
По чл.79 от ЗЧСИ
<br>
от дата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['RODATA']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;&nbsp;&nbsp;&nbsp;
по изп.дело <b><?php echo $this->_tpl_vars['RODATA']['fullcase']; ?>
</b>
</center>

<br>
		<table align=center class="tabl" width=90%>
		<tr>
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> №
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Действие
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Основание
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Материален<br>интерес
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Пропорц.<br>такса
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Обикнов.<br>такса
<td align=center class="cell" <?php echo $this->_tpl_vars['BGCO']; ?>
> Допълнит.<br>разноски
						<?php echo smarty_function_counter(array('start' => 0,'print' => false), $this);?>

				<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<tr>
<td class="cell" align=right> <?php echo smarty_function_counter(array(), $this);?>
.
<td class="cell"> <?php echo $this->_tpl_vars['elem']['action']; ?>

<td class="cell"> <?php echo $this->_tpl_vars['elem']['ground']; ?>

<td class="cell"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['interest'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 &nbsp;
<td class="cell" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxprop'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 &nbsp;
<td class="cell" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxregu'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 &nbsp;
<td class="cell" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxaddi'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 &nbsp;
				<?php endforeach; endif; unset($_from); ?>
		<tr>
<td colspan=4> &nbsp;
<td class="cell" colspan=2 <?php echo $this->_tpl_vars['BGCO']; ?>
> Общо
<td class="cell" colspan=1 align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> &nbsp;
		<tr>
<td colspan=4> &nbsp;
<td class="cell" colspan=2 <?php echo $this->_tpl_vars['BGCO']; ?>
> ДДС 20 %
<td class="cell" colspan=1 align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['svat'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> &nbsp;
		<tr>
<td colspan=4> &nbsp;
<td class="cell" colspan=2 <?php echo $this->_tpl_vars['BGCO']; ?>
> ВСИЧКО
<td class="cell" colspan=1 align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['tota'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> &nbsp;
		</table>
		
<br>
		<table align=center width=90%>
		<tr>
<td colspan=3>
Платени : <b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['tota'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> лв (<?php echo $this->_tpl_vars['SLOVOM']; ?>
)
		<tr>
<td width=20%> &nbsp;
<td> В брой
<td> ПКО №
<td width=20%> от
		<tr>
<td width=20%> &nbsp;
<td> По банков път
<td> Пл.нареждане рег.№
<td width=20%> от
		</table>

<br>
		<table align=center width=90%>
		<tr>
<td width=45%><nobr> Задължено лице : ____________________</nobr>
<br>
<font size=-2>
(подпис и печат на задълженото лице)
</font>
<td><nobr> Съставител : ____________________</nobr>
<br>
<font size=-2>
(подпис и печат на част.съдебен изпълнител)
</font>
		<tr>
<td colspan=2>
<br>
Забележка :
За дължимите но неплатени такси и допълнителни разноски по тази сметка
окръжният съд издава изпълнителен лист на основание чл.79 ал.3 от ЗЧСИ
във връзка с чл.237 буква "к" от ГПК.
		</table>

</body>
</html>