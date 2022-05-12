<?php
/**
 * Plugin name: Blife menu
 * Description: Blife menu
 */

include_once('Controller/Index.php');

function blife_statistical()
{
    add_menu_page(
        "Blife",
        "Statistical",
        "customize",
        "blife-statistical",
        "blife_statistical_callback",
        "dashicons-chart-bar",
        4);
}

add_action("admin_menu", "blife_statistical");

function blife_statistical_callback()
{
    $controller = new Index();
    $controller->execute();
}