/**
 * ADE SAMPA 2025 Theme Interactive Scripts
 * - Transparência Dropdown Navigation
 * - Mobile Navigation Drawer
 * - Espaços de Trabalho Tabs (Teia, Sampa Cast, Sampa Audio, Sampa Estúdio)
 * - Editais Category Filter Pills & Carousel Slider (1 --- 12)
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		/* ==========================================================================
		   1. TRANSPARÊNCIA DROPDOWN & MOBILE MENU
		   ========================================================================== */
		var dropdownItem = document.getElementById('nav-transparencia');
		var dropdownBtn = dropdownItem ? dropdownItem.querySelector('.nav-dropdown-toggle') : null;

		if (dropdownItem && dropdownBtn) {
			dropdownBtn.addEventListener('click', function (e) {
				e.stopPropagation();
				var isOpen = dropdownItem.classList.toggle('open');
				dropdownBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			});

			document.addEventListener('click', function (e) {
				if (!dropdownItem.contains(e.target)) {
					dropdownItem.classList.remove('open');
					dropdownBtn.setAttribute('aria-expanded', 'false');
				}
			});

			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape') {
					dropdownItem.classList.remove('open');
					dropdownBtn.setAttribute('aria-expanded', 'false');
				}
			});
		}

		var mobileToggle = document.getElementById('mobile-menu-toggle');
		var siteHeader = document.getElementById('masthead');
		if (mobileToggle && siteHeader) {
			mobileToggle.addEventListener('click', function () {
				var expanded = siteHeader.classList.toggle('mobile-menu-open');
				mobileToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
			});
		}

		/* ==========================================================================
		   2. ESPAÇOS DE TRABALHO INTERACTIVE TABS
		   ========================================================================== */
		var tabButtons = document.querySelectorAll('.espacos-tab-btn');
		var tabPanels = document.querySelectorAll('.espacos-tab-panel');

		if (tabButtons.length && tabPanels.length) {
			tabButtons.forEach(function (btn) {
				btn.addEventListener('click', function () {
					var targetTab = btn.getAttribute('data-tab');

					tabButtons.forEach(function (b) {
						var isCurrent = b === btn;
						b.classList.toggle('active', isCurrent);
						b.setAttribute('aria-selected', isCurrent ? 'true' : 'false');
					});

					tabPanels.forEach(function (panel) {
						var isMatch = panel.getAttribute('data-panel') === targetTab;
						if (isMatch) {
							panel.removeAttribute('hidden');
							panel.classList.add('active');
						} else {
							panel.setAttribute('hidden', 'hidden');
							panel.classList.remove('active');
						}
					});
				});
			});
		}

		/* ==========================================================================
		   3. EDITAIS CATEGORY FILTER PILLS & CAROUSEL SLIDER
		   ========================================================================== */
		var filterPills = document.querySelectorAll('.edital-filter-pill');
		var track = document.getElementById('editais-track');
		var prevBtn = document.getElementById('edital-prev');
		var nextBtn = document.getElementById('edital-next');
		var currentNumEl = document.getElementById('edital-current-num');
		var totalNumEl = document.getElementById('edital-total-num');

		if (track) {
			var allCards = Array.prototype.slice.call(track.querySelectorAll('.edital-card'));
			var currentIndex = 0;

			function getVisibleCards() {
				return allCards.filter(function (c) {
					return !c.classList.contains('is-filtered-out');
				});
			}

			function updateCarousel() {
				var visibleCards = getVisibleCards();
				var total = visibleCards.length;

				if (currentIndex >= total) {
					currentIndex = Math.max(0, total - 1);
				}
				if (currentIndex < 0) {
					currentIndex = 0;
				}

				if (visibleCards.length > 0) {
					var firstCard = visibleCards[0];
					var cardStyle = window.getComputedStyle(firstCard);
					var cardWidth = firstCard.offsetWidth;
					var gap = parseFloat(window.getComputedStyle(track).gap) || 28;
					var maxScrollIndex = Math.max(0, total - 1);
					var clampedIndex = Math.min(currentIndex, maxScrollIndex);
					var offset = clampedIndex * (cardWidth + gap);
					track.style.transform = 'translateX(-' + offset + 'px)';
				} else {
					track.style.transform = 'translateX(0px)';
				}

				if (currentNumEl) {
					currentNumEl.textContent = total > 0 ? String(currentIndex + 1) : '0';
				}
				if (totalNumEl) {
					totalNumEl.textContent = String(total);
				}
			}

			filterPills.forEach(function (pill) {
				pill.addEventListener('click', function () {
					var selectedCat = pill.getAttribute('data-filter');

					filterPills.forEach(function (p) {
						var active = p === pill;
						p.classList.toggle('active', active);
						p.setAttribute('aria-selected', active ? 'true' : 'false');
					});

					allCards.forEach(function (card) {
						var cardCat = card.getAttribute('data-category');
						var show = selectedCat === 'GERAL' || cardCat === selectedCat;
						card.classList.toggle('is-filtered-out', !show);
					});

					currentIndex = 0;
					updateCarousel();
				});
			});

			if (prevBtn) {
				prevBtn.addEventListener('click', function () {
					var visibleCards = getVisibleCards();
					if (visibleCards.length === 0) return;
					currentIndex = currentIndex > 0 ? currentIndex - 1 : visibleCards.length - 1;
					updateCarousel();
				});
			}

			if (nextBtn) {
				nextBtn.addEventListener('click', function () {
					var visibleCards = getVisibleCards();
					if (visibleCards.length === 0) return;
					currentIndex = currentIndex < visibleCards.length - 1 ? currentIndex + 1 : 0;
					updateCarousel();
				});
			}

			window.addEventListener('resize', updateCarousel);
			updateCarousel();
		}
	});
})();
