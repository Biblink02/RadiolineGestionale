<?php

namespace App\Services;

use Spatie\SchemaOrg\Schema;

class SchemaGenerator
{
    /**
     * Generate JSON-LD schema based on page key
     *
     * @param string $page
     * @return string
     */
    public static function for(string $page): string
    {
        switch ($page) {
            case 'home':
                Schema::
                $schema = Schema::webSite()
                    ->name(__('head.home.title'))
                    ->description(__('head.home.description'))
                    ->url(url(locale().'/'));
                break;

            case 'about':
                $schema = Schema::aboutPage()
                    ->name(__('head.about.title'))
                    ->description(__('head.about.description'))
                    ->url(url(locale().'/about-us'));
                break;

            case 'proposals':
                $schema = Schema::webPage()
                    ->name(__('head.proposals.title'))
                    ->description(__('head.proposals.description'))
                    ->url(url(locale().'/proposals'));
                break;

            case 'jubilee':
                $schema = Schema::event()
                    ->name(__('head.jubilee.title'))
                    ->description(__('head.jubilee.description'))
                    ->url(url(locale().'/jubilee-2025'))
                    ->startDate('2025-01-01')
                    ->endDate('2025-12-31');
                break;

            case 'radio-rent':
                $schema = Schema::service()
                    ->name(__('head.radio_rent.title'))
                    ->description(__('head.radio_rent.description'))
                    ->url(url(locale().'/radio-rent'));
                break;

            case 'contact':
                $schema = Schema::contactPage()
                    ->name(__('head.contact.title'))
                    ->description(__('head.contact.description'))
                    ->url(url(locale().'/contact-us'));
                break;

            case 'services':
                $schema = Schema::service()
                    ->name(__('head.services.title'))
                    ->description(__('head.services.description'))
                    ->url(url(locale().'/services'));
                break;

            case 'offices':
                $schema = Schema::webPage()
                    ->name(__('head.offices.title'))
                    ->description(__('head.offices.description'))
                    ->url(url(locale().'/offices'));
                break;

            case 'gallery':
                $schema = Schema::webPage()
                    ->name(__('head.gallery.title'))
                    ->description(__('head.gallery.description'))
                    ->url(url(locale().'/gallery'));
                break;

            case 'payments':
                $schema = Schema::webPage()
                    ->name(__('head.payments.title'))
                    ->description(__('head.payments.description'))
                    ->url(url(locale().'/payments'));
                break;

            case 'privacy':
                $schema = Schema::webPage()
                    ->name(__('head.privacy.title'))
                    ->description(__('head.privacy.description'))
                    ->url(url(locale().'/privacy-policy'));
                break;

            default:
                $schema = Schema::webPage()
                    ->name(__('head.default.title'))
                    ->description(__('head.default.description'))
                    ->url(url()->current());
        }

        return $schema->toScript();
    }
}
