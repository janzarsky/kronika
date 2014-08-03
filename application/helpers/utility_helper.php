<?php

function stylesheet($filename){
   return base_url() . 'public/stylesheets/' . $filename;
}

function javascript($filename){
   return base_url() . 'public/javascripts/' . $filename;
}