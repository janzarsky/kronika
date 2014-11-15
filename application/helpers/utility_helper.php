<?php

function stylesheet($filename){
   return base_url() . 'public/stylesheets/' . $filename;
}

function javascript($filename){
   return base_url() . 'public/javascripts/' . $filename;
}

function media_image($filename, $height=1080){
   if ($height == 'thumb')
      return base_url() . 'public/media/images/thumb/' . $filename . '.jpg';
   else
      return base_url() . 'public/media/images/h' . $height . 'px/' . $filename . '.jpg';
}