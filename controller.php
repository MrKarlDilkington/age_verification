<?php
namespace Concrete\Package\AgeVerification;

use Package;
use BlockType;

/*
Age Verification by Karl Dilkington (aka MrKDilkington)
This software is licensed under the terms described in the concrete5.org marketplace.
Please find the add-on there for the latest license copy.
*/

class Controller extends Package
{

	protected $pkgHandle = 'age_verification';
	protected $appVersionRequired = '5.7.3.1';
	protected $pkgVersion = '0.9.6';

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
	    $pkg = parent::install();
		$blk = BlockType::getByHandle('age_verification');
		if(!is_object($blk) ) {
			BlockType::installBlockTypeFromPackage('age_verification', $pkg);
		}
    }
}