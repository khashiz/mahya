<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

foreach ($this->category->jcfields as $field) :
	$fieldsValue[$field->name] = $field->value;
	$fieldsRawValue[$field->name] = $field->rawvalue;
endforeach;

?>
<div class="com-content-category-blog blog" itemscope itemtype="https://schema.org/Blog">
    <?php if ($this->params->get('show_page_heading')) : ?>
        <div class="page-header uk-overflow-hidden">
            <h1 class="font uk-text-secondary uk-h2 uk-text-bold uk-animation-slide-left-medium uk-text-center uk-margin-bottom uk-text-right@s"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            <hr class="uk-margin-remove-top uk-margin-medium-bottom uk-visible@s">
        </div>
    <?php endif; ?>

    <?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
        <?php $this->category->tagLayout = new FileLayout('joomla.content.tags'); ?>
        <?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
    <?php endif; ?>

    <?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
        <?php if ($this->params->get('show_no_articles', 1)) : ?>
            <div class="alert alert-info">
                <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                    <?php echo Text::_('COM_CONTENT_NO_ARTICLES'); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($this->lead_items)) : ?>
        <div class="uk-child-width-1-1 uk-child-width-1-4@s uk-grid-small com-content-category-blog__items blog-items items-leading <?php echo $this->params->get('blog_class_leading'); ?>" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-small; delay: 300">
            <?php foreach ($this->lead_items as &$item) : ?>
                <div class="com-content-category-blog__item blog-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                    <?php
                    $this->item = &$item;
                    echo $this->loadTemplate('item');
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($this->intro_items)) : ?>
        <?php $blogClass = $this->params->get('blog_class', ''); ?>
        <?php if ((int) $this->params->get('num_columns') > 1) : ?>
            <?php $blogClass .= (int) $this->params->get('multi_column_order', 0) === 0 ? ' masonry-' : ' columns-'; ?>
            <?php $blogClass .= (int) $this->params->get('num_columns'); ?>
        <?php endif; ?>
        <div class="com-content-category-blog__items blog-items <?php echo $blogClass; ?>">
        <?php foreach ($this->intro_items as $key => &$item) : ?>
            <div class="com-content-category-blog__item blog-item"
                itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                    <?php
                    $this->item = & $item;
                    echo $this->loadTemplate('item');
                    ?>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($this->link_items)) : ?>
        <div class="items-more">
            <?php echo $this->loadTemplate('links'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
        <div class="com-content-category-blog__children cat-children">
            <?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
                <h3> <?php echo Text::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
            <?php endif; ?>
            <?php echo $this->loadTemplate('children'); ?> </div>
    <?php endif; ?>
    <?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
        <div class="com-content-category-blog__navigation w-100">
            <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                <p class="com-content-category-blog__counter counter float-end pt-3 pe-2">
                    <?php echo $this->pagination->getPagesCounter(); ?>
                </p>
            <?php endif; ?>
            <div class="com-content-category-blog__pagination">
                <?php echo $this->pagination->getPagesLinks(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

	<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
    <div class="uk-text-center category-desc clearfix">
        <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
            <?php echo LayoutHelper::render(
                'joomla.html.image',
                [
                    'src' => $this->category->getParams()->get('image'),
                    'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
                ]
                ); ?>
            <?php endif; ?>
            <?php if ($this->params->get('show_category_title', 1)) : ?>
                <<?php echo $htag; ?> class="uk-h3 uk-text-primary uk-text-bold font">
                    <?php echo $this->category->title; ?>
                </<?php echo $htag; ?>>
            <?php endif; ?>
        <?php /* echo $afterDisplayTitle; ?>
        <?php echo $beforeDisplayContent; */ ?>
    <div class="uk-padding uk-padding-remove-vertical">
	    <?php if ($this->params->get('show_description') && $this->category->description) : ?>
            <div class="uk-text-primary font uk-text-primary"><?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?></div>
	    <?php endif; ?>
	    <?php if (!empty($fieldsValue['readmore'])) { ?>
            <a href="#" data-uk-toggle="target: #more; animation: uk-animation-fade" target="_self" title="<?php echo JText::_('MORE'); ?>" class="uk-button uk-button-plain uk-border-pill uk-margin-bottom font locationButton"><i class="far fa-chevron-circle-down"></i><span><?php echo JText::_('MORE'); ?></span></a>
            <div class="uk-text-primary font uk-text-primary" id="more" hidden><?php echo $fieldsValue['readmore']; ?></div>
	    <?php } ?>
    </div>
        <?php /* echo $afterDisplayContent; */ ?>
    </div>
    <?php endif; ?>