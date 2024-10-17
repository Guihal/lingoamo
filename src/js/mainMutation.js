import { addClassToCourse, addClassToInputs } from "./addClassToFormBtn";
import { gtranslate } from "./header/gtranslate";
import { addSvgInBtn } from "./utils/addSvgInBtn";

export function mainObserver() {
	const observer = new MutationObserver((mutations, obs) => {
		// gtranslate();
		addSvgInBtn();
		addClassToCourse();
		addClassToInputs();
	});

	observer.observe(document.documentElement, { childList: true, subtree: true });
}
