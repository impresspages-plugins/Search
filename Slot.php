<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 5/20/14
 * Time: 4:06 PM
 */

namespace Plugin\Search;

class Slot {

    public static function searchBox($query)
    {
        $data['form'] = Model::getSearchBoxForm($query);

        return ipView('view/searchBox.php', $data);
    }

    public static function searchResults($query)
    {
        $results = Model::getSearchResults($query);

        if (!empty($results)){

            $data['results'] = $results;
            return ipView('view/results.php', $data);
        }else{
            return ipView('view/noResults.php');
        }

    }

}
