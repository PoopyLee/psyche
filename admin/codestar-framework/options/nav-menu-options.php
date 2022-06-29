<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

$prefix = '_lot_menu_options';
CSF::createNavMenuOptions( $prefix, array(
  'data_type' => 'unserialize'
) );
CSF::createSection( $prefix, array(
  'fields' => array(
    array(
        'id'      => 'menu_icon',
        'type'    => 'icon',
        'title'   => '菜单图标',
    ),
  )
) );
