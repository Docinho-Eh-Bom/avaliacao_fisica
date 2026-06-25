<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class CleanPdfCacheJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Storage::deleteDirectory($this->path);
    }
}
