import {Requester} from "./requester";
import {selectors} from "./selectors";

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
        let self = this;
        this.requester.get_basket_products();
        this.requester.get_welcome_campaign();

        $(selectors.basket.btn_checkout).on('click', function (e) {
            e.preventDefault();
            self.requester.checkout();
        });
    }
}

window.Controller = Controller;
