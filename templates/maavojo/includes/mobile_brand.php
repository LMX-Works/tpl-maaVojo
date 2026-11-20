
<?php
/**
 * ============================================================
 * @package     maaVojo
 * @version     0.1.0
 * @author      maaVojo
 * @copyright   Copyright (C) 2026 maaVojo
 * @license     GNU General Public License version 2 or later;
 *               see LICENSE
 * ============================================================
 */
?>

<a
    class="mv-brand__mobile mv-brand__link"
    href="<?php echo \Joomla\CMS\Router\Route::_('index.php'); ?>"
    aria-label="maaVojo – Startseite"
>

    <!-- Bildmarke -->
    <span class="mv-brand__logo">
        <img
            src="<?php echo \Joomla\CMS\Uri\Uri::root(); ?>media/templates/site/maavojo/images/bildmarke.png"
            alt=""
        >
    </span>

    <!-- Wortmarke und Slogan -->
    <span class="mv-brand__content">

        <span class="mv-brand__wordmark">
            <span class="mv-brand__first">maa</span>
            <span class="mv-brand__second">Vojo</span>
        </span>

        <span class="mv-slogan">
            Entwicklung ist ein Weg zur Lösung.
        </span>

    </span>

</a>
