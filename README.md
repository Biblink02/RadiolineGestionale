
# MedjugorjeService  
_A multilingual travel & services website built with Laravel 12 and advanced SEO architecture_  

## ✨ Why this project matters
MedjugorjeService is a full-stack Laravel 12 application designed for travel agencies and service providers, with a strong emphasis on **multilingual SEO optimization**, accessibility, and robust back-office operations.  

* **Per-language SEO** – Dynamic JSON-LD generated per locale with schema.org entities (Organization, LocalBusiness, FAQ).  
* **Google-first directives** – Automatic `<link rel="alternate" hreflang="xx">` tags for every route, canonical URLs, and coherent meta descriptions.  
* **Accessible & indexable** – Semantic HTML, ARIA roles, language-specific sitemaps for maximum search engine visibility.  
* **Modern PHP 8.3** – Enums, readonly properties, and attributes power robust validation and type-safety.  
* **CMS-like backend** – Admin panel for localized content management (texts, pages, media).  
* **Order management** – Full order lifecycle with PDF invoice/shipping note (“bolla”) generation directly from the dashboard.  
* **Hard-won extras** – Image optimization, lazy loading, multilingual sitemap.xml, structured data.  

---

## 🏗️ Tech stack  

| Layer         | Technology                                         | Highlight                                                                 |
|---------------|----------------------------------------------------|---------------------------------------------------------------------------|
| **Backend**   | Laravel 12, PHP 8.3                                | Multilingual routing, SEO middleware, order management with PDF export    |
| **Frontend**  | Blade, Alpine.js, TailwindCSS                      | SSR-ready, responsive and WCAG-compliant rendering                        |
| **SEO**       | JSON-LD per language, hreflang, canonical, sitemap | Fully aligned with Google’s multilingual SEO directives                   |
| **Data**      | MySQL/MariaDB, Eloquent with UUIDs                 | Localized tables with automatic fallback                                  |
| **Tooling**   | Docker, Composer, npm, Pint, ESLint, Prettier      | Unified development and deployment setup                                  |
| **Ops**       | Artisan CLI, CI friendly                           | Automated builds and SEO validation tasks                                 |  

---

## 🌍 Internationalisation & SEO  

* **Full i18n** – English (default) and additional locales powered by JSON translation catalogs.  
* **SEO-ready markup** – Structured data injected at runtime per language, ensuring Google interprets the right locale.  
* **Google directives compliance** – `hreflang` and `canonical` automatically included on every page for correct indexation.  
* **Multilingual sitemap** – Dynamic XML sitemap, segmented by language, refreshed on deployment.  

---

## ⚙️ Local setup  

```bash
# Prerequisites: Docker installed and running

git clone https://github.com/your-handle/medjugorje-service.git
cd medjugorje-service

cp .env.example .env    # edit DB creds, ips
cp src/.env.example src/.env    # edit DB creds, mail

# Build and start containers
docker compose up -d
````

---

## 🛠️ Useful artisan commands

| Command                   | Purpose                                                              |
| ------------------------- | -------------------------------------------------------------------- |
| `seo:generate-sitemap`    | Builds multilingual `sitemap.xml` with alternate language references |
| `seo:validate-hreflang`   | Ensures all localized routes include proper `<hreflang>` directives  |
| `orders:generate-bolla`   | Creates a PDF shipping note/invoice for completed orders             |
| `optimize`/`config:cache` | Zero-downtime cache warm-ups                                         |

---

## 📁 High-level folder map

```text
app/        Domain logic, SEO middleware, Models, Orders, PDF services
resources/  Blade templates, Alpine.js components, Tailwind, i18n JSON
database/   Migrations, Seeders, Factories
routes/     Web, API & CLI routes with locale grouping
tests/      Feature & Unit test suites, SEO and order flow tests
```

---

## 📜 License

Released under the **MIT license** — free to adapt for educational or commercial use (attribution appreciated).
