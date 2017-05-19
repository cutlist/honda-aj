function format_currency( input ){
   "use strict";
 
   // get input value and clean up characters except numbers
   var angka = input.val().replace( /[^0-9]+/g, "" );
 
   // get input length, how much character there
   var pjg = angka.length;
 
   // if there are less than 3 characters then, ... etc. I think this is a traditional and dirty code. hahaha.
   if( pjg < 3 ){
      input.val( angka.substring( 0, pjg % 3 ) + angka.substring( pjg % 3 ) );
   }
   else if( pjg == 3 ) {
      input.val( angka.substring( 0, 3 ) );
   }
   else if( pjg < 6 ){
      input.val( angka.substring( 0, pjg % 3 ) + "." + angka.substring( pjg % 3 ) );
   }
   else if( pjg == 6 ) {
      input.val( angka.substring( 0, 3 ) + "." + angka.substring( 3, 6 ) );
   }
   else if( pjg < 9 ){
      input.val( angka.substring( 0, pjg % 3 ) + "." + angka.substring( pjg % 3, 3 + ( pjg % 3 ) ) + "." + angka.substring( 3 + ( pjg % 3 ) ) );
   }
   else if( pjg == 9 ){
      input.val( angka.substring( 0, 3 ) + "." + angka.substring( 3, 6 ) + "." + angka.substring( 6, 9 ) );
}
   else if( pjg < 12 ){
      input.val( angka.substring( 0, pjg % 3) + "." + angka.substring( pjg % 3, 3 + ( pjg % 3 ) ) + "." + angka.substring( 3 + ( pjg % 3 ), 6 + ( pjg % 3 ) ) + "." + angka.substring( 6 + ( pjg % 3 ) ) );
   }
   else if( pjg == 12 ){
      input.val( angka.substring( 0, 3 ) + "." + angka.substring( 3, 6 ) + "." + angka.substring( 6, 9 ) + "." + angka.substring( 9, 12 ) );
   }
}
