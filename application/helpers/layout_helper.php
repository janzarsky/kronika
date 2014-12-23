<?php

function layout_events($events) {
   $initial_split = array();
   $i = 0;
   
   foreach ($events as $event) {
      if ($event['importance'] == 1) {
         $event['layout_width'] = 12;
         
         $i++;
         $initial_split[$i][] = $event;
         $i++;
      }
      else {
         $event['layout_width'] = 4;
         
         $initial_split[$i][] = $event;
      }
   }
   
   $final_split = array();
   
   foreach ($initial_split as $row) {
      $count = count($row);
      
      if ($count > 3) {
         for ($i = 0; $i < $count - $count%3; $i += 3) {
            $final_split[] = array($row[$i], $row[$i + 1], $row[$i + 2]);
         }
         
         if ($count%3 == 2)
            $final_split[] = array($row[$i], $row[$i + 1]);
         else if ($count%3 == 1)
            $final_split[] = array($row[$i]);
      }
      else {
         $final_split[] = $row;
      }
   }
   
   return $final_split;
}