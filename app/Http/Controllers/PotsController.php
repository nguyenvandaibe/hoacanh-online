<?php

namespace App\Http\Controllers;

use App\Models\Pot;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PotsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pots Controller
    |--------------------------------------------------------------------------
    |
    | Controller này xử lý các request liên quan đến đối tượng "Chậu cảnh".
    |
    */

    /**
     * Liệt kê danh sách chậu cảnh
     *
     * @return View
     */
    public function index() : View {
        
        $pots = Pot::all(); // lấy toàn bộ chậu cảnh trong database

        return view('pots.admin_all_pots', ['pots' => $pots]); // trả ra view pots.admin_all_pots với dữ liệu là $pots
    }
}
