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

<div class="uk-margin-medium-bottom">
    <div class="uk-container">
        <div class="uk-position-relative uk-background-muted uk-border-rounded uk-padding">
            <div data-uk-slider>
                <div>
                    <div class="uk-slider-container">
                        <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-grid uk-grid-small">
						    <?php foreach ($params->get('boxes') as $item) : ?>
							    <?php if ($item->title != '') { ?>
                                    <div>
                                        <div class="uk-padding-small uk-border-rounded uk-background-<?php echo $item->background; ?>">
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-1-1 uk-width-expand@s uk-flex uk-flex-middle">
                                                    <div class="uk-flex-1 uk-padding-small uk-text-center uk-text-right@s">
                                                        <h5 class="font uk-text-black uk-h2 uk-margin-remove uk-text-center uk-text-right@s uk-text-<?php echo $item->background == 'primary' ? 'white' : 'primary'; ?>"><?php echo $item->title; ?></h5>
                                                        <span class="uk-text-small font uk-text-white"><?php echo $item->subtitle; ?></span>
                                                        <div class="uk-margin-top uk-width-1-1 uk-width-1-2@s">
                                                            <a href="<?php echo JRoute::_("index.php?Itemid={$item->link}"); ?>" class="uk-button uk-button-<?php echo $item->background == 'primary' ? 'default' : 'primary'; ?> uk-border-pill uk-button-small font"><span><?php echo $item->btn_label; ?></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-1 uk-width-1-3@s uk-flex uk-flex-center uk-flex-middle uk-flex-first uk-flex-last@s">
                                                    <div class="uk-padding-small"><img src="<?php echo (HTMLHelper::cleanImageURL($item->image))->url; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
							    <?php } ?>
						    <?php endforeach; ?>
                        </div>
                    </div>
                    <span class="sliderArrow sliderArrowRight uk-position-center-right" href="#" data-uk-slider-item="next"><i class="far fa-chevron-right"></i></span>
                    <span class="sliderArrow sliderArrowLeft uk-position-center-left" href="#" data-uk-slider-item="previous"><i class="far fa-chevron-left"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>