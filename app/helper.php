<?php
function translations($json)
{
    if(!file_exists($json)) {
	return [];
    }
    return json_decode(file_get_contents($json), true);
}

function imgUpload($img)
    {
        
        $img_name=time().'-'.$img->getClientOriginalName();
        Image::make($img)->save(base_path('/public/img/'.$img_name));
        return "img/" . $img_name;
        }

        function imgUserUpload($img)
    {
        

        $img_name=time().'-'.$img->getClientOriginalName();
        Image::make($img)->save(base_path('/public/img/users/'.$img_name));
        return "img/users/" . $img_name;
        }