<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice) {
            $invoice->serial = $invoice->generateSerial();
        });
    }

    public function generateSerial(): int
    {
        $now = Carbon::now();

        // Format the current date and time
        $dateTimeFormat = $now->format('Y-m-d-H-i');

        // Get the total number of invoices
        $totalInvoicesCount = self::count() + 1;

        // Get the number of invoices for this student
        $invoicesForStudentCount = $this->student->invoices()->count() + 1;

        // Concatenate the parts to form the serial
        return $dateTimeFormat.$totalInvoicesCount.$invoicesForStudentCount.$this->student_id;
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "student_id");
    }
}
