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
			const galleries = document.getElementsByClassName('gallery-slider');

			for (let i = 0; i < galleries.length; i++) {
				const gallery = galleries[i];
				const slider = new setupGallerySlider(gallery, {
					arrow: true,
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
			new Glide('.hero-slider.mobile', glideOptions).mount();
			new Glide('.hero-slider.desktop', glideOptions).mount();

			const smController = new ScrollMagic.Controller();
			const smOptions = {
				triggerElement: '#concept',
				triggerHook: 0,
			};
			if (isQueryMatch()) {
				// Stick title on desktop only
				new ScrollMagic.Scene(smOptions) // Titile
					.setPin('#sm-target1')
					.addTo(smController);
				new ScrollMagic.Scene(smOptions) // Title English
					.setPin('#sm-target2')
					.addTo(smController);
				new ScrollMagic.Scene(smOptions) // Tour name
					.setPin('#sm-target3')
					.addTo(smController);
			}
		},
	},
};
