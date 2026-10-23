<?php

namespace Tests\Feature;

use App\Actions\Custom\CreatePdf;
use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Mockery;
use RuntimeException;
use Tests\TestCase;

class PdfTest extends TestCase
{
    use DatabaseMigrations;

    public function test_pdf_is_replaced_only_after_successful_generation(): void
    {
        Storage::fake('public');
        $loan = Loan::create(['pdf_url' => 'loan_1000.pdf']);
        Storage::disk('public')->put($loan->pdf_url, 'old PDF');

        CreatePdf::createPdf($loan);

        Storage::disk('public')->assertMissing('loan_1000.pdf');
        $this->assertStringStartsWith('%PDF-', Storage::disk('public')->get($loan->pdf_url));
        $this->get('/pdf/'.$loan->pdf_url)->assertOk()->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_generation_failure_keeps_the_previous_pdf_and_database_reference(): void
    {
        Storage::fake('public');
        $loan = Loan::create(['pdf_url' => 'old.pdf']);
        Storage::disk('public')->put('old.pdf', 'old PDF');
        Pdf::shouldReceive('loadView')->once()->andThrow(new RuntimeException('render failed'));

        try {
            CreatePdf::createPdf($loan);
            $this->fail('Expected PDF rendering to fail.');
        } catch (RuntimeException $exception) {
            $this->assertSame('render failed', $exception->getMessage());
        }

        $this->assertSame('old.pdf', $loan->fresh()->pdf_url);
        $this->assertSame('old PDF', Storage::disk('public')->get('old.pdf'));
    }

    public function test_database_failure_preserves_old_pdf_and_removes_new_file(): void
    {
        Storage::fake('public');
        $loan = Loan::create(['pdf_url' => 'old.pdf']);
        Storage::disk('public')->put('old.pdf', 'old PDF');
        Loan::saving(fn () => throw new RuntimeException('save failed'));

        try {
            CreatePdf::createPdf($loan);
            $this->fail('Expected database save to fail.');
        } catch (RuntimeException $exception) {
            $this->assertSame('save failed', $exception->getMessage());
        } finally {
            Loan::flushEventListeners();
        }

        $this->assertSame('old.pdf', $loan->fresh()->pdf_url);
        $this->assertSame(['old.pdf'], Storage::disk('public')->files());
    }

    public function test_download_rejects_non_pdf_paths_and_missing_files(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('notes.txt', 'private notes');
        $this->getJson('/pdf/notes.txt')->assertUnprocessable();
        $this->getJson('/pdf/missing.pdf')->assertNotFound();
    }

    public function test_cancelled_save_keeps_the_previous_pdf(): void
    {
        Storage::fake('public');
        $loan = Loan::create(['pdf_url' => 'old.pdf']);
        Storage::disk('public')->put('old.pdf', 'old PDF');
        Loan::saving(fn () => false);

        try {
            CreatePdf::createPdf($loan);
            $this->fail('Expected the cancelled save to fail.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Unable to save the loan PDF reference.', $exception->getMessage());
        } finally {
            Loan::flushEventListeners();
        }

        $this->assertSame('old.pdf', $loan->fresh()->pdf_url);
        $this->assertSame(['old.pdf'], Storage::disk('public')->files());
    }

    public function test_write_failure_keeps_the_previous_database_reference(): void
    {
        $loan = Loan::create(['pdf_url' => 'old.pdf']);
        $disk = Mockery::mock();
        Storage::shouldReceive('disk')->with('public')->andReturn($disk);
        $disk->shouldReceive('put')->once()->andReturnFalse();
        $disk->shouldReceive('delete')->once()->withArgs(fn ($path) => $path !== 'old.pdf');

        try {
            CreatePdf::createPdf($loan);
            $this->fail('Expected storage write to fail.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Unable to save the loan PDF.', $exception->getMessage());
        }
        $this->assertSame('old.pdf', $loan->fresh()->pdf_url);
    }
}
