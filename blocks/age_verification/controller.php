<?php
namespace Concrete\Package\AgeVerification\Block\AgeVerification;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\Asset\AssetList;

class Controller extends BlockController
{

    protected $btInterfaceHeight = 675;
    protected $btInterfaceWidth = 550;
    protected $btCacheBlockOutput = true;
    protected $btExportFileColumns = array('fID');
    protected $btIgnorePageThemeGridFrameworkContainer = true;
    protected $btTable = 'btAgeVerification';

    public function getBlockTypeDescription()
    {
        return t('Add an age verification on your pages.');
    }

    public function getBlockTypeName()
    {
        return t('Age Verification');
    }

    public function edit()
    {
        $this->set('content', LinkAbstractor::translateFrom($this->content));
    }

    public function view()
    {
        $this->set('content', LinkAbstractor::translateFrom($this->content));
    }

    public function registerViewAssets($outputContent = '')
    {
        $al = AssetList::getInstance();
        $al->register(
            'javascript', 'fgcookie', 'blocks/age_verification/files/f.g.cookie.min.js',
            array('version' => '0.1.0', 'minify' => false, 'combine' => true),
            'age_verification'
        );
        $al->register(
            'javascript', 'mask', 'blocks/age_verification/files/jquery.mask.min.js',
            array('version' => '1.11.4', 'minify' => false, 'combine' => true),
            'age_verification'
        );
        $al->registerGroup('age_verification_files', array(
            array('javascript', 'jquery'),
            array('javascript', 'fgcookie'),
            array('javascript', 'mask')
        ));
        $this->requireAsset('age_verification_files');
    }

    public function save($args)
    {
        $args['content'] = LinkAbstractor::translateTo($args['content']);
        parent::save($args);
    }
}