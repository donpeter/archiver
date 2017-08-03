<?php 

function currentPage($url = "/"){
    return strstr(request()->path(), $url);
}