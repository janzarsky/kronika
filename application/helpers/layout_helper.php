<?php

function layout_events($events) {
   foreach ($events as $key => $event) {
      switch ($event['importance']) {
         case 1:
            $events[$key]['lg_width'] = 12;
            $events[$key]['sm_width'] = 12;
            break;
         case 2:
            $events[$key]['lg_width'] = 8;
            $events[$key]['sm_width'] = 12;
            break;
         default:
            $events[$key]['lg_width'] = 4;
            $events[$key]['sm_width'] = 6;
      }
   }
   
   $numbered_events = array_values($events);
   
   $numbered_events = sort_events($numbered_events, 3, 'lg_width');
   $numbered_events = sort_events($numbered_events, 2, 'sm_width');

   return array(0 => $numbered_events);
}

function sort_events($events, $cols, $width) {
   $width_sum = 0;
   $row_counter = 0;
   $event_counter = 0;
   
   foreach ($events as $i => $event) {
      $width_sum += $event[$width];
      
      if ($width_sum > 12) {
         if ($events[$i - 1][$width] == 12 - ($width_sum - $events[$i][$width])
             && isset($events[$i - 1]['swapped']) == false) {
            $tmp = $events[$i - 1];
            $events[$i - 1] = $events[$i];
            $events[$i] = $tmp;
            
            $width_sum = $events[$i][$width];
            $row_counter++;
         }
         else if ($i != count($events) - 1
                  && $events[$i + 1][$width] == 12 - ($width_sum - $events[$i][$width])) {
            $tmp = $events[$i + 1];
            $events[$i + 1] = $events[$i];
            $events[$i] = $tmp;
            
            $width_sum = $events[$i][$width];
            $row_counter++;
         }
      }
      else if ($width_sum == 12) {
         $width_sum = 0;
         $row_counter++;
      }
   }
   
   return $events;
}