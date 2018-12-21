<?php
/**
 * 图片处理类
 */
namespace App\Handlers;

class ImageUploadHandler
{
    //允许上传的图片后缀
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        //构建存储的文件夹规则: uploads/images/avatars/201812/21/
        //如此切割，让查找效率更高
        $folder_name = "uploads/images/$folder/". date("Ym/d");

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201812/21/
        $upload_path = public_path() .'/'. $folder_name;

        //获取文件的后缀名，因图片从剪粘板里黏贴时后缀为空，所以在此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //拼接文件名, 加前缀是为了增加辨析度，是关联数据库的ID
        //例如：1_XXXX_XXXX.png
        $filename = $file_prefix . '_' . time() . '_'. str_random(10) .'.'. $extension;

        //如果上传的不是图片将终止操作
        if ( !in_array($extension, $this->allowed_ext) )
        {
            return false;
        }

        //移动图片
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url'). "/$folder_name/$filename"
        ];
    }
}