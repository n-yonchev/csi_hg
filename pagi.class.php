<?php
# --------------- вер.2 --------------------------------------------------
# заедно с библиотеката за достъп dbsimple [dklab] 
#-------------------------------------------------------------------------
# клас за странициране 
# съглашения : 
//#    номера на текущата страница се предава чрез сесийна променлива 
//#    $_POST["para"] - [вход] желаната страница от формата 
# използва се готов външен обект с име $smarty 
# линковете за страници се криптират чрез външна функция geturl() 
# smarty променливи, на които се назначават резултатни стойности 
#    "ONPREV"   - линк за предишна страница 
#    "ONNEXT"   - линк за следваща страница 
#    "PAGELIST" - списък на страниците с линкове 
#    "PAGENO"   - номера на текущата страница 
//# rame11 - заради използването на cpanel 
# предаваме и общия брой записи и страници 
#    "TOTREC"   - общия брой записи 
#    "TOTPAG"   - общия брой страници 
# в шаблона на страницата да се използва шаблона за странициране 
#    {include file="_pagina.tpl"} 


#---------------------- константи ------------------------
# име на масива със smarty параметрите 
# по премълчаване е PAGIPARA, да се съгласува с шаблоните _pagina.html, $pagina.tpl 
define ("SMARNAME", "PAGIPARA");
//# за URL - име на параметъра за номер на страница 
//define ("PANONAME", "page");


# начало на дефиницията 
class paginator {

#---------------------- входни ------------------------
# брой записи на страница 
var $perpage;
# за дизайна - максималния брой номера на страници в списъка с линковете 
var $pagemaxi;
//# сесийно име за съхраняване номера на текущата страница 
//var $pagename;
//# номера на текущата страница 
//var $currpage;
# заявка за определяне на общия брой чрез mysql_num_rows 
				#------------- вер.2 ---------------
				# $quex вече е истинската заявка за данните 
var $quex;
//# c10 
//# вече предаваме параметрите към smarty обекта в масив 
//# име на масива със smarty параметрите 
//var $smarname;
//# базовия URL за криптираните линкове 
//var $baseurl;

#---------------------- резултатни ------------------------
# общия брой записи 
var $totrec;
# общия брой страници 
var $totpag;

//function paginator($perpage,$pagemaxi,$pagename,$quex  ,$smarname="PAGIPARA"){
function paginator($perpage,$pagemaxi,$quex){
//# $smarname - име на масива със smarty параметрите 
//# по премълчаване е PAGIPARA, да се съгласува с шаблоните _pagina.html, $pagina.tpl 
				#------------- вер.2 ---------------
				# $quex вече не е заявка само за броя записи, а истинската заявка за данните 
	$this->perpage= $perpage;
	$this->pagemaxi= $pagemaxi;
//	$this->pagename= $pagename;
//	$this->currpage= $currpage;
	$this->quex= $quex;
//	$this->smarname= $smarname;
//	$this->baseurl= $baseurl;
}

//function calculate(){
# 08.01.2009 
# заради съхраняване при рекурсивно използване на обекти от класа 
# специално 4-ти параметър - различно значение на PANONAME 
# - име на параметъра за номер на страница 
//function calculate($currpage,$prefurl,$baseurl){
function calculate($currpage,$prefurl,$baseurl    ,$panoname=""){
global $smarty;
						if ($panoname==""){
define ("PANONAME", "page");
						}else{
define ("PANONAME", $panoname);
						}
	# $pano - локална променлива за номера на текущата страница 
//						# вземаме номера на текущата страница от сесията 
//						$pano= $_SESSION[$this->pagename];
//	$pano= $this->currpage;
	$pano= $currpage;
/*
	# променяме номера на текущата страница 
	list($paname,$pavalu)= explode("=",$_POST["para"]);
	if ($paname==$this->pagename){
		$pano= $pavalu;
	}else{
	}
*/
	if (isset($pano)){
	}else{
		$pano= 1;
	}
# c10 - корегирана грешка
# иначе дава Fatal Error - Unsupported operand types 
$pano= (int)$pano;
# rame8 - корегирана грешка 
# иначе гърми заявката $DB->selectPage - error in your SQL syntax 
# заради отрицателно число в limit, напр. LIMIT -20,20 
$pano= ($pano==0) ? 1 : $pano;
	# изчисляваме параметрите предишна/следваща 
				#------------- вер.2 ---------------
				# корегиран код 
/*
	$set1= myqu($this->quex,"calculate=1",true);
	$this->totrec= mynu($set1);
*/
global $DB;
											#---- вер.2 --- 
											# изпълняваме заявката в цикъл докато 
											# номера на текущата страница остава по-голям от общия брой страници 
											while (true){
		# началния запис 
		$begi= ($pano-1) * $this->perpage;
//print "<h2> $begi/$pano/$this->perpage/$this->totpag </h2>";
				# заявката dbsimple 
			/*
				$rows= $DB->selectPage(
				  $totalRows,
				  $this->quex,
				  $begi, $this->perpage
				);
			*/
				$rows= $DB->selectPage(
				  $totalRows,
				  $this->quex ." limit ?d, ?d",
				  $begi, $this->perpage
				);
				$this->totrec= $totalRows;
				#----------------------------------
	$this->totpag= ceil($this->totrec/$this->perpage);
	if ($this->totpag <= 1){
		$prev= "";
		$next= "";
		$limi= "";
	}else{
/*
# c10 - корегирана грешка 
# иначе дава Fatal Error - Unsupported operand types 
$pano= (int)$pano;
*/
		$prev= ($pano==1) ? "" : $pano-1;
		$next= ($pano==$this->totpag) ? "" : $pano+1;
		$begi= ($pano-1) * $this->perpage;
		$limi= "limit $begi,$this->perpage";
	}
	# Нормираме номера на текущата страница, да не е по-голям от номера на последната. 
	# Възможно е след изтриване на последния запис страниците да намалеят с една. 
				#------------- вер.2 ---------------
				# корегиран код 
/*
	$pano= ($pano > $this->totpag) ? $this->totpag : $pano;
*/
				# ако номера на текущата страница се промени, изпълняваме отново цикъла със заявката 
				# в противен случай - излизаме от цикъла 
//print "[$pano][$this->totpag]";
/*
				if ($pano > $this->totpag){
					$pano=$this->totpag;
				}else{
											break;
				}
*/
				if ($this->totpag==0){
											# ВНИМАНИЕ. 
											# ако няма запис - също излизаме ! 
											break;
				}elseif ($pano > $this->totpag){
					$pano= $this->totpag;
				}else{
											break;
				}
				#----------------------------------

											#---- вер.2 --- 
											# край на цикъла със заявката 
											}
											
//						# записваме отново номера на текущата страница в сесията 
//						$_SESSION[$this->pagename]= $pano;
	# номера вече е определен 
	# параметри за линковете предишна/следваща 
//	$onprev= ($prev=="") ? "" : "jspara('$this->pagename='+'$prev')";
//	$onnext= ($next=="") ? "" : "jspara('$this->pagename='+'$next')";
	$onprev= ($prev=="") ? "" : $prefurl .geturl($baseurl."&".PANONAME."=$prev");
	$onnext= ($next=="") ? "" : $prefurl .geturl($baseurl."&".PANONAME."=$next");
# smarty параметрите - в масив 
$smpara= array();
$smpara["ONPREV"]= $onprev;
$smpara["ONNEXT"]= $onnext;
	# подготвяме визуалния компонент за избор на страница 
	# ще извеждаме списък с линкове към страници, но не повече от $pagemaxi 
	$page1= $pano - (int)($this->pagemaxi/2);
	$page1= ($page1<1) ? 1 : $page1;
	$page2= $page1 + $this->pagemaxi -1;
	$page2= ($page2>$this->totpag) ? $this->totpag : $page2;
				$pagelist= array();
	for ($indx=$page1; $indx<=$page2; $indx++){
//		$pagelist[$indx]= "jspara('$this->pagename='+'$indx')";
//$aa= $baseurl."&".PANONAME."=$indx";
//print "<br> $prefurl/$aa";
		$pagelist[$indx]= $prefurl .geturl($baseurl."&".PANONAME."=$indx");
	}
# smarty параметрите - в масив 
$smpara["PAGELIST"]= $pagelist;
$smpara["PAGENO"]= $pano;
# rame11 - заради използването на cpanel 
# предаваме и общия брой записи и страници 
$smpara["TOTREC"]= $this->totrec;
$smpara["TOTPAG"]= $this->totpag;
							
							# заради новия дизайн 
							$smpara["BASE"]= $prefurl .geturl($baseurl."&".PANONAME."=?");
							# и още - за първата и последната страница 
							$smpara["ONFIRST"]= $prefurl .geturl($baseurl."&".PANONAME."=1");
							$smpara["ONLAST"]=  $prefurl .geturl($baseurl."&".PANONAME."=".$this->totpag);
	
# c10 
# предаваме масива със smarty параметрите като му даваме желаното име 
//$smarty->assign($this->smarname, $smpara);
$smarty->assign(SMARNAME, $smpara);

				#------------- вер.2 ---------------
				# корегиран код 
/*
# връщаме фразата за limit MySQL 
return $limi;
*/
				# връщаме резултата с данните от заявката 
return $rows;
				#-----------------------------------
}

}

?>