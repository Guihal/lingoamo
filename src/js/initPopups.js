import { elementReady } from "./utils/elementReady";
export async function initClosePopup() {
	const popup = await elementReady("#callback");
	const popupBtn = await elementReady("#callback .popup__close");

	popupBtn.addEventListener("click", () => {
		popup.classList.remove("showed");
	});
}

export class Popup {
	duration = 300;

	constructor(popupSelector, popupBtnSelector) {
		this.popupSelector = popupSelector;
		this.popupBtnSelector = popupBtnSelector;
		this.popupInit();
	}

	async popupInit() {
		this.popup = await elementReady(this.popupSelector);
		this.popupClose = await elementReady(`${this.popupSelector} .popup__close`);

		this.addClassesToSubmit();
		this.addCloseEvent();
		this.mainObserver();
	}

	async addClassesToSubmit() {
		const submitBtn = await elementReady("#gform_submit_button_7");

		if (!submitBtn) return;

		submitBtn.className += " btn-cstm blue";

		submitBtn.style.cssText = "padding: 11px 25px !important;";
	}

	mainObserver() {
		const observer = new MutationObserver((mutations, obs) => {
			this.addOpenEvent();
		});

		observer.observe(document.documentElement, { childList: true, subtree: true });
	}

	getHideAnimate() {
		return [{ opacity: 1 }, { opacity: 0 }];
	}

	getShowAnimate() {
		return [{ display: "flex", opacity: 0 }, { opacity: 1 }];
	}

	getTimingAnimate() {
		return {
			duration: this.duration,
			easing: "ease",
		};
	}

	showPopup() {
		const animation = this.popup.animate(this.getShowAnimate(), this.getTimingAnimate());

		this.popup.classList.remove("hide");
		document.documentElement.classList.add("ov-h");

		animation.addEventListener("finish", () => {
			this.popup.classList.add("show");
		});
	}

	hidePopup() {
		const animation = this.popup.animate(this.getHideAnimate(), this.getTimingAnimate());

		this.popup.classList.remove("show");
		document.documentElement.classList.remove("ov-h");

		animation.addEventListener("finish", () => {
			this.popup.classList.add("hide");
		});
	}

	addCloseEvent() {
		this.popupClose.addEventListener("click", () => {
			this.hidePopup();
		});
	}

	addEventForClose() {
		this.popup.addEventListener(
			"click",
			(ev) => {
				if (!ev.target.classList.contains("popup") && !ev.target.classList.contains("popup__close")) return;

				this.hidePopup();
			},
			{
				once: true,
			}
		);
	}

	addOpenEvent() {
		document.querySelectorAll(`${this.popupBtnSelector}:not(.check-pop)`).forEach((btn) => {
			btn.classList.add("check-pop");

			btn.addEventListener("click", (ev) => {
				ev.preventDefault();
				this.showPopup();
				this.addEventForClose();
			});
		});
	}
}
