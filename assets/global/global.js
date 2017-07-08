function toggleSideBar() {
    console.log( 'aaaaaaaaac' );
    $('#aside').toggleClass( 'hide' );
    $('#wrapper').toggleClass( 'hide' );
    return false;
}

$( document ).ready( function() {
    $('.fade-in').animate( { opacity: 1 }, 1000 );
});
