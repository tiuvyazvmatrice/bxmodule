<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Application;

/**
 * Класс компонента вывода списка групп пользователей
 * @method
 */
class CompanyUsergroupsComponent extends CBitrixComponent
{
    /**
     * @param $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        return $params;
    }

    function executeComponent(): void
    {
        try {

        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }
}