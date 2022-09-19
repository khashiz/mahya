<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
?>
<div class="uk-width-1-1 uk-width-1-2@s uk-margin-auto">
    <div>
        <div class="uk-border-rounded uk-box-shadow-small uk-overflow-hidden">
            <?php if ($this->params->get('show_page_heading', 0)) { ?>
                <h1 class="uk-padding-small uk-text-white uk-background-primary uk-text-center uk-margin-remove font f500 uk-h4"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            <?php } ?>
            <div class="uk-padding">
                <div class="rsform"><?php echo RSFormProHelper::displayForm($this->formId); ?></div>
            </div>
        </div>
    </div>
</div>