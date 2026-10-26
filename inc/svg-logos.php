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
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-adesampa.png' ) . '" alt="ADE SAMPA" class="ade-header-logo-img" />';

		case 'ade-footer':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-adesampa-footer.png' ) . '" alt="ADE SAMPA" class="ade-footer-logo-img" />';

		case 'contrata-sp':
			return '
			<div class="prog-logo prog-logo-contrata">
				<svg class="prog-icon" width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="4" y="10" width="32" height="24" rx="4" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M12 22H28M12 27H22" stroke="#13E2DE" stroke-width="2.5" stroke-linecap="round"/>
					<circle cx="38" cy="34" r="11" fill="#13E2DE" fill-opacity="0.25" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M34 34L37 37L43 31" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">CONTRATA<strong>SP</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'descomplica-sp':
			return '
			<div class="prog-logo prog-logo-descomplica">
				<svg class="prog-icon" width="56" height="54" viewBox="0 0 56 54" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 10H44C47.3137 10 50 12.6863 50 16V34C50 37.3137 47.3137 40 44 40H24L14 48V40H12C8.68629 40 6 37.3137 6 34V16C6 12.6863 8.68629 10 12 10Z" fill="#13E2DE" fill-opacity="0.3" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M20 26C21.5 29.5 24.5 31 28 31C31.5 31 34.5 29.5 36 26" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
					<circle cx="21" cy="20" r="2" fill="#1D428A"/>
					<circle cx="35" cy="20" r="2" fill="#1D428A"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">DESCOMPLICA<strong>SP</strong></span>
					<span class="prog-sub-caption">SÃO PAULO MAIS FÁCIL</span>
				</div>
			</div>';

		case 'teia':
			return '
			<div class="prog-logo prog-logo-white">
				<svg class="prog-icon" width="68" height="64" viewBox="0 0 68 64" fill="none" xmlns="http://www.w3.org/2000/svg">
					<line x1="16" y1="32" x2="34" y2="14" stroke="#13E2DE" stroke-width="2.5"/>
					<line x1="34" y1="14" x2="52" y2="28" stroke="#13E2DE" stroke-width="2.5"/>
					<line x1="16" y1="32" x2="32" y2="48" stroke="#13E2DE" stroke-width="2.5"/>
					<line x1="32" y1="48" x2="52" y2="28" stroke="#13E2DE" stroke-width="2.5"/>
					<line x1="16" y1="32" x2="52" y2="28" stroke="#13E2DE" stroke-width="2"/>
					<line x1="34" y1="14" x2="32" y2="48" stroke="#13E2DE" stroke-width="2"/>
					<circle cx="16" cy="32" r="6" fill="#2D5596" stroke="#FFFFFF" stroke-width="2.5"/>
					<circle cx="34" cy="14" r="6" fill="#13E2DE" stroke="#FFFFFF" stroke-width="2.5"/>
					<circle cx="52" cy="28" r="7" fill="#13E2DE" stroke="#FFFFFF" stroke-width="2.5"/>
					<circle cx="32" cy="48" r="6" fill="#2D5596" stroke="#FFFFFF" stroke-width="2.5"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-white prog-title-xl">TEIA</span>
					<span class="prog-by-badge prog-by-white">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'sampacast':
			return '
			<div class="prog-logo prog-logo-white">
				<svg class="prog-icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="23" y="10" width="18" height="28" rx="9" stroke="#13E2DE" stroke-width="2.8"/>
					<line x1="27" y1="18" x2="37" y2="18" stroke="#FFFFFF" stroke-width="2"/>
					<line x1="27" y1="24" x2="37" y2="24" stroke="#FFFFFF" stroke-width="2"/>
					<path d="M16 26C16 34.8366 23.1634 42 32 42C40.8366 42 48 34.8366 48 26" stroke="#FFFFFF" stroke-width="2.8" stroke-linecap="round"/>
					<line x1="32" y1="42" x2="32" y2="54" stroke="#13E2DE" stroke-width="2.8" stroke-linecap="round"/>
					<line x1="22" y1="54" x2="42" y2="54" stroke="#FFFFFF" stroke-width="2.8" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-white">SAMPA <strong>CAST</strong></span>
					<span class="prog-by-badge prog-by-white">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'sampaaudio':
			return '
			<div class="prog-logo prog-logo-white">
				<svg class="prog-icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="32" cy="32" r="24" stroke="#13E2DE" stroke-width="2.2" stroke-dasharray="4 4"/>
					<rect x="16" y="26" width="4" height="12" rx="2" fill="#13E2DE"/>
					<rect x="23" y="18" width="4" height="28" rx="2" fill="#FFFFFF"/>
					<rect x="30" y="12" width="4" height="40" rx="2" fill="#13E2DE"/>
					<rect x="37" y="20" width="4" height="24" rx="2" fill="#FFFFFF"/>
					<rect x="44" y="25" width="4" height="14" rx="2" fill="#13E2DE"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-white">SAMPA <strong>ÁUDIO</strong></span>
					<span class="prog-by-badge prog-by-white">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'sampaestudio':
			return '
			<div class="prog-logo prog-logo-white">
				<svg class="prog-icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="8" y="18" width="34" height="28" rx="5" stroke="#13E2DE" stroke-width="2.8"/>
					<path d="M42 26L56 19V45L42 38V26Z" stroke="#FFFFFF" stroke-width="2.8" stroke-linejoin="round"/>
					<circle cx="25" cy="32" r="6" stroke="#FFFFFF" stroke-width="2.2"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-white">SAMPA <strong>ESTÚDIO</strong></span>
					<span class="prog-by-badge prog-by-white">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'hub-greensampa':
			return '
			<div class="prog-logo prog-logo-card">
				<svg class="prog-icon" width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M40 12C24 12 12 22 12 38C28 38 40 28 40 12Z" fill="#13E2DE" fill-opacity="0.35" stroke="#1D428A" stroke-width="2.5" stroke-linejoin="round"/>
					<path d="M12 38L28 24" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">HUB <strong>GREEN SAMPA</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'hub-sampagames':
			return '
			<div class="prog-logo prog-logo-card">
				<svg class="prog-icon" width="54" height="52" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="6" y="14" width="42" height="26" rx="13" fill="#13E2DE" fill-opacity="0.3" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M18 23V31M14 27H22" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
					<circle cx="35" cy="24" r="2.2" fill="#1D428A"/>
					<circle cx="40" cy="29" r="2.2" fill="#1D428A"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">HUB <strong>SAMPA GAMES</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'credsampa':
			return '
			<div class="prog-logo prog-logo-cred">
				<svg class="prog-icon" width="60" height="58" viewBox="0 0 60 58" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="30" cy="24" r="14" fill="#13E2DE" fill-opacity="0.4" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M30 16V32M26 20H32C33.6569 20 35 21.3431 35 23C35 24.6569 33.6569 26 32 26H28C26.3431 26 25 27.3431 25 29C25 30.6569 26.3431 32 28 32H34" stroke="#1D428A" stroke-width="2.2" stroke-linecap="round"/>
					<path d="M12 44C18 40 26 42 36 42C42 42 48 39 50 37" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue prog-title-lg">CRED <strong>SAMPA</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'gestaosampa':
			return '
			<div class="prog-logo prog-logo-gestao">
				<svg class="prog-icon" width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="8" y="10" width="42" height="36" rx="5" fill="#13E2DE" fill-opacity="0.3" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M16 36V26M25 36V20M34 36V28M42 36V18" stroke="#1D428A" stroke-width="3" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue prog-title-lg">GESTÃO <strong>SAMPA</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'fabrica-negocios':
			return '
			<div class="prog-logo prog-logo-fabrica">
				<svg class="prog-icon" width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M29 10C20.7157 10 14 16.7157 14 25C14 30.3 16.8 34.9 21 37.5V43C21 44.6569 22.3431 46 24 46H34C35.6569 46 37 44.6569 37 43V37.5C41.2 34.9 44 30.3 44 25C44 16.7157 37.2843 10 29 10Z" fill="#13E2DE" fill-opacity="0.35" stroke="#1D428A" stroke-width="2.5"/>
					<path d="M23 50H35" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
					<path d="M25 26L28 29L34 22" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue"><strong>FÁBRICA</strong> DE NEGÓCIOS</span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'ade-ensina':
			return '<img src="' . esc_url( $theme_uri . '/assets/images/logo-ade-ensina.png' ) . '" alt="ADE SAMPA ensina" class="ade-ensina-img" />';

		case 'edital-vaitec':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M26 6L10 26H22L18 40L36 20H24L26 6Z" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2" stroke-linejoin="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-edital-kicker">ACELERAÇÃO</span>
					<span class="prog-title-blue"><strong>VAI TEC</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-sampagames':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="5" y="13" width="36" height="22" rx="11" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2"/>
					<path d="M15 20V28M11 24H19" stroke="#1D428A" stroke-width="2.2" stroke-linecap="round"/>
					<circle cx="30" cy="21" r="2" fill="#1D428A"/>
					<circle cx="34" cy="26" r="2" fill="#1D428A"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">SAMPA <strong>GAMES</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-amplificacine':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="20" cy="23" r="12" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2"/>
					<circle cx="20" cy="23" r="4" fill="#1D428A"/>
					<path d="M32 19L41 14V32L32 27V19Z" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2" stroke-linejoin="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">AMPLIFICA <strong>CINE</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-greensampa':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M36 10C22 10 10 20 10 34C24 34 36 24 36 10Z" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2"/>
					<path d="M10 34L25 21" stroke="#1D428A" stroke-width="2.2" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">GREEN <strong>SAMPA</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-rural':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M23 38V16M23 22C17 22 12 17 12 11C18 11 23 16 23 22ZM23 28C29 28 34 23 34 17C28 17 23 22 23 28Z" stroke="#1D428A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
					<circle cx="23" cy="12" r="4" fill="#13E2DE"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">SAMPA <strong>RURAL</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-textil':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="13" y="10" width="20" height="26" rx="4" fill="#13E2DE" stroke="#1D428A" stroke-width="2.2"/>
					<line x1="10" y1="10" x2="36" y2="10" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
					<line x1="10" y1="36" x2="36" y2="36" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">MODA <strong>SAMPA</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		case 'edital-hackathon':
			return '
			<div class="prog-logo prog-logo-edital">
				<svg class="prog-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M16 16L8 23L16 30M30 16L38 23L30 30M25 13L21 33" stroke="#1D428A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<div class="prog-logo-text">
					<span class="prog-title-blue">HACKA<strong>THON</strong></span>
					<span class="prog-by-badge">por <strong>ADE SAMPA</strong></span>
				</div>
			</div>';

		default:
			return '';
	}
}
