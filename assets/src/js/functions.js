function triggerHandlerCta(e) {
	const ctaElem = document.getElementById('cta-reservation');
	const sideNav = document.getElementsByClassName('side-nav')[0];
	if (!ctaElem) {
		console.info('CTAは無効に設定されています。');
		return false;
	}
	if (e.type === 'enter') {
		ctaElem.classList.add('show');
		sideNav.classList.add('up');
	} else {
		ctaElem.classList.remove('show');
		sideNav.classList.remove('up');
	}
}

function triggerThing(e) {
	const ctaElem = document.getElementById('cta-reservation');
	const brandElem = document.getElementsByClassName('brand')[0];
	if (e.type === 'enter') {
		ctaElem.style.transform =
			'translateY(-' + brandElem.offsetHeight + 'px)';
	} else {
		ctaElem.style.transform = 'translateY(0px)';
	}
}
export { triggerHandlerCta, triggerThing };
