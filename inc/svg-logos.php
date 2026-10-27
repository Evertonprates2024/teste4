<?php
/**
 * Vector SVG Logos & Program Badges for ADE SAMPA 2025 Theme
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the HTML/SVG markup for the requested ADE SAMPA or program logo.
 *
 * @param string $name Identifier of the logo.
 * @return string SVG/HTML markup.
 */
function ade_sampa_get_logo( $name ) {
	$theme_uri = get_template_directory_uri();

	switch ( $name ) {
		case 'ade-header':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-adesampa.png' ) . '" alt="ADE SAMPA" class="ade-header-logo-img" height="36" style="height: 36px; width: auto; max-height: 38px; max-width: 175px; object-fit: contain; display: block;" />';

		case 'ade-footer':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-adesampa-footer.png' ) . '" alt="ADE SAMPA" class="ade-footer-logo-img" height="40" style="height: 40px; width: auto; max-height: 44px; max-width: 200px; object-fit: contain; display: block;" />';

		case 'product-ensina':
			return '
			<svg class="product-app-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect width="60" height="60" rx="16" fill="#004CE8"/>
				<path d="M24 20L42 30L24 40V20Z" fill="white"/>
			</svg>';

		case 'product-data':
			return '
			<svg class="product-app-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect width="60" height="60" rx="16" fill="#004CE8"/>
				<path d="M22 18H34C39.5228 18 44 22.4772 44 28V32C44 37.5228 39.5228 42 34 42H22V18Z" stroke="white" stroke-width="4.5" stroke-linejoin="round"/>
				<rect x="22" y="26" width="6" height="16" fill="white"/>
			</svg>';

		case 'product-gestao':
			return '
			<svg class="product-app-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect width="60" height="60" rx="16" fill="#004CE8"/>
				<circle cx="30" cy="30" r="14" stroke="white" stroke-width="4.5"/>
				<path d="M30 24V30H36" stroke="white" stroke-width="4" stroke-linecap="round"/>
			</svg>';

		case 'check-circle':
			return '
			<svg class="check-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="11" cy="11" r="11" fill="#004CE8"/>
				<path d="M6.5 11L9.5 14L15.5 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>';

		case 'brasao-prefeitura-white':
			$logo_url = get_template_directory_uri() . '/assets/images/logo-prefeitura-sp.png';
			return '<a href="https://capital.sp.gov.br" target="_blank" rel="noopener noreferrer" class="prefeitura-footer-brand" aria-label="' . esc_attr__( 'Prefeitura do Município de São Paulo', 'tema-ade-sampa' ) . '">
				<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr__( 'Prefeitura do Município de São Paulo', 'tema-ade-sampa' ) . '" class="prefeitura-footer-img" width="160" height="48" loading="lazy">
			</a>';

		default:
			return '';
	}
}
