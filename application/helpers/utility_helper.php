<?php

function stylesheet($filename){
   return base_url() . 'public/stylesheets/' . $filename;
}

function javascript($filename){
   return base_url() . 'public/javascripts/' . $filename;
}

function media_image($filename, $width=1200){
   if ($width == 'thumb')
      return base_url() . 'public/media/images/thumb/' . $filename . '.jpg';
   else
      return base_url() . 'public/media/images/w' . $width . 'px/' . $filename . '.jpg';
}