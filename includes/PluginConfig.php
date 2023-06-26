<?php
defined( 'ABSPATH' ) || exit;
class PluginConfig {

    public function __construct() {
        // add_filter( 'woocommerce_checkout_fields', 'np_shipping_checkout_fields' );
        // add_action( 'woocommerce_checkout_after_customer_details', 'shipping_form' );
    }

    public function plugin_logo() {
        $logo_url = plugins_url( 'assets/img/nova-poshta-logo.png', plugin_dir_path( __FILE__ ) );
        echo '<img src="' . esc_url( $logo_url ) . '" alt="Nova Poshta Simple Plugin" />';
    }

    public function plugin_shortcode( $atts ) {
        return $this->plugin_logo();
    }

    public function shipping_form() {
        $form_html = '
            <div class="simple_nova_poshta_form">
                <h3>Доставка Новою Поштою</h3><br>
                <div class="woocommerce-input-wrapper input-block form-row" id="shipping_nova_poshta_region_field">
                    <label for="shipping_nova_poshta_region">Область:</label><br>
                    <select name="shipping_nova_poshta_region" id="shipping_nova_poshta_region" data-placeholder="Оберіть область">
                        <option value="" selected="selected">Оберіть область</option>
                    </select>
                </div>
                <div class="woocommerce-input-wrapper input-block form-row" id="shipping_nova_poshta_city_field">
                    <label for="shipping_nova_poshta_city">Місто:</label><br>
                    <select name="shipping_nova_poshta_city" id="shipping_nova_poshta_city" data-placeholder="Оберіть місто">
                        <option value="" selected="selected">Оберіть область</option>
                    </select>
                </div>
                <div class="woocommerce-input-wrapper input-block form-row" id="shipping_nova_poshta_warehouse_field">
                    <label for="shipping_nova_poshta_warehouse">Відділення:</label><br>
                    <select name="shipping_nova_poshta_warehouse" id="shipping_nova_poshta_warehouse" data-placeholder="Оберіть відділення">
                        <option value="" selected="selected">Оберіть область</option>
                    </select>
                </div>
            </div>
        ';
        echo $form_html;
    }

    function np_shipping_checkout_fields( $fields ) {
        unset( $fields['shipping'] );
        $fields['shipping'] = array(
            'np_shipping_city' => array(
                'label'       => 'Місто доставки',
                'required'    => true,
                'class'       => array( 'form-row-wide' ),
                'clear'       => true,
                'priority'    => 25,
            ),
            'np_shipping_warehouse' => array(
                'label'       => 'Відділення Нової Пошти',
                'required'    => true,
                'class'       => array( 'form-row-wide' ),
                'clear'       => true,
                'priority'    => 30,
            ),
        );
    
        return $fields;
    }

    function apd_settings_link( array $links ) {
        $url = get_admin_url() . "admin.php?page=wc-settings&tab=shipping&section=simple_np_shipping_method";
        $settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
        $links[] = $settings_link;
        return $links;
    }
}