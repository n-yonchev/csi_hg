<?php


# масив с префикси - за допълнителни входни полета 
# $smarname е име в Smarty шаблона - трябва да е съгласувано с шаблона 
# $postfiel е име на входно поле - трябва да е съгласувано с шаблона 
$arex= array(
	"VZISKATEL" => array("table"=>"claimer", "postfiel"=>"idclaimer", "roname"=>"roclai", "smarname"=>"CLAI")
	,"DLUJNIK" =>  array("table"=>"debtor",  "postfiel"=>"iddebtor",  "roname"=>"rodebt", "smarname"=>"DEBT")
//	,"PREDOLIH" => array("table"=>"subject", "postfiel"=>"idpredolih","roname"=>"roolih", "smarname"=>"OLIH"  ,"getselfunc"=>"subj_getsel")
//	,"PREDNEOLIH" => array("table"=>"subject", "postfiel"=>"idpredneolih","roname"=>"roneolih", "smarname"=>"NEOLIH"  ,"getselfunc"=>"subj_getsel")
	,"PREDOLIH" =>   array("table"=>"subject", "postfiel"=>"idpredolih",  "roname"=>"roolih",   "smarname"=>"OLIH"   
					,"getselfunc"=>"subj_getsel", "fupa"=>"idtype in(1,3)")
	,"PREDNEOLIH" => array("table"=>"subject", "postfiel"=>"idpredneolih","roname"=>"roneolih", "smarname"=>"NEOLIH" 
//					,"getselfunc"=>"subj_getsel", "fupa"=>"idtype=2")
# 13.01.2011 месечна неолихв.сума =5 
					,"getselfunc"=>"subj_getsel", "fupa"=>"idtype in (2,5)")
	,"CSI_SMETKA" => array("table"=>"", "postfiel"=>"idsmetka","roname"=>"robankacco", "smarname"=>"SMETKA" 
					,"getselfunc"=>"smetka_getsel", "fupa"=>"1"
					,"getdatfunc"=>"smetka_getdat")
# 05.08.2009 - Бъзински - поделение на АДВ и др. - избор чрез select/option 
//,"DB_regionadv_1" => array("type"=>"form"  ,"text"=>"клон на АДВ"   ,"fieltype"=>"text"  ,"fielname"=>"adv_branch")
	,"ADV" =>  array("table"=>"regionadv",  "postfiel"=>"idregionadv",  "roname"=>"roadvr", "smarname"=>"ADVR"
					,"getselfunc"=>"adv_getsel")
	,"NAP" =>  array("table"=>"regionnap",  "postfiel"=>"idregionnap",  "roname"=>"ronapr", "smarname"=>"NAPR"
					,"getselfunc"=>"nap_getsel")
	);

# масив за заместване - маркери 
$arsource= array(
	"xyz"=> ""

//	,"CSI_NUMBER" =>            array("type"=>"dire"  ,"from"=>"rooffi",  "name"=>"serial"     ,"text"=>"ЧСИ номер" )
//	,"CSI_NUMBER" =>            array("type"=>"dire2"  ,"from"=>"rooffi^serial"     ,"text"=>"ЧСИ номер" )
	,"CSI_NUMBER" =>            array("type"=>"dire3"  ,"from"=>"rooffi['serial']"     ,"text"=>"ЧСИ номер" )
	,"CSI_RAION_NA_DEISTVIE" => array("type"=>"dire3"  ,"from"=>"rooffi['region']"     ,"text"=>"ЧСИ район")
	,"CSI_NAME" =>              array("type"=>"dire3"  ,"from"=>"rooffi['fullname']"   ,"text"=>"ЧСИ пълно име")
	,"CSI_SHORT_NAME" =>        array("type"=>"dire3"  ,"from"=>"rooffi['shortname']"  ,"text"=>"ЧСИ кратко име")
	,"CSI_KANTORA_ADDRESS" =>   array("type"=>"dire3"  ,"from"=>"rooffi['address']"    ,"text"=>"ЧСИ адрес")
//	,"CSI_SMETKA_IBAN" =>    array("type"=>"dire3"  ,"from"=>"rooffi['iban']"   ,"text"=>"ЧСИ сметка IBAN" )
//	,"CSI_SMETKA_BIC" =>     array("type"=>"dire3"  ,"from"=>"rooffi['bic']"    ,"text"=>"ЧСИ сметка BIC" )
//	,"CSI_SMETKA_BANKA" =>   array("type"=>"dire3"  ,"from"=>"rooffi['bank']"   ,"text"=>"ЧСИ сметка банка" )
	,"CSI_SMETKA_IBAN" =>    array("type"=>"dire3"  ,"from"=>"robankacco['iban']"   ,"text"=>"ЧСИ сметка IBAN" )
	,"CSI_SMETKA_BIC" =>     array("type"=>"dire3"  ,"from"=>"robankacco['bic']"    ,"text"=>"ЧСИ сметка BIC" )
	,"CSI_SMETKA_BANKA" =>   array("type"=>"dire3"  ,"from"=>"robankacco['bank']"   ,"text"=>"ЧСИ сметка банка" )

//	,"DELO_NUMBER" =>           array("type"=>"dire3"  ,"from"=>"rocase['serial']"     ,"text"=>"изп.дело номер" )
	,"DELO_NUMBER" =>           array("type"=>"func"  ,"from"=>"exnu"     ,"text"=>"изп.дело номер" )
	,"DELO_YEAR" =>             array("type"=>"dire3"  ,"from"=>"rocase['year']"       ,"text"=>"изп.дело година" )
	,"DELO_FROM_NUMBER" =>   array("type"=>"dire3"  ,"from"=>"rocase['conome']"     ,"text"=>"идващо дело номер" )
	,"DELO_FROM_YEAR" =>     array("type"=>"dire3"  ,"from"=>"rocase['coyear']"     ,"text"=>"идващо дело година" )
	,"DELO_FROM_SYD" =>      array("type"=>"dire3"  ,"from"=>"rofrom['name']"       ,"text"=>"идващо дело съд" )
# 13.03.2009 ПЕТЪК - ако няма състав на съда 
//	,"DELO_FROM_SASTAV" =>   array("type"=>"dire3"  ,"from"=>"rocase['cogrou']"     ,"text"=>"идващо дело състав" )
,"DELO_FROM_SASTAV" =>     array("type"=>"func"   ,"from"=>"delo4"    ,"text"=>"идващо дело състав" )
# 01.06.2010 
,"DELO_FROM_VID" =>     array("type"=>"func"   ,"from"=>"delo5"    ,"text"=>"идващо дело вид" )
,"DELO_ZAPOVED_NUMBER" =>     array("type"=>"dire3"  ,"from"=>"rocase['nomecomm']"   ,"text"=>"заповед изпълн.номер" )
,"OBEZ_ZAPOVED_NUMBER" => array("type"=>"func"   ,"from"=>"delo6"    ,"text"=>"обезп.заповед номер" )
,"OBEZ_ZAPOVED_DATE" =>   array("type"=>"func"   ,"from"=>"delo7"    ,"text"=>"обезп.заповед дата" )
	,"DELO_IZP_LIST_DATE" =>    array("type"=>"dire3"  ,"from"=>"rocase['dateexec']"   ,"text"=>"изпълнит.лист дата" )
	,"DELO_ZAPOVED_DATE" =>     array("type"=>"dire3"  ,"from"=>"rocase['datecomm']"   ,"text"=>"заповед изпълн.дата" )
	,"DELO_TITUL" =>     array("type"=>"func"   ,"from"=>"delo1"    ,"text"=>"изпълнителен титул" )
	,"DELO_PODTITUL" =>  array("type"=>"func"   ,"from"=>"delo2"    ,"text"=>"подтитул" )
	,"DELO_DLUJNIK_SPISAK" =>        array("type"=>"func"   ,"from"=>"delo3"    ,"text"=>"длъжници списък " )
# 07.09.2009 - Софрониев - общо всички неолихвяеми суми по делото 
# - независимо от взискателя и длъжниците 
	,"DELO_NEOLIH_TOTAL" => array("type"=>"func" ,"from"=>"neolih_total" ,"text"=>"общо неолихв.сума" )

	,"VZISKATEL_NAME" =>        array("type"=>"dire3"  ,"from"=>"roclai['name']"       ,"text"=>"взискател име" )
	,"VZISKATEL_ADVOKAT" =>     array("type"=>"dire3"  ,"from"=>"roclai['agent']"      ,"text"=>"взискател адвокат" )
	,"VZISKATEL_EGN_BULSTAT" => array("type"=>"func"   ,"from"=>"clai1"    ,"text"=>"взискател егн ЕИК" )
	,"VZISKATEL_IDENT_TYPE" =>  array("type"=>"func"   ,"from"=>"clai2"    ,"text"=>"взискател идент.тип" )
//	,"VZISKATEL_ADDRESS" =>     array("type"=>"form"   ,"from"=>"roclai['address']"    ,"text"=>"взискател адрес"       
//					,"fieltype"=>"tear" ,"fielname"=>"claiaddr")
	,"VZISKATEL_ADDRESS" =>     array(
					"type"=>"formdata" ,"name"=>"roclai","indx"=>"address"
					,"text"=>"взискател адрес"       
					,"fieltype"=>"tear" ,"fielname"=>"claiaddr"
					)
	,"VZISKATEL_SADEBEN_ADDRESS" =>  array(
					"type"=>"formdata"  ,"name"=>"roclai","indx"=>"address"  
					,"text"=>"взискател съд.адрес"  
					,"fieltype"=>"tear"  ,"fielname"=>"vzisk_sadeben_addr"
					)
	,"VZISKATEL_FD_NUMBER" => array("type"=>"dire3"   ,"from"=>"roclai['regidocu']"  ,"text"=>"взискател фирм.дело №" )
	,"VZISKATEL_FD_DATE" =>   array("type"=>"dire3"   ,"from"=>"roclai['regidate']"  ,"text"=>"взискател фирм.дело дата" )
	,"VZISKATEL_FD_SYD" =>    array("type"=>"dire3"   ,"from"=>"roclai['regicase']"  ,"text"=>"взискател фирм.дело съд" )

	,"DLUJNIK_NAME" =>          array("type"=>"dire3"   ,"from"=>"rodebt['name']"    ,"text"=>"длъжник име" )
	,"DLUJNIK_FIRMA_NAME" =>    array("type"=>"dire3"   ,"from"=>"rodebt['name']"    ,"text"=>"длъжник фирм.име" )
	,"DLUJNIK_NAME_EGN" =>      array("type"=>"func"   ,"from"=>"debt1"    ,"text"=>"длъжник име егн" )
	,"DLUJNIK_EGN_BULSTAT" =>   array("type"=>"func"   ,"from"=>"debt3"    ,"text"=>"длъжник ЕГН ЕИК" )
	,"DLUJNIK_FD_NUMBER" =>   array("type"=>"dire3"   ,"from"=>"rodebt['regidocu']"    ,"text"=>"длъжник фирм.дело" )
	,"DLUJNIK_FD_GODINA" =>   array("type"=>"dire3"   ,"from"=>"rodebt['regidate']"    ,"text"=>"длъжник фирм.дело година" )
	,"DLUJNIK_FD_SYD" =>      array("type"=>"dire3"   ,"from"=>"rodebt['regicase']"    ,"text"=>"длъжник фирм.дело съд" )
//	,"DLUJNIK_ADDRESS" =>          array("type"=>"form"   ,"from"=>"rodebt['address']"    ,"text"=>"длъжник адрес"       
//					,"fieltype"=>"tear" ,"fielname"=>"debtaddr")
	,"DLUJNIK_ADDRESS" =>      array(
					"type"=>"formdata" ,"name"=>"rodebt","indx"=>"address"
					,"text"=>"длъжник адрес"       
					,"fieltype"=>"tear" ,"fielname"=>"debtaddr"
					)
	,"DLUJNIK_PREDSTA_NAME_EGN" => array("type"=>"func"   ,"from"=>"debt2"    ,"text"=>"длъжник представ. име егн" )
# 28.07.2010 - Дичев, Пламен 
	,"DLUJNIK_PREDSTA_NAME" => array("type"=>"dire3"   ,"from"=>"rodebt['regipers']"    ,"text"=>"длъжник представ.име " )
//	,"DLUJNIK_SPISAK" =>        array("type"=>"func"   ,"from"=>"debt3"    ,"text"=>"длъжници списък " )
# 27.05.2009 - Бургас - всичко за длъжника според типа юр/физ лице 
	,"DLUJNIK_INFO"   => array("type"=>"func"   ,"from"=>"debt99"    ,"text"=>"информация за длъжника" )
	,"VZISKATEL_INFO" => array("type"=>"func"   ,"from"=>"clai99"    ,"text"=>"информация за взискателя" )
# 14.09.2009 - Бургас - всичко за длъжника според типа юр/физ лице 
# но с шаблоните за един ред 
	,"DLUJNIK_INFO_ONELINE"   => array("type"=>"func"   ,"from"=>"debt99one"    ,"text"=>"инфо 1ред за длъжника" )
	,"VZISKATEL_INFO_ONELINE" => array("type"=>"func"   ,"from"=>"clai99one"    ,"text"=>"инфо 1ред за взискателя" )
# 04.06.2009 - данни за съпруга, ако длъжника е физич.лице 
	,"DLUJNIK_SAPRUG_NAME_EGN"   => array("type"=>"func"   ,"from"=>"debtsa"    ,"text"=>"съпруг на длъжника име ЕГН" )
	,"DLUJNIK_SAPRUG_ADDRESS"    => array("type"=>"dire3"  ,"from"=>"rodebt['address2']"    ,"text"=>"съпруг на длъжника адрес" )
# само заради проверката с {empty}{/empty} 
	,"DLUJNIK_SAPRUG_NAME"   => array("type"=>"dire3"   ,"from"=>"rodebt['name2']"    ,"text"=>"съпруг на длъжника име" )
	,"DLUJNIK_SAPRUG_EGN"    => array("type"=>"dire3"   ,"from"=>"rodebt['egn2']"     ,"text"=>"съпруг на длъжника ЕГН" )

	,"PREDOLIH_OLIHVQEMA_SUMA" =>  array("type"=>"dire3"  ,"from"=>"roolih['amount']"   , "tran"=>"tranamou" ,"text"=>"олихвяема сума" )
	,"PREDOLIH_LIHVA_DATE" =>      array("type"=>"dire3"  ,"from"=>"roolih['fromdate']" , "tran"=>"trandate" ,"text"=>"олихв.от дата" )
//	,"PREDOLIH_OLIHVQEMA_SUMA" =>  array("type"=>"func"   ,"from"=>"amou1"     ,"text"=>"олихвяема сума" )
//	,"PREDOLIH_LIHVA_DATE" =>      array("type"=>"dire3"   ,"from"=>"roolih['fromdate']"  ,"text"=>"олихв.от дата" )

	,"PREDNEOLIH_SUMA" =>  array("type"=>"dire3"  ,"from"=>"roneolih['amount']"   , "tran"=>"tranamou" ,"text"=>"неолихвяема сума" )

# 11.11.2009 - изброяване на всички суми за длъжника заедно с текстовете 
//	,"DLUJNIK_SUMI"   => array("type"=>"func"   ,"from"=>"debtsumi"    ,"text"=>"сумите за длъжника" )
	,"DLUJNIK_SUMI" =>  array(
			"type"=>"formdata" ,"name"=>"debtsumi","indx"=>"text"
			,"text"=>"длъжник дълг"
			,"fieltype"=>"tear" ,"fielname"=>"dlujnik_sumi"
			)

# без префикси 
	,"FIRMA_NAME" =>     array("type"=>"form"  ,"text"=>"месторабота име"  ,"fieltype"=>"text"  ,"fielname"=>"firma_name")
	,"FIRMA_ADDRESS" =>  array("type"=>"form"  ,"text"=>"месторабота адрес"  ,"fieltype"=>"tear"  ,"fielname"=>"firma_address")
	,"OPIS_ADDRESS" =>   array("type"=>"form"  ,"text"=>"адрес на описа"   ,"fieltype"=>"text"  ,"fielname"=>"opis_address")
	,"OPIS_DATE" =>      array("type"=>"form"  ,"text"=>"дата на описа"    ,"fieltype"=>"text"  ,"fielname"=>"opis_date")
	,"PRIEMNO_VREME_OT" =>  array("type"=>"form"  ,"text"=>"приемно време от"  ,"fieltype"=>"text"  ,"fielname"=>"vreme_ot")
	,"PRIEMNO_VREME_DO" =>  array("type"=>"form"  ,"text"=>"приемно време до"  ,"fieltype"=>"text"  ,"fielname"=>"vreme_do")
	,"SADEJ_DATE_CHAS" =>   array("type"=>"form"  ,"text"=>"съдействие за дата час"  ,"fieltype"=>"text"  ,"fielname"=>"sadej_date_chas")
	,"SADEJ_TEXT" =>        array("type"=>"form"  ,"text"=>"съдействие текст"  ,"fieltype"=>"tear"  ,"fielname"=>"sadej_text")
	,"SADEJ_OPIS_NA" =>     array("type"=>"form"  ,"text"=>"за извършване опис на"  ,"fieltype"=>"tear"  ,"fielname"=>"sadej_opis_na")
	,"ADDRESS_CITY" =>   array("type"=>"form"  ,"text"=>"град"  ,"fieltype"=>"text"  ,"fielname"=>"address_city")
	,"POKOEN_NAME_EGN_DATE_ADDRESS" =>  array("type"=>"form"  
	                     ,"text"=>"покойник име ЕГН дата адрес"  ,"fieltype"=>"tear"  ,"fielname"=>"pokoen_name_egn_date_address")

	,"VAZBR_NAME_EGN" => array("type"=>"form"  ,"text"=>"собственик на имота" ,"fieltype"=>"text"  ,"fielname"=>"vazbr_address")
	,"VAZBR_ADDRESS" =>  array("type"=>"form"  ,"text"=>"адрес на имота"     ,"fieltype"=>"text"  ,"fielname"=>"vazbr_address")
	,"VAZBR_CITY" =>     array("type"=>"form"  ,"text"=>"град на имота"      ,"fieltype"=>"text"  ,"fielname"=>"vazbr_city")
	,"VAZBR_TEXT" =>     array("type"=>"form"  ,"text"=>"описание на имота"  ,"fieltype"=>"tear"  ,"fielname"=>"vazbr_text")
	,"VAZBR_POST_NO" =>    array("type"=>"form"  ,"text"=>"постановление №"     ,"fieltype"=>"text"  ,"fielname"=>"vazbr_post_no")
	,"VAZBR_POST_DATE" =>  array("type"=>"form"  ,"text"=>"постановление дата"  ,"fieltype"=>"text"  ,"fielname"=>"vazbr_post_date")
	,"VAZBR_AGEN_CITY" =>  array("type"=>"form"  ,"text"=>"агенция град"      ,"fieltype"=>"text"  ,"fielname"=>"vazbr_agen_city")

	,"VDIGVAZBR_TEXT" =>       array("type"=>"form"  ,"text"=>"описание на имота"  ,"fieltype"=>"tear"  ,"fielname"=>"vdigvazbr_text")
	,"VDIGVAZBR_AKT_VHNUM" =>  array("type"=>"form"  ,"text"=>"акт вход.№","fieltype"=>"text"  ,"fielname"=>"vdigvazbr_vhnum")
	,"VDIGVAZBR_AKT_TOM" =>    array("type"=>"form"  ,"text"=>"акт том"   ,"fieltype"=>"text"  ,"fielname"=>"vdigvazbr_tom")
	,"VDIGVAZBR_AKT_NUMBER" => array("type"=>"form"  ,"text"=>"акт №"     ,"fieltype"=>"text"  ,"fielname"=>"vdigvazbr_number")
	,"VDIGVAZBR_AKT_DATE" =>   array("type"=>"form"  ,"text"=>"акт дата"  ,"fieltype"=>"text"  ,"fielname"=>"vdigvazbr_date")

	,"VDIGZAB_TEXT" =>     array("type"=>"form"  ,"text"=>"описание на имота"  ,"fieltype"=>"tear"  ,"fielname"=>"vdigzab_text")
	,"VDIGZAB_CITY" =>     array("type"=>"form"  ,"text"=>"място на имота"  ,"fieltype"=>"text"  ,"fielname"=>"vdigzab_city")
	,"VDIGZAB_POST_IZHNUM" => array("type"=>"form"  ,"text"=>"постановление изх.№" ,"fieltype"=>"text"  ,"fielname"=>"vdigzab_post_izhnum")
	,"VDIGZAB_POST_DATE" =>   array("type"=>"form"  ,"text"=>"постановление дата"  ,"fieltype"=>"text"  ,"fielname"=>"vdigzab_post_date")

	,"POEMA_NAME" =>  array("type"=>"form"  ,"text"=>"име в обръщението"  ,"fieltype"=>"text"  ,"fielname"=>"vazbr_post_date")

	,"UVED_POLUCH_NAME" =>    array("type"=>"form"  ,"text"=>"получател име"    ,"fieltype"=>"text"  ,"fielname"=>"uved_poluch_name")
	,"UVED_POLUCH_ADDRESS" => array("type"=>"form"  ,"text"=>"получател адрес"  ,"fieltype"=>"text"  ,"fielname"=>"uved_poluch_address")

	,"PRED_POLUCH_NAME" =>    array("type"=>"form"  ,"text"=>"получател име"    ,"fieltype"=>"text"  ,"fielname"=>"pred_poluch_name")
	,"PRED_POLUCH_ADDRESS" => array("type"=>"form"  ,"text"=>"получател адрес"  ,"fieltype"=>"text"  ,"fielname"=>"pred_poluch_address")

//	,"VZISKATEL_SADEBEN_ADDRESS" =>  array("type"=>"form"  ,"from"=>"roclai['address']"  
//	                     ,"text"=>"взискател съд.адрес"  ,"fieltype"=>"tear"  ,"fielname"=>"vzisk_sadeben_addr")
	,"KARTA_OBRAZEC" =>  array("type"=>"form"  ,"text"=>"карта образец"  ,"fieltype"=>"text"  ,"fielname"=>"karta_obrazec")
	,"ISKANE_IZH_NUMBER" => array("type"=>"form"  ,"text"=>"наше искане изх.№" ,"fieltype"=>"text"  ,"fielname"=>"iskane_izhnum")
	,"ISKANE_DATE" =>       array("type"=>"form"  ,"text"=>"наше искане дата"  ,"fieltype"=>"text"  ,"fielname"=>"iskane_date")
	,"VASH_VHNUM" =>        array("type"=>"form"  ,"text"=>"ваш входящ №"    ,"fieltype"=>"text"  ,"fielname"=>"vash_vhnum")
	,"VASH_VHNUM_DATE" =>   array("type"=>"form"  ,"text"=>"ваш входящ дата" ,"fieltype"=>"text"  ,"fielname"=>"vash_vhnum_date")
	,"DIREKCIQ_NAME" =>     array("type"=>"form"  ,"text"=>"до дирекция"     ,"fieltype"=>"text"  ,"fielname"=>"direkciq_name")
//	,"CURRENT_DATE" =>   array("type"=>"form"  ,"tran"=>"getdat" ,"text"=>"днешна дата"  ,"fieltype"=>"text"  ,"fielname"=>"current_date")
	,"CURRENT_DATE" =>   array(
					"type"=>"formdata" ,"name"=>"rocurrdate","indx"=>"currdate"
					,"text"=>"днешна дата"       
					,"fieltype"=>"text" ,"fielname"=>"current_date"
					)
	,"PREKR_DATE" =>        array("type"=>"form"  ,"text"=>"дата на постановлението"  ,"fieltype"=>"text"  ,"fielname"=>"prekr_date")

	,"SOBS_NAME_EGN" =>     array("type"=>"form"  ,"text"=>"собственик име ЕГН" ,"fieltype"=>"text"  ,"fielname"=>"sobs_name_egn")
	,"SOBS_IMOT_ADDRESS" => array("type"=>"form"  ,"text"=>"адрес на имота"     ,"fieltype"=>"text"  ,"fielname"=>"sobs_imot_address")
	,"SOBS_IMOT_OPIS" =>    array("type"=>"form"  ,"text"=>"описание на имота"  ,"fieltype"=>"tear"  ,"fielname"=>"sobs_imot_opis")
	
	,"ZAPOR_TEXT" => array("type"=>"form"  ,"text"=>"запор на"     ,"fieltype"=>"text"  ,"fielname"=>"zapor_text")
//	,"ZAPOR_TEXT_DJAL" => array("type"=>"form"  ,"text"=>"запор на дялове в"     ,"fieltype"=>"text"  ,"fielname"=>"zapor_text_djal")
	,"ZAPOR_BANK_TEXT" => array("type"=>"form"  ,"text"=>"своб.текст"     ,"fieltype"=>"text"  ,"fielname"=>"zapor_bank_text")
	,"ZAPOR_DATE" =>    array("type"=>"form"  ,"text"=>"дата на запорите"     ,"fieltype"=>"text"  ,"fielname"=>"zapor_date")
	,"ZAPOR_PREDMET" => array("type"=>"form"  ,"text"=>"предмет на запорите"  ,"fieltype"=>"text"  ,"fielname"=>"zapor_predmet")

	# 10.02.2009 - виж cazo2.php 
	# временно решение - лихви и такса за ЧСИ 
	,"LIHVA_SUMA" =>  array("type"=>"dire3"  ,"from"=>"_SESSION['intereca']"  , "tran"=>"tranamou" ,"text"=>"лихва обща сума" )
	,"TAKSA_SUMA" =>  array("type"=>"dire3"  ,"from"=>"_SESSION['calctax']"   , "tran"=>"tranamou" ,"text"=>"такса т.26" )

	# 13.03.2009 ПЕТЪК - допълнителни корекции - първи пас 
	,"OPISANIE_PPS" =>    array("type"=>"form"  ,"text"=>"описание на ППС"    ,"fieltype"=>"text"  ,"fielname"=>"opisanie_pps")
# 13.03.2009 ПЕТЪК - 
# нова разновидност - попълване чрез въвеждане във форма, но с предварително съдържание 
,"MESTOIM_PALNO" =>   array("type"=>"form"  ,"text"=>"местоимение пълно"  ,"fieltype"=>"text"  ,"fielname"=>"mestoim_palno"  ,"fielvalue"=>"него нея")
,"MESTOIM_KRATKO" =>  array("type"=>"form"  ,"text"=>"местоимение кратко" ,"fieltype"=>"text"  ,"fielname"=>"mestoim_kratko" ,"fielvalue"=>"му й")
,"STATUS_DELO" =>     array("type"=>"form"  ,"text"=>"какво е делото"     ,"fieltype"=>"text"  ,"fielname"=>"status_delo"    ,"fielvalue"=>"ПРЕКРАТЕНО СВЪРШЕНО")
	,"DO_RED1" =>   array("type"=>"form"  ,"text"=>"до кого ред 1"  ,"fieltype"=>"text"  ,"fielname"=>"do_red1")
	,"DO_RED2" =>   array("type"=>"form"  ,"text"=>"до кого ред 2"  ,"fieltype"=>"text"  ,"fielname"=>"do_red2")
	,"DJAL_KADE" => array("type"=>"form"  ,"text"=>"запор на дялове в"  ,"fieltype"=>"text"  ,"fielname"=>"djal_kade")
	,"DJAL_OPIS" => array("type"=>"form"  ,"text"=>"опис на дяловете"   ,"fieltype"=>"tear"  ,"fielname"=>"djal_opis")
	,"SLUJBA_NAME" =>    array("type"=>"form"  ,"text"=>"общинска служба"   ,"fieltype"=>"text"  ,"fielname"=>"slujba_name")
	,"OBSHTINA_NAME" =>  array("type"=>"form"  ,"text"=>"община"   ,"fieltype"=>"text"  ,"fielname"=>"obshtina_name")
	,"TD_NAP_ADDRESS" => array("type"=>"form"  ,"text"=>"адрес на ТД НАП"   ,"fieltype"=>"text"  ,"fielname"=>"td_nap_address")
	,"AKTUALNO_DO" => array("type"=>"form"  ,"text"=>"до къде"   
			,"fieltype"=>"select"  ,"arname"=>"araktual_utf8"    ,"arnameout"=>"araktuout_utf8"  
			,"fielname"=>"aktualno_do")
	,"DO_OBSHTINA" => array("type"=>"form"  ,"text"=>"до община"   ,"fieltype"=>"text"  ,"fielname"=>"do_obshtina")
	,"DO_RAION" => array("type"=>"form"  ,"text"=>"до район"   ,"fieltype"=>"text"  ,"fielname"=>"do_raion")
	,"POCHINAL_NA" => array("type"=>"form"  ,"text"=>"починал на"   ,"fieltype"=>"text"  ,"fielname"=>"pochinal_na")

# 08.05.2009 - адресат за всички документи. 
# ВНИМАНИЕ - специфичен режим 
# - началното съдържание се взема от табл.docuout 
# - след формиране на документа съдържанието се копира в табл.docuout - заради изходящия регистър 
//,"ADRESAT" => array("type"=>"form"  ,"text"=>"адресат"   ,"fieltype"=>"text"  ,"fielname"=>"adresat")
,"ADRESAT" => array(
		"type"=>"formdata" ,"name"=>"rodoty","indx"=>"adresat"
		,"text"=>"адресат"       
		,"fieltype"=>"tear" ,"fielname"=>"adresat"
# специф.поле - проверява се по-нагоре в caso6crea.ajax.php 
,"todata"=>true
		)
# 22.05.2009 - Бъзински - за предишното дело - Уведомление за предадено дело 
,"PRED_DELO" => array("type"=>"form"  ,"text"=>"стар номер/година"   ,"fieltype"=>"text"  ,"fielname"=>"pred_delo")
,"PRED_SI_NAME" => array("type"=>"form"  ,"text"=>"име предишен СИ"   ,"fieltype"=>"text"  ,"fielname"=>"pred_si_name")
,"PRED_SI_REG" => array("type"=>"form"  ,"text"=>"рег.№ предишен СИ"   ,"fieltype"=>"text"  ,"fielname"=>"pred_si_reg")

# 05.08.2009 - Бъзински - клон на АДВ и др. - избор чрез select/option 
,"ADV_NAME" => array("type"=>"dire3"   ,"from"=>"roadvr['name']"  ,"text"=>"клон на АДВ" )
,"NAP_NAME" => array("type"=>"dire3"   ,"from"=>"ronapr['name']"  ,"text"=>"клон на НАП" )

# 17.08.2009 - избор на длъжници и съпрузите им с чекбоксове 
,"DLAJNICI_SAPRUZI" => array("type"=>"form" ,"text"=>"длъжници и съпрузи" ,"fieltype"=>"tear"  ,"fielname"=>"dlajnici_sapruzi"
					,"ajax"=>"c6spouse.ajax.php")
,"DLAJNICI" => array("type"=>"form" ,"text"=>"длъжници" ,"fieltype"=>"tear"  ,"fielname"=>"dlajnici"
					,"ajax"=>"c6spouse.ajax.php")
//					,"ajax"=>"c6spa.ajax.php")
,"SAPRUZI" => array("type"=>"form" ,"text"=>"съпрузи" ,"fieltype"=>"tear"  ,"fielname"=>"sapruzi"
					,"ajax"=>"c6spouse.ajax.php")
//					,"ajax"=>"c6spb.ajax.php")

# 08.01.2010 - за Шукри Дервиш Благоевград 
,"DIREKTOR_RDVR" => array("type"=>"form"  ,"text"=>"до Директора на РДВР"   ,"fieltype"=>"text"  ,"fielname"=>"direktor_rdvr")
,"SPIS_SUMI" => array(
		"type"=>"formdata" ,"name"=>"listsubj","indx"=>"suit" 
		,"text"=>"списък дължими суми"
		,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi")
,"SPIS_BANKI" => array("type"=>"form" ,"text"=>"банки" ,"fieltype"=>"tear"  ,"fielname"=>"EXTRA_spis_banki"
					,"ajax"=>"c6bank.ajax.php")
,"DELO_MOLBA_OBRAZUV" => 	array("type"=>"func"  ,"from"=>"molbaob"     ,"text"=>"молба образуване" )
,"DELO_OBSHTO_DYLG" => 		array("type"=>"func"  ,"from"=>"obshto_dylg"    ,"text"=>"общо дълг по делото" )
,"DELO_OBSHTO_RAZNOS" => 	array("type"=>"func"  ,"from"=>"obshto_raznos"  ,"text"=>"общо разноски по делото" )
,"SUMA_DESCRIP" => array("type"=>"form"  ,"text"=>"запорир.сума представлява"   ,"fieltype"=>"tear"  ,"fielname"=>"suma_descrip")
//,"DIREKTOR_RDVR" => array("type"=>"form"  ,"text"=>"до Директора на РДВР"   ,"fieltype"=>"text"  ,"fielname"=>"direktor_rdvr")
/*
# списък суми "да заплати" - подобно на SPIS_SUMI 
,"SPIS_SUMI_ZAPL" => array(
		"type"=>"formdata" ,"name"=>"listsubj","indx"=>"suit" 
		,"text"=>"да заплати сумите"
		,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi")
# списък суми по изп.лист - подобно на SPIS_SUMI 
,"SPIS_SUMI_LIST" => array(
		"type"=>"formdata" ,"name"=>"listsubj","indx"=>"suit" 
		,"text"=>"суми по изп.лист"
		,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi")
# списък суми по изп.дело - подобно на SPIS_SUMI 
,"SPIS_SUMI_DELO" => array(
		"type"=>"formdata" ,"name"=>"listsubj","indx"=>"suit" 
		,"text"=>"суми по изп.дело"
		,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi")
*/
# Шукри Дервиш - Протокол за дължими суми - много зависими суми с ajax 
,"SPIS_SUMI_ZAPL" => array("type"=>"form" ,"text"=>"да заплати сумите" ,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi_zapl"
					,"ajax"=>"c6sumi.ajax.php")
,"SPIS_SUMI_LIST" => array("type"=>"form" ,"text"=>"суми по изп.лист" ,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi_list"
					,"ajax"=>"c6sumi.ajax.php")
,"SPIS_SUMI_DELO" => array("type"=>"form" ,"text"=>"суми по изп.дело" ,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi_delo"
					,"ajax"=>"c6sumi.ajax.php")
,"TOTAL_SUMI_LIST" => array("type"=>"form" ,"text"=>"общо по изп.лист" ,"fieltype"=>"text"  ,"fielname"=>"total_sumi_list")
,"TOTAL_SUMI_DELO" => array("type"=>"form" ,"text"=>"общо по изп.дело" ,"fieltype"=>"text"  ,"fielname"=>"total_sumi_delo")
,"TOTAL_SUMI" => array("type"=>"form" ,"text"=>"общо дълж.сума" ,"fieltype"=>"text"  ,"fielname"=>"total_sumi")
,"VNES_SUMA" => array("type"=>"form" ,"text"=>"внесена сума" ,"fieltype"=>"text"  ,"fielname"=>"vnes_suma")
,"OSTA_SUMA" => array("type"=>"form" ,"text"=>"оставаща сума" ,"fieltype"=>"text"  ,"fielname"=>"osta_suma")
# служ.бележка - подобно на Протокола 
,"SPIS_SUMI_LIST_2" => array("type"=>"form" ,"text"=>"дължи суми" ,"fieltype"=>"tear"  ,"fielname"=>"spis_sumi_list_2"
					,"ajax"=>"c6sumi2.ajax.php")
,"TOTAL_SUMI_LIST_2" => array("type"=>"form" ,"text"=>"дължи общо" ,"fieltype"=>"text"  ,"fielname"=>"total_sumi_list_2")

# 09.07.2010 - клонинг за Дичев, но само с 1 адрес, а не с 2 
# източник : 
# 14.09.2009 - Бургас - всичко за длъжника според типа юр/физ лице, но с шаблоните за един ред 
,"DLUJNIK_DATA_ONELINE"   => array("type"=>"func"   ,"from"=>"data_debt99one"    ,"text"=>"данни 1ред за длъжника" )
,"VZISKATEL_DATA_ONELINE" => array("type"=>"func"   ,"from"=>"data_clai99one"    ,"text"=>"данни 1ред за взискателя" )
# 09.07.2010 - клонинг за Дичев - списък на взискателите/длъжниците само с 1 адрес 
# аналог : "DELO_DLUJNIK_SPISAK" 
,"SPISAK_DLUJ" =>   array("type"=>"func"   ,"from"=>"delodebtlist"    ,"text"=>"Списък-Длъжници" )
,"SPISAK_VZIS" => array("type"=>"func"   ,"from"=>"deloclailist"    ,"text"=>"Списък-Взискатели" )

# 21.07.2010 - клонинг за Дичев - всички такси без/със т.26 
,"SUMA_TAKSI" =>   array("type"=>"func" ,"from"=>"delosumtax" ,"text"=>"сума такси" )
,"SUMA_TAKSI_T26" =>   array("type"=>"func" ,"from"=>"delosumtax_t26" ,"text"=>"сума такси+т.26" )

/*
# 11.11.2009 - изброяване на всички суми за длъжника заедно с текстовете 
# 29.01.2018 копирано от Бъзински 
	,"DLUJNIK_SUMI" =>  array(
			"type"=>"formdata" ,"name"=>"debtsumi","indx"=>"text"
			,"text"=>"длъжник дълг"
			,"fieltype"=>"tear" ,"fielname"=>"dlujnik_sumi"
			)
*/

# 06.02.2017 актуален дълг 
,"ACDEBT" =>   array(
			"type"=>"formdata" ,"name"=>"roacdebt","indx"=>"ad"
			,"text"=>"актуален дълг"       
			,"fieltype"=>"text" ,"fielname"=>"delo_acdebt"
					)

# 30.01.2018 актуален дълг - списък елементи 
,"ACDEBT_LIST" =>   array(
			"type"=>"formdata" ,"name"=>"roacdebt","indx"=>"li"
			,"text"=>"акт.дълг елементи"       
			,"fieltype"=>"tear" ,"fielname"=>"delo_acdebt_list"
					)
	);

# 06.02.2017 актуален дълг 
$roacdebt["ad"]= "";
$roacdebt["li"]= "";

?>
