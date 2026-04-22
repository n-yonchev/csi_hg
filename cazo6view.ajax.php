<?php
# зона-6 : разглеждане съдържанието на съществуващ изходящ документ по делото 
# в шаблона няма форма, няма бутон submit, нито за затваряне 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
#  $view= документа за разглеждане 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];


# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "cazo6view.ajax.tpl";
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

# съдържанието 
$cont= $DB->selectCell("select content from $taname where id=?d" ,$view);
# извеждаме го 
$smarty->assign("CONT", to1251($cont));
print smdisp($tpname,"iconv");


?>
