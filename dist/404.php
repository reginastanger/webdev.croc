<?php /*
  * Fehlerseite 404 - Seite nicht gefunden
  * Template kann beliebig angepasst werden
  * "get_header()" & "get_footer()" sind die einzigen beiden Funktionen die notwendig sind
  * https://developer.wordpress.org/themes/basics/template-hierarchy/
 */ ?>
<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>
<main id="content" class="error">
	<div class="container">
		<h1><?php _e('Oops, Seite nicht gefunden', 'regi'); ?></h1>
		<p><?php _e('Leider ist diese Seite zur Zeit nicht verfügbar, versuchen Sie es später nocheinmal', 'wifi');?></p>
		<div class="btn-bar">
            <?php /* Link zur Startseite
            * Die WordPress Funktion "home_url()" gibt die URL zur Startseite zurück
            */ ?>
			<a class="btn" href="<?php echo home_url(); ?>"><?php _e('Zur Startseite', 'regi');?></a>
		</div>
	</div>
</main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>
