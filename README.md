<div align="left">
  <h2 style="text-align: center; color: #2e7d32;">🌿 Serenity Springs Website</h2><br/>
  <h2 style="text-align: center; color: #2e7d32;">🧭 Overview</h2>
  <p>
    Serenity Springs Website is a comprehensive web platform built to serve farmers, eco-conscious consumers, and the agriculture community.
    Our mission is to empower sustainable farming practices by providing tools, services, and educational resources — all in one place.
    This platform bridges the gap between producers and consumers, offering features like real-time weather data, integrated chatbot assistance,
    educational events, and a dedicated marketplace for eco-friendly products.
  </p>

  <section id="audience" style="padding: 2em; background-color: #f9f9f9; font-family: Arial, sans-serif;">
    <h2 style="text-align: center; color: #2e7d32;">🌍 Who Is This Platform For?</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 2em; margin-top: 2em;">
      <div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 style="color: #388e3c;">👩‍🌾 Farmers</h3>
        <p>
          Utilize weather forecasting tools, access veterinary support, and connect with eco-conscious consumers to sell sustainable products efficiently.
        </p>
      </div>
      <div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 style="color: #00796b;">🛒 Consumers</h3>
        <p>
          Discover healthy, environmentally friendly products, support local producers, and make responsible, sustainable purchasing decisions.
        </p>
      </div>
      <div style="flex: 1 1 250px; background: white; border-radius: 10px; padding: 1.5em; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 style="color: #5d4037;">🌱 Agricultural Community</h3>
        <p>
          Participate in educational events, share expertise, and help build a more sustainable and resilient agricultural future.
        </p>
      </div>
    </div>
  </section>

  <section id="installation" style="padding: 2em; background-color: #e8f5e9; font-family: Arial, sans-serif;">
    <h2 style="text-align: center; color: #1b5e20;">🛠️ Installation & Configuration</h2>
    <ol style="max-width: 900px; margin: auto; font-size: 1em; line-height: 1.6;">
      <li><strong>Clone the repository:</strong><br/>
        <code>git clone https://github.com/molka-makri/serenity-springs-website.git</code>
      </li><br/>

      <li><strong>Move the project to XAMPP's htdocs directory:</strong><br/>
        - Windows: <code>C:\xampp\htdocs\serenity-springs-website</code><br/>
        - macOS/Linux: <code>/opt/lampp/htdocs/serenity-springs-website</code>
      </li><br/>

      <li><strong>Start Apache and MySQL:</strong><br/>
        Open the XAMPP Control Panel and click "Start" next to Apache and MySQL.
      </li><br/>

      <li><strong>Configure the database:</strong><br/>
        - Go to <code>http://localhost/phpmyadmin</code><br/>
        - Create a new database (e.g., <code>serenity</code>)<br/>
        - Import the SQL file from the <code>database/</code> folder of the project.
      </li><br/>

      <li><strong>Edit your database connection (e.g., config.php):</strong><br/>
        Example:
        <pre style="background: #f0f0f0; padding: 1em; border-radius: 8px;">
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'serenity');
        </pre>
      </li><br/>

      <li><strong>Access the website:</strong><br/>
        Open your browser and navigate to:<br/>
        <code>http://localhost/serenity-springs-website</code>
      </li>
    </ol>
  </section>
</div>
