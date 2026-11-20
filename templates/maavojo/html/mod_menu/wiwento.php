
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
 * Alternative Menüausgabe für das WIWENTO-Framework.
 *
 * Version:      0.1.0
 *
 * ============================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/**
 * Modul-ID für eindeutige Untermenü-IDs.
 */
$moduleId = (int) $module->id;

/**
 * Menüelemente ausgeben.
 */
?>

<ul class="wiw-nav__list">

    <?php foreach ($list as $i => $item) :

        // ----------------------------------------------------
        // Menüelement vorbereiten
        // ----------------------------------------------------

        $itemId = (int) $item->id;

        $hasChildren = !empty($item->deeper);

        $submenuId = 'wiw-submenu-' . $moduleId . '-' . $itemId;

        $itemClasses = ['wiw-nav__item'];

        if (!empty($item->active)) {
            $itemClasses[] = 'is-active';
        }

        $itemClass = implode(' ', $itemClasses);

        // ----------------------------------------------------
        // Menüelement öffnen
        // ----------------------------------------------------
        ?>

        <li class="<?php echo htmlspecialchars($itemClass, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="wiw-nav__item-header">

                <?php
                // ------------------------------------------------
                // Menüelement-Typ bestimmen
                // ------------------------------------------------

                switch ($item->type) :

                    case 'heading':
                    case 'separator':
                    ?>

                        <span class="wiw-nav__link">
                            <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
                        </span>

                        <?php
                        break;

                    default:

                        $target = '';

                        if ((int) $item->browserNav === 1) {
                            $target = ' target="_blank"';
                        }

                        $anchorClass = !empty($item->anchor_css)
                            ? ' ' . htmlspecialchars($item->anchor_css, ENT_QUOTES, 'UTF-8')
                            : '';

                        $anchorTitle = !empty($item->anchor_title)
                            ? ' title="' . htmlspecialchars($item->anchor_title, ENT_QUOTES, 'UTF-8') . '"'
                            : '';

                        $anchorRel = !empty($item->anchor_rel)
                            ? ' rel="' . htmlspecialchars($item->anchor_rel, ENT_QUOTES, 'UTF-8') . '"'
                            : '';

                        if ($target && !$anchorRel) {
                            $anchorRel = ' rel="noopener noreferrer"';
                        }
                        ?>

                        <a
                            class="wiw-nav__link<?php echo $anchorClass; ?>"
                            href="<?php echo htmlspecialchars($item->flink, ENT_QUOTES, 'UTF-8'); ?>"
                            <?php echo $anchorTitle; ?>
                            <?php echo $anchorRel; ?>
                            <?php echo $target; ?>
                        >
                            <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
                        </a>

                        <?php
                        break;

                endswitch;
                ?>

                <?php if ($hasChildren) : ?>

                    <button
                        class="wiw-nav__toggle"
                        type="button"
                        data-wiw-nav-toggle
                        aria-expanded="false"
                        aria-controls="<?php echo $submenuId; ?>"
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

            <?php if ($item->deeper) : ?>

                <ul
                    class="wiw-nav__submenu"
                    id="<?php echo $submenuId; ?>"
                    hidden
                >

            <?php elseif ($item->shallower) : ?>

                </li>

                <?php echo str_repeat('</ul></li>', (int) $item->level_diff); ?>

            <?php else : ?>

                </li>

            <?php endif; ?>

    <?php endforeach; ?>

</ul>
