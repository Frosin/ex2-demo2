<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
            "DEFAULT" => "1",
		),
        "AUTHOR_CODE" => array(
			"NAME" => GetMessage('AUTHOR_CODE'),
			"TYPE" => "STRING",
            "DEFAULT" => "AUTHOR",
		),
         "USER_PROP_CODE" => array(
			"NAME" => GetMessage("USER_PROP_CODE"),
			"TYPE" => "STRING",
            "DEFAULT" => "UF_AUTHOR_TYPE",
		),
 
	),
);