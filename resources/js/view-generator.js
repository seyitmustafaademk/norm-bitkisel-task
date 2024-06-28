import {selectors} from "./selectors";
import {Helpers} from "./helpers";

export class ViewGenerator {
    createCategoryLink(slug, name) {
        return `<li><a href="#" class="btn-category" data-category-slug="${slug}">${name}</a></li>`;
    }

    createProductCard(product) {
        let image_url = product.image.toString().startsWith('http') ? product.image : `/storage/${product.image}`;
        let header_basket_icon = $(selectors.homepage.header_basket_icon).length > 0;
        let helpers = new Helpers();

        return `
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item" data-product-id="${product.id}">
                    <div class="product__item__pic set-bg">
                        <img src="${image_url}" loading="lazy" alt="" style="width: 100%; height: 100%; object-fit: cover; border: 1px solid #000">
                        <ul class="product__item__pic__hover">
                            ${
                                header_basket_icon
                                ? '<li><a href="#" class="btn-add-to-cart"><i class="fa fa-shopping-cart"></i></a></li>'
                                : ''
                            }
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.name}</a></h6>
                        <h5>${helpers.formatCurrency(product.price)}</h5>
                        <h6>${product.stock === 0 ? 'Stok Bitti': ('Stok: ' + product.stock)}</h6>
                    </div>
                </div>
            </div>
        `;
    }

    createPagination(paginate) {
        let style = ''
        if (paginate.url === null) {
            style = 'pointer-events: none; cursor: default; background-color: #6c757d; color: #fff';
        }
        else if(paginate.active) {
            style = 'background-color: #007bff; color: #fff';
        }
        return `<a class="btn-paginate" href="${paginate.url}" style="${style}">${paginate.label}</a>`;
    }

    createBasketProductListEmpty() {
        return `
            <tr>
                <td colspan="5">There is no product in the basket.</td>
            </tr>
        `;
    }

    createBasketProductCard(product) {
        let image_url = product.image.toString().startsWith('http') ? product.image : `/storage/${product.image}`;
        let helpers = new Helpers();

        return `
            <tr class="product-wrapper" data-id="${ product.id }">
                <td class="shoping__cart__item">
                    <img style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #000" src="${ image_url }" alt="">
                    <h5>${ product.name }</h5>
                </td>
                <td class="shoping__cart__price">
                    ${ helpers.formatCurrency(product.price) }
                </td>
                <td class="shoping__cart__quantity">
                    <div class="quantity">
                        <div class="pro-qty d-flex justify-content-between align-items-center">
                            <button class="btn btn-danger btn-quantity-decrease">-</button>
                            <span class="txt-product-quantity">${ product.quantity }</span>
                            <button class="btn btn-success btn-quantity-increase">+</button>
                        </div>
                    </div>
                </td>
                <td class="shoping__cart__total">
                    ${ helpers.formatCurrency(product.total_price) }
                </td>
                <td class="shoping__cart__item__close">
                    <button class="btn btn-danger btn-remove-from-cart">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    }

    createNotification(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon
        });
    }

    createWelcomeCampaignProductCart(product) {
        let image_url = product.image.toString().startsWith('http') ? product.image : `/storage/${product.image}`;
        let helpers = new Helpers();

        return `
            <tr class="product-wrapper" data-id="${ product.id }">
                <td class="shoping__cart__item">
                    <img style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #000" src="${ image_url }" alt="">
                    <h5>${ product.name }</h5>
                </td>
                <td class="shoping__cart__price">
                    ${ helpers.formatCurrency(0) }
                </td>
                <td></td>
            </tr>
        `;
    }

    createWelcomeCampaignTable(campaign) {
        let helpers = new Helpers();
        let second_description = `${campaign.ended_at} tarihine kadar ${helpers.formatCurrency(campaign.campaign_details[0].min_purchase_amount)} ve üzeri alışverişlerde aşağıdaki ${campaign.period_products.period_products.length > 1 ? 'ürünler': 'ürün'} hediyemiz!`;

        let campaign_products = campaign.period_products.period_products;

        return `
           <div class="shoping__cart__table">
                <div class="card">
                    <div class="card-header">
                        <h4 id="welcome-campaign-title">${campaign.name}</h4>
                        <p id="welcome-campaign-description">${campaign.description}</p>
                        <p id="welcome-campaign-description-second">${second_description}</p>
                    </div>
                    <div class="card-body">
                        <table id="welcome-campaign-products-table-wrapper">
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="welcome-campaign-products-wrapper">
                                ${
                                    campaign_products.map(product => {
                                        return this.createWelcomeCampaignProductCart(product);
                                    }).join('')
                                }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    }
}
