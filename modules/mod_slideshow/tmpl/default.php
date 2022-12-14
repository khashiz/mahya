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

if ($params->get('backgroundimage'))
{
	/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
	$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
	$wa->addInlineStyle('
#' . $modId . '{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}
', ['name' => $modId]);
}
?>
<div>
    <div class="uk-box-shadow-small uk-position-relative uk-visible-toggle" tabindex="-1" data-uk-slideshow="animation: slide; ratio: 3:1; autoplay: true; autoplay-interval: 4000;" id="<?php echo $modId; ?>">
        <ul class="uk-slideshow-items">
            <?php foreach ($params->get('slideshow') as $item) : ?>
                <?php if ($item->background != '') { ?>
                    <li>
                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" class="uk-display-block">
                            <div class="uk-position-cover">
                                <img src="<?php echo (HTMLHelper::cleanImageURL($item->background))->url; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-1">
                            </div>
                            <?php if (!empty($item->title) || !empty($item->subtitle)) { ?>
                                <div class="uk-position-center-right uk-padding">
                                    <?php if (!empty($item->title)) { ?>
                                        <h2 class="uk-margin-remove font f300 uk-text-primary" data-uk-slideshow-parallax="opacity: 0,1,0; x: 100,-100;"><?php echo nl2br($item->title); ?></h2>
                                    <?php } ?>
                                    <?php if (!empty($item->subtitle)) { ?>
                                        <p class="uk-margin-remove-bottom uk-margin-small-top uk-text-dark font f500" data-uk-slideshow-parallax="opacity: 0,1,0; x: 200,-200;"><?php echo nl2br($item->subtitle); ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </a>
                    </li>
                <?php } ?>
            <?php endforeach; ?>
        </ul>
        <div class="uk-position-bottom-center uk-position-small">
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-small-bottom"></ul>
        </div>
    </div>
</div>