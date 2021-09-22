<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?php $APPLICATION->IncludeComponent(
    "company:usergroups.list",
    ".default",
    [
        "COMPONENT_TEMPLATE" => ".default",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ],
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
