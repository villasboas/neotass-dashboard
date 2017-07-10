/**
 * toggleSideBar
 * 
 * esconde/mostra o sidebar
 * 
 */
function toggleSideBar() {

    // mostrar o aside
    $('#aside').toggleClass( 'hide' );

    // mostra o wrapper
    $('#wrapper').toggleClass( 'hide' );

    // retorna false
    return false;
}

/**
 * importarPlanilha
 * 
 * importa uma planilha
 * 
 */
function importarPlanilha( input ) {

    // verifica se existe algum conteudo
    if ( input.val() ) $( '#import-form' ).submit();
}

// mostra as importacoes
$( document ).ready( function() {
    $('.fade-in').animate( { opacity: 1 }, 1000 );
});
