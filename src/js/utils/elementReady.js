export function elementReady(selector, parent = false) {
	return new Promise((resolve) => {
		const blockOut = parent ? parent.querySelector(selector) : document.querySelector(selector);

		if (blockOut) {
			if (blockOut) {
				resolve(blockOut);
				return;
			}
		}

		const observer = new MutationObserver((mutations, obs) => {
			const block = parent ? parent.querySelector(selector) : document.querySelector(selector);
			if (block) {
				resolve(block);
				obs.disconnect();
			}
		});

		parent ? observer.observe(parent, { childList: true, subtree: true }) : observer.observe(document.documentElement, { childList: true, subtree: true });
	});
}
