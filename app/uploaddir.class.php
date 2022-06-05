<?php
Class UploadFolder
{

    protected string $folder;
    protected string|false $curdir;

    public function __construct()
    {
        error_reporting( 0 & ~E_WARNING & ~E_STRICT & ~E_NOTICE & ~E_DEPRECATED);
        $this->curdir = getcwd();
    }


    public function set_folder($folder_name)
    {
        $this->folder = $folder_name;
    }

    public function process($path, $files)
    {
        // Original path from user's device
        $original_path  = dirname($path);

        // Extract file's data
        $file_name      = $files['name'];
        $file_tmp       = $files['tmp_name'];

        // Real server's dir, eg => /var/www/myfolder/upload
        $base = $this->curdir . DIRECTORY_SEPARATOR . $this->folder;

        // Upload dir, eg: /var/www/myfolder/upload/MyPictures
        $upload_dir  = $base . DIRECTORY_SEPARATOR . $original_path ;

        // Upload path, eg: /var/www/myfolder/upload/MyPictures/photo1.jpg
        $upload_path = $upload_dir . DIRECTORY_SEPARATOR. basename($file_name) ;

        // Create target dir if not exist
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0700, true);

        move_uploaded_file($file_tmp, $upload_path);

    }
}