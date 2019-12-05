<?php
namespace Concrete\Package\AgeVerification;

use BlockType;
use Package;

/*
Age Verification by Karl Dilkington (aka MrKDilkington)
This software is licensed under the terms described in the concrete5.org marketplace.
Please find the add-on there for the latest license copy.
*/

class Controller extends Package
{
    protected $pkgHandle = 'age_verification';
    protected $appVersionRequired = '8.5.2';
    protected $pkgVersion = '0.9.7';

    public function getPackageName()
    {
        return t('Age Verification');
    }

    public function getPackageDescription()
    {
        return t('Add an age verification on your pages.');
    }

    public function install()
    {
        $packageInstall = parent::install();

        $blockType = BlockType::getByHandle('age_verification');
        if (!is_object($blockType)) {
            BlockType::installBlockTypeFromPackage('age_verification', $packageInstall);
        }
    }
}
