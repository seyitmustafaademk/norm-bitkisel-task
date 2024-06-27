const path = require('path');

module.exports = {
    mode: 'production', // Geliştirme modunda çalıştırın
    entry: {
        content: './resources/js/app.js',
    },
    output: {
        filename: 'app.js', // Çıktı dosyası adını [name] ile dinamik hale getirin
        path: path.resolve(__dirname, 'public/front-assets/js'), // Çıktı dizinini belirtin
    },
};
