<?php

    function certaintyString ($date, $certainty)
      {
        if ($certainty) {
          return $date;
        }
        return ( $date . ' [?]');
      }
      
      function concatenateDatesWithBrackets ($birth, $death)
      {
        if ( $birth == 0  and !( $death == 0 ) ){
          return '(†' . $death . ')';
        }
        
        if ( !( $birth == 0 )  and ( $death == 0 ) ){
          return ' (*' . $birth . ')';
        }
        
        if ( ( $birth == 0 ) and ( $death == 0 ) ) {
          return '';
        }
        
        return '(' . $birth . '–' . $death . ')';
      }


      function concatenateDates ($birth, $death)
      {
        if ( $birth == 0  and !( $death == 0 ) ){
          return '†' . $death;
        }
        
        if ( !( $birth == 0 )  and ( $death == 0 ) ){
          return ' *' . $birth;
        }
        
        if ( ( $birth == 0 ) and ( $death == 0 ) ) {
          return '';
        }
        
        return $birth . '–' . $death;
      }

