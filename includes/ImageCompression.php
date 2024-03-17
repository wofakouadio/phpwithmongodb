<?php

class ImageProcessing{

    use IdGenerator;

    public $response = [];
// this script is used to check image file name, type, size, then compress it
public function ImageCompression($image_source, $image_compress)
 {

     $image_info = getimagesize($image_source);
     if ($image_info["mime"] == "image/jpeg") {
         $image_source = imagecreatefromjpeg($image_source);
         imagejpeg($image_source, $image_compress, 35);
     } elseif ($image_info["mime"] == "image/png") {
         $image_source = imagecreatefrompng($image_source);
         imagepng($image_source, $image_compress, 6);
     } else {
         $image_source = imagecreatefromjpeg($image_source);
         imagejpeg($image_source, $image_compress, 35);
     }

     return $image_compress;
 }

//  upload image based on form submission type, file name, type, and
// call the image compression function to compress it to save on storage
    public function ImageUpload($initial, $fileName, $fileTemp, $destination){
        // strip off the image extension
        $fileExtension = explode(".", $fileName);
        // convert extension string to lowercase
        $fileNewExtension = strtolower(end($fileExtension));
        // file extension
        $ValidExtension = ["jpeg", "jpg", "png", "gif"];
        // let check if file extension maps with valid extension
        if (!in_array($fileNewExtension, $ValidExtension)) {
            $this->response = [
                'status' => 201,
                'msg' => 'Invalid Extension. Preferred Format: jpeg, jpg, png'
            ];
        }else{
            $NewFileName = base64_encode($initial . $this->NewID() . time()) . "." . $fileNewExtension;
            move_uploaded_file($fileTemp, $destination . $NewFileName);
            $this->ImageCompression($destination . $NewFileName, $destination . $NewFileName);
            $this->response = [
                'status' => 200,
                'imageFile' => $NewFileName
            ];
        }
        return json_encode($this->response);
    }
}
