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
			return '
			<div class="prefeitura-footer-brand">
				<svg width="44" height="48" viewBox="0 0 44 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M22 2L4 8V22C4 33 11.5 43.5 22 46C32.5 43.5 40 33 40 22V8L22 2Z" stroke="white" stroke-width="2" fill="none"/>
					<path d="M22 6L8 11V22C8 30.5 14 38.5 22 41C30 38.5 36 30.5 36 22V11L22 6Z" fill="rgba(255,255,255,0.15)"/>
					<rect x="18" y="14" width="8" height="6" fill="white"/>
					<path d="M14 24H30M14 28H30M14 32H26" stroke="white" stroke-width="2" stroke-linecap="round"/>
				</svg>
				<span class="prefeitura-footer-title">PREFEITURA DE<br><strong>SÃO PAULO</strong></span>
			</div>';

		default:
			return '';
	}
}
