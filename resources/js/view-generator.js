export class ViewGenerator {
    createCategoryLink(slug, name) {
        return `<li><a href="#" class="btn-category" data-category-slug="${slug}">${name}</a></li>`;
    }

    createProductCard(product) {
        let image_url = product.image.toString().startsWith('http') ? product.image : `/storage/${product.image}`;
        return `
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item" data-product-id="${product.id}">
                    <div class="product__item__pic set-bg">
                        <img src="${image_url}" loading="lazy" alt="" style="width: 100%; height: 100%; object-fit: cover; border: 1px solid #000">
                        <ul class="product__item__pic__hover">
                            <li><a href="#" class="btn-add-to-cart"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.name}</a></h6>
                        <h5>${product.price}</h5>
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

        return `
            <tr class="product-wrapper" data-id="${ product.id }">
                <td class="shoping__cart__item">
                    <img style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #000" src="${ image_url }" alt="">
                    <h5>${ product.name }</h5>
                </td>
                <td class="shoping__cart__price">
                    ${ product.price } ₺
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
                    ${ product.total_price } ₺
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
}
