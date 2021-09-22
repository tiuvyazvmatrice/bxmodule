<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['GROUP_LIST']) > 0) { ?>
    <table class="">
        <thead>
        <tr>
            <td><?php echo Loc::getMessage("COMPANY_U_GROUP_ID");?></td>
            <td><?php echo Loc::getMessage("COMPANY_U_GROUP_NAME");?></td>
            <td><?php echo Loc::getMessage("COMPANY_U_COUNT");?></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arResult['GROUP_LIST'] as $groupItem) { ?>
            <tr>
                <td><?php echo $groupItem['ID']; ?></td>
                <td><?php echo $groupItem['NAME']; ?></td>
                <td><?php echo $groupItem['COUNT']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
