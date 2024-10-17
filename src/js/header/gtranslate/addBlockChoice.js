import { elementReady } from "../../utils/elementReady";
import { arrowSvg } from "./arrowSvg";

export class Choice {
	activeClass = "active";

	constructor(block) {
		this.block = block.parentNode;
		this._addHtml();
		this._clickGtranslate();
	}

	_addHtml() {
		this.choice = Object.assign(document.createElement("div"), { className: "choice" });

		this.choiceTitle = Object.assign(document.createElement("div"), { className: "choice-title", innerHTML: arrowSvg() });
		this.text = Object.assign(document.createElement("div"), { className: "choice-text" });
		this.flag = Object.assign(document.createElement("img"), { className: "choice-flag", loading: "lazy", width: "20", height: "15" });
		this.wrapper = Object.assign(document.createElement("div"), { className: "choice-wrapper" });

		this.choiceTitle.prepend(this.flag, this.text);
		this.choice.append(this.choiceTitle, this.wrapper);

		this.block.append(this.choice);

		this._changeStateChoice();
	}

	_removeActive() {
		const active = this.wrapper.querySelector(this.activeClass);

		if (!active) return;

		active.classList.remove(this.activeClass);
	}

	_clickActive(satelite) {
		const el = this.block.querySelector(`.gsatelite[data-gt-lang="${satelite.dataset.lang}"]`);
		// console.log(el);

		if (!el) return;

		el.click();
	}

	_setTitle(satelite) {
		this._removeActive();

		satelite.classList.add(this.activeClass);

		this.text.textContent = satelite.textContent;
		this.flag.src = satelite.dataset.src;
	}

	_eventClick(satelite) {
		this._setTitle(satelite);
		this._clickActive(satelite);
	}

	async _clickGtranslate() {
		this.globe = await elementReady(".gglobe", this.block);

		this.globe.addEventListener("click", () => {
			console.log(1);
			this._titleEvent();
		});
	}

	_changeStateChoice() {
		this.choiceTitle.addEventListener("click", this._titleEvent);
	}

	_titleEvent() {
		if (this.choice.classList.contains(this.activeClass)) {
			this.choice.classList.remove(this.activeClass);
		} else {
			this.choice.classList.add(this.activeClass);

			document.addEventListener(
				"click",
				(ev) => {
					if (ev.target.closest(".elementor-shortcode")) return;

					this.choice.classList.remove(this.activeClass);
				},
				true,
				{ once: true }
			);
		}
	}

	_addSatelite(sateliteEl) {
		const sateliteImg = sateliteEl.querySelector("img");

		// console.log(sateliteImg);

		const satelite = Object.assign(document.createElement("div"), {
			className: "choice-item",
			innerHTML: `<img height='15' width='20' src="${sateliteImg.dataset.gtLazySrc}" loading="lazy" /> ${sateliteEl.dataset.gtLang}`,
		});

		satelite.dataset.src = sateliteImg.dataset.gtLazySrc;
		satelite.dataset.lang = sateliteEl.dataset.gtLang;

		this.wrapper.append(satelite);

		if (sateliteEl.classList.contains("gt-current-lang")) {
			this._eventClick(satelite);
		}

		satelite.addEventListener("click", (ev) => {
			this._eventClick(satelite);
		});

		return satelite;
	}

	addElements(satelites) {
		satelites.forEach((satelite) => {
			satelite.classList.add("check");
			this._addSatelite(satelite);
		});
	}
}
