<?php

/**
 * ============================================================
 * maaVojo Template
 * ============================================================
 *
 * Datei:        wiwento_component.php
 * Verzeichnis:  html/mod_menu/
 * Bereich:      Joomla Menü-Override / Component
 *
 * Beschreibung:
 * Ausgabe interner Joomla-Menülinks.
 * Berücksichtigt die Browser-Navigationseinstellungen
 * des Menüeintrags.
 *
 * Version:      0.1.0
 *
 * ============================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Filter\OutputFilter;

// ------------------------------------------------------------
// Linkattribute
// ------------------------------------------------------------

$attributes = [];

if ($item->anchor_title) {
    $attributes['title'] = $item->anchor_title;
}

$attributes['class'] = 'wiw-nav__link';

if ($item->anchor_css) {
    $attributes['class'] .= ' ' . $item->anchor_css;
}

if ($item->anchor_rel) {
    $attributes['rel'] = $item->anchor_rel;
}

// ------------------------------------------------------------
// Aktuellen Menüpunkt kennzeichnen
// ------------------------------------------------------------

// Die zentrale wiwento.php entscheidet, welcher Menüpunkt
// tatsächlich aktuell ist. Das Unterlayout übernimmt nur
// diese Entscheidung und setzt das passende ARIA-Attribut.

if (!empty($isCurrent)) {
    $attributes['aria-current'] = 'page';
}

// ------------------------------------------------------------
// Linkinhalt
// ------------------------------------------------------------

$title = htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');

$linktype = $title;

// ------------------------------------------------------------
// Icon
// ------------------------------------------------------------

if ($item->menu_icon) {

    $iconClass = htmlspecialchars(
        $item->menu_icon,
        ENT_QUOTES,
        'UTF-8'
    );

    $icon = '<span class="wiw-nav__icon '
        . $iconClass
        . '" aria-hidden="true"></span>';

    if ($itemParams->get('menu_text', 1)) {
        $linktype = $icon . $title;
    } else {
        $linktype = $icon
            . '<span class="wiw-visually-hidden">'
            . $title
            . '</span>';
    }

// ------------------------------------------------------------
// Bild
// ------------------------------------------------------------

} elseif ($item->menu_image) {

    $imageAttributes = [
        'class' => 'wiw-nav__image',
        'alt'   => '',
    ];

    if ($item->menu_image_css) {
        $imageAttributes['class'] .= ' ' . $item->menu_image_css;
    }

    $linktype = HTMLHelper::_(
        'image',
        $item->menu_image,
        '',
        $imageAttributes
    );

    $linktype .= '<span class="wiw-nav__image-title'
        . ($itemParams->get('menu_text', 1) ? '' : ' wiw-visually-hidden')
        . '">' . $title . '</span>';
}

// ------------------------------------------------------------
// Link ausgeben
// ------------------------------------------------------------

$url = OutputFilter::ampReplace(
    htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)
);

echo HTMLHelper::_(
    'link',
    $url,
    $linktype,
    $attributes
);
