import { elementReady } from "../utils/elementReady";
import { throttle } from "../utils/throttle";

export async function mrgnBody() {
	const body = await elementReady("body");
	const header = await elementReady("header");

	const changeMargnTop = () => {
		body.style.setProperty("--mrgntop", `${header.offsetHeight}px`);
		body.style.marginBottom = `-${header.offsetHeight}px`;
	};

	changeMargnTop();

	document.addEventListener("DOMContentLoaded", changeMargnTop);

	window.addEventListener("resize", throttle(changeMargnTop, 300));
}
