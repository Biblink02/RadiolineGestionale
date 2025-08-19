<?php

namespace App\Services;

use DateTime;
use Spatie\SchemaOrg\BaseType;
use Spatie\SchemaOrg\Contracts\ThingContract;
use Spatie\SchemaOrg\Schema;

class SchemaGenerator
{
    /**
     * Restituisce lo script JSON-LD (stringa) adatto alla pagina corrente.
     *
     * @param string $page Slug della pagina (es. 'about-us', 'home', ecc.)
     * @return string         Script <script type="application/ld+json">…</script>
     */
    public static function for(string $page): string
    {
        $url = url(secure: true)->current();
        $locale = app()->getLocale();

        $schema = match ($page) {
            'home' => Schema::webPage(),
            'about-us' => Schema::aboutPage(),
            'contact-us' => Schema::contactPage(),
            'privacy-policy' => Schema::webPage(),
            'gallery' => Schema::imageGallery(),
            'jubilee-2025' => Schema::webPage(),
            'radio-rent' => Schema::service(),
            'services' => Schema::service(),
            'offices' => Schema::localBusiness(),
            'payments' => Schema::webPage(),
            'proposals' => Schema::webPage(),
            default => Schema::webPage(),
        };

        $schema = $schema
            ->name(__("schema-org.$page.title") ?: ucfirst(str_replace('-', ' ', $page)))
            ->url($url)
            ->inLanguage($locale);

        return match ($page) {
            'home' => self::homePage($schema, $url, $locale),
            'jubilee-2025' => self::jubileePage($schema, $url, $locale),
            'about-us' => self::aboutPage($schema, $locale),
            'radio-rent' => self::radioRentPage($schema, $locale),
            'offices' => self::officesPage($schema, $locale),
            default => self::defaultPage($schema, $page, $locale),
        };
    }

    /** Home (/) */
    private static function homePage(BaseType $schema, string $url, string $locale): string
    {
        return $schema
            ->description(__('schema-org.home.hero.subtitle1') . ' – ' . __('schema-org.home.hero.subtitle2'))
            ->isPartOf(self::webSiteEntity())
            ->mainEntity(self::organizationEntity())
            ->primaryImageOfPage(
                Schema::imageObject()
                    ->url(asset('images/logo.png', secure: true))
                    ->caption(__('schema-org.home.hero.title'))
                    ->inLanguage($locale)
            )
            ->breadcrumb(self::generateBreadcrumbs('home', $locale))
            ->toScript();
    }

    /** Jubilee 2025 */
    private static function jubileePage(BaseType $schema, string $url, string $locale): string
    {
        return $schema
            ->description(__('schema-org.jubilee.body.paragraph1'))
            ->isPartOf(self::webSiteEntity())
            ->mainEntity(
                Schema::thing()
                    ->name('Jubilee 2025')
                    ->alternateName('Holy Year 2025')
                    ->description(__('schema-org.jubilee.body.paragraph2.before-quote') . ' "' . __('schema-org.jubilee.body.paragraph2.quote') . '"')
                    ->url($url)
            )
            ->primaryImageOfPage(
                Schema::imageObject()
                    ->url(asset('images/jubilee-logo.png', secure: true))
                    ->caption(__('schema-org.jubilee.body.image-alt'))
                    ->inLanguage($locale)
            )
            ->breadcrumb(self::generateBreadcrumbs('jubilee-2025', $locale))
            ->toScript();
    }

    /** About Us */
    private static function aboutPage(BaseType $schema, string $locale): string
    {
        return $schema
            ->about(self::organizationEntity())
            ->breadcrumb(self::generateBreadcrumbs('about-us', $locale))
            ->toScript();
    }

    /** Radio-Rent (service) */
    private static function radioRentPage(BaseType $schema, string $locale): string
    {
        return $schema
            ->serviceType('Radio guide rental for pilgrimages')
            ->provider(self::organizationEntity())
            ->areaServed(Schema::place()->name('Medjugorje'))
            ->offers(
                Schema::offer()
                    ->availability(Schema::itemAvailability()->url('https://schema.org/InStock'))
            )
            ->description(__('schema-org.radio-rent.body.intro'))
            ->mainEntityOfPage(url()->current())
            ->breadcrumb(self::generateBreadcrumbs('radio-rent', $locale))
            ->toScript();
    }

    /** Offices (LocalBusiness) */
    private static function officesPage(BaseType $schema, string $locale): string
    {
        return $schema
            ->description(__('schema-org.offices.body.card.subtitle'))
            ->address(
                Schema::postalAddress()
                    ->streetAddress('Pape Ivana Pavla II 14')
                    ->addressLocality('Medjugorje')
                    ->postalCode('88266')
                    ->addressCountry('BA')
            )
            ->geo(
                Schema::geoCoordinates()
                    ->latitude(43.19106)
                    ->longitude(17.67872)
            )
            ->breadcrumb(self::generateBreadcrumbs('offices', $locale))
            ->toScript();
    }

    /** Pagine generiche che non richiedono altri campi */
    private static function defaultPage(BaseType $schema, string $page, string $locale): string
    {
        return $schema
            ->breadcrumb(self::generateBreadcrumbs($page, $locale))
            ->toScript();
    }


    /** Organization da riutilizzare */
    private static function organizationEntity(): ThingContract
    {
        return Schema::organization()
            ->name('Medjugorje Service')
            ->url(env('APP_URL'))
            ->logo(asset('images/logo.png', secure: true))
            ->foundingDate(new DateTime('2012-01-01'))
            ->contactPoint(
                Schema::contactPoint()
                    ->telephone('+387 063 144 027')
                    ->contactType('customer service')
            );
    }

    /** WebSite entity (senza toScript) */
    private static function webSiteEntity(): BaseType
    {
        return Schema::webSite()
            ->name('Medjugorje Service')
            ->url(env('APP_URL'));
    }

    /**
     * Genera dinamicamente un BreadcrumbList a due livelli:
     *  - Home
     *  - Pagina corrente (se diversa da home)
     */
    private static function generateBreadcrumbs(string $page, string $locale): BaseType
    {
        $baseUrl = url('/' . $locale, secure: true);
        $elements = [];

        // Home
        $elements[] = Schema::listItem()
            ->position(1)
            ->identifier('Medjugorje#Home')
            ->name(__('schema-org.Home'))
            ->item(Schema::thing()->url($baseUrl));

        // Secondo livello (se non home)
        if ($page !== 'home') {
            $elements[] = Schema::listItem()
                ->position(2)
                ->identifier("Medjugorje#$page")
                ->name(__("schema-org.$page.title") ?: ucfirst(str_replace('-', ' ', $page)))
                ->item(Schema::thing()->url($baseUrl . '/' . $page));
        }

        return Schema::breadcrumbList()->itemListElement($elements);
    }


    /** JSON-LD per Organization (inseriscilo una sola volta nel layout) */
    public static function organization(): string
    {
        return self::organizationEntity()->toScript();
    }

    /** JSON-LD per WebSite con SearchAction (inseriscilo nel layout) */
    public static function website(): string
    {
        return Schema::webSite()
            ->name('Medjugorje Service')
            ->url(env('APP_URL'))
            ->potentialAction(
                Schema::searchAction()
                    ->target(env('APP_URL') . '/search?q={search_term_string}')
                    ->queryInput('required name=search_term_string')
            )
            ->toScript();
    }
}
