import {Requester} from "./requester";
import {selectors} from "./selectors";

// let requester = new Requester();
//
// requester.get_categories();
// requester.get_products();
// requester.get_basket_products();


export class Controller {
    constructor() {
        this.requester = new Requester();
    }

    init_homepage() {
        this.requester.get_categories();
        this.requester.get_products();
        this.requester.get_basket_products();
    }

    init_basket() {
        this.requester.get_basket_products();
    }
}

window.Controller = Controller;
