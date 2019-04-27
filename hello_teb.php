<?php
/**
 * @package Hello_teb
 * @version 1.1.1
 */
/*
Plugin Name: Hello Teb
Plugin URI: http://wordpress.org/plugins/hello-teb/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Piotr Piotr
Version: 1.1.1
*/

function hello_teb_get_lyric() {
	/** These are the lyrics to Hello Teb */
	$lyrics = "Hello, Teb
	We all came out to Montreux
	On the Lake Geneva shoreline
	To make records with a mobile
	We didn't have much time
	Frank Zappa and the Mothers
	Were at the best place around
	But some stupid with a flare gun
	Burned the place to the ground
	Smoke on the water, fire in the sky
	Smoke on the water
	They burned down the gambling house
	It died with an awful sound
	Funky Claude was running in and out
	Pulling kids out the ground
	When it all was over
	We had to find another place
	But Swiss time was running out
	It seemed that we would lose the race
	Smoke on the water, fire in the sky
	Smoke on the water
	We ended up at the Grand hotel
	It was…;";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_teb() {
	$chosen = hello_teb_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_teb' );

// We need some CSS to position the paragraph.
function teb_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #teb {
		float: left;
	}
	.block-editor-page #teb {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #teb {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'teb_css' );
