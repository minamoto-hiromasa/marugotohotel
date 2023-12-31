import Glide from '@glidejs/glide';
import ScrollMagic from 'scrollmagic';
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { triggerHandlerCta, triggerThing } from './functions';
import { swapImageControl, MoviePlayer } from './helpers';

gsap.registerPlugin(ScrollToPlugin);

import {
	isQueryMatch,
	setupExpandContent,
	setupAccordion,
	setupGallerySlider,
	staggerList,
} from './helpers.js';

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
			const bodyContent = document.getElementById('body-content');
			toggleMenu.addEventListener('click', function () {
				sideNav.classList.toggle('show');
				burger.classList.toggle('close');
				bodyContent.classList.toggle('locked');
			});
			for (const element of sideNavLinks) {
				element.addEventListener('click', function (e) {
					e.preventDefault();
					sideNav.classList.remove('show');
					burger.classList.remove('close');
					bodyContent.classList.remove('locked');
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

			const accordionElms =
				document.getElementsByClassName('accordion-content');

			for (const target of accordionElms) {
				const accordion = new setupAccordion(target);
				accordion.init();
			}
			// CTA
			const controller = new ScrollMagic.Controller();
			const elemCTA = document.getElementById('trigger-cta');
			const footerElem = document.getElementById('footer');
			if (elemCTA) {
				footerElem.classList.add('has-cta');
				new ScrollMagic.Scene({
					triggerElement: '#trigger-cta',
					triggerHook: 0.5,
				})
					.on('enter leave', triggerHandlerCta)
					.addTo(controller);

				new ScrollMagic.Scene({
					triggerElement: '#footer',
					triggerHook: 1,
				})
					.on('enter leave', triggerThing)
					.addTo(controller);
			} else {
				console.warn('CTAのトリガーが設定されていません。');
				return false;
			}

			// ムービーコントロール追加
			const movie = new MoviePlayer('key-movie');
			movie.init();
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
	'page-dmo': {
		init: () => {
			const swapImageGroups =
				document.getElementsByClassName('swap-images');
			for (const imageGroup of swapImageGroups) {
				const control = new swapImageControl(imageGroup);
				control.init();
			}
			const bodyContent = document.getElementById('body-content');
			const linkGroup =
				bodyContent.getElementsByClassName('link-list')[0];
			const linkElm = new staggerList(linkGroup);
			linkElm.init();
		},
	},
};
