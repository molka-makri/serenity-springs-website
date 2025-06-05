# 🌿 Serenity Springs Website

## 🧭 Overview

Serenity Springs Website is a comprehensive web platform built to serve farmers, eco-conscious consumers, and the agriculture community.  
Our mission is to empower sustainable farming practices by providing tools, services, and educational resources — all in one place.  
This platform bridges the gap between producers and consumers, offering features like real-time weather data, integrated chatbot assistance, educational events, and a dedicated marketplace for eco-friendly products.

## 🌍 Who Is This Platform For?

<div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-around; margin-top: 20px;">

<div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

### 👩‍🌾 Farmers

Utilize weather forecasting tools, access veterinary support, and connect with eco-conscious consumers to sell sustainable products efficiently.

</div>

<div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

### 🛒 Consumers

Discover healthy, environmentally friendly products, support local producers, and make responsible, sustainable purchasing decisions.

</div>

<div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

### 🌱 Agricultural Community

Participate in educational events, share expertise, and help build a more sustainable and resilient agricultural future.

</div>

</div>

## 🛠️ Installation & Configuration

### 1. Clone the Repository

```bash
git clone https://github.com/molka-makri/serenity-springs-website.git
cd serenity-springs-website
```

### 2. Move the Project to XAMPP's htdocs Directory
Place the cloned folder into the htdocs directory of your XAMPP installation:

Windows
C:\xampp\htdocs\serenity-springs-website

macOS/Linux
/Applications/XAMPP/htdocs/serenity-springs-website
ou
/opt/lampp/htdocs/serenity-springs-website
### 3. Start Apache and MySQL
Open the XAMPP Control Panel and start the Apache and MySQL services.
### 4. Create and Import the Database
1.Open your browser and go to:
http://localhost/phpmyadmin

2.Create a new database named:
serenity_springs

3.Select the newly created database, then go to the Import tab.

4.Choose the SQL file from the project folder:
database/serenity_springs.sql

5.Click Go to import the database structure and data.


### 5. Configure the Database Connection
Open the configuration file (for example config.php) and make sure the following settings match your local setup:
```bash
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'serenity_springs');
````
### 6. Access the Website
Once everything is configured, open your browser and go to:
```bash
http://localhost/serenity-springs-website/view/index.html
