import { elementReady } from "../utils/elementReady";

function getHideAnimate() {
	return [{ opacity: 1 }, { opacity: 0 }];
}

function getShowAnimate() {
	return [{ opacity: 0 }, { opacity: 1 }];
}

function getTimingAnimate() {
	return {
		duration: 300,
		easing: "ease",
	};
}

export async function burger() {
	const burger = await elementReady(".burger");
	const burgerBtn = await elementReady(".burger__btn");
	let pass = true;

	burgerBtn.addEventListener("click", () => {
		if (!pass) return;

		if (burgerBtn.classList.contains("active")) {
			document.documentElement.classList.remove("ov-hidden");
			burgerBtn.classList.remove("active");
			addAnimation(burger, false);
		} else {
			document.documentElement.classList.add("ov-hidden");
			burgerBtn.classList.add("active");
			addAnimation(burger, true);
		}
	});

	function addAnimation(block, show = true) {
		pass = false;
		if (show) {
			burger.classList.remove("hide");
		} else {
			burger.classList.remove("show");
		}

		const animate = burger.animate(show ? getShowAnimate() : getHideAnimate(), getTimingAnimate());

		animate.addEventListener("finish", () => {
			if (show) {
				burger.classList.add("show");
			} else {
				burger.classList.add("hide");
			}

			pass = true;
		});
	}
}
