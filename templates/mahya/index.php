<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
JHtml::_('jquery.framework');

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

$app  = JFactory::getApplication();
$user = JFactory::getUser();
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();

$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

// Add CSS
JHtml::_('stylesheet', 'fontawesome.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'brands.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'light.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'regular.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'solid.min.css', array('version' => 'auto', 'relative' => true));

JHtml::_('stylesheet', 'uikit-rtl.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'mahya.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'plyr.css', array('version' => 'auto', 'relative' => true));

// Add js
JHtml::_('script', 'uikit.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'uikit-icons.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'particles.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'plyr.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'custom.js', array('version' => 'auto', 'relative' => true));

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$netparsi = "<a href='https://netparsi.com' class='netparsi' target='_blank' rel='nofollow'>".JTEXT::sprintf('NETPARSI')."</a>";

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4ZTYXBR490"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4ZTYXBR490');
    </script>
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="<?php echo $params->get('presetcolor'); ?>">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#000000">
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
    <script type="application/javascript" src="https://player.arvancloud.com/arvanplayer.min.js"></script>
</head>
<body class="<?php echo $option . ' view-' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . ($pageclass ? ' ' . $pageclass : '') . ($this->direction == 'rtl' ? ' rtl' : ''); ?> <?php if ($pageclass == 'auth') echo 'uk-height-viewport uk-background-muted'; ?>">
    <header class="uk-background-white">
        <div class="uk-container">
            <div class="uk-grid-column-medium" data-uk-grid>
                <div class="uk-width-auto uk-flex uk-flex-middle uk-text-zero uk-hidden@s">
                    <a href="#hamMenu" data-uk-toggle class="uk-display-block uk-text-primary offcanvasToggler"><i class="far fa-bars-staggered"></i></a>
                </div>
                <div class="uk-width-auto">
                    <a href="<?php echo JUri::base(); ?>" title="<?php echo $sitename; ?>" class="uk-display-inline-block uk-padding-small uk-padding-remove-horizontal"><img src="<?php echo JUri::base().'images/logo.png'; ?>" width="79" height="70" alt="<?php echo $sitename; ?>"></a>
                </div>
                <div class="uk-width-expand uk-hidden@s">&ensp;</div>
                <div class="uk-width-auto uk-flex uk-flex-middle">
                    <a href="#" title="" target="" class="uk-button uk-button-primary uk-button-outline uk-border-pill uk-box-shadow-small font"><span><?php echo JText::_('ONLINE_RESERVE'); ?></span></a>
                </div>
                <jdoc:include type="modules" name="search" style="html5" />
                <div class="uk-width-expand uk-visible@s">&ensp;</div>
                <div class="uk-width-auto uk-flex uk-flex-middle uk-visible@s">
                    <a href="#mahyaLocation" data-uk-toggle target="_self" data-caption="<?php echo JText::_('MAHYA_LOCATION'); ?>" data-type="iframe" title="<?php echo JText::_('MAHYA_LOCATION'); ?>" class="uk-button uk-button-plain uk-border-pill font locationButton"><i class="far fa-map-marker-alt"></i><span><?php echo JText::_('MAHYA_LOCATION'); ?></span></a>
                </div>
            </div>
        </div>
    </header>
    <nav class="uk-background-primary uk-margin-remove main" data-uk-sticky="animation: uk-animation-slide-top; start: 100%;">
        <div class="uk-container">
            <div class="uk-padding-small uk-hidden@s mobileShortcuts">
                <div class="uk-child-width-1-3 uk-grid-small uk-grid-divider uk-text-center" data-uk-grid>
                    <div><a href="tel:<?php echo $params->get('phone'); ?>" target="_blank" class="uk-text-white uk-flex uk-flex-middle uk-flex-center"><i class="far fa-flip-horizontal fa-phone uk-margin-small-left"></i><span class="uk-text-small font"><?php echo JText::_('CALL_US'); ?></span></a></div>
                    <div><a href="#mahyaLocation" data-uk-toggle class="uk-text-white uk-flex uk-flex-middle uk-flex-center"><i class="far fa-map-marker-alt uk-margin-small-left"></i><span class="uk-text-small font"><?php echo JText::_('OUR_LOCATION'); ?></span></a></div>
                    <div><a href="https://wa.me/<?php echo $params->get('mobile'); ?>" target="_blank" class="uk-text-white uk-flex uk-flex-middle uk-flex-center"><i class="fab fa-whatsapp uk-margin-small-left"></i><span class="uk-text-small font"><?php echo JText::_('WHATSAPP'); ?></span></a></div>
                </div>
            </div>
            <jdoc:include type="modules" name="menu" style="html5" />
        </div>
    </nav>
    <jdoc:include type="message" />
    <?php if ($this->countModules('topout', true)) : ?>
        <jdoc:include type="modules" name="topout" style="html5" />
    <?php endif; ?>
    <main class="uk-padding uk-padding-remove-horizontal">
        <div class="uk-container">
	        <?php if ($this->countModules('topin', true)) : ?>
                <jdoc:include type="modules" name="topin" style="html5" />
	        <?php endif; ?>
            <div class="<?php echo $pageclass == 'tickets' ? 'uk-container' : ''; ?>">
                <div class="uk-grid-divider" data-uk-grid>
			        <?php if ($this->countModules('sidestart', true)) : ?>
                        <aside class="uk-width-1-1 uk-width-1-4@m uk-visible@m">
                            <div data-uk-sticky="offset: 92; bottom: true;">
                                <div class="uk-child-width-1-1" data-uk-grid><jdoc:include type="modules" name="sidestart" style="none" /></div>
                            </div>
                        </aside>
			        <?php endif; ?>
                    <article class="uk-width-1-1 uk-width-expand@m">
                        <jdoc:include type="component" />
                    </article>
			        <?php if ($this->countModules('sideend', true)) : ?>
                        <aside class="uk-width-1-1 uk-width-1-4@s uk-visible@s"><jdoc:include type="modules" name="sideend" style="none" /></aside>
			        <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <?php if ($this->countModules('bottomout', true)) : ?>
        <jdoc:include type="modules" name="bottomout" style="html5" />
    <?php endif; ?>
    <?php if ($this->countModules('reserve', true)) : ?>
        <jdoc:include type="modules" name="reserve" style="html5" />
    <?php endif; ?>
    <footer class="uk-background-primary uk-overflow-hidden uk-position-relative">
        <div class="uk-padding uk-padding-remove-horizontal modules uk-position-relative">
            <div class="uk-container">
                <div class="uk-flex-between uk-grid-column-large uk-grid-row-small" data-uk-grid>
                    <div class="uk-width-1-1 uk-width-1-3@s contact">
                        <div class="uk-margin-bottom uk-text-center uk-text-right@s"><?php echo JHtml::image('images/logo-white.png', $sitename, 'width="" height=""'); ?></div>
                        <ul class="uk-grid-small uk-visible@s" data-uk-grid>
                            <li class="uk-text-small uk-flex uk-flex-middle uk-width-1-1"><i class="fal fa-map-signs fa-fw fa-lg uk-margin-left uk-text-white"></i><a href="#" class="uk-text-white font f500"><?php echo $params->get('address'); ?></a></li>
                            <li class="uk-text-small uk-flex uk-flex-middle uk-width-1-2 uk-width-1-1@m"><i class="fal fa-phone fa-flip-horizontal fa-fw fa-lg uk-margin-left uk-text-white"></i><a href="tel:<?php echo $params->get('phone'); ?>" class="uk-text-white font f500 ltr"><?php echo $params->get('phone'); ?></a></li>
                            <li class="uk-text-small uk-flex uk-flex-middle uk-width-1-2 uk-width-1-1@m"><i class="fab fa-whatsapp fa-fw fa-lg uk-margin-left uk-text-white"></i><a href="tel:<?php echo $params->get('mobile'); ?>" class="uk-text-white font f500 ltr"><?php echo $params->get('mobile'); ?></a></li>
                            <li class="uk-text-small uk-flex uk-flex-middle uk-width-1-2 uk-width-1-1@m"><i class="fal fa-envelope-open-text fa-fw fa-lg uk-margin-left uk-text-white"></i><a href="mailto:<?php echo $params->get('email'); ?>" class="uk-text-white font f500 ltr"><?php echo $params->get('email'); ?></a></li>
                        </ul>
                    </div>
                    <div class="uk-width-1-1 uk-width-expand@s">
                        <h5 class="uk-text-center uk-text-right@s"><?php echo JText::_('ABOUT_MAHYA_CLINIC'); ?></h5>
                        <div class="font uk-text-small uk-text-center uk-text-white uk-text-right@s"><?php echo $params->get('footer_text'); ?></div>
                    </div>
                    <div class="uk-width-auto uk-visible@s"><jdoc:include type="modules" name="footer" style="html5" /></div>
                    <div class="uk-width-1-1 uk-width-auto@s">
                        <h5 class="uk-text-center uk-text-right@s"><?php echo JText::_('BE_WITH_US'); ?></h5>
                        <ul class="uk-grid-small uk-child-width-auto uk-flex-center uk-flex-right@m socials" data-uk-grid>
                            <?php foreach ($params->get('socials') as $item) : ?>
                                <?php if ($item->icon != '') { ?>
                                    <li><a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" data-uk-tooltip class="uk-flex uk-flex-center uk-flex-middle" target="_blank" id="<?php echo $item->title; ?>"><i class="fab fa-<?php echo $item->icon; ?>"></i></a></li>
                                <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-container">
            <div class="uk-padding-small uk-padding-remove-horizontal copyright">
                <div class="uk-grid-row-small uk-grid-column-medium uk-text-center uk-text-right@s" data-uk-grid>
                    <div class="uk-width-1-1 uk-width-expand@m">
                        <p class="uk-margin-remove uk-text-tiny uk-text-white font"><?php echo JText::sprintf('COPYRIGHT', $sitename); ?></p>
                    </div>
                    <div class="uk-width-1-1 uk-width-auto@m uk-hidden">
                        <p class="uk-margin-remove uk-text-tiny uk-text-white font"><?php echo JText::sprintf('DEVELOPER', $netparsi); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="mahyaLocation" class="uk-flex-top" data-uk-modal>
        <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4740.819266853735!2d9.99008871708242!3d53.550454675412404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3f9d24afe84a0263!2sRathaus!5e0!3m2!1sde!2sde!4v1499675200938" width="1280" height="720" uk-responsive></iframe>
        </div>
    </div>
    <div id="hamMenu" data-uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar uk-card uk-card-default uk-padding-remove bgWhite">
            <div class="uk-flex uk-flex-column uk-height-1-1">
                <div class="uk-width-expand">
                    <div class="offcanvasTop uk-box-shadow-small uk-position-relative uk-flex-stretch uk-background-primary">
                        <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                            <div class="uk-flex uk-width-1-4 uk-flex uk-flex-center uk-flex-middle"><a onclick="UIkit.offcanvas('#hamMenu').hide();" class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-width-1-1 uk-margin-remove"><i class="far fa-chevron-right"></i></a></div>
                            <div class="uk-flex uk-width-expand uk-flex uk-flex-right uk-flex-middle uk-text-white">
                                <span class="font uk-flex uk-flex-middle uk-text-white uk-text-bold uk-h3 uk-margin-remove"><?php echo $sitename; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="uk-padding-small"><jdoc:include type="modules" name="offcanvas" style="xhtml" /></div>
                </div>
            </div>
        </div>
    </div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>