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

###2. Move the Project to XAMPP's htdocs Directory
Placez le dossier cloné dans le répertoire htdocs de votre installation XAMPP :

Windows
C:\xampp\htdocs\serenity-springs-website

macOS/Linux
/Applications/XAMPP/htdocs/serenity-springs-website
ou
/opt/lampp/htdocs/serenity-springs-website
###3. Start Apache and MySQL
Lancez le XAMPP Control Panel et démarrez les services Apache et MySQL.
###4. Create and Import the Database
Ouvrez votre navigateur et allez sur :
http://localhost/phpmyadmin

Créez une nouvelle base de données nommée :
serenity_springs

Sélectionnez cette base de données, puis allez dans l’onglet Importer.

Choisissez le fichier suivant depuis le projet :
database/serenity_springs.sql

Cliquez sur Go pour importer les tables et les données.
###5. Configure the Database Connection
Ouvrez le fichier de configuration (par exemple config.php) et assurez-vous que les paramètres suivants sont corrects
6. Access the Website
Une fois tout configuré, accédez à l'application via votre navigateur :
```bash
http://localhost/serenity-springs-website
