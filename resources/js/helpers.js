export class Helpers {
    formatCurrency(value) {
        return Intl.NumberFormat('tr-TR', { style: 'currency', currency: 'TRY' }).format(value);
    }
}
