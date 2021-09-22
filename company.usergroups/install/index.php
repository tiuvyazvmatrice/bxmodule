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

    private function makeDir($path)
    {
        return is_dir($path) || mkdir($path);
    }

    public function doInstall()
    {
        $this->installFiles();
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function doUninstall()
    {
        $this->uninstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installFiles() {
        $this->COMPONENT_PATH = $this->makeDir($_SERVER['DOCUMENT_ROOT'].'/local/components') ? $_SERVER['DOCUMENT_ROOT'].'/local/components' : $_SERVER['DOCUMENT_ROOT'].'/bitrix/components';

        CopyDirFiles(__DIR__.'/components/', $this->COMPONENT_PATH, true, true);
    }

    public function uninstallFiles() {
        DeleteDirFilesEx('/local/components/company/');
        DeleteDirFilesEx('/bitrix/components/company/');
    }

    public function installDB()
    {

    }

    public function uninstallDB()
    {

    }
}