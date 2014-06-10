# Search plugin

Search plugin for ImpressPages 4.

## Features

Adds searchBox and searchResults slots. 
Adds `Search` widget to widgets toolbar. 

## Install

1. Upload `Search` directory to your website's `Plugin` directory.
2. Login to the administration area.
3. Go to `Plugins` panel, locate `Search` plugin and click `activate` button.
4. Optional: specify `Search URL`.

## Usage

There are two options on how to use this plugin: it can be added to theme's layout code 
or dragged from widget's toolbar to content area.

### Adding search feature to your theme

To display a search box, place the following code to your theme layout file:

    <?php echo ipSlot('searchBox'); ?>
    
Search results are displayed on a page with URL path specified on plugin's settings pannel.

