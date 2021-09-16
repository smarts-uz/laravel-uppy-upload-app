<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apps()
    {
        return view('app');
    }

    public function two()
    {
        return view('app');
    }

    public function upload()
    {
        $my_file = $_FILES['uz_file'];
        $file_path = $my_file['tmp_name']; // temporary upload path of the file
        $file_name = $_POST['name']; // desired name of the file
        move_uploaded_file($file_path, $_SERVER['DOCUMENT_ROOT'] . '/public/upload' . basename($file_name)); // save the file at `img/FILE_NAME`
    }
}
