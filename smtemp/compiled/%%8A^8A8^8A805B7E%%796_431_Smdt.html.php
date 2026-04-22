<?php /* Smarty version 2.6.9, created on 2020-04-21 09:52:26
         compiled from /var/www/csi/outgoing/796_431_Smdt.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/var/www/csi/outgoing/796_431_Smdt.html', 8, false),)), $this); ?>
<?php $this->assign('tehead', "
ДО
<br>
Община (-[DO_OBSHTINA]-)
<br>
отдел \"МДТ\"
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_header.html") : smarty_modifier_cat($_tmp, "sd_header.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tehead'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
<p align=justify>
Моля, на основание на основание чл. 431 ал.З ГПК, незабавно ни съобщете всички имоти, движими и недвижими вещи лични и съпружеска общност, 
които притежава лицето (-[DLUJNIK_NAME]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-) с адрес (-[DLUJNIK_ADDRESS]-) - 
длъжник по изп. дело № (-[DELO_NUMBER]-)/(-[DELO_YEAR]-) г., в качеството му на Физическо или Юридическо лиие по смисъла на Търговския закон.
</p>
<p align=justify>
Моля в справката да упоменете номерата на документите за собственост, които са записани в подадената 
от длъжника или от неговата съпруг /съпруга/ декларация по чл. 14 от ЗМДТ.
</p>
<p align=justify>
Моля в справката да бъдат приложени копия от декларация на длъжника по чл. 14 от ЗМДТ, както и копия от нотариални актове 
или др. титули за собственост, ако има приложени такива.
</p>
<p align=justify>
Моля да бъдат посочени и данни за притежаваното от длъжника /неговата съпруг а/ МПС като марка, модел и регистрационен номер и др.
</p>
<p align=justify>
Сведенията ни са необходими за извършване на принудителни изпълнителни действия.
</p>
<p align=justify>
В случай че не е посочен акта за собственост, моля да ни бъде дадено пълното описание на имота с оглед спазване 
разпоредбата на чл.6, ал.1, т.б от Правилника за вписванията.
</p>

<?php $this->assign('tefoot', "
<br>
<br>
<br>
<br>
Връчител : 
<br>
<br>
Получател : 
<br>
<br>
Дата : 
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_footer.html") : smarty_modifier_cat($_tmp, "sd_footer.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tefoot'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>