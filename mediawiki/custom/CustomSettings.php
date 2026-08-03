<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

$logoUrl = getenv( 'MEDIAWIKI_LOGO_URL' ) ?: 'https://preservemygames.org/static/img/logo.svg';

$wgLogos = [
	'icon' => $logoUrl,
	'1x' => $logoUrl,
];
