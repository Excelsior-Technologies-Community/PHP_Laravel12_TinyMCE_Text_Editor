# PHP_Laravel12_TinyMCE_Text_Editor

A clean and beginner‑friendly **Laravel 12 + TinyMCE** based Article Management System. This project demonstrates how to integrate a rich text editor into Laravel and perform full **CRUD (Create, Read, Update, Delete)** operations with HTML content and image uploads.

---

## Project Overview

This project is designed for learning and real‑world usage. It allows administrators or users to:

* Create articles with rich formatted content
* Edit existing articles using TinyMCE
* Upload and embed images inside the editor
* View rendered HTML content safely
* Delete articles from the system

It is ideal for blogs, CMS systems, admin panels, and interview demonstrations.

---

## Features

* Full Laravel CRUD operations
* TinyMCE rich text editor integration
* Image upload support inside editor
* Clean and responsive Bootstrap 5 UI
* MySQL database integration
* Simple and readable code structure

---

## Tech Stack

* **Backend:** Laravel 12
* **Database:** MySQL
* **Frontend:** Blade Templates + Bootstrap 5
* **Editor:** TinyMCE (CDN based)

---

## Screenshots

<img width="1729" height="587" alt="Article List" src="https://github.com/user-attachments/assets/2f2d3b3a-e4b1-489b-8eb9-e036420c4ab5" />

<img width="1718" height="950" alt="TinyMCE Editor" src="https://github.com/user-attachments/assets/3869a6f4-d016-4043-95bd-ad338165e90c" />

---

## Installation Guide

### 1. Clone the Project

```bash
git clone https://github.com/your-username/tiny-laravel-editor.git
cd tiny-laravel-editor
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiny_editor
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations

```bash
php artisan migrate
```

---

## Database Structure

### `articles` Table

| Column     | Type                 |
| ---------- | -------------------- |
| id         | bigint (primary key) |
| title      | string               |
| content    | text                 |
| created_at | timestamp            |
| updated_at | timestamp            |

---

## TinyMCE Integration

### Add TinyMCE CDN

Include this script in your Blade layout or form view:

```html
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
```

### Initialize TinyMCE

```html
<script>
tinymce.init({
    selector: '#content',
    height: 400,
    plugins: 'link image lists',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    automatic_uploads: true,
    images_upload_url: '/upload-image',
    images_upload_credentials: true
});
</script>
```

---

## Image Upload Support

### Route Definition

Add the following route in `routes/web.php`:

```php
Route::post('/upload-image', function () {
    if (request()->hasFile('file')) {
        $file = request()->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        return response()->json([
            'location' => url('uploads/' . $filename)
        ]);
    }

    return response()->json(['error' => 'No file uploaded'], 400);
})->name('upload.image');
```

### Create Upload Directory

```bash
mkdir public/uploads
```

Ensure the directory is writable.

---

## Application Routes

```php
Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);
```

---

## Run the Project

```bash
php artisan serve
```

Open in browser:

```
http://localhost:8000/articles
```

---

## Project Structure

```
tiny-laravel-editor/
├── app/
│   └── Http/Controllers/ArticleController.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       └── articles/
├── routes/
│   └── web.php
└── public/
    └── uploads/
```

---

## Security & Best Practices

* Use `@csrf` in all forms
* Validate input before saving
* Sanitize output when displaying content
* Restrict image upload size and type in production
* Store uploads outside public directory for advanced security

---

## Learning Purpose

This project is useful for:

* Laravel beginners
* CMS or blog systems
* Rich text editor integration examples
* Interview demonstrations
* Practical CRUD applications

---

This project is open‑source and free to use for learning and development purposes.
