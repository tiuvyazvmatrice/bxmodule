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

    private function getGroups(): array {
        $groupsList = [];

        $result = \Bitrix\Main\GroupTable::getList(array(

            'filter' => array('ACTIVE'=>'Y', /*'USER_GROUP.USER.ACTIVE' => 'Y'*/),

            'select' => array('NAME','ID','USER_ACTIVE' => 'USER_GROUP.USER.ACTIVE','USER_GROUP.GROUP_ID', 'USER_GROUP.USER_ID', 'countElements'), // выбираем идентификатор группы и символьный код группы

            'runtime' => [
                'USER_GROUP' => [
                    'data_type' =>"\Bitrix\Main\UserGroupTable",
                    'reference' => [
                        '=this.ID' => 'ref.GROUP_ID',
                    ],
                    'join_type' => 'LEFT'
                ],
                'countElements' => [
                    'data_type' => 'integer',
                    'expression' => ['count(%s)', 'USER_GROUP.USER_ID']
                ]
            ],
            'group' => ['USER_GROUP.GROUP_ID']
        ));

        while ($groups = $result->fetch()) {
            $groupsList[] = $groups;
        }

        return $groupsList;
    }

    function executeComponent(): void
    {
        try {
            $this->arResult['GROUP_LIST'] = $this->getGroups();

            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }
}