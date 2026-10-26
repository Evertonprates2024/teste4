/**
 * ADE SAMPA 2025 Theme Interactive Scripts (Vanilla ES6+)
 * - Header Dropdown Menus (Programas, Imprensa)
 * - Mobile Navigation Drawer
 * - Destaques e Oportunidades Native Carousel (Prev/Next, Dots, Touch Swipe)
 *
 * @package Tema_ADE_Sampa
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		/* ==========================================================================
		   1. HEADER DROPDOWNS (PROGRAMAS & IMPRENSA)
		   ========================================================================== */
		var dropdownItems = document.querySelectorAll('.nav-item-has-dropdown');

		dropdownItems.forEach(function (item) {
			var btn = item.querySelector('.nav-dropdown-toggle');
			if (!btn) return;

			btn.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				// Fecha outros abertos
				dropdownItems.forEach(function (other) {
					if (other !== item) {
						other.classList.remove('open');
						var otherBtn = other.querySelector('.nav-dropdown-toggle');
						if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
					}
				});

				var isOpen = item.classList.toggle('open');
				btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			});
		});

		// Fecha dropdown ao clicar fora ou pressionar ESC
		document.addEventListener('click', function (e) {
			dropdownItems.forEach(function (item) {
				if (!item.contains(e.target)) {
					item.classList.remove('open');
					var btn = item.querySelector('.nav-dropdown-toggle');
					if (btn) btn.setAttribute('aria-expanded', 'false');
				}
			});
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				dropdownItems.forEach(function (item) {
					item.classList.remove('open');
					var btn = item.querySelector('.nav-dropdown-toggle');
					if (btn) btn.setAttribute('aria-expanded', 'false');
				});
			}
		});

		/* ==========================================================================
		   2. MENU MOBILE TOGGLE
		   ========================================================================== */
		var mobileToggle = document.getElementById('mobile-menu-toggle');
		var siteHeader = document.getElementById('masthead');

		if (mobileToggle && siteHeader) {
			mobileToggle.addEventListener('click', function () {
				var isOpen = siteHeader.classList.toggle('mobile-menu-open');
				mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			});
		}

		/* ==========================================================================
		   3. CARROSSEL DE DESTAQUES E OPORTUNIDADES
		   ========================================================================== */
		var track = document.getElementById('oportunidades-track');
		var prevBtn = document.getElementById('oportunidades-prev');
		var nextBtn = document.getElementById('oportunidades-next');
		var dotsContainer = document.getElementById('oportunidades-dots');

		if (track) {
			var cards = track.querySelectorAll('.oportunidade-card');
			var dots = dotsContainer ? dotsContainer.querySelectorAll('.dot') : [];
			var currentIndex = 0;
			var totalCards = cards.length;

			function updateCarousel(index) {
				if (index < 0) index = 0;
				if (index >= totalCards) index = totalCards - 1;
				currentIndex = index;

				// Scroll do viewport
				if (cards[currentIndex]) {
					var cardLeft = cards[currentIndex].offsetLeft;
					track.scrollTo({
						left: cardLeft,
						behavior: 'smooth'
					});
				}

				// Atualiza visual dos dots
				dots.forEach(function (dot, i) {
					if (i === currentIndex) {
						dot.classList.add('active');
						dot.setAttribute('aria-selected', 'true');
					} else {
						dot.classList.remove('active');
						dot.setAttribute('aria-selected', 'false');
					}
				});
			}

			if (prevBtn) {
				prevBtn.addEventListener('click', function () {
					updateCarousel(currentIndex - 1);
				});
			}

			if (nextBtn) {
				nextBtn.addEventListener('click', function () {
					updateCarousel(currentIndex + 1);
				});
			}

			dots.forEach(function (dot, i) {
				dot.addEventListener('click', function () {
					updateCarousel(i);
				});
			});

			// Suporte a Touch Swipe em Mobile
			var startX = 0;
			var endX = 0;

			track.addEventListener('touchstart', function (e) {
				startX = e.changedTouches[0].screenX;
			}, { passive: true });

			track.addEventListener('touchend', function (e) {
				endX = e.changedTouches[0].screenX;
				var diff = startX - endX;
				if (Math.abs(diff) > 40) {
					if (diff > 0) {
						updateCarousel(currentIndex + 1);
					} else {
						updateCarousel(currentIndex - 1);
					}
				}
			}, { passive: true });
		}
	});
})();
