<?php /*
 * die footer.php wird auf jeder Seiten eingebunden (über die Funktion "get_footer()" in den einzelnen Templates).
 * Somit hier sollte das Markup, dass auf jeder Seite im Footer angezeigt wird, zu finden sein.
 * Am Ende sollte immer der schließende </body> und </html> Tag stehen - geöffnet werden die Tags in der Datei "header.php"
*/ ?>

<footer id="page-footer" class="container">
    <div class="columns">
        <div class="col-3 animate fade-in-up">
            <?php /*
            * Ausgabe der Social-Links
            * diese sollten grundsätzlich auch im WordPress zu konfigurieren sein - ZB. über die ACF-Otpion-Page als Wiederholungsfleld mit Text, Icon & Url oder einzelne Url-Felder
            */ ?>
            <ul class="social-links">
                <li>
                    <a href="https://www.linkedin.com/" target="_blank" rel="nofollow">
                        <span class="icon-linkedin" aria-hidden="true"></span>
                        <span class="screen-reader-text"><?php _e('Folge uns auf LinkedIn','regi');?></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/" target="_blank" rel="nofollow">
                        <span class="icon-facebook" aria-hidden="true"></span>
                        <span class="screen-reader-text"><?php _e('Folge uns auf Facebook','regi');?></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/" target="_blank" rel="nofollow">
                        <span class="icon-instagram" aria-hidden="true"></span>
                        <span class="screen-reader-text"><?php _e('Folge uns auf Instagram','regi');?></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.youtube.com/" target="_blank" rel="nofollow">
                        <span class="icon-youtube" aria-hidden="true"></span>
                        <span class="screen-reader-text"> _e('Folge uns auf YouTube','regi');?></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-3 animate fade-in-up">
            <span class="copyright">&copy; Regina Stanger</span>
        </div>
        <div class="col-3 animate fade-in-up">
            <nav id="footer-nav">
                <?php /*
                * Ausgabe des Menüs, dass im WordPress als "Footer Navigation" festgelegt wurde (Design -> Menüs oder Cusotmizer -> Menüs / Position im Theme: Checkbox "Footer Navigation")
                * https://developer.wordpress.org/reference/functions/wp_nav_menu/
                */
                wp_nav_menu(array(
                    'theme_location' => 'footer',   // wurde in der functions.php festgelegt "register_nav_menus()"
                    'container'      => false,      // true würde eine <div> um die <ul> des wp_nav_menu() erzeugen
                    'menu_class'     => 'nav-menu', // Klassenname der ul: <ul class="nav-menu">
                    'depth'          => 1,          // Anzahl der Menüebenen die ausgegeben werden
                    'fallback_cb'    => false       // wenn im WordPress kein Menü als "Footer Navigation" zugewiesen wurde (Checkbox), wird keine Navigation ausgegeben. Default wäre die Ausgebe der WordPress Funktion "wp_page_menu()" (https://developer.wordpress.org/reference/functions/wp_page_menu/)
                )); ?>
            </nav>
        </div>
    </div>
</footer>
<?php wp_footer(); //erlaubt WordPress und den installierten Plugins hier Code (Scripten, HTML, etc.) auszugeben ?>
</body>
</html>