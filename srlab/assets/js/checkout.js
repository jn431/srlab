class SRCheckout {
   init = () => {
      /** @var  {string}  showstep */
      let showstep = this.get_local() || $( '.step' ).first().data( "step" );
      let self = this;

      // Show {showstep} first load
      self.goto( showstep );
      self.progress( showstep );

      /**
       * @param   {string}   prev
       * @param   {string}   next
       * @param   {string}   curr
       */
      $( document ).on( "click", ".step-btn", function ( e ) {
         let BTN = $( e.target );
         let DIR = BTN.data( "direct" );
         let curr = $( ".step.active" ).data( "step" );
         let next = BTN.data( "next" ) || "";
         let prev = BTN.data( "prev" ) || "";

         if ( DIR === "prev" ) {
            self.goto( prev ).set_local( prev );
            self.progress( prev );
         }
         else if ( DIR === "next" ) {
            // self.validate_step( curr );
            console.log( "Validate " + curr );
            console.log( "Val: " + self.validate_step( curr ) );
            // self.goto( next ).set_local( next );
            // self.progress( next );
         }
      } );
   }

   /**
    * Swap visibility for steps
    * @param {string} from
    * @param {string} to
    */
   goto = ( to ) => {
      const TO = $( `#checkout-${to}` );

      if ( !TO ) {
         return;
      }

      $( ".tile.step" ).removeClass( "active" ).attr( "tabindex", 0 ).fadeOut( 200 );
      TO.addClass("active").attr( "tabindex", 1 ).fadeIn( 600 );
   }

   progress = ( to ) => {
      $( `#order-progress [data-step]` ).removeClass( 'active' );
      $( `#order-progress [data-step="${to}"]` ).addClass( "active" );
   }

   set_local = ( to ) => {
      localStorage.setItem( "LS_step", to );
   }

   get_local = () => {
      return localStorage.getItem( "LS_step" );
   }

   validate_step = ( to ) => {
      const ACTIVE = $( '.step.active' );
      const REQ = ACTIVE.find( '.validate-required' );
      let count = 0;

      if ( REQ.length > 0 ) {
         console.log( "Hads validations" );
         let all_inputs = REQ.find( ".input" );

         all_inputs.each( function ( i ) {
            if ( !$( this ).val() ) {
               $(this).addClass("invalid").focus();
               count++;
            }
         } );

         if( count !== 0){
            return false;
         } else {
            return true;
         }
      } else {
         return true;
      }

   }
}
export { SRCheckout };