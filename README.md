# ✏️ tiny-laravel12-editor

A simple **Laravel + TinyMCE** based Article Management System that allows you to **create, edit, view, and delete articles** with rich HTML content support.

---

## 🚀 Features

✅ Full Laravel CRUD (Create, Read, Update, Delete)  
✅ TinyMCE Rich Text Editor  
✅ Image Upload inside the editor  
✅ Clean & Responsive Bootstrap 5 UI  
✅ MySQL Database support  

---

## 🛠️ Tech Stack

- **Backend:** Laravel  
- **Database:** MySQL  
- **Frontend:** Blade + Bootstrap 5  
- **Editor:** TinyMCE  

---

🖼️ Screenshots
<img width="1729" height="587" alt="Article List" src="https://github.com/user-attachments/assets/2f2d3b3a-e4b1-489b-8eb9-e036420c4ab5" /> 

<img width="1718" height="950" alt="TinyMCE Editor" src="https://github.com/user-attachments/assets/3869a6f4-d016-4043-95bd-ad338165e90c" />

## 📥 Installation Guide

### 1️⃣ Clone the Project
```bash
git clone https://github.com/your-username/tiny-laravel-editor.git
cd tiny-laravel-editor
2️⃣ Install Dependencies
composer install

3️⃣ Create .env File
cp .env.example .env
php artisan key:generate


Update your database configuration inside .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiny_editor
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Run Migrations
php artisan migrate

🧱 Database Structure

articles table:

Column	Type
id	bigint
title	string
content	text
created_at	timestamp
updated_at	timestamp
⚙️ TinyMCE Integration

Add TinyMCE CDN inside your Blade file:

<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>


Initialize TinyMCE:

tinymce.init({
    selector: '#content',
    height: 400,
    plugins: 'link image lists',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
});

📸 Image Upload Support

Add this route in routes/web.php:

Route::post('/upload-image', function() {
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


Create upload directory:

mkdir public/uploads

🧭 Project Routes
Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);

▶️ Run the Project
php artisan serve


Open in browser:

http://localhost:8000/articles

📁 Project Structure
tiny-laravel-editor/
│
├── app/
├── database/
├── resources/
│   └── views/
│       └── articles/
├── routes/
└── public/uploads/
