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

        // header basket icon varsa sepeti yükle
        if ($(selectors.homepage.header_basket_icon).length) {
            this.requester.get_basket_products_statistics();
        }
    }

    init_basket() {
        this.requester.get_basket_products();
        this.requester.get_unused_campaigns();
    }
}

window.Controller = Controller;
