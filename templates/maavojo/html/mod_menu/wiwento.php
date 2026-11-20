<?php

/**
 * ============================================================
 * maaVojo Template
 * ============================================================
 *
 * Datei:        wiwento.php
 * Verzeichnis:  html/mod_menu/
 * Bereich:      Joomla Menü-Override
 *
 * Beschreibung:
 * Zentrale Menüausgabe für das WIWENTO-Framework.
 *
 * Joomla bleibt für die Ermittlung des aktiven Menüeintrags und
 * des aktiven Navigationspfads verantwortlich. Die Statuslogik
 * orientiert sich an der Joomla-Core-Ausgabe von mod_menu.
 *
 * WIWENTO übernimmt Markup, CSS-Klassen und Interaktionsattribute.
 *
 * Version:      0.2.0
 *
 * ============================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

// ------------------------------------------------------------
// Modul- und Menüparameter
// ------------------------------------------------------------

$moduleId  = (int) $module->id;
$tagId     = (string) $params->get('tag_id', '');
$classSfx  = trim((string) $params->get('class_sfx', ''));
$defaultId = (int) $default_id;
$activeId  = (int) $active_id;

// Joomla liefert $path als Navigationspfad des aktiven
// Menüeintrags. Die Werte werden für den Vergleich vereinheitlicht.
$activePath = array_map('intval', (array) $path);

// Zusätzliche Klassen des Moduls übernehmen.
$listClasses = ['wiw-nav__list'];

if ($classSfx !== '') {
    $listClasses[] = $classSfx;
}

// ------------------------------------------------------------
// Attribute der Menü-Liste
// ------------------------------------------------------------

$listAttributes = ' class="'
    . htmlspecialchars(implode(' ', $listClasses), ENT_QUOTES, 'UTF-8')
    . '"';

if ($tagId !== '') {
    $listAttributes .= ' id="'
        . htmlspecialchars($tagId, ENT_QUOTES, 'UTF-8')
        . '"';
}

?>

<ul<?php echo $listAttributes; ?>>

    <?php foreach ($list as $i => &$item) :

        // ----------------------------------------------------
        // Menüelement vorbereiten
        // ----------------------------------------------------

        $itemId      = (int) $item->id;
        $itemParams  = $item->getParams();
        $hasChildren = !empty($item->deeper);
        $submenuId   = 'wiw-submenu-' . $moduleId . '-' . $itemId;

        $isAlias = $item->type === 'alias';

        $aliasId = $isAlias
            ? (int) $itemParams->get('aliasoptions', 0)
            : 0;

        $isDefault = $itemId === $defaultId;

        // ----------------------------------------------------
        // Joomla-Core-Statuslogik: current
        // ----------------------------------------------------
        // Joomla kennzeichnet einen Menüpunkt als current, wenn
        // seine ID der active_id entspricht oder wenn es sich um
        // einen Alias auf genau diesen aktiven Menüpunkt handelt.

        $isCurrent = $itemId === $activeId
            || ($isAlias && $aliasId === $activeId);

        // ----------------------------------------------------
        // Joomla-Core-Statuslogik: active / Alias-Pfad
        // ----------------------------------------------------

        $isActivePath = in_array($itemId, $activePath, true);
        $isAliasParentActive = false;

        if (!$isActivePath && $isAlias && $aliasId !== 0) {

            $lastPathId = !empty($activePath)
                ? $activePath[count($activePath) - 1]
                : 0;

            if ($lastPathId !== 0 && $aliasId === $lastPathId) {
                $isActivePath = true;

            } elseif (in_array($aliasId, $activePath, true)) {
                $isAliasParentActive = true;
            }
        }

        // ----------------------------------------------------
        // CSS-Klassen zusammenstellen
        // ----------------------------------------------------

        $itemClasses = ['wiw-nav__item'];

        if ($isDefault) {
            $itemClasses[] = 'is-default';
        }

        if ($isCurrent) {
            $itemClasses[] = 'is-current';
        }

        if ($isActivePath) {
            $itemClasses[] = 'is-active';
        }

        if ($isAliasParentActive) {
            $itemClasses[] = 'is-alias-parent-active';
        }

        // WIWENTO verwendet diese Klasse, um den aktiven
        // Navigationspfad in verschachtelten Menüs zu öffnen.
        if (($isActivePath || $isAliasParentActive) && !$isCurrent) {
            $itemClasses[] = 'is-active-path';
        }

        if ($hasChildren) {
            $itemClasses[] = 'has-children';
        }

        if (!empty($item->parent)) {
            $itemClasses[] = 'is-parent';
        }

        if ($item->type === 'separator') {
            $itemClasses[] = 'is-separator';
        }

        $itemClass = implode(' ', $itemClasses);

        ?>

        <li class="<?php echo htmlspecialchars($itemClass, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="wiw-nav__item-header">

                <?php
                // Passendes Unterlayout laden.
                $layout = in_array(
                    $item->type,
                    ['component', 'url', 'heading', 'separator'],
                    true
                )
                    ? 'wiwento_' . $item->type
                    : 'wiwento_url';

                require ModuleHelper::getLayoutPath('mod_menu', $layout);
                ?>

                <?php if ($hasChildren) : ?>

                    <button
                        class="wiw-nav__toggle"
                        type="button"
                        data-wiw-nav-toggle
                        aria-expanded="false"
                        aria-controls="<?php echo htmlspecialchars($submenuId, ENT_QUOTES, 'UTF-8'); ?>"
                        aria-label="<?php echo htmlspecialchars(
                            Text::sprintf('MOD_MENU_TOGGLE_SUBMENU_LABEL', $item->title),
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                    >
                        <span aria-hidden="true"></span>
                    </button>

                <?php endif; ?>

            </div>

            <?php if ($hasChildren) : ?>

                <ul
                    class="wiw-nav__submenu"
                    id="<?php echo htmlspecialchars($submenuId, ENT_QUOTES, 'UTF-8'); ?>"
                    hidden
                >

            <?php elseif (!empty($item->shallower)) : ?>

                </li>

                <?php echo str_repeat('</ul></li>', (int) $item->level_diff); ?>

            <?php else : ?>

                </li>

            <?php endif; ?>

    <?php endforeach; ?>

</ul>

<?php
unset($item);
