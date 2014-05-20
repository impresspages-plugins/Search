<?php
namespace Plugin\Search;

$routes[ipGetOption('Search.url').'{/query}'] = array(
    'name' => 'Search',
    'action' =>
        function($query = '') {

            $data = array(
                'title' => __('Search results', 'Search'),
                'url' => ipRouteUrl('Search')
            );

            $html = ipSlot('searchBox', $data);
            $html .= ipSlot('searchResults', $query);

            return $html;

        }
);