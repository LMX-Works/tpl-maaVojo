<?php

/**
 * ============================================================
 * maaVojo Template
 * ============================================================
 *
 * Datei:        wiwento_url.php
 * Verzeichnis:  html/mod_menu/
 * Bereich:      Joomla Menü-Override / URL
 *
 * Beschreibung:
 * Ausgabe von URL-Menüeinträgen und weiteren Linktypen.
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

$attributes = [
    'class' => 'wiw-nav__link',
];

if ($item->anchor_title) {
    $attributes['title'] = $item->anchor_title;
}

if ($item->anchor_css) {
    $attributes['class'] .= ' ' . $item->anchor_css;
}

if ($item->anchor_rel) {
    $attributes['rel'] = $item->anchor_rel;
}

// ------------------------------------------------------------
// Aktuellen Menüpunkt kennzeichnen
// ------------------------------------------------------------

if (!empty($isCurrent)) {
    $attributes['aria-current'] = 'page';
}

// ------------------------------------------------------------
// Linkinhalt
// ------------------------------------------------------------

$title = htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
$linktype = $title;

// Icon
if ($item->menu_icon) {
    $iconClass = htmlspecialchars(
        $item->menu_icon,
        ENT_QUOTES,
        'UTF-8'
    );

    $icon = '<span class="wiw-nav__icon ' . $iconClass . '" aria-hidden="true"></span>';

    if ($itemParams->get('menu_text', 1)) {
        $linktype = $icon . $title;
    } else {
        $linktype = $icon
            . '<span class="wiw-visually-hidden">' . $title . '</span>';
    }

// Bild
} elseif ($item->menu_image) {
    $imageAttributes = [
        'class' => 'wiw-nav__image',
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
// Browser-Navigation
// ------------------------------------------------------------

if ((int) $item->browserNav === 1) {
    $attributes['target'] = '_blank';

    // Bestehende rel-Werte erhalten und sichere Werte ergänzen.
    $relValues = preg_split(
        '/\s+/',
        trim($attributes['rel'] ?? ''),
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    $relValues[] = 'noopener';
    $relValues[] = 'noreferrer';

    $attributes['rel'] = implode(' ', array_unique($relValues));

} elseif ((int) $item->browserNav === 2) {
    $options = 'toolbar=no,location=no,status=no,menubar=no,'
        . 'scrollbars=yes,resizable=yes,'
        . $params->get('window_open');

    // JSON-Kodierung schützt den Optionswert als JavaScript-String.
    $jsOptions = json_encode(
        $options,
        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
    );

    $attributes['onclick'] = "window.open(this.href, 'targetWindow', "
        . $jsOptions . "); return false;";
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
