<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!$list) {
    return;
}

?>
<div class="uk-margin-medium-bottom">
    <div class="uk-container">
        <h5 class="uk-text-center uk-text-bold uk-text-secondary font uk-h3 uk-margin-small-bottom"><?php echo $module->title; ?></h5>
        <div class="uk-position-relative uk-background-muted uk-border-rounded uk-padding">
            <div data-uk-slider>
                <div>
                    <div class="uk-slider-container">
                        <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-5@s uk-grid uk-grid-small">
	                        <?php foreach ($list as $item) : ?>
                                <div class="mod-articlesnews__item" itemscope itemtype="https://schema.org/Article">
			                        <?php require ModuleHelper::getLayoutPath('mod_articles_news', '_magitem'); ?>
                                </div>
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