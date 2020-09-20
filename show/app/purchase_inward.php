<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_inward extends Model
{	
	protected $primaryKey = 'id';
    protected $table = 'vendor_id,branch_id,invoice_no,round_of_amount,invoice_date,delivery_note,buyer_order_no,buyer_order_date,delivery_date,dispatch_through';
}
