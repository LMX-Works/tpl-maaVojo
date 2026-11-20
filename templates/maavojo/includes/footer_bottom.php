<?php
/**
 * ============================================================
 * @package     maaVojo
 * @version     0.1.0
 * @author      maaVojo
 * @copyright   Copyright (C) 2026 maaVojo
 * ============================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

// Aktuelles Jahr anhand der Joomla-Zeitzone ermitteln.
$app = Factory::getApplication();
$year = Factory::getDate('now', $app->getConfig()->get('offset'))->format('Y');
?>

<div class="site-footer__bottom">

    <div class="wiw-container">

        <!-- Inhalt Footer Bottom -->
        <div class="wiw-grid">

            <div class="wiw-col-12 wiw-col-md-5 wiw-col-lg-4 mv-footer__copyright-col">
                <p class="mv-footer__copyright">
                    © <?php echo $year; ?>

                    <span class="mv-fob-brand-first">maa</span>
                    <span class="mv-fob-brand-second">Vojo</span>.

                    Alle Rechte vorbehalten.
                </p>
            </div>

            <div class="wiw-col-12 wiw-col-md-4 wiw-col-lg-4 mv-footer__version-col">
                <p class="mv-footer__version">
                    Version 1.0.0
                </p>
            </div>

            <div class="wiw-col-12 wiw-col-md-3 wiw-col-lg-4 mv-footer__developed-col">
                <p class="mv-footer__developed">
                    Mit

                    <span class="mv-footer__heart" aria-hidden="true">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="#f71808"
                            stroke="none"
                        >
                            <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                        </svg>
                    </span>

                    in Hamm entwickelt.
                </p>
            </div>

        </div>
    </div>
</div>