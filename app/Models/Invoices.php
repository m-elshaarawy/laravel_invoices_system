<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
