<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
   if (($arParams['ID_CANONICAL'] !== "") &&
       (intval($arParams['ID_CANONICAL']) > 0))
   {
    $filter = [
               "IBLOCK_ID" => intval($arParams['ID_CANONICAL']),
               "!PROPERTY_NEWS" => false,
               ];
    $select = ["ID","NAME","PROPERTY_NEWS"];
    $r = CIBlockElement::GetList(
                [],
                $filter,
                false,
                false,
                $select
               );
    $res = $r->GetNext();
    if ($res && ($arResult["ID"] == $res["PROPERTY_NEWS_VALUE"]) )
    {
        $APPLICATION->SetPageProperty("canonical", $res["NAME"]);
    }
   }
?>

