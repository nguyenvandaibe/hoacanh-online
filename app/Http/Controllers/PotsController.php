<?php

namespace App\Http\Controllers;

use App\Models\Pot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    public function index(): View
    {

        $pots = Pot::orderByDesc('created_at')->get(); // lấy toàn bộ chậu cảnh trong database

        return view('pots.admin_all_pots', ['pots' => $pots]); // trả ra view pots.admin_all_pots với dữ liệu là $pots
    }

    /**
     * Trả về view "Tạo chậu cảnh"
     *
     * @return View
     */
    public function create(): View
    {
        return view('pots.admin_create_pot');
    }

    /**
     * Lưu thông tin chậu cảnh mới
     *
     * @param Request $request
     * @return View
     */
    public function store(Request $request)
    {
        $uploadedImage = $request->file('uploadedImage');

        #region Đổi tên file ảnh để tránh trùng lặp
        // Lấy ra tên file
        // Ví dụ: my-image.jpg
        $imageOriginalName = $uploadedImage->getClientOriginalName();

        // Lấy ra file extension
        // Ví dụ: my-image.jpg ==> jpg
        $imageOriginalExtension = $uploadedImage->getClientOriginalExtension();

        // Lấy ra chuỗi chỉ có tên file không có extension
        // Ví dụ: my-image.jpg ==> my-imge
        $imageOriginalNameWithoutExtension = trim($imageOriginalName, '.' . $imageOriginalExtension);

        $imageName = $imageOriginalNameWithoutExtension . '-' . Carbon::now()->timestamp . '.' . $imageOriginalExtension;

        $imagePath = 'pots/' . $imageName;
        #endregion

        // Upload file lên MinIO
        // Trả về true: Thành công
        // Trả về false: Thất bại
        $hasSuccessfullyUpload = Storage::cloud()->put($imagePath, $uploadedImage->getContent());

        // Nếu upload lên MinIO thành công
        if ($hasSuccessfullyUpload) {

            // Lấy đầy đủ URL của ảnh
            $uploadedImageURL = config('filesystems.disks.s3.endpoint') . '/' . config('filesystems.disks.s3.bucket') . '/' . $imagePath;

            // Lưu vào cơ sở dữ liệu
            Pot::create([
                'name' => $request->input('name'),
                'image' => $uploadedImageURL,
                'dimesion_length' => $request->input('length'),
                'dimesion_width' => $request->input('width'),
                'dimesion_height' => $request->input('height'),
                'price' => $request->input('price')
            ]);
            
            // Trả về kết quả là đã tạo thành công
            return redirect()->route('admin.pots.index')->with('status', [
                'isSuccess' => true,
                'message' => 'Tạo chậu ' . $request->input('name') . ' thành công.'
            ]);
        } else {
            // Trả về kết quả là không tạo thành công
            redirect()->route('admin.pots.index')->with('status', [
                'isSuccess' => false,
                'message' => 'Tạo chậu ' . $request->input('name') . ' thất bại.'
            ]);
        }
    }
}
