<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class AsrorController extends Controller
{
    public function upload()
    {
        $my_file = $_FILES['uz_file'];
        $file_path = $my_file['tmp_name']; // temporary upload path of the file
        $file_name = $_POST['name']; // desired name of the file
        move_uploaded_file($file_path, $_SERVER['DOCUMENT_ROOT'] . '/public/upload' . basename($file_name)); // save the file at `img/FILE_NAME`


    }

    public function uploader(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs($folder, $filename);

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "File unsuccessfully uploaded",
        ]);

    }

    public function up2()
    {
        header('Content-Type: text/plain; charset=utf-8');

        try {

            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here.
            if ($_FILES['upfile']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($_FILES['upfile']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )) {
                throw new RuntimeException('Invalid file format.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['upfile']['tmp_name'],
                sprintf('./uploads/%s.%s',
                    sha1_file($_FILES['upfile']['tmp_name']),
                    $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }

    }
}
