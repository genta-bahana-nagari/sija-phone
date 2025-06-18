# 📱 SIJA Phone - Laravel Project

A smartphone catalog web application built with Laravel that allows users to:

- Get smartphone recommendations based on preferences  
- View products by brand  
- Search and filter smartphones by stock status and brand  
- Browse products with a modern, responsive, and lightweight interface  

---

## 🔧 Key Features

- ✅ **Personalized recommendations based on user preferences**  
- 🔍 **Dynamic search and filtering**  
- 🏷️ **Brand and stock status filters**  
- 🔄 **"Load More" button for seamless pagination**  
- 📸 **Modern and mobile-friendly UI**  
- 📦 **Product stock availability and quantity display**  
- 🚀 **Image performance optimization (lazy loading)**  

---

## 🛠️ Technologies Used

- [Laravel](https://laravel.com/) 12  
- [Tailwind via CDN](https://tailwindcss.com/)  
- [Filament](https://filamentphp.com/) 3  
- [Filament Shield](https://github.com/ryangjchandler/filament-shield)  

---

## ⚙️ Installation

1. **Clone the repository:**
   ```bash
   git clone -b main --single-branch https://github.com/genta-bahana-nagari/phone_store.git
   cd phone_store
   ```
   > The `main` branch is stable and tested.

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Copy environment file and generate app key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Install and configure Filament Shield and create a super admin user:**
   ```bash
   php artisan make:filament-user
   php artisan shield:generate
   php artisan shield:super-admin --panel
   ```

5. **Run the local development server:**
   ```bash
   php artisan serve
   ```

---

## 🔐 Roles & Permissions

Role management is powered by Filament Shield with the following roles:

- **Super Admin** – Full access to all modules and acts as a seller  
- **Customer** – Buyer role, frontend access only  

Manage roles and permissions using:
```bash
php artisan shield:generate
php artisan shield:super-admin
```

---

## 🤝 Contributing

Contributions are always welcome!  
You can fork the repo and open a pull request — or clone and build locally first to test your changes.

---

## 👤 Author
- **Genta Bahana Nagari** – [LinkedIn](https://www.linkedin.com/in/genta-bahana-nagari/) | [GitHub](https://github.com/genta-bahana-nagari)

---

## 🌟 Show Your Support
If you find this script helpful, feel free to ⭐ the repository and share it with others!

---

## 📜 License
This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

---
