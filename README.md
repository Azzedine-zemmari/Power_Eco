# 🛍️ E‑Commerce Project

An e‑commerce platform developed with **Vue.js** (frontend), **Laravel** (backend), and **PostgreSQL** (database).  
This project is built to cover all the essential needs of an online store, including user accounts, a cart, order placement, role‑based access for administrators, sales staff, and product managers, as well as statistical dashboards.

---

## ⚡️ Technologies Used
- **Frontend:** Vue.js  
- **Backend:** Laravel  
- **Database:** PostgreSQL  
- **Authentication:** Laravel Sanctum  
- **Data Export:** PDF generation (Invoices)

---

## ✅ Features

### 👤 User Side
- Registration and login
- Password reset feature
- Products listing with category, name, price filtering
- Product details page
- Add products to cart
- Edit quantity in cart
- Finalize order via checkout page:
  - Displays order summary
  - Captures required order information
- Dashboard with user profile:
  - Edit personal information
- Quote page:
  - Displays available products, quantity, and total price
- Invoice page:
  - Displays user’s invoices for every order
  - Ability to download invoices as PDFs

---

### 👔 Admin Side
- Create user accounts (for sales staff, product managers, etc.)
- Activate or archive user accounts
- Only activated users can log in

---

### 🛠️ Product Manager
- Complete product management (CRUD)
- Filter products by category
- Add/edit product categories
- Import products from an Excel file
- Product filtering by:
  - Min/Max price
  - Min/Max stock
  - Name
- Automatic pricing and margin calculations:
  - Enter cost and margin ➔ Sale price calculated
  - Enter cost and sale price ➔ Margin calculated
- Dashboard statistics:
  - Total products
  - Total categories
  - Total sales

---

### 📋 Commercial Role
- Sales List page:
  - Displays all orders
  - Shows products per order, quantity, price, and status
- Ability to update order status:
  - **Order** ➔ **Paid** ➔ **Delivered** ➔ **Received**

---

## 🗂️ Project Architecture
The project uses an **MVC structure** (Model‑View‑Controller) in Laravel for the backend and a **component‑based structure** in Vue.js for the frontend.

---
