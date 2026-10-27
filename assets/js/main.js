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
		   1. BARRA AZUL ATIVA DINÂMICA (INDICADOR DE NAVEGAÇÃO)
		   ========================================================================== */
		var navItems = document.querySelectorAll('.main-navigation .nav-item:not(.nav-item-mobile-cta)');
		var currentPath = window.location.pathname.replace(/\/$/, '');

		// Ativa automaticamente o item correspondente à página atual
		navItems.forEach(function (item) {
			var link = null;
			var trigger = null;

			// Procura link e trigger diretos através dos filhos imediatos (compatível com todos os navegadores)
			for (var i = 0; i < item.children.length; i++) {
				var child = item.children[i];
				if (child.tagName === 'A' && !link) {
					link = child;
				}
				if (child.classList.contains('nav-dropdown-toggle') || child.tagName === 'A') {
					if (!trigger) trigger = child;
				}
			}

			if (link) {
				var href = link.getAttribute('href');
				if (href) {
					var linkPath = href.replace(/^https?:\/\/[^\/]+/, '').replace(/\/$/, '');
					if (linkPath === currentPath && currentPath !== '') {
						navItems.forEach(function (other) {
							other.classList.remove('current-menu-item');
							other.classList.remove('active');
						});
						item.classList.add('current-menu-item');
						item.classList.add('active');
					}
				}
			}

			if (trigger) {
				trigger.addEventListener('click', function () {
					navItems.forEach(function (other) {
						other.classList.remove('current-menu-item');
						other.classList.remove('active');
					});
					item.classList.add('current-menu-item');
					item.classList.add('active');
				});
			}
		});

		/* ==========================================================================
		   2. HEADER DROPDOWNS & MEGA MENU (HOVER INTENT COM BUFFER + CLIQUE)
		   ========================================================================== */
		var dropdownItems = document.querySelectorAll('.nav-item-has-dropdown');
		var hoverTimeouts = {};

		dropdownItems.forEach(function (item, index) {
			var btn = item.querySelector('.nav-dropdown-toggle');
			var menu = item.querySelector('.mega-menu-dropdown, .nav-dropdown-menu');
			if (!btn) return;

			function openDropdown() {
				clearTimeout(hoverTimeouts[index]);
				dropdownItems.forEach(function (other, otherIndex) {
					if (other !== item) {
						other.classList.remove('open');
						var otherBtn = other.querySelector('.nav-dropdown-toggle');
						if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
					}
				});
				item.classList.add('open');
				btn.setAttribute('aria-expanded', 'true');
			}

			function closeDropdownWithDelay() {
				clearTimeout(hoverTimeouts[index]);
				hoverTimeouts[index] = setTimeout(function () {
					item.classList.remove('open');
					btn.setAttribute('aria-expanded', 'false');
				}, 280);
			}

			// Hover intent no desktop
			item.addEventListener('mouseenter', function () {
				if (window.innerWidth > 1024) openDropdown();
			});
			item.addEventListener('mouseleave', function () {
				if (window.innerWidth > 1024) closeDropdownWithDelay();
			});

			if (menu) {
				menu.addEventListener('mouseenter', function () {
					if (window.innerWidth > 1024) openDropdown();
				});
				menu.addEventListener('mouseleave', function () {
					if (window.innerWidth > 1024) closeDropdownWithDelay();
				});
			}

			// Alternância por clique
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				var wasOpen = item.classList.contains('open');

				dropdownItems.forEach(function (other) {
					if (other !== item) {
						other.classList.remove('open');
						var otherBtn = other.querySelector('.nav-dropdown-toggle');
						if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
					}
				});

				var isOpen = !wasOpen;
				item.classList.toggle('open', isOpen);
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
		   3. MENU MOBILE TOGGLE (TABLETS & CELULARES)
		   ========================================================================== */
		var mobileToggle = document.getElementById('mobile-menu-toggle');
		var siteHeader = document.getElementById('masthead');

		if (mobileToggle && siteHeader) {
			function toggleMobileMenu(e) {
				if (e) {
					e.preventDefault();
					e.stopPropagation();
				}
				var isOpen = siteHeader.classList.toggle('mobile-menu-open');
				mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
				document.body.classList.toggle('mobile-nav-active', isOpen);
			}

			mobileToggle.addEventListener('click', toggleMobileMenu);

			// Fecha ao clicar em qualquer link de navegação interno
			var navLinks = siteHeader.querySelectorAll('.main-navigation a');
			navLinks.forEach(function (link) {
				link.addEventListener('click', function () {
					if (siteHeader.classList.contains('mobile-menu-open')) {
						siteHeader.classList.remove('mobile-menu-open');
						document.body.classList.remove('mobile-nav-active');
						mobileToggle.setAttribute('aria-expanded', 'false');
					}
				});
			});

			// Fecha ao clicar fora do cabeçalho
			document.addEventListener('click', function (e) {
				if (siteHeader.classList.contains('mobile-menu-open') && !siteHeader.contains(e.target)) {
					siteHeader.classList.remove('mobile-menu-open');
					document.body.classList.remove('mobile-nav-active');
					mobileToggle.setAttribute('aria-expanded', 'false');
				}
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
