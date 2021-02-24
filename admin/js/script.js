$(document).ready(function() {
	
$(function() {
      $( 'ul.nav li' ).on( 'click', function() {
            $( this ).parent().find( 'li.active' ).removeClass( 'active' );
            $( this ).addClass( 'active' );
      });
});

 });