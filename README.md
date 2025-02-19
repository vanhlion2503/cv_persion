# Giới thiệu trang wed
Là một nền tảng tạo và chia sẻ hồ sơ cá nhân chuyên nghiệp, giúp bạn dễ dàng xây dựng CV dưới dạng portfolio trực tuyến, mang đến một giải pháp hiện đại và tiện lợi để giới thiệu bản thân một cách ấn tượng. Với giao diện trực quan, thân thiện và dễ sử dụng, bạn có thể nhanh chóng tạo ra một trang web cá nhân chuyên nghiệp để quảng bá kỹ năng, kinh nghiệm và thành tựu của mình đến nhà tuyển dụng, đối tác hoặc khách hàng tiềm năng.

Tính năng chính: 
  About – Giới thiệu bản thân, thông tin cá nhân.

  Resume – Trang CV chi tiết, bao gồm học vấn, kinh nghiệm làm việc và kỹ năng.

  Album – Danh mục các ảnh mình chia sẽ.
  
  Blog – Chia sẻ bài viết, kinh nghiệm hoặc tin tức liên quan đến lĩnh vực nghề nghiệp.
  
  Contact – Thông tin liên hệ để nhà tuyển dụng hoặc đối tác có thể kết nối với bạn.

👨‍💻Nguyễn Trần Việt Anh

# Chức năng
## Use Case
![image](https://github.com/user-attachments/assets/ad9b0dd6-fd16-4357-bb95-4427e5e4328a)


## Sơ đồ khối (Structural Diagram)
![sơ đồ khối](https://github.com/user-attachments/assets/1f0a6782-c1d9-4754-9f72-c65b56175fc1)

## Sơ đồ quan hệ
![Screenshot 2025-02-19 212034](https://github.com/user-attachments/assets/1082f52c-8d2b-4609-a8aa-bc11cfa503de)


## Sơ đồ thuật toán (Behavioural Diagram)

# Công nghệ (Technologies)

- Dùng PHP Laravel Framework

- Dùng mysql của Aiven để lưu trữ database

- Dùng Cloudinary để lưu trữ ảnh
# Cài đặt (Installation)

## Tạo project laravel

```
composer create-project --prefer-dist laravel/laravel QuanLyThuVien
php artisan serve
```

## Tích hợp Aiven và laravel
Cài đặt gói aiven-laravel:

```
composer require aiven-labs/aiven-laravel
```
Cấu hình kết nối:
```
php artisan aiven:getconfig
```
Câu hình .env cho Mysql trên Aiven:
```
DB_CONNECTION=mysql
DB_HOST=your-aiven-host
DB_PORT=your-aiven-port
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
DB_SSLMODE=require
```

## Tích hợp Cloudinary vào Laravel

Cài đặt gói cloudinary-laravel:
```
composer require cloudinary-labs/cloudinary-laravel

```
Cấu hình kết nối file .env
```
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```
# Triển khai (Deployment)
