<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function nomor_registrasi()
    {
        return str_pad(Supplier::count() + 1, 3, '0', STR_PAD_LEFT) . '/PRC/REG-VENDOR/' . Carbon::now()->addHours(8)->format('y');
    }
}
