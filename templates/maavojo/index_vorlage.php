
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>maaVojo – Entwicklung ist ein Weg zur Lösung.</title>

    <!-- WIWENTO Framework -->
    <link
        rel="stylesheet"
        href="vendor/wiwento/css/wiwento.min.css"
    >

    <!-- maaVojo Template -->
    <link
        rel="stylesheet"
        href="css/template.css"
    >
</head>

<body>

    <!-- ==========================================
         HEADER
    =========================================== -->

    <div class="site-header__top">
         <div class="wiw-container">
            
        </div>  
    </div>
    
    <header class="site-header">

        <div class="wiw-container">

            <div class="site-header__main wiw-grid wiw-align-items-center">
            
                <!-- Mobiles Branding -->
                <div class="site-header__brand--mobile wiw-col-8">
                    <?php require __DIR__ . '/includes/mobile_brand.php'; ?>
                </div>
            
            
                <div class="site-header__brand--desktop wiw-col-8 wiw-col-md-3">
                    <!-- Branding -->
                    <?php require __DIR__ . '/includes/brand.php' ?>
                </div>


                <!-- Hauptnavigation -->
                <nav class=" site-header__navigation wiw-col-md-8 wiw-hidden-below-md" aria-label="Hauptnavigation">
                    <ul class="wiw-cluster vjo-navigation-first">
                        <li>Start</li>
                        <li>Projekte </li>
                        <li>Wissenswerk</li>
                        <li>Wiwento</li>
                        <li>Sampfchroniken </li>
                        <li>Über mich</li>
                    </ul>
                </nav>

                <!-- Header Actions -->
                <div class=" site-header__actions wiw-col-4 wiw-col-md-1">

                    <div class="wiw-cluster wiw-justify-content-end">

                        <!-- Suche -->
                        <button class="site-header__search-toggle" type="button" aria-label="Suche öffnen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search preview-icon"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                        </button>

                        <!-- Mobiler Menüschalter -->
                        <?php require __DIR__ . '/includes/mobile_menu.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- ==========================================
        OFFCANVAS NAVIGATION
    =========================================== -->

    <div
        class="wiw-offcanvas-backdrop"
        aria-hidden="true"
    ></div>

    <aside
        class="wiw-offcanvas"
        id="site-offcanvas"
        aria-label="Mobile Navigation"
        aria-hidden="true"
    >

        <!-- Offcanvas Header -->
        <div class="wiw-offcanvas__header">

            <div class="wiw-offcanvas__brand">
                maaVojo
            </div>

            <button
                class="wiw-offcanvas__close"
                type="button"
                aria-label="Menü schließen"
            >
                Schließen
            </button>

        </div>

        <!-- Offcanvas Navigation -->
        <nav
            class="wiw-offcanvas__nav"
            aria-label="Mobile Hauptnavigation"
        >
            <!-- Navigation wird hier eingebunden -->
        </nav>

        <!-- Offcanvas Footer -->
        <div class="wiw-offcanvas__footer">
            <!-- Zusätzliche Links -->
        </div>

    </aside>

    <!-- ==========================================
         hero
    =========================================== -->
    <section class="site-hero">

        <div class="wiw-container">

            <div class="hero-site__main">

                <!-- Eyebrow -->
                <p class="hero-site__eyebrow">
                    ENTWICKLUNG · KONZEPT · UMSETZUNG
                </p>

                <!-- Überschrift -->
                <h1 class="hero-site__title">
                    <span class="hero-site__title_fir">Entwicklung ist ein</span>
                    <span class="hero-site__title_sec">Weg zur Lösung.</span>
                </h1>

                <!-- Beschreibung -->
                <p class="hero-site__description">
                    Konzeption, Webentwicklung und praxisnahe Lösungen –
                    unabhängig, strukturiert und mit einem klaren Ziel:
                    Ideen in funktionierende Ergebnisse zu verwandeln.
                </p>

                <!-- Aktionen -->
                <div class="hero-site__actions">
                    <!-- Buttons ergänzen wir später -->
                </div>

            </div>

        </div>

    </section>

    <!-- ==========================================
         MAIN TOP
    =========================================== -->

    <div class="main-top">

        <div class="wiw-container">
           <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
           </p>
            
        </div>


    </div>

    <!-- ==========================================
         MAIN CONTENT
    =========================================== -->

    <main class="site-main">

        <div class="wiw-container">

            <!-- Seiteninhalt -->

            <section class="site-main__section">

                <!-- Inhalt der ersten Section -->

            </section>

        </div>

    </main>

    <!-- ==========================================
         MAIN BOTTOM
    =========================================== -->

    <div class="main-bottom">

        <div class="wiw-container">

            <!-- Optionaler Abschlussbereich -->

        </div>

    </div>

    <!-- ==========================================
         FOOTER
    =========================================== -->

    <footer class="site-footer">

        <!-- Footer Top -->
        <div class="site-footer__top">

            <div class="wiw-container">

                <!-- Inhalt Footer Top -->

            </div>

        </div>
        
        <!-- Footer Main -->
        <div class="site-footer__main">

            <div class="wiw-container">

                <div class="wiw-grid wiw-align-items-center">

                    <!-- Branding -->
                    <div class="site-footer__brand wiw-col-12 wiw-col-lg-3">

                        <?php require __DIR__ . '/includes/brand.php' ?>

                    </div>

                    <!-- Footer Navigation -->
                    <div class="site-footer__navigation-area wiw-col-12 wiw-col-md-9 wiw-col-lg-6" >

                        <div class="wiw-grid">

                            <?php require __DIR__ . '/includes/footer_navigation.php' ?>

                        </div>

                    </div>

                    <!-- Icon Bar -->
                    <div class="site-footer__icons wiw-col-12 wiw-col-md-12 wiw-col-lg-3">

                            <!-- Social Media / weitere Icons -->

                            <a class="mv-social mv-social__link" href="/" aria-label="maaVojo – Startseite">
                                <!-- github -->
                                <span class="mv-social__icongit">
                                    <img src="assets/icons_webp/github-white-icon.webp" alt="">
                                </span>
                            </a>

                    </div>

                    </div>

                </div>

            </div>

        <!-- Footer Bottom -->
         <?php require_once __DIR__ . '/includes/footer_bottom.php' ?>
       
    </footer>

    <!-- ==========================================
         JAVASCRIPT
    =========================================== -->

    <script
        type="module"
        src="/vendor/wiwento/js/wiwento.mjs"
    ></script>

</body>
</html>

