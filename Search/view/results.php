<div class="ipSearch">
<?php

foreach ($results as $result){

    echo '<div class="_result">';

    echo '<div class="_title">';
    echo '<a class="_url" href="'.esc($result['url']).'">';
    echo esc($result['title']);
    echo '</a>';
    echo '</div>';

    echo '<div class="_description">';
    echo esc($result['description']);
    echo '</div>';

    echo '</div>';
}

?>
</div>