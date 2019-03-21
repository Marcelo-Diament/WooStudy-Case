<?php
/**
 * WooStudy Case functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage WooStudy Case
 * @since 1.0.0
 */



/* Enqueue Style*/
function woostudycase_enqueue_styles() {
    $parent_style = 'storefront-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'woostudycase-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'woostudycase_enqueue_styles' );

/* Retorna o URI do tema filho*/
function get_template_directory_child() {
    $directory_template = get_template_directory_uri(); 
    $directory_child = str_replace('storefront', '', $directory_template) . 'woostudycase';
    return $directory_child;
}

/* Customizando a página de login */

    /* Logo */

    //$wccImgLogin = get_stylesheet_directory_uri() . '/images/logo-300x300.png);height:150px;';
    function woostudycase_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/logo-300x300.png);height:150px;'; ?>);
                height:150px;
                width:150px;
                background-size: 150px 150px;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'woostudycase_login_logo' );

    /* Link */
    function woostudycase_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'woostudycase_login_logo_url' );

    /* Link Title */
    function woostudycase_login_logo_url_title() {
        return 'WooStudy Case';
    }
    add_filter( 'login_headertitle', 'woostudycase_login_logo_url_title' );

    /* Mensagem */
    function woostudycase_login_message(){
        return '<h1 style="text-align:center;">WooStudy Case</h1><br/><h3 style="text-align:center; font-weight:normal">for studies purpose | powered by <a href="https://djament.com.br" target="_blank">djament.co</a></h3>';
    }
    add_filter( 'login_message', 'woostudycase_login_message' );

    /* Botão */
    function woostudycase_login_stylesheet() {
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
        // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
    }
    add_action( 'login_enqueue_scripts', 'woostudycase_login_stylesheet' );

    /* Admin Panel Style */
    function woostudycase_admin_theme_style() {
        wp_enqueue_style('my-admin-style', get_stylesheet_directory_uri() . '/style-login.css');
    }
    add_action('admin_enqueue_scripts', 'woostudycase_admin_theme_style');

    /* Adicionando página ao Dashboard */
    function add_woostudycase_dashboard_widgets() { 
        wp_add_dashboard_widget(
            'woostudycase_dashboard_widget', // Widget slug.
            'WooStudy Case', // Title.
            'woostudycase_dashboard_widget_content' // Display function.
        );
    }
    add_action( 'wp_dashboard_setup', 'add_woostudycase_dashboard_widgets' );

    /* Create the function to output the contents of your Dashboard Widget. */
    function woostudycase_dashboard_widget_content() {
        $woostudycase_id_user_logado = get_current_user_id();
        $user_info = get_userdata($woostudycase_id_user_logado);
        $user_display_name = $user_info->first_name;
        echo '<h4>Seja bem-vindo ' . $user_display_name . '!</h4><img src="' . get_stylesheet_directory_uri() . '/images/logo-h-321x157.png)" title="WooStudy Case | WooStudy Case" alt""WooStudy Case" height="157" width="auto" style="height:157px;width:auto;margin:auto;padding:5% 9%;"/><p>Através desse painel é possível incluir páginas, posts e realizar uma série de outras edições de conteúdo.</p><p>Em caso de dúvidas, entre em contato com a Djament Comunicação através do email <a href="mailto:contato@djament.com.br" title="Enviar email para Djament.co">contato@djament.com.br</a>. Obrigado!</p>';
    }

/* CHECKOUT */
    /* Adição de Campos Customizados - Add Custom Fields */
    /***
        SETUP
    ****/
    function woostudycase_setup_fields() {
        $fields = array(
            array(
                'key' => 'entrega_periodo',
                'label' => 'Qual o melhor período para receber a mercadoria (matutino, vespertino ou noturno)?',
                'placeholder' => '"Matutino"',
                'required' => 'required',
                'error' => 'Por favor, informe o melhor período para a entrega.'
            ),
            array(
                'key' => 'entrega_horarios',
                'label' => 'Qual(is) o(s) melhor(es) horário(s) para receber sua compra?',
                'placeholder' => '"Entre 10 e 12 horas e após as 17 horas".',
                'required' => 'required',
                'error' => 'Por favor, conte-nos em que área sua empresa atua.'
            )
        );
       
       
        return $fields;
    }

    /**
 * Add custom fields to user / checkout
 */
add_action( 'woocommerce_after_order_notes', 'woostudycase_checkout_field' );
 
function woostudycase_checkout_field( $checkout ) {
    $fields = woostudycase_setup_fields();
 
 
    if ( ! empty( $fields ) ) {
       
        echo '<div id=""><h2>Preferências de Recebimento</h2><small>Não garantimos que a entrega será feita dentro desse período e/nem horário - mas faremos o possível para respeitá-los. De toda forma, certifique-se de que haverá alguém responsável por receber sua compra. ;)</small>';
       
        foreach ($fields as $field) {
            woocommerce_form_field(
                $field['key'],
                array(
                    'type'          => 'text',
                    'class'         => array('form-row-wide'),
                    'label'         => __($field['label']),
                    'placeholder'   => __($field['placeholder']),
                ),
                get_user_meta( get_current_user_id(), $field['key'] , true  )
            );
        }
 
        echo '</div>';
    }
}
/**
 * Verification
 */
add_action('woocommerce_checkout_process', 'woostudycase_checkout_field_process');
 
function woostudycase_checkout_field_process() {
    $fields = woostudycase_setup_fields();
   
    if ( ! empty( $fields ) ) {
        foreach($fields as $field) {
            $key = $field['key'];
            if ( ! $_POST[$key] ) {
                wc_add_notice( __( $field['error'] ), 'error' );
            }
        }
    }
}