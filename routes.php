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

            $query = ipGetOption('Search.useGet') ? ipRequest()->getQuery(ipGetOption('Search.queryVariableName', 'q')) : $query;

            $html = ipSlot('searchBox', $query);
            $html .= ipSlot('searchResults', $query);

            return $html;

        }
);
