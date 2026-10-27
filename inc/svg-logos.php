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
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-produto-ensina.png' ) . '" alt="' . esc_attr__( 'Sampa Ensina', 'tema-ade-sampa' ) . '" class="product-app-icon" width="48" height="48" loading="lazy" />';

		case 'product-data':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-produto-data.png' ) . '" alt="' . esc_attr__( 'Data Sampa', 'tema-ade-sampa' ) . '" class="product-app-icon" width="48" height="48" loading="lazy" />';

		case 'product-gestao':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-produto-gestao.png' ) . '" alt="' . esc_attr__( 'Gestão Sampa', 'tema-ade-sampa' ) . '" class="product-app-icon" width="48" height="48" loading="lazy" />';

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
