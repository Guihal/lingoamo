import { Choice } from "./addBlockChoice";

export function initAll(gtranslate) {
	const choice = new Choice(gtranslate);

	const observer = new MutationObserver((mutations, obs) => {
		const satelites = gtranslate.querySelectorAll(".gsatelite:not(.check)");

		choice.addElements(satelites);
	});

	observer.observe(gtranslate, { childList: true, subtree: true });
}
