<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

foreach($arResult['ITEMS'] as $key => &$item)
{
   if ($item["PROPERTIES"]['ENG_NAME']['VALUE'] <> "")
   {
        $item['FIELDS']['NAME'] = $item["PROPERTIES"]['ENG_NAME']['VALUE'];
        
   }
        
   if ($item["PROPERTIES"]['ENG_PREVIEW']['VALUE'] <> "")
   {
         $item['FIELDS']['PREVIEW_TEXT'] = $item["PROPERTIES"]['ENG_PREVIEW']['VALUE'];
   }
        
        
   $item["DISPLAY_PROPERTIES"] = [];
}
?>