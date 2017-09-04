<?php
/**
 * Meta for Core-Modules
 *
 * @copyright Sven Rhinow 2004-2017
 * @package   x-meta4coremodules
 * @author    Sven Rhinow <http://www.sr-tag.de>
 * @license   LGPL
 */

namespace srhinow\Meta4CoreModules;

/**
 * Class ClassMeta4CoreModules
 * @package srhinow\Meta4CoreModules
 */
class ClassMeta4CoreModules extends \Contao\Frontend
{
    /**
     * add to HTML-<head>-Meta entries dependent on meta-entries from the core-modul (like news,faq,...)
     * @param $objTemplate
     */
    public function m4cmParseTemplate($objTemplate)
    {
        // Set the item from the auto_item parameter
        if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
        {
            \Input::setGet('items', \Input::get('auto_item'));
        }

        if(\Input::get('items'))
        {
          #  print_r($objTemplate->type);

            switch($objTemplate->type) {
                case 'faqreader':
                    $objFaq = \FaqModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objFaq) return;

                    if($objFaq->m4cm_title != '') $this->setPageTitle($objFaq->m4cm_title);
                    if($objFaq->m4cm_description != '') $this->setDescription($objFaq->m4cm_description);
                    if($objFaq->m4cm_keywords != '') $this->setKeywords($objFaq->m4cm_keywords);
                    if($objFaq->m4cm_moremetas != '') $this->setMoreHeads($objFaq->m4cm_moremetas);

                    break;
                case 'newsreader':
                    $objNews = \NewsModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objNews) return;

                    if($objNews->m4cm_title != '') $this->setPageTitle($objNews->m4cm_title);
                    if($objNews->m4cm_description != '') $this->setDescription($objNews->m4cm_description);
                    if($objNews->m4cm_keywords != '') $this->setKeywords($objNews->m4cm_keywords);
                    if($objNews->m4cm_moremetas != '') $this->setMoreHeads($objNews->m4cm_moremetas);

                    break;
                case 'nl_reader':
                    $objNewsletter = \NewsletterModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objNewsletter) return;

                    if($objNewsletter->m4cm_title != '') $this->setPageTitle($objNewsletter->m4cm_title);
                    if($objNewsletter->m4cm_description != '') $this->setDescription($objNewsletter->m4cm_description);
                    if($objNewsletter->m4cm_keywords != '') $this->setKeywords($objNewsletter->m4cm_keywords);
                    if($objNewsletter->m4cm_moremetas != '') $this->setMoreHeads($objNewsletter->m4cm_moremetas);

                    break;
                case 'eventreader':
                    $objEvent = \CalendarEventsModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objEvent) return;

                    if($objEvent->m4cm_title != '') $this->setPageTitle($objEvent->m4cm_title);
                    if($objEvent->m4cm_description != '') $this->setDescription($objEvent->m4cm_description);
                    if($objEvent->m4cm_keywords != '') $this->setKeywords($objEvent->m4cm_keywords);
                    if($objEvent->m4cm_moremetas != '') $this->setMoreHeads($objEvent->m4cm_moremetas);

                    break;

            }
        }
    }

    /**
     * @param $titleStr
     */
    protected function setPageTitle($titleStr) {
        /** @var \PageModel $objPage */
        global $objPage;

         $objPage->pageTitle = strip_tags(strip_insert_tags($titleStr));
    }

    /**
     * @param $descriptionStr
     */
    protected function setDescription($descriptionStr) {
        /** @var \PageModel $objPage */
        global $objPage;

        $objPage->description = $this->prepareMetaDescription($descriptionStr);
    }

    /**
     * @param $keywordsStr
     */
    protected function setKeywords($keywordsStr) {
        if ($keywordsStr != '')
        {
            $GLOBALS['TL_KEYWORDS'] .= (($GLOBALS['TL_KEYWORDS'] != '') ? ', ' : '') . $keywordsStr;
        }
    }

    /**
     * @param $moreStr
     */
    protected function setMoreHeads($moreStr) {
        $GLOBALS['TL_HEAD'][] = $moreStr;
    }
}