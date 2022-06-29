<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.


//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面
//美化二次开发用户请添加自定义设置框架到下面



//
// Field: 自定义选项框架 美化二开专用 代码已经注释
//


// CSF::createSection($prefix, array(
//     'title'       => '自定义选项框架',
//     'icon'        => 'fa fa-shield',
//     'description' => '自定义选项框架',
//     'fields'      => array(

//         array(
//             'id'    => '_diy_ripro_opt1',
//             'type'  => 'text',
//             'title' => '自定义选项1',
//             'after' => '自定义选项111111',
//         ),
//         array(
//             'id'    => '_diy_ripro_opt2',
//             'type'  => 'text',
//             'title' => '自定义选项2',
//             'after' => '自定义选项22222',
//         ),

//     ),
// ));
// 
// 
// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

  //
  // Set a unique slug-like ID
  $prefix = 'my_comment_options';

  //
  // Create a metabox
  CSF::createCommentMetabox( $prefix, array(
    'title'        => 'My Comment Options',
    'data_type'    => 'serialize',
    'priority'     => 'default',
    'show_restore' => false,
    'theme'        => 'dark',
    'class'        => '',
  ) );

  //
  // Create a section
  CSF::createSection( $prefix, array(
    'title'  => 'Tab Title 1',
    'fields' => array(

      //
      // A text field
      array(
        'id'      => 'opt-text',
        'type'    => 'text',
        'title'   => 'Text',
      ),


      array(
        'id'      => 'opt-color',
        'type'    => 'color',
        'title'   => 'Color',
      ),

      array(
        'id'      => 'opt-select',
        'type'    => 'select',
        'title'   => 'Select',
        'options' => array(
          'opt-1' => 'Option 1',
          'opt-2' => 'Option 2',
          'opt-3' => 'Option 3',
        )
      ),

    )
  ) );

  //
  // Create a section
  CSF::createSection( $prefix, array(
    'title'  => 'Tab Title 2',
    'fields' => array(

      // A textarea field
      array(
        'id'    => 'opt-textarea',
        'type'  => 'textarea',
        'title' => 'Textarea',
      ),

    )
  ) );

}

