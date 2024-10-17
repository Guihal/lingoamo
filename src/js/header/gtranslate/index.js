import { initAll } from "./initAll";

export async function gtranslate() {
	const gtranslates = document.querySelectorAll(".gtranslate_wrapper:not(.init)");

	for (let i = 0; i < gtranslates.length; i++) {
		const gtranslate = gtranslates[i];
		gtranslate.classList.add("init");

		initAll(gtranslate);
	}
}
