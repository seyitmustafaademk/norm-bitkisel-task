<?php

namespace App\Enums;

enum CampaignTypeEnum: int
{
    case WELCOME = 1;
    case BASKET_DISCOUNT = 2;
    case PRODUCT_DISCOUNT = 3;
    case GIFT = 4;

    public function label(): string
    {
        return match ($this) {
            self::WELCOME => 'Hoş Geldin',
            self::BASKET_DISCOUNT => 'Sepet İndirimi',
            self::PRODUCT_DISCOUNT => 'Ürün İndirimi',
            self::GIFT => 'Hediye',
        };
    }
}
