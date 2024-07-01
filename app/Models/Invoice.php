<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
      "paymentData" => "array",
      "totalCost" => "float",
    ];

    protected static function boot(): void
    {
        parent::boot();

        // Automatically generate a serial number when creating a new invoice
        static::creating(function ($invoice) {
            $invoice->serial = $invoice->generateSerialNumber();
        });
    }

    /**
     * Generate a unique serial number for the invoice.
     *
     * @return string
     */
    public function generateSerialNumber(): string
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $lastInvoice = static::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->first();

        $number = 1;

        if ($lastInvoice) {
            $lastSerialNumber = $lastInvoice->serial;
            $lastNumber = (int) substr($lastSerialNumber, -4);
            $number = $lastNumber + 1;
        }

        return sprintf('%s-%s-%04d', $prefix, $date, $number);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "student_id");
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class, "invoice_id");
    }

    public function enrollments():HasMany
    {
        return $this->hasMany(Enrollment::class, "invoice_id");
    }
}
