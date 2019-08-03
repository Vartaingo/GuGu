<?php
namespace Modules;

class fileManagerModule
{
    public function fileUpload(array $file_info, string $saving_path, array $valid_extensions = null)
    {
        $name = strtolower($file_info["name"]);
        $size = $file_info["size"];
        $tmp = $file_info["tmp_name"];
        $saving_path = $_SERVER['DOCUMENT_ROOT'] . $saving_path;
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if (!empty($valid_extensions)) {
            if (in_array($extension, $valid_extensions)) {
                $saving_path = $saving_path . strtolower($name);
                if (move_uploaded_file($tmp, $saving_path)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                echo 'Unknow file extension. Valid Extensions: ' . implode(", ", $valid_extensions);
                return false;
            }
        } else {
            $saving_path = $saving_path . strtolower($name);
            if (move_uploaded_file($tmp, $saving_path)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
