<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable=[
        'invoice_number',
        'invoice_Date',
        'due_date',
        'product',
        'section_id',
        'amount_collection',
        'amount_Commission',
        'discount',
        'value_VAT',
        'rate_VAT',
        'total',
        'status',
        'value_Status',
        'note',
        'payment_Date',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Sections::class,'section_id');
    }
}
