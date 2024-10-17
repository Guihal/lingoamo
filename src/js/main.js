import "../scss/main.scss";
import { addClassToEls } from "./addClassToFormBtn";
import { clickBtn } from "./header/btns";
import { burger } from "./header/burger";
import { mrgnBody } from "./header/mrgnBody";
import { Popup } from "./initPopups";
import { mainObserver } from "./mainMutation";

clickBtn();
mainObserver();
burger();
mrgnBody();

const callback = new Popup("#callback", '[href="#contactPopup"]');

addClassToEls();
