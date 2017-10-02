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
    private $noOverwrite = false;

    /**
     * add to HTML-<head>-Meta entries dependent on meta-entries from the core-modul (like news,faq,...)
     * @param $objTemplate
     */
    public function m4cmParseTemplate($objTemplate)
    {
        global $objPage;

        // Set the item from the auto_item parameter
        if (!isset($_GET['items']) && \Config::get('useAutoItem') && isset($_GET['auto_item']))
        {
            \Input::setGet('items', \Input::get('auto_item'));
        }

        //damit es nur beim ersten parseTemplae-Hook aufgerufen und gesetzt wird
        if($GLOBALS['m4cm_firstrun'] == 0) {
            // og und google defaults setzen
            $GLOBALS['m4cm']['seoTitle'] = $objPage->title;
            $GLOBALS['m4cm']['seoHeadline'] = $objPage->pageTitle;
            $GLOBALS['m4cm']['seoDescription'] = $objPage->description;
            $GLOBALS['m4cm']['seoType'] = 'website';
            $GLOBALS['m4cm']['seoUrl'] = \Environment::get('url')."/".\Environment::get('request');

            $this->firstrun = 1;
        }

        if(\Input::get('items'))
        {
            switch($objTemplate->type) {
                case 'faqreader':
                    $objFaq = \FaqModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objFaq) return;

                    $GLOBALS['m4cm']['seoTitle'] = $objFaq->question.' - '.\Environment::get('host');
                    $GLOBALS['m4cm']['seoType'] = 'article';

                    if($objFaq->m4cm_title != '') $this->setPageTitle($objFaq->m4cm_title);
                    if($objFaq->m4cm_description != '') $this->setDescription($objFaq->m4cm_description);
                    if($objFaq->m4cm_keywords != '') $this->setKeywords($objFaq->m4cm_keywords);
                    if($objFaq->m4cm_moremetas != '') $this->setMoreHeads($objFaq->m4cm_moremetas);

                    if($objFaq->addImage == 1) {

                        $objFile = \FilesModel::findByUuid($objFaq->singleSRC);
                        list($width, $height, $type, $attr) = getimagesize($objFile->path);

                        if($width > $height) {
                            #Querformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 0, 400 , 'proportional');
                        }else{
                            #Hochformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 400, 0 , 'proportional');
                        }

                    }

                    $this->noOverwrite = true;
                    break;
                case 'newsreader':
                    $objNews = \NewsModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objNews) return;

                    $GLOBALS['m4cm']['seoTitle'] = $objNews->headline.' - '.\Environment::get('host');
                    $GLOBALS['m4cm']['seoDescription'] = strip_tags($objNews->teaser);
                    $GLOBALS['m4cm']['seoType'] = 'article';

                    if($objNews->m4cm_title != '') $this->setPageTitle($objNews->m4cm_title);
                    if($objNews->m4cm_description != '') $this->setDescription($objNews->m4cm_description);
                    if($objNews->m4cm_keywords != '') $this->setKeywords($objNews->m4cm_keywords);
                    if($objNews->m4cm_moremetas != '') $this->setMoreHeads($objNews->m4cm_moremetas);

                    if($objNews->addImage == 1) {

                        $objFile = \FilesModel::findByUuid($objNews->singleSRC);
                        list($width, $height, $type, $attr) = getimagesize($objFile->path);

                        if($width > $height) {
                            #Querformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 0, 400 , 'proportional');
                        }else{
                            #Hochformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 400, 0 , 'proportional');
                        }

                    }

                    $this->noOverwrite = true;

                    break;

                case 'nl_reader':
                    $objNewsletter = \NewsletterModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objNewsletter) return;

                    $GLOBALS['m4cm']['seoTitle'] = $objNewsletter->title.' - '.\Environment::get('host');
                    $GLOBALS['m4cm']['seoDescription'] = strip_tags($objNewsletter->teaser);
                    $GLOBALS['m4cm']['seoType'] = 'article';

                    if($objNewsletter->m4cm_title != '') $this->setPageTitle($objNewsletter->m4cm_title);
                    if($objNewsletter->m4cm_description != '') $this->setDescription($objNewsletter->m4cm_description);
                    if($objNewsletter->m4cm_keywords != '') $this->setKeywords($objNewsletter->m4cm_keywords);
                    if($objNewsletter->m4cm_moremetas != '') $this->setMoreHeads($objNewsletter->m4cm_moremetas);

                    $this->noOverwrite = true;

                    break;
                case 'eventreader':
                    $objEvent = \CalendarEventsModel::findByIdOrAlias(\Input::get('items'));
                    if (null === $objEvent) return;

                    $GLOBALS['m4cm']['seoTitle'] = $objEvent->subject.' - '.\Environment::get('host');
                    $GLOBALS['m4cm']['seoType'] = 'article';

                    if($objEvent->m4cm_title != '') $this->setPageTitle($objEvent->m4cm_title);
                    if($objEvent->m4cm_description != '') $this->setDescription($objEvent->m4cm_description);
                    if($objEvent->m4cm_keywords != '') $this->setKeywords($objEvent->m4cm_keywords);
                    if($objEvent->m4cm_moremetas != '') $this->setMoreHeads($objEvent->m4cm_moremetas);

                    if($objEvent->addImage == 1) {

                        $objFile = \FilesModel::findByUuid($objEvent->singleSRC);
                        list($width, $height, $type, $attr) = getimagesize($objFile->path);

                        if($width > $height) {
                            #Querformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 0, 400 , 'proportional');
                        }else{
                            #Hochformatbilder
                            $GLOBALS['m4cm']['seoImage'] = \Environment::get('base') . \Image::get($objFile->path, 400, 0 , 'proportional');
                        }

                    }

                    $this->noOverwrite = true;

                    break;
            }
;
        }

        if($GLOBALS['m4cm_overwrite'] == true) {
            //Open-Graph tags setzen
            $this->setOpenGraphHeadMetas();

            //Google+ Tags setzen
            $this->setGoogleHeadMetas();

            //Twitter-Tags setzen
            $this->setTwitterHeadMetas();

            if($this->noOverwrite) $GLOBALS['m4cm_overwrite'] = false;
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

    /**
     * setzt den OpenGraph (Facebook) Meta-String zusammen
     */
    protected function setOpenGraphHeadMetas() {
        global $objPage;

        $ogString = "<!--Facebook Open Graph-->
        <meta property=\"og:title\" content=\"".$GLOBALS['m4cm']['seoTitle']."\" />
        <meta property=\"og:headline\" content=\"".$GLOBALS['m4cm']['seoHeadline']."\" />
        <meta property=\"og:description\" content=\"".$GLOBALS['m4cm']['seoDescription']."\" />
        <meta property=\"og:url\" content=\"".$GLOBALS['m4cm']['seoUrl']."\" />
        <meta property=\"og:type\" content=\"".$GLOBALS['m4cm']['seoType']."\" />
        <meta property=\"og:locale\" content=\"".$objPage->language."\" />";

        if(strlen(trim($GLOBALS['m4cm']['seoImage'])) > 0) $ogString  .= "\n<meta property=\"og:image\" content=\"".$GLOBALS['m4cm']['seoImage']."\" />";

        $GLOBALS['m4cm_ogString'] = $ogString;

    }

    /**
     * setzt den Google-Meta-String zusammen
     */
    protected function setGoogleHeadMetas() {

        $googleString = "<!--Google Meta-Tags-->
        <meta itemscope itemtype=\"http://schema.org/article\" />
        <meta itemprop=\"headline\" content=\"" . $GLOBALS['m4cm']['seoHeadline'] . "\"/>
        <meta itemprop=\"description\" content=\"" . $GLOBALS['m4cm']['seoDescription'] . "\"/>";
        if ($GLOBALS['og:image']) $googleString .= "\n<meta itemprop=\"image\" content=\"" . $GLOBALS['og:image'] . "\"/>";

        $GLOBALS['m4cm_googleString'] = $googleString;

    }

    /**
     * setzt den Twitter-Card Meta-String zusammen
     */
    protected function setTwitterHeadMetas() {
        $twitterString = "<meta name=\"twitter:card\" content=\"summary\" />";
        if(strlen($GLOBALS['TL_CONFIG']['m4cm_twitter_site']) > 0) $twitterString .= "<meta name=\"twitter:site\" content=\"".$GLOBALS['TL_CONFIG']['m4cm_twitter_site']."\" />";
        if(strlen($GLOBALS['TL_CONFIG']['m4cm_twitter_creator']) > 0) $twitterString .= "<meta name=\"twitter:creator\" content=\"".$GLOBALS['TL_CONFIG']['m4cm_twitter_creator']."\" />";

        $GLOBALS['m4cm_twitterString'] = $twitterString;
    }

    /**
     * zum finalen setzen der OpenGraph und Google-Meta-Tags per generatePage-HOOK
     */
    public function m4cmGeneratePage(){
        $GLOBALS['TL_HEAD'][] = $GLOBALS['m4cm_ogString'];
        $GLOBALS['TL_HEAD'][] = $GLOBALS['m4cm_googleString'];
        $GLOBALS['TL_HEAD'][] = $GLOBALS['m4cm_twitterString'];
    }
}