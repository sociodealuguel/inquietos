<?php
// Enqueue child theme styles
function astra_child_theme_styles() {
    wp_enqueue_style( 'astra-child-theme', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'astra_child_theme_styles', 1000 );






//Trocar Logomarca do Login
function my_login_logo_one() {
?>
<style type="text/css">
body.login div#login h1 a {
 background-image: url(https://inquietos.com.br/wp-content/uploads/2018/05/logomarca-inquietos.com_.br_.png);  //Add your own logo image in this url
padding-bottom: 10px;
}
</style>
<?php
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );



// Ocultar barra de administração para Assinantes
function remove_admin_bar() {
$user = wp_get_current_user();
if (in_array('subscriber', $user->roles)) {
show_admin_bar(false);
}
}
add_action('after_setup_theme', 'remove_admin_bar');



// Adicionar novos campos para usuários
function modify_contact_methods($profile_fields) {
$profile_fields['pontos'] = 'Pontos';
$profile_fields['face'] = 'Facebook';
return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');




//Redirecionar usuário para o site após login bem sucedido.
function my_login_redirect( $redirect_to, $request, $user ) {
global $user;
if ( isset( $user->roles ) && is_array( $user->roles ) ) {
if ( in_array( 'administrator', $user->roles ) ) {
return 'inicio';
} else {
return 'inicio';
}
} else {
return 'inicio';
}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



//Redirecionar usuário após Logout
function ps_redirect_after_logout(){
         wp_redirect( '/' );
         exit();
}
add_action('wp_logout','ps_redirect_after_logout');




//Exibir dados Usuário
function wp_shortcode_btnblue( $atts ) {
  $current_user = wp_get_current_user();
  $user_info = get_userdata($current_user->ID);
  $atts = shortcode_atts( array(
    'first_name' => $user_info->first_name,
    'pontos' => $user_info->pontos,
    'user_email' => $user_info->user_email
  ), $atts );
  return '<b>Pontos:</b> '.$atts['pontos'].'<br/><b>Email:</b> '.$atts['user_email'].'';
}
add_shortcode("btnblue", "wp_shortcode_btnblue");




//TopBar Login
/**
function register_additional_menus() {
  register_nav_menu( 'top-menu', __( 'Top Menu' ) );
}
add_action( 'init', 'register_additional_menus' );
function add_script_before_header() {

ob_start();
wp_loginout('index.php');
$loginoutlink = ob_get_contents();
$consultUser = ob_get_contents();
	
ob_end_clean();	

echo"<div class='top-header-bar'>
<div class='ast-container'>
".$loginoutlink."
</div>
</div>";	
//wp_nav_menu( array( 'theme_location' => 'top-menu' ) );	

}
add_action( 'astra_header_before', 'add_script_before_header' );
*/