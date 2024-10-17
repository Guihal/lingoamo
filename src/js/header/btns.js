export function clickBtn() {
	const btnClass = `btn-cstm`;

	document.addEventListener("click", (ev) => {
		const parent = ev.target.closest(`.${btnClass}`);

		if (!ev.target.classList.contains(btnClass) && !parent) return;

		const clickable = parent ? parent.querySelector("a, button") : ev.target.querySelector("a, button");

		if (!clickable) return;

		clickable.click();
	});
}
