import {selectors} from "./selectors";
import {ViewGenerator} from "./view-generator";
import {Helpers} from "./helpers";

export class Requester {

    constructor() {
        this.helpers = new Helpers();
    }

    get_categories() {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.get(api_url.homepage.categories)
            .then(function (response) {
                let category_wrapper = $(selectors.homepage.category_wrapper);
                let categories = response.data.data.categories;

                let input = view_generator.createCategoryLink('/', 'Hepsini Göster');
                category_wrapper.append(input);

                categories.map(function (category) {
                    let category_html = view_generator.createCategoryLink(category.slug, category.name);
                    category_wrapper.append(category_html);
                });

                $(selectors.homepage.btn_category).on('click', (event) => {
                    event.preventDefault();

                    let category_slug = $(event.target).data('category-slug');
                    self.get_products(category_slug, 1);
                });
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Kategoriler yüklenirken bir hata oluştu', 'error');
            });
    }

    get_products(category = null, page = 1) {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.get(api_url.homepage.products, {
            params: {
                category: category,
                page: page
            }
        })
            .then(function (response) {
                let product_wrapper = $(selectors.homepage.product_wrapper);
                let text_product_count = $(selectors.homepage.txt_product_count);
                let text_total_product_count = $(selectors.homepage.txt_total_product_count);

                let products_paginate = response.data.data.products;
                let products = products_paginate.data;

                text_total_product_count.text(products_paginate.total);
                text_product_count.text(`${products_paginate.from} - ${products_paginate.to}`);

                product_wrapper.html('');
                products.map(function (product) {
                    let product_html = view_generator.createProductCard(product);
                    product_wrapper.append(product_html);
                });

                $(selectors.homepage.pagination_wrapper).html('');
                products_paginate.links.map(function (link) {
                    let label = link.label;
                    if (link.label === 'Next &raquo;') {
                        label = link.label.replace('Next ', '');
                    }
                    else if (link.label === '&laquo; Previous') {
                        label = link.label.replace(' Previous', '');
                    }

                    let paginate = {
                        url: link.url,
                        label: label,
                        active: link.active
                    }

                    let pagination_html = view_generator.createPagination(paginate);
                    $(selectors.homepage.pagination_wrapper).append(pagination_html);

                    $(selectors.homepage.btn_paginate).on('click', (event) => {
                        event.preventDefault();
                        let url = $(event.target).attr('href');
                        let page = url.split('page=')[1];
                        self.get_products(selected_category, page);
                    });
                });

                $(selectors.homepage.btn_add_to_cart).on('click', (event) => {
                    event.preventDefault();
                    let product_id = $(event.target).closest('.product__item').data('product-id');
                    self.addToCart(product_id);
                });

                selected_category = category;
                selected_page = page;
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Ürünler yüklenirken bir hata oluştu', 'error');
            });
    }

    addToCart(product_id) {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.post(api_url.basket.add.replace('###', product_id))
            .then(function (response) {
                view_generator.createNotification('Başarılı', 'Ürün sepete eklendi', 'success');
                self.get_basket_products_statistics();
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Ürün sepete eklenirken bir hata oluştu', 'error');
            });
    }

    get_basket_products_statistics() {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.get(api_url.basket.get)
            .then(function (response) {
                let products = response.data.data;

                total_product_count = 0;
                products.map(function (product) {
                    total_product_count += product.quantity;
                });
                $(selectors.homepage.txt_basket_count).text(total_product_count);
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Sepet yüklenirken bir hata oluştu', 'error');
            });
    }

    get_welcome_campaign() {
        let view_generator = new ViewGenerator();

        axios.get(api_url.basket.welcome_campaign)
            .then(function (response) {
                console.log(response.data.data);

                let campaign = response.data.data;
                if (campaign === null) {
                    return;
                }

                let welcome_campaign_products_table = view_generator.createWelcomeCampaignTable(campaign);
                $(selectors.basket.welcome_campaign_products_table_wrapper).html(welcome_campaign_products_table);
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Kampanyalar yüklenirken bir hata oluştu', 'error');
            });
    }



    get_basket_products() {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.get(api_url.basket.get)
            .then(function (response) {
                let basket_wrapper = $(selectors.basket.basket_product_wrapper);
                let products = response.data.data;

                basket_wrapper.html('');
                if (products.length === 0) {
                    basket_wrapper.append(view_generator.createBasketProductListEmpty());
                }

                total_product_count = 0;
                sub_total = 0;
                products.map(function (product) {
                    let product_html = view_generator.createBasketProductCard(product);
                    basket_wrapper.append(product_html);

                    total_product_count += product.quantity;
                    sub_total += (product.price * product.quantity);
                    $(selectors.homepage.txt_basket_count).text(total_product_count);
                });

                $(selectors.basket.txt_basket_subtotal).text(self.helpers.formatCurrency(sub_total));
                $(selectors.basket.txt_basket_total).text(self.helpers.formatCurrency(sub_total * 1.20));

                $(selectors.basket.btn_quantity_increase).on('click', (event) => {
                    event.preventDefault();
                    let product_id = $(event.target).closest(selectors.basket.product_wrapper).data('id');
                    self.increase_quantity(product_id);
                    self.get_basket_products();
                });

                $(selectors.basket.btn_quantity_decrease).on('click', (event) => {
                    event.preventDefault();
                    let product_id = $(event.target).closest(selectors.basket.product_wrapper).data('id');
                    self.decrease_quantity(product_id);
                    self.get_basket_products();
                });

                $(selectors.basket.btn_remove_from_cart).on('click', (event) => {
                    event.preventDefault();
                    let product_id = $(event.target).closest(selectors.basket.product_wrapper).data('id');
                    self.remove_from_cart(product_id);
                    self.get_basket_products();
                });
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Sepet yüklenirken bir hata oluştu', 'error');
            });
    }

    remove_from_cart(product_id) {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.post(api_url.basket.remove.replace('###', product_id))
            .then(function (response) {
                console.log(response);
                self.get_basket_products();
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Ürün sepetten silinirken bir hata oluştu', 'error');
            });
    }

    decrease_quantity(product_id) {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.post(api_url.basket.decrease.replace('###', product_id))
            .then(function (response) {
                console.log(response);
                self.get_basket_products();
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Sepette ki ürün miktarı azaltılırken bir hata oluştu', 'error');
            });
    }

    increase_quantity(product_id) {
        let view_generator = new ViewGenerator();
        let self = this;

        axios.post(api_url.basket.increase.replace('###', product_id))
            .then(function (response) {
                console.log(response);
                self.get_basket_products();
            })
            .catch(function (error) {
                console.error(error);
                view_generator.createNotification('Hata', 'Sepette ki ürün miktarı arttırılırken bir hata oluştu', 'error');
            });
    }

}
