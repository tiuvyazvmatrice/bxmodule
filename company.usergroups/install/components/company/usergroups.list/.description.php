<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage("COMPANY_U_DESC_LIST"),
    "DESCRIPTION" => Loc::getMessage("COMPANY_U_DESC_LIST_DESC"),
    "ICON" => "/images/news_list.gif",
    "SORT" => 20,
    "CACHE_PATH" => "Y",
    "PATH" => [
        "ID" => "content",
    ],
];

?>