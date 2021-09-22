<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?php $APPLICATION->IncludeComponent(
    "company:usergroups.list",
    "",
    [
    ],
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
