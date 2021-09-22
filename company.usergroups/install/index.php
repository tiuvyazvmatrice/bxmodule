<?php
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class company_usergroups extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'company.usergroups';
        $this->MODULE_NAME = Loc::getMessage('COMPANY_USERGROUPS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('COMPANY_USERGROUPS_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('COMPANY_USERGROUPS_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'https://github.com/tiuvyazvmatrice/bxmodule/';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function doUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {

    }

    public function uninstallDB()
    {

    }
}