import { FormHandler } from './form.js';
import { SRCheckout } from './checkout.js';

let Frm = new FormHandler;
let CHECKOUT = new SRCheckout;
CHECKOUT.init();

$( document ).ready( function () {
   if ( $( '.fp-slider' ).length !== 0 ) {
      $( '.fp-slider' ).slick( {
         dots: true,
         infinite: true,
         centerMode: true,
         centerPadding: '10%',
         useTransform: false,
         dotsClass: 'tab',
         slidesToShow: 1,
         customPaging: function ( slider, i ) {
            return '';
         },
         responsive: [
            {
               breakpoint: 650,
               settings: {
                  arrows: false,
                  centerPadding: '0',
               }
            },
            {
               breakpoint: 768,
               settings: {
                  centerPadding: '15%'
               }
            }
         ]
      } );
   }
} );
window.addEventListener( "load", function () {
   const header_ht = $( "header" ).height();
   const footer_ht = $( "footer" ).height();
   const window_ht = window.innerHeight;
   let adminbar = 0;
   if ( $( "#wpadminbar" ).length ) {
      adminbar = $( "#wpadminbar" ).height();
   }
   $( "main" ).css( "min-height", window_ht - header_ht - footer_ht - adminbar );
} );
// jQuery('body').on( 'wc_cart_emptied', function() {
//    alert(1);
// } );
// jQuery('body').on( 'updated_wc_div', function() {
//    alert(2);
// } );
// jQuery('body').on( 'updated_cart_totals', function() {
//    alert(1);
// } );
// jQuery('body').on( 'init_checkout', function() {
//    alert(4);
// } );
// jQuery('body').on( 'wc_cart_button_updated', function() {
//    alert(5);
// } );
// jQuery('body').on( 'cart_totals_refreshed', function() {
//    alert(6);
// } );
