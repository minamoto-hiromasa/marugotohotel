import Glide from '@glidejs/glide';
import ScrollMagic from 'scrollmagic';
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';

gsap.registerPlugin(ScrollToPlugin);

import { isQueryMatch, setupExpandContent, setupGallerySlider } from './helpers.js';

const slideAnimeDuration = 4500;
const glideOptions = {
	gap: 0,
	autoplay: slideAnimeDuration,
	hoverpause: false,
	type: 'carousel',
	animationDuration: 1500,
	animationTimingFunc: 'cubic-bezier(.21,.55,.58,1)',
};
export const controlerPath = {
	common: {
		init: () => {
			// Slider setup
			const galleries = document.getElementsByClassName('gallery');

			for (const element of galleries) {
				const gallery = element;
				let isArrow = true;
				if (gallery.id === 'gallery-1' || gallery.id === 'gallery-2') {
					isArrow = false;
				}
				const slider = new setupGallerySlider(gallery, {
					arrow: isArrow,
				});
				slider.init(() => {
					new Glide(
						'.' + slider.glideEl.classList[0],
						glideOptions
					).mount();
				});
			}

			function getOffset(el) {
				const rect = el.getBoundingClientRect();
				return {
					left: rect.left + window.scrollX,
					top: rect.top + window.scrollY,
				};
			}

			const toggleMenu =
				document.getElementsByClassName('toggle-menu')[0];
			const sideNav = document.getElementsByClassName('side-nav')[0];
			const sideNavLinks = sideNav.getElementsByTagName('a');
			const burger = document.getElementsByClassName('burger')[0];
			toggleMenu.addEventListener('click', function () {
				sideNav.classList.toggle('show');
				burger.classList.toggle('close');
			});
			for (const element of sideNavLinks) {
				element.addEventListener('click', function (e) {
					e.preventDefault();
					sideNav.classList.remove('show');
					burger.classList.remove('close');
					if (element.attributes.href.value.indexOf('#') === 0) {
						const targetElem = document.getElementById(
							element.attributes.href.value.replace('#', '')
						);
						gsap.to(window, {
							duration: 1,
							scrollTo: { y: getOffset(targetElem).top },
							ease: 'power2',
						});
					} else {
						location.href = element.attributes.href.value;
					}
				});
			}

			// Expandable content setup
			const targetElems =
				document.getElementsByClassName('expand-content');
			for (const target of targetElems) {
				const expander = new setupExpandContent(target, { lines: 5 });
				expander.init();
			}

			// CTA
			const controller = new ScrollMagic.Controller();
			function triggerHandlerCta(e) {
				const ctaElem = document.getElementById('cta-reservation');
				if (e.type === 'enter') {
					ctaElem.classList.add('show');
					sideNav.classList.add('up');
				} else {
					ctaElem.classList.remove('show');
					sideNav.classList.remove('up');
				}
			}
			new ScrollMagic.Scene({
				triggerElement: '#trigger-cta',
				triggerHook: 0.5,
			})
				.on('enter leave', triggerHandlerCta)
				.addTo(controller);
		},
	},
	home: {
		init: () => {
			const smController = new ScrollMagic.Controller();
			const mainMenu = document.getElementById('main-menu');
			if (!mainMenu) {
				console.info('メニューが見つかりません');
				return false;
			}
			const menuItems = mainMenu.getElementsByTagName('a');
			// Stick title on desktop only
			if (menuItems.length > 0 && isQueryMatch()) {
				for (const element of menuItems) {
					const menuItem = element;
					const triggerTarget = document.getElementById(
						menuItem.className.replace('menu-', '')
					);
					if (!triggerTarget) {
						console.info(
							'対象のコンテンツが見つかりません メニュー: ',
							menuItem.className.replace('menu-', '')
						);
					}
					new ScrollMagic.Scene({
						triggerElement: triggerTarget,
						triggerHook: 0.5,
					})
						.on('enter leave', function () {
							for (const item of menuItems) {
								item.classList.remove('im-here');
							}
							menuItem.classList.add('im-here');
						})
						.addTo(smController);
				}
			} else {
				console.info('メニューが登録されていません');
			}
		},
	},
};
