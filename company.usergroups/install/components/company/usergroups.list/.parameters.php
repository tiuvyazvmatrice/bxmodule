<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arCurrentValues */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!CModule::IncludeModule("iblock")) {
    return;
}


$arComponentParameters = [
    "GROUPS" => [
    ],
    "PARAMETERS" => [
        "CACHE_TIME" => ["DEFAULT" => 36000000],
    ],
];

