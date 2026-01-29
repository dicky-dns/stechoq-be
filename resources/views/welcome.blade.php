<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stechoq Backend API Test</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
::-webkit-scrollbar {
  width: 8px;
}
::-webkit-scrollbar-track {
  background: #1f2937; 
}
::-webkit-scrollbar-thumb {
  background-color: #4b5563;
  border-radius: 4px;
}
</style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans min-h-screen py-[59px] mx-auto max-w-5xl">

  <header class="mb-6 border-b border-gray-700 pb-4">
    <h1 class="text-4xl font-bold mb-2">🚀 Stechoq Backend API Test</h1>
<p class="text-gray-400 flex items-center gap-2">
    Practical Test - Dicky DNS - Laravel 12 & PostgreSQL
    <a href="https://github.com/dicky-dns/stechoq-be" target="_blank" 
       class="text-gray-200 underline text-sm flex items-center gap-1 hover:text-white transition">
        <span>View on GitHub</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7m0 0v7m0-7L10 14" />
        </svg>
    </a>
</p>
  </header>

  <section class="mb-6">
    <h2 class="text-2xl font-bold mb-2">📦 Tech Stack</h2>
    <ul class="list-disc list-inside text-gray-300">
      <li>Laravel 12</li>
      <li>PHP 8.3</li>
      <li>PostgreSQL 16</li>
      <li>Docker & Docker Compose</li>
    </ul>
    <hr class="border-gray-700 my-4">
  </section>

  <section class="mb-6">
    <h2 class="text-2xl font-bold mb-2">⚙️ Prasyarat</h2>
    <ul class="list-disc list-inside text-gray-300">
      <li>Docker</li>
      <li>Docker Compose</li>
    </ul>
    <hr class="border-gray-700 my-4">
  </section>

  <section class="mb-6">
    <h2 class="text-2xl font-bold mb-2">🚀 Quick Start & Setup</h2>
    <pre class="bg-gray-800 rounded-lg overflow-x-auto relative">
      <button class="absolute top-2 right-2 bg-gray-700 text-gray-100 px-2 py-1 rounded cursor-pointer text-sm hover:bg-gray-600" onclick="copyCode(this)">Copy</button>
        <code class="text-green-400 left-[-30px] top-[0] relative">
        git clone &lt;URL_REPOSITORY_GIT&gt;

        cd &lt;folder-project&gt;

        <span class="text-gray-400"># jalankan docker compose</span>
        docker compose up -d --build

        <span class="text-gray-400"># buat .env</span>
        copy .env.example menjadi .env

        <span class="text-gray-400"># Jalankan composer install & atur ownership</span>
        docker exec app composer install --no-interaction --prefer-dist
        sudo chown -R 33:33 storage bootstrap/cache

        <span class="text-gray-400"># jalankan app key generate dan migrasi & seeder</span>
        docker exec app php artisan key:generate
        docker exec app php artisan migrate --seed

        <span class="text-gray-400"># Done ✅</span>
        <span class="text-gray-400"># Jalankan pada postman / Insomnia base url http://localhost:8001</span>
        </code>
    </pre>
    <hr class="border-gray-700 my-4">
  </section>

  <section class="mb-6">
    <h2 class="text-2xl font-semibold mb-2">Struktur Folder</h2>
    <pre class="bg-gray-800 py-4 rounded-md overflow-x-auto text-sm">
    <code class="left-[-5px] top-[0] relative">
        project-laravel/
        ├── app/
        ├── bootstrap/
        ├── config/
        ├── public/
        ├── storage/
        ├── docker/
        │   └── nginx/
        │       └── default.conf
        ├── docker-compose.yml
        ├── Dockerfile
        ├── .env
        └── README.md
    </code>
    </pre>
    <hr class="border-gray-700 my-4">
  </section>

    <section class="mb-6">
    <h2 class="text-2xl font-bold mb-2">🗄️ Konfigurasi Database</h2>
    <pre class="bg-gray-800 py-0 rounded-lg overflow-x-auto relative">
      <button class="absolute top-2 right-2 bg-gray-700 text-gray-100 px-2 py-1 rounded cursor-pointer text-sm hover:bg-gray-600" onclick="copyCode(this)">Copy</button>
      <code class="text-green-400 left-[-30px] top-[0] relative">
        DB_CONNECTION=pgsql
        DB_HOST=postgres
        DB_PORT=5432
        DB_DATABASE=stechoq_db
        DB_USERNAME=stechoq_user
        DB_PASSWORD=secret
      </code>
    </pre>
    <p class="text-gray-400 mt-2">⚠️ Jangan ganti <code>DB_HOST</code> menjadi <code>localhost</code>. Konfigurasi harus sesuai <code>docker-compose.yml</code>.</p>
    <hr class="border-gray-700 my-4">
  </section>
  <section>
    <div class="mt-4 text-gray-300">
      <h2 class="text-2xl font-bold mb-2">👥 Dummy User untuk Login (Seed):</h2>
      <pre class="bg-gray-800 py-[30px] px-0 rounded-lg overflow-x-auto text-green-400">
        <code class="text-green-400 left-[-65px] top-[0] relative">
            <b class="text-gray-400">Manager</b>
            email: manager1@example.com
            password: password
    
            <b class="text-gray-400">Manager</b>
            email: manager2@example.com
            password: password

            <b class="text-gray-400">Engineer</b>
            email: engineer1@example.com
            password: password

            <b class="text-gray-400">Engineer</b>
            email: engineer2@example.com
            password: password

            <b class="text-gray-400">Engineer</b>
            email: engineer3@example.com
            password: password

            <b class="text-gray-400">Engineer</b>
            email: engineer4@example.com
            password: password
        </code>
      </pre>
    </div>
    <hr class="border-gray-700 my-4">
   </section>


  <section class="mb-6">
    <h2 class="text-2xl font-bold mb-2">❗ Troubleshooting</h2>
    <ul class="list-disc list-inside text-gray-300">
      <li><strong>Database connection refused</strong> → pastikan <code>DB_HOST=postgres</code></li>
      <li><strong>Port 8001 bentrok</strong> → ubah port di <code>docker-compose.yml</code></li>
      <li><strong>Container mati setelah restart laptop</strong> → sudah di-handle dengan <code>restart: unless-stopped</code></li>
    </ul>
  </section>

<script>
function copyCode(button) {
  const code = button.nextElementSibling.innerText;
  navigator.clipboard.writeText(code).then(() => {
    button.innerText = "Copied!";
    setTimeout(() => button.innerText = "Copy", 1500);
  });
}
</script>

</body>
</html>
