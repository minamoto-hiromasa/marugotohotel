class setupGallerySlider {
	constructor(elm, options) {
		this.group = elm;
		this.glideEl = '';
		this.hasArrow = options.arrow;
	}
	init(callback) {
		const imageGroup = this.group.querySelectorAll('img');
		this.glideEl = document.createElement('div');
		const trackElm = document.createElement('div');
		const ulElm = document.createElement('ul');

		// Arrow elements
		const arrowContainer = document.createElement('div');
		const arrowLeft = document.createElement('button');
		const arrowRight = document.createElement('button');
		arrowContainer.setAttribute('data-glide-el', 'controls');
		arrowContainer.classList.add('glide__arrows');
		arrowLeft.classList.add('glide__arrow', 'glide__arrow--left');
		arrowLeft.setAttribute('data-glide-dir', '<');
		arrowLeft.textContent = 'prev';
		arrowRight.classList.add('glide__arrow', 'glide__arrow--right');
		arrowRight.setAttribute('data-glide-dir', '>');
		arrowContainer.appendChild(arrowLeft);
		arrowRight.textContent = 'next';
		arrowContainer.appendChild(arrowRight);

		// Bullets elements
		const bulletContainer = document.createElement('div');
		bulletContainer.classList.add('glide__bullets');
		bulletContainer.setAttribute('data-glide-el', 'controls[nav]');
		for (let i = 0; i < imageGroup.length; i++) {
			const bullet = document.createElement('button');
			bullet.classList.add('glide__bullet');
			bullet.setAttribute('data-glide-dir', '=' + i);
			bulletContainer.appendChild(bullet);
		}

		this.glideEl.classList.add('glide-' + Date.now());
		this.glideEl.classList.add('glide');
		trackElm.classList.add('glide__track');
		trackElm.setAttribute('data-glide-el', 'track');
		ulElm.classList.add('glide__slides');

		imageGroup.forEach((image) => {
			const listElm = document.createElement('li');
			const imageDiv = document.createElement('div');
			// const imageElm = document.createElement('img');
			// imageElm.src = image.attributes.src.value;
			// imageElm.classList.add('glide__slide__img');
			imageDiv.classList.add('image');
			imageDiv.style.backgroundImage = `url(${image.attributes.src.value})`;
			listElm.classList.add('glide__slide');
			listElm.appendChild(imageDiv);
			// listElm.appendChild(imageElm);
			ulElm.appendChild(listElm);
			image.remove();
		});
		trackElm.appendChild(ulElm);
		this.glideEl.appendChild(trackElm);
		if (this.hasArrow) this.glideEl.appendChild(arrowContainer);
		if (!this.hasArrow) this.glideEl.appendChild(bulletContainer);
		// const groupChildren = this.group.children;
		// console.log(groupChildren);
		// for (let i = 0; i < groupChildren.length; i++) {
		//   const element = groupChildren[i];
		//   console.log(element);
		//   element.remove();
		// }
		// console.log('append slider')
		this.group.appendChild(this.glideEl);
		return callback();
	}
}
function observeNodes(callback) {
	const observer = new MutationObserver(function (mutaionsList) {
		callback(mutaionsList[0].target);
	});
	const entryContent = document.getElementById('main');
	observer.observe(entryContent, {
		childList: true,
		subtree: true,
	});
}
function isQueryMatch() {
	const mql = window.matchMedia('screen and (min-width: 640px)');
	return mql.matches;
}

class setupExpandContent {
	constructor(elm, options) {
		this.target = elm;
		this.lines = options.lines;
	}
	init() {
		if (!this.target.getElementsByTagName('p')) {
			console.error('文章が設定されていません');
			return false;
		}
		const paragraph = this.target.getElementsByTagName('p')[0];
		const fontSize = window
			.getComputedStyle(paragraph)
			.fontSize.replace('px', '');
		const lineHeight = fontSize * 1.9;
		const openParagraphHeight = this.target.clientHeight;
		const article = this.target.closest('article');
		if (!article) {
			console.error('折りたたみコンテンツが正しく設定されていません');
			return false;
		}
		const closedParagraphHeight = Math.ceil(lineHeight * this.lines);
		this.target.style.height = closedParagraphHeight + 'px';

		// Close
		const elemContainer = document.createElement('div');
		elemContainer.classList.add('grid-x', 'right');
		const btn = document.createElement('div');
		btn.innerHTML = 'もっと見る';
		btn.classList.add('expand-button');
		const parent = this.target.parentElement;
		btn.addEventListener('click', (e) => {
			e.preventDefault();
			this.target.style.height = openParagraphHeight + 'px';
			e.target.style.display = 'none';
		});
		elemContainer.appendChild(btn);
		parent.insertBefore(elemContainer, this.target.nextSibling);
	}
}

class swapImageControl {
	constructor(imageGroup) {
		this.imageGroup = imageGroup;
	}
	init() {
		const parent = this.imageGroup.parentElement;
		const contentGroup = parent.getElementsByClassName('swap-content');
		const images = this.imageGroup.getElementsByTagName('figure');
		if (images.length !== contentGroup.length + 1) {
			console.error(
				'SwapImagesの設定が正しくありません。画像とボタンの数を確認してください。'
			);
			return false;
		}
		for (let i = 0; i < contentGroup.length; i++) {
			const content = contentGroup[i];
			content.addEventListener('mouseover', {
				index: i + 1,
				figures: images,
				handleEvent: this.swapImage,
			});
			content.addEventListener('mouseout', {
				index: 0,
				figures: images,
				handleEvent: this.swapImage,
			});
		}
	}
	swapImage() {
		for (let i = 1; i < this.figures.length; i++) {
			const figure = this.figures[i];
			figure.style.display = 'none';
		}
		this.figures[this.index].style.display = 'block';
	}
}
export {
	setupGallerySlider,
	observeNodes,
	isQueryMatch,
	setupExpandContent,
	swapImageControl,
};
