/**
 * SASS
 */
import '../sass/frontend.scss';

/**
 * JavaScript
 */
import { controlerPath } from './controler-path';

function pathControler() {
	const classes = document.body.classList;
	const fire = (func) => {
		if (
			func !== '' &&
			controlerPath[func] &&
			typeof controlerPath[func].init === 'function'
		) {
			controlerPath[func].init();
		}
	};
	const init = () => {
		fire('common');
		classes.forEach((cls) => {
			fire(cls);
		});
	};
	init();
}
pathControler();

/**
 * Add here your JavasScript code
 */
