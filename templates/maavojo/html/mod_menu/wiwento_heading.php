<?php

/**
 * ============================================================
 * maaVojo Template
 * ============================================================
 *
 * Datei:        wiwento_heading.php
 * Verzeichnis:  html/mod_menu/
 * Bereich:      Joomla Menü-Override / Heading
 *
 * Beschreibung:
 * Ausgabe von Menüüberschriften.
 *
 * Version:      0.1.0
 *
 * ============================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

// ------------------------------------------------------------
// Attribute
// ------------------------------------------------------------

$titleAttribute = '';

if ($item->anchor_title) {
    $titleAttribute = ' title="'
        . htmlspecialchars($item->anchor_title, ENT_QUOTES, 'UTF-8')
        . '"';
}

$classes = ['wiw-nav__heading'];

if ($item->anchor_css) {
    $classes[] = $item->anchor_css;
}

// ------------------------------------------------------------
// Inhalt
// ------------------------------------------------------------

$title = htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8');
$content = $title;

// Icon
if ($item->menu_icon) {
    $iconClass = htmlspecialchars(
        $item->menu_icon,
        ENT_QUOTES,
        'UTF-8'
    );

    $icon = '<span class="wiw-nav__icon ' . $iconClass . '" aria-hidden="true"></span>';

    if ($itemParams->get('menu_text', 1)) {
        $content = $icon . $title;
    } else {
        $content = $icon
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

    $content = HTMLHelper::_(
        'image',
        $item->menu_image,
        '',
        $imageAttributes
    );

    $content .= '<span class="wiw-nav__image-title'
        . ($itemParams->get('menu_text', 1) ? '' : ' wiw-visually-hidden')
        . '">' . $title . '</span>';
}

// ------------------------------------------------------------
// Ausgabe
// ------------------------------------------------------------

?>

<span
    class="<?php echo htmlspecialchars(implode(' ', $classes), ENT_QUOTES, 'UTF-8'); ?>"
    <?php echo $titleAttribute; ?>
>
    <?php echo $content; ?>
</span>
