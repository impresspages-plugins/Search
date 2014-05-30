<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 5/20/14
 * Time: 10:40 AM
 */
namespace Plugin\Search;

class Model{


    public static function getSearchResults($query){

        if (!$query){
            return false;
        }else{
            $searchWords = explode(' ', $query);

            foreach ($searchWords as $searchWordKey => $searchWord) {
                if ($searchWord != '') {
                    $nonEmptySearchWords[] = $searchWord;
                }
            }

            $searchWords = $nonEmptySearchWords;

            $getAllWidgetData = self::getAllWidgetData();

            if (!empty($getAllWidgetData)){

                $searchResults = Array();

                foreach ($getAllWidgetData as $widgetKey=>$widget){

                    $text = self::getWidgetText($widget);


                    foreach ($searchWords as $searchWord){
                        if (substr_count(strtolower($text), strtolower($searchWord))){
                            $result['pageId'] = $widget['pageId'];
                            $result['title'] = $widget['title'];
                            $result['url'] = ipHomeUrl().$widget['urlPath'];
                            $result['description'] = self::html2text($text);
                            $searchResults[] = $result;
                        }
                    }
                }


                $searchResults = self::filterUniquePageIds($searchResults);

                return $searchResults;
            }
        }


    }

    /**
     * Taken from stackoverflow post by Erik Töyrä
     */
    private static function filterUniquePageIds($searchResults){
        $pageIds = array();

        $searchResults = array_filter($searchResults, function($el) use (&$pageIds) {
            if (in_array($el['pageId'], $pageIds)) { // if the id has already been seen
                return false; // remove it
            } else {
                $pageIds[] = $el['pageId']; // the id has now been seen
                return true;
            }
        });

        return $searchResults;
    }

    private static function getWidgetText($widget){
        $widgetValue = json_decode($widget['data'], true);

        switch ($widget['name']){
            case 'Heading':
                $text = $widgetValue['title'];
            break;
            case 'Text':
                $text = $widgetValue['text'];
            break;
            default:
                $text = '';
            break;
        }
        return $text;
    }

    private static function html2text($html){

        $html2text = new \Ip\Internal\Text\Html2Text(htmlspecialchars_decode($html), false);
        $text = esc($html2text->get_text());
        $text = str_replace('[', ' ', $text);
        $text = str_replace(']', ' ', $text);

        return $text;
    }

    public static function getAllWidgetData()
    {

        $langCode = ipContent()->getCurrentLanguage()->getCode();

        $sql =
            'select distinct p.id as pageId, p.title as title, p.urlPath as urlPath, w.name as name, w.data as data from '.ipTable('page').' as p
            left join '.ipTable('revision').' as r on p.Id=r.pageId
            left join '.ipTable('widget').' as w on r.revisionId=w.revisionId
            where
                w.isVisible = 1 and
                w.isDeleted = 0 and
                r.isPublished=1 and
                p.isVisible=1 and
                p.isDisabled=0 and
                p.isSecured=0 and
                p.isDeleted=0 and
                p.urlPath<>"" and
                p.languageCode="'.$langCode.'"';
        $ra = ipDb()->fetchAll($sql);
        return $ra;

    }

    public static function getSearchBoxForm($query=''){

        /**
         * @var $form \Ip\Form
         */
        $form = new \Ip\Form();

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'search',
                'label' => __('Search:', 'Search'),
                'value' => $query
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Submit(
            array(
                'value' => __('Search', 'Search')
            ));
        $form->addField($field);


        $form->setAction(ipRouteUrl('Search'));
        $form->setMethod('get');

        $form->setAjaxSubmit(false);
        $form->removeCsrfCheck();
        $form->removeSpamCheck();

        return $form;
    }

}
