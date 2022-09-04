<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom' . $module->id;

if ($params->get('backgroundimage')) {
    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
    $wa->addInlineStyle('
#' . $modId . '{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}
', ['name' => $modId]);
}

?>
<section id="<?php echo $modId; ?>" class="uk-text-center mod-custom custom">
    <div class="uk-container uk-container-small">
        <h4 class="uk-text-center uk-text-bold uk-text-secondary font uk-h3 uk-margin-small-bottom"><?php echo $module->title ?></h4>
        <div class="font uk-text-secondary"><?php echo $module->content; ?></div>
        <a href="#" data-uk-toggle="target: #more; animation: uk-animation-fade" target="_self" title="بیشتر" class="uk-button uk-button-plain uk-border-pill uk-margin-bottom font locationButton" aria-expanded="true"><i class="far fa-chevron-circle-down"></i><span>بیشتر</span></a>
        <div class="uk-text-secondary uk-margin-medium-bottom font" id="more" hidden><?php echo $params->get('fulltext'); ?></div>
    </div>
</section>