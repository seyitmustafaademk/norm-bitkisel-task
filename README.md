## TASK: Homm Bitkisel - Hoş Geldin Kampanyası

### Tanıtım
Bu Laravel projesi, kullanıcıların ürünleri listeleyebileceği, sepete ekleyebileceği, sepetten çıkarabileceği ve sepet içeriğini yönetebileceği kapsamlı bir e-ticaret uygulamasıdır. Ayrıca, kullanıcı giriş ve kaydı, sepetteki ürünlerin listelenmesi, hoş geldin kampanyası ürünlerinin gösterilmesi ve sipariş oluşturma gibi özellikler de sunmaktadır. Proje, kullanıcıların kayıt tarihine göre hoş geldin kampanyası ürünlerini otomatik olarak sepete eklemekte ve bu şekilde müşteri memnuniyetini artırmayı hedeflemektedir.

[Hom Bitkisel Task](https://task-homm-bitkisel.seyitmustafaademk.dev "Demo: Hom Bitkisel Task")

| Demo User     | john.doe@mail.com |
|---------------|-------------------|
| Demo Password | password          |

### Özellikler
- Ürün listeleme
- Ürünleri sepete ekleme ve çıkarma
- Sepetteki ürün sayısını artırma ve azaltma
- Kullanıcı girişi ve kaydı
- Sepetteki ürünleri listeleme
- Sepet sayfasında hoş geldin kampanyası ürünlerini listeleme
- Satın al butonuna basıldığında sipariş oluşturma ve hoş geldin kampanyası ürünlerini sepete ekleme

### Gereksinimler
- PHP 8.1 veya üzeri
- Composer
- Laravel 8.x veya üzeri
- MySQL veya MariaDB

## Kurulum Aşamaları
1.  Proje dosyalarını indirme
```bash
git clone https://github.com/seyitmustafaademk/norm-bitkisel-task.git
cd norm-bitkisel-task
```

2. Composer bağımlılıklarını yükleme
```bash
composer install
```

3. .env dosyasının oluşturulması
```bash
copy .env.example .env
```

4. App Key oluşturulması
```bash
php artisan key:generate
```

5. Storage bağlantısının kurulması
```bash
php artisan storage:link
```

6. Veritabanı sunucusunda yeni bir veritabanı oluşturun: `homm_bitkisel_task`

7.  .env dosyasının düzenlenmesi
```bash
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=homm_bitkisel_task
DB_USERNAME=root
DB_PASSWORD=
```

7. Migration dosyalarında tanımlanan tabloların veritabanına aktarılması:
```bash
php artisan migrate --seed
```

8. Uygulamanın çalıştırılması
```bash
php artisan serve
```
