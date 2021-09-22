<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;
use \Bitrix\Main\GroupTable;
use \Bitrix\Main\UserGroupTable;

/**
 * Класс компонента вывода списка групп пользователей
 * @method getGroups - основной метод для выборки групп с количеством пользователей
 */
class CompanyUsergroupsComponent extends CBitrixComponent
{
    /**
     * @param $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        if ($params['CACHE_TYPE'] == 'N') {
            $params['CACHE_TIME'] = 0;
        }

        return $params;
    }

    private function getGroups(): array
    {
        $cacheManager = Bitrix\Main\Application::getInstance()->getTaggedCache();
        $cache = Cache::createInstance();

        $cacheDir = '/usergroups/';

        if ($cache->initCache($this->arParams['CACHE_TIME'], 'usergroups', $cacheDir)) {
            $vars = $cache->GetVars();
            $groupData = $vars['arResult'];
        } elseif ($cache->startDataCache()) {
            $groups = GroupTable::getList(array(
                'filter' => ['ACTIVE' => 'Y'],
                'select' => ['NAME', 'ID'],
                'group' => ['ID'],
                'cache' => ['ttl' => $this->arParams['CACHE_TIME']],
            ));

            while ($result = $groups->fetch()) {
                $groupData[$result['ID']] = $result;
                $groupData[$result['ID']]['COUNT'] = 0;
            }

            $userGroup = UserGroupTable::getList(array(
                'filter' => array('GROUP_ID' => array_keys($groupData), 'USER.ACTIVE' => 'Y', 'USER_ID'),
                'select' => array('GROUP_ID', 'countElements'),
                'runtime' => [
                    'countElements' => [
                        'data_type' => 'integer',
                        'expression' => ['count(distinct %s)', 'USER_ID'],
                    ],
                ],
                'cache' => ['ttl' => $this->arParams['CACHE_TIME']],
            ));

            while ($result = $userGroup->fetch()) {
                $groupData[$result['GROUP_ID']]['COUNT'] = intval($result['countElements']);
            }

            $cacheManager->StartTagCache($cacheDir);
            $cacheManager->RegisterTag("USER_CARD");
            $cacheManager->EndTagCache();

            if (empty($groupData))
                $cache->abortDataCache();

            $cache->endDataCache([
                'arResult' => $groupData,
            ]);
        }

        return $groupData;
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