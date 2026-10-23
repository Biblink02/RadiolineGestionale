<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesTest extends TestCase
{
    public function test_public_pages_and_legacy_redirects_work_in_every_language(): void
    {
        $this->withoutVite();
        $pages = ['', 'about-us', 'proposals', 'payments', 'jubilee-2025', 'privacy-policy', 'radio-rent', 'contact-us', 'services', 'offices', 'gallery'];

        foreach ($pages as $page) {
            $this->get('/'.$page)->assertRedirect('/en'.($page ? '/'.$page : ''));

            foreach (config('custom.lang.available') as $locale) {
                $this->get('/'.$locale.($page ? '/'.$page : ''))
                    ->assertOk()
                    ->assertHeader('Content-Language', $locale);
            }
        }

        $this->get('/xx/contact-us')->assertNotFound();
    }
}
