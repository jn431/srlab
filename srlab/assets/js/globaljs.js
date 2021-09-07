class SRGlobal {
   mobile = () => {
      const MOBILEBTN = $( "#mob-btn" );
      const PRIMARYNAV = $( "#primary" );

      MOBILEBTN.on( "click", function ( e ) {
         $( this ).add(PRIMARYNAV).toggleClass( "open" );
      } );
   }

   login = () => {
      const PANEL = $( "#login-panel" );
      const BUTTON = $( "#login-btn" );
      const CLOSE = $( "#login-x" );

      BUTTON.on( "click", function ( e ) {
         e.preventDefault();
         $( "body" ).attr( "data-overlay", "login" );
         PANEL.fadeIn();
      } );

      CLOSE.on( "click", function ( e ) {
         e.preventDefault();
         $( "body" ).removeAttr( "data-overlay" );
         PANEL.fadeOut();
      } );
   }
}
export { SRGlobal };