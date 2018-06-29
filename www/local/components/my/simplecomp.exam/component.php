<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


if (intval($arParams["NEWS_IBLOCK_ID"]) > 0 &&
	$this->StartResultCache())
{
	
	
	$arButtons = CIBlock::GetPanelButtons($arParams["NEWS_IBLOCK_ID"]);
	
	$newsElementsURL = $arButtons['submenu']['element_list']['ACTION_URL'];
	


	$this->AddIncludeAreaIcon(
	 [
		'URL'   => $newsElementsURL,
		'TITLE' => GetMessage("BUTTON_NAME"),
		'IN_PARAMS_MENU' => true,
	 ]
	);

	
	
	
	
	//iblock elements
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
		"PROPERTY_".$arParams["AUTHOR_CODE"],
		"ACTIVE_FROM",
	);
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
		"ACTIVE" => "Y",
		"!PROPERTY_".$arParams["AUTHOR_CODE"] => false,
	);
	$arSortElems = array (
		
	);
	
	$elements = [];
	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElements->GetNext())
	{
		$elements[] = $arElement;
	}
	
	
	
	// Дергаем новости текущего пользователя
	global $USER;
	$curUserNews = [];
	$r = CIBlockElement::GetList(
		[],
		["IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
		 "PROPERTY_".$arParams["AUTHOR_CODE"] => $USER->GetID()
		 ],
		false,
		false,
		['ID','NAME']
	);
	
	while ($res = $r->GetNext())
	{
		$curUserNews[] = $res['ID'];
	}
	// Дергаем группу текущего пользователя
	
	
	
	$rsUsers = CUser::GetList($arOrderUser = [],
							  $sortOrder = [],
							  $arFilterUser = ['ID' => $USER->GetID()],
							  $arUParams = ["SELECT" => [$arParams["USER_PROP_CODE"]] ]);
	
	$curUserGroup = $rsUsers->GetNext()[$arParams["USER_PROP_CODE"]];

	
	// user
	$arOrderUser = array("id");
	$sortOrder = "asc";
	$arFilterUser = array(
		"ACTIVE" => "Y"
	);
	$arUParams = ["SELECT" => [$arParams["USER_PROP_CODE"]]];
	
	$users = [];
	$rsUsers = CUser::GetList($arOrderUser, $sortOrder, $arFilterUser, $arUParams); // выбираем пользователей
	while($arUser = $rsUsers->GetNext())
	{
		if ($arUser['ID'] == $USER->GetID()) continue;
		
		foreach($elements as $item)
		{
			if ($item["PROPERTY_AUTHOR_VALUE"] == $arUser['ID'] &&
				!in_array($item['ID'], $curUserNews))
						$arUser['NEWS'][] = $item;
		}
		if ($arUser[$arParams["USER_PROP_CODE"]] == $curUserGroup) $users[] = $arUser;
		
	}	
	
	// Считаем количество уникальных новостей
	
	$newsIds = [];
	foreach ($users as &$user)
	{
		foreach ($user['NEWS'] as $item)
		{
			$newsIds[] = $item['ID'];
		}
	}
	
	$newsUniqueCount = count(array_unique($newsIds));
	

	if ($USER->IsAuthorized())
	{
		$arResult['ITEMS'] = $users;
		$arResult['NEWS_COUNT'] = $newsUniqueCount;
	}
	
	$this->setResultCacheKeys(['NEWS_COUNT']);
	$this->includeComponentTemplate();	
}

$APPLICATION->SetTitle("Новостей ".$arResult['NEWS_COUNT']);




?>