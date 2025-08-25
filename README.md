# HodShop — نسخه ووکامرس

این برنچ نسخه‌ی سفارشی قالب HodShop برای WooCommerce است.  
توی این نسخه فایل‌های پیش‌فرض ووکامرس داخل پوشه‌ی woocommerce/ بازنویسی شده و با Tailwind CSS و چندتا هوک، نمایش محصولات، دسته‌ها، قیمت و دکمه‌ها تغییر کرده.

---

## شروع سریع
1. مخزن رو کلون کن:
   `bash
   git clone https://github.com/amixrzie/HodShop.git
   cd HodShop
   git checkout woocommerce-version

2. افزونه WooCommerce رو نصب و فعال کن.


3. از تنظیمات ووکامرس، یه برگه رو به عنوان فروشگاه انتخاب کن.


4. توی «تنظیمات → پیوندهای یکتا» یک بار ذخیره بزن.


5. قالب HodShop رو فعال کن.




---

ساختار اصلی

woocommerce/
 ├─ archive-product.php   
 ├─ content-product.php  
 └─ single-product.php   
functions.php             
functions-woohooks.php    
header.php / footer.php  
index.php                 



---

## 📝 یادداشت نویسنده

این پروژه با هدف یادگیری و تمرین طراحی قالب وردپرس و مدیریت محصولات داینامیک ساخته شده.  
تمام تلاش من این بوده که تجربه کاربری ساده و کدنویسی تمیز حفظ شود.
