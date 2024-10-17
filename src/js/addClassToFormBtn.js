import { elementReady } from "./utils/elementReady";

export function addClassToEls() {
	addClassToFormBtn();
}

async function addClassToFormBtn() {
	const btn = await elementReady('.waiting-list__form [type="submit"]');

	btn.className = "btn-cstm green btn-w-arrow-small";
}

export async function addClassToCourse() {
	const courses = document.querySelectorAll(".course_section:not(.check)");

	courses.forEach((course) => {
		course.classList.add("check");

		course.querySelectorAll(".elementor-image-box-description").forEach((el) => {
			el.className = "text small";
		});

		course.querySelectorAll("h3").forEach((h3) => {
			h3.className = "text bigger bold mob-14";
		});
	});
}

export async function addClassToInputs() {
	const inps = document.querySelectorAll('[type="text"]:not(.check), [type="email"]:not(.check), textarea:not(.check)');

	inps.forEach((inp) => {
		if (inp.tagName === "TEXTAREA") {
			inp.className += " check text bigger default-input textarea";
			return;
		}

		inp.className += " check text bigger default-input";
	});
}

// function mutationWait(el, func) {
// 	func();

// 	const observer = new MutationObserver((mutations, obs) => {
// 		func();
// 	});

// 	observer.observe(el, { childList: true, subtree: true });
// }
