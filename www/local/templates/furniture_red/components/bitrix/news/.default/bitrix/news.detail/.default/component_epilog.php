<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (isset($arResult['CANONICAL']) && strlen($arResult['CANONICAL']) > 0)
   {
      $APPLICATION->SetPageProperty("canonical", $arResult["CANONICAL"]);
   }
?>


