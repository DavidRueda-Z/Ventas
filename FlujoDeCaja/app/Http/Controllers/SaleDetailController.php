<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    public function destroy(SaleDetail $detail)
    {
        $detail->delete();
        return back()->with('success', 'Product removed from sale.');
    }
}
