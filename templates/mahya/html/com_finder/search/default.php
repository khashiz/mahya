<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$this->document->getWebAssetManager()
    ->useStyle('com_finder.finder')
    ->useScript('com_finder.finder');

?>
<div class="com-finder finder">
    <?php if ($this->params->get('show_page_heading')) : ?>
        <div class="page-header uk-overflow-hidden">
            <h1 class="font uk-text-secondary uk-h2 uk-text-bold uk-animation-slide-left-medium uk-text-center uk-margin-bottom uk-text-right@s">
		        <?php if ($this->escape($this->params->get('page_heading'))) : ?>
			        <?php echo $this->escape($this->params->get('page_heading')); ?>
		        <?php else : ?>
			        <?php echo $this->escape($this->params->get('page_title')); ?>
		        <?php endif; ?>
            </h1>
            <hr class="uk-margin-remove-top uk-margin-medium-bottom uk-visible@s">
        </div>
    <?php endif; ?>
    <div class="uk-text-center uk-margin-auto uk-width-1-3 uk-margin-medium-bottom">
        <?php echo JHtml::image('images/svgs/search.svg','','','',''); ?>
    </div>
    <div id="search-form" class="uk-hidden com-finder__form">
        <?php echo $this->loadTemplate('form'); ?>
    </div>
    <?php // Load the search results layout if we are performing a search. ?>
    <?php if ($this->query->search === true) : ?>
        <div id="search-results" class="com-finder__results">
            <?php echo $this->loadTemplate('results'); ?>
        </div>
    <?php endif; ?>
</div>
