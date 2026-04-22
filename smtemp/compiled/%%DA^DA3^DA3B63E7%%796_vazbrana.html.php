<?php /* Smarty version 2.6.9, created on 2020-07-07 13:57:15
         compiled from /var/www/csi/outgoing/796_vazbrana.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/var/www/csi/outgoing/796_vazbrana.html', 8, false),)), $this); ?>
<?php $this->assign('tehead', "
ДО
<br>
ДИРЕКТОРА на ОДП
<br>
(-[DIREKTOR_RDVR]-)
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_header.html") : smarty_modifier_cat($_tmp, "sd_header.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tehead'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
<p align=justify>
В кантората на частен съдебен изпълнител (-[CSI_NAME]-) с рег. № (-[CSI_NUMBER]-) в КЧСИ с район на действие - 
(-[CSI_RAION_NA_DEISTVIE]-) и седалище (-[CSI_KANTORA_ADDRESS]-) е образувано 
изп.дело № (-[IZHODQSHT_NOMER]-)/(-[IZHODQSHT_GODINA]-) год., със страни: 
взискател (-[VZISKATEL_NAME]-) (-[VZISKATEL_ADDRESS]-) ЕГН (-[VZISKATEL_EGN_BULSTAT]-)
и длъжник (-[DLUJNIK_NAME]-) (-[DLUJNIK_ADDRESS]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-), 
да заплати сумите както следва:
</p>
<br>
<div style="padding-left: 40pt;">
(-[SPIS_SUMI]-)
</div>
<br>
<p align=justify>
С молба вх. № 01088/27.07. 2007 година, взискателят е направил искане за прилагане на административната мярка по чл.76, т.З от ЗБДС
 по отношение на длъжника по делото - (-[DLUJNIK_NAME]-) (-[DLUJNIK_ADDRESS]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-).
</p>
<p align=justify>
Като взех предвид факта, че длъжникът има парични задължения в големи размери  към български юридически лица, 
установено по съдебен ред, както и поради това, че не е представено надлежено обезпечение от длъжника по делото, 
а личното му имущество, с което разполага е недостатъчно, направеното искане се 
явява основателно и същото следва да бъде уважено, като се предложи на Директора на РДВР (-[DIREKTOR_RDVR]-) да издаде заповед, 
с която да бъде наложена исканата принудителна административна мярка.
</p>

<p>
Водим от горното правя следното предложение:
</p>
<br><center>ПРЕДЛАГАМ :</center><br>
<p align=justify>
Да се наложи принудителна административна мярка - да бъде забранено напускането на стараната или да бъде отнет паспорта 
и заместващите го документи на (-[DLUJNIK_NAME]-) (-[DLUJNIK_ADDRESS]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-), 
длъжник по изп.дело № (-[IZHODQSHT_NOMER]-)/(-[IZHODQSHT_GODINA]-) г. по описа на ЧИС (-[CSI_NAME]-) с рег.№ (-[CSI_NUMBER]-) в КЧСИ 
с район на действие (-[CSI_RAION_NA_DEISTVIE]-).
</p>
<br><center>ПРИЛОЖЕНИЕ :</center><br>
<p>
1. Копие от изп.лист от (-[DELO_IZP_LIST_DATE]-) г., издаден по ч.гр.д. № (-[DELO_FROM_NUMBER]-)/(-[DELO_FROM_YEAR]-) г. на (-[DELO_FROM_SYD]-).
</p>
<p>
2. Молба за прилагане на адм.мярка по чл.76, т.З от ЗБДС, подадена от взискателя по изп. дело.
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_footer.html") : smarty_modifier_cat($_tmp, "sd_footer.html")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>