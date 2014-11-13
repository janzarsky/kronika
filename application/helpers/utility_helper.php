<?php

function stylesheet($filename){
   return base_url() . 'public/stylesheets/' . $filename;
}

function javascript($filename){
   return base_url() . 'public/javascripts/' . $filename;
}

function media_image($filename){
   return base_url() . 'public/media/images/h1080px/' . $filename . '.jpg';
}