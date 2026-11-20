
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

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

// Joomla-Anwendung
$app = Factory::getApplication();

// Web Asset Manager
$wa = $this->getWebAssetManager();

// CSS-Assets laden
$wa->useStyle('wiwento.style');
$wa->useStyle('maavojo.style');

// JavaScript-Assets laden
$wa->useScript('maavojo.script');

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>"
      dir="<?php echo $this->direction; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body>

    <!-- ======================================================
         HEADER TOP
    ======================================================= -->

    <div class="site-header__top">

        <div class="wiw-container">

            <jdoc:include type="modules" name="topbar" style="none" />

        </div>

    </div>


    <!-- ======================================================
         HEADER
    ======================================================= -->

    <header class="site-header">

        <div class="wiw-container">

            <div class="site-header__main wiw-grid wiw-align-items-center">

                <!-- Mobiles Branding -->

                <div class="site-header__brand--mobile wiw-col-8">

                    <?php require __DIR__ . '/includes/mobile_brand.php'; ?>

                </div>


                <!-- Desktop Branding -->

                <div class="site-header__brand--desktop wiw-col-8 wiw-col-md-3">

                    <?php require __DIR__ . '/includes/brand.php'; ?>

                </div>


                <!-- Hauptnavigation -->

                <nav
                    class="site-header__navigation wiw-col-md-8 wiw-hidden-below-md"
                    data-wiw-nav
                    data-wiw-current="manual"
                    aria-label="Hauptnavigation"
                >

                    <jdoc:include type="modules" name="menu" style="none" />

                </nav>


                <!-- Header Actions -->

                <div class="site-header__actions wiw-col-4 wiw-col-md-1">

                    <div class="wiw-cluster wiw-justify-content-end">

                        <!-- Suche -->

                        <jdoc:include type="modules" name="search" style="none" />

                        <!-- Mobiler Menüschalter -->

                        <?php require __DIR__ . '/includes/mobile_menu.php'; ?>

                    </div>

                </div>

            </div>

        </div>

    </header>


     <!-- ======================================================
         OFFCANVAS NAVIGATION
    ======================================================= -->

    <!-- Backdrop -->
    <div
        class="wiw-offcanvas-backdrop"
        data-wiw-offcanvas-backdrop="site-offcanvas"
        aria-hidden="true"
        hidden
    ></div>


    <!-- Offcanvas Panel -->
    <aside
        class="wiw-offcanvas"
        id="site-offcanvas"
        data-wiw-offcanvas
        aria-label="Mobile Navigation"
        aria-hidden="true"
        inert
    >

        <!-- Offcanvas Header -->
        <div class="wiw-offcanvas__header">

            <div class="wiw-offcanvas__brand">
                maaVojo
            </div>

            <button
                class="wiw-offcanvas__close"
                type="button"
                data-wiw-offcanvas-close
                aria-label="Menü schließen"
            >
                <span aria-hidden="true">&times;</span>
            </button>

        </div>


        <!-- Offcanvas Navigation -->
        <nav
            class="wiw-offcanvas__nav"
            data-wiw-nav
            data-wiw-current="auto"
            aria-label="Mobile Hauptnavigation"
        >

            <jdoc:include type="modules" name="offcanvas" style="none" />

        </nav>


        <!-- Offcanvas Footer -->
        <div class="wiw-offcanvas__footer">

        </div>

    </aside>


    <!-- ======================================================
         HERO
    ======================================================= -->

    <section class="site-hero">

        <div class="wiw-container">

            <div class="hero-site__main">

                <p class="hero-site__eyebrow">
                    ENTWICKLUNG · KONZEPT · UMSETZUNG
                </p>

                <h1 class="hero-site__title">

                    <span class="hero-site__title_fir">
                        Entwicklung ist ein
                    </span>

                    <span class="hero-site__title_sec">
                        Weg zur Lösung.
                    </span>

                </h1>

                <p class="hero-site__description">
                    Konzeption, Webentwicklung und praxisnahe Lösungen –
                    unabhängig, strukturiert und mit einem klaren Ziel:
                    Ideen in funktionierende Ergebnisse zu verwandeln.
                </p>

                <div class="hero-site__actions">

                </div>

            </div>

        </div>

    </section>


    <!-- ======================================================
         MAIN TOP
    ======================================================= -->

    <div class="main-top">

        <div class="wiw-container">

            <jdoc:include type="modules" name="main-top" style="none" />

        </div>

    </div>


    <!-- ======================================================
         MAIN CONTENT
    ======================================================= -->

    <main class="site-main">

        <div class="wiw-container">

            <div class="site-main__layout wiw-grid">

                <!-- Sidebar Navigation -->

                <aside
                    class="site-sidebar wiw-col-12 wiw-col-md-3"
                    aria-label="Seitennavigation"
                >

                    <nav
                        class="site-sidebar__navigation"
                        data-wiw-nav
                        data-wiw-current="manual"
                        aria-label="Seitennavigation"
                    >
                        <jdoc:include type="modules" name="sidebar" style="none" />
                    </nav>

                </aside>


                <!-- Main Content -->

                <section class="site-main__section site-main__content wiw-col-12 wiw-col-md-9">

                    <jdoc:include type="message" />

                    <jdoc:include type="component" />

                </section>

            </div>

        </div>

    </main>


    <!-- ======================================================
         MAIN BOTTOM
    ======================================================= -->

    <div class="main-bottom">

        <div class="wiw-container">

            <jdoc:include type="modules" name="main-bottom" style="none" />

        </div>

    </div>


    <!-- ======================================================
         FOOTER
    ======================================================= -->

    <footer class="site-footer">


        <!-- Footer Top -->

        <div class="site-footer__top">

            <div class="wiw-container">

            </div>

        </div>


        <!-- Footer Main -->

        <div class="site-footer__main">

            <div class="wiw-container">

                <div class="wiw-grid wiw-align-items-center">


                    <!-- Branding -->

                    <div class="site-footer__brand wiw-col-12 wiw-col-lg-3">

                        <?php require __DIR__ . '/includes/brand.php'; ?>

                    </div>


                    <!-- Footer Navigation -->

                    <div class="site-footer__navigation-area wiw-col-12 wiw-col-md-9 wiw-col-lg-6">

                        <div class="wiw-grid">

                            <?php require __DIR__ . '/includes/footer_navigation.php'; ?>

                        </div>

                    </div>


                    <!-- Social Media -->

                    <div class="site-footer__icons wiw-col-12 wiw-col-md-12 wiw-col-lg-3">

                                                <!-- Social Media / weitere Icons -->

                            <a class="mv-social mv-social__link" href="/" aria-label="maaVojo – Startseite">
                                <!-- github -->
                                <span class="mv-social__icongit">
                                     <img
                                        src="<?php echo \Joomla\CMS\Uri\Uri::root(); ?>media/templates/site/maavojo/icons_webp/github-white-icon.webp"
                                        alt="GitHub"
>
                                </span>
                            </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- Footer Bottom -->

        <?php require_once __DIR__ . '/includes/footer_bottom.php'; ?>


        <!-- Footer Modules -->

        <jdoc:include type="modules" name="footer" style="none" />

    </footer>

</body>

</html>
