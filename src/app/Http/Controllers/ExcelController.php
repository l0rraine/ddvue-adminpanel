<?php

namespace DDVue\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;
use DDVue\AdminPanel\app\Models\DdvueMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ExcelController extends Controller
{
    /**
     * @var DdvueMenu
     */
    private $ddvueMenu;

    /**
     * AdminPanelController constructor.
     *
     * @param DdvueMenu $ddvueMenu
     */
    public function __construct(DdvueMenu $ddvueMenu)
    {
        $this->ddvueMenu = $ddvueMenu;
    }

    public function getIndex()
    {
        return view('ddvue.adminpanel::pages.excel.upload');
    }

    // 只做了单文件上传
    public function upload(Request $request)
    {
        if ($request->isMethod('post')) {
            $file     = $request->file('file');
            $filename = $this->doUpload($file);
            if ($filename) {
                $this->afterUpload($filename);
            }
        }
    }

    protected function afterUpload($filename)
    {
        return json_encode(['success' => true, 'message' => '上传成功']);
    }


    /**
     * 单文件上传
     *
     * @param $file
     */
    protected function doUpload($file)
    {
        // 文件是否上传成功
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName();                 // 文件原名
            $ext          = $file->getClientOriginalExtension();            // 扩展名
            $realPath     = $file->getRealPath();                           //临时文件的绝对路径
            $type         = $file->getClientMimeType();                     // image/jpeg
            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

            return $bool ? $filename : $bool;

        }
    }

}