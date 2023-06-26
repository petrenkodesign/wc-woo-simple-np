<?php
defined( 'ABSPATH' ) || exit;
class Simple_NP_Shipping_Method extends WC_Shipping_Method {
    public function __construct() {
        $this->id                 = 'simple_np_shipping_method';
        $this->method_title       = 'Доставка Новою Поштою';
        $this->method_description = 'Метод доставки за допомогою сервісу Нової Пошти';
        $this->enabled            = 'yes';
        $this->title              = 'Доставка Новою Поштою';

        $this->init_form_fields();
        $this->init_settings();

        $this->enabled            = $this->get_option( 'enabled' );
        $this->title              = $this->get_option( 'title' );

        // $this->supports = array(
        //     'shipping-zones',
        //     'instance-settings',
        //     'instance-settings-modal',
        // );

		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => 'Активувати',
                'type'    => 'checkbox',
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => 'Назва',
                'type'        => 'text',
                'description' => 'Назва методу доставки, яка буде відображатися покупцям.',
                'default'     => 'Доставка Новою Поштою',
                'desc_tip'    => true,
            ),
            'np_api_key' => array(
                'title'       => 'АРІ ключ',
                'type'        => 'text',
                'description' => 'АРІ ключ Нової Пошти (можна отримати у особистому кабінеті НП)',
                'default'     => '',
            )
        );
    }

    public function calculate_shipping( $package = array() ) {
        // sipping calculate
    }
}