import Glide from '@glidejs/glide';
import ScrollMagic from 'scrollmagic';
import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';

gsap.registerPlugin(ScrollToPlugin);

import { isQueryMatch, setupGallerySlider } from './helpers.js';

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

			for (let i = 0; i < galleries.length; i++) {
				const gallery = galleries[i];
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
			console.log(menuItems);
			// Stick title on desktop only
			if (menuItems.length > 0 && isQueryMatch()) {
				for (let i = 0; i < menuItems.length; i++) {
					const menuItem = menuItems[i];
					const triggerTarget = document.getElementById(
						menuItem.className.replace('menu-', '')
					);
					if (!triggerTarget) {
						console.info(
							'対象のコンテンツが見つかりません メニュー: ',
							menuItem.className
						);
					}
					new ScrollMagic.Scene({
						triggerElement: triggerTarget,
						triggerHook: 0.5,
					})
						.on('enter leave', function () {
							for (let j = 0; j < menuItems.length; j++) {
								menuItems[j].classList.remove('im-here');
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
