<?php 

add_theme_support('post-thumbnails');
function posx()
{
   /*    $p = get_role('editor');
    var_dump($p);
    die; */
    register_post_type('aa', array(
        'labels'=>array(
            'name'=>'sjksdkj',
            'singular_name'=>'dsnskj',
            'add_new_item'=>'kjqfkjns'
        ),
        'public'=>true,
        'supports'=>['title','editor','thumbnail'],
        
       'capability_type' =>['aa','aas'],
        'add_meta_cap'=>true,
    ));
} 
add_action('init','posx');

function add_rs()
{
   // remove_role('imad');
    add_role('imad','Imad');
}

add_action('after_setup_theme','add_rs');

add_action('admin_init','psp_add_role_caps',999);
    function psp_add_role_caps() {
 
 // Add the roles you'd like to administer the custom post types
 $roles = array('imad','administrator');
 
 // Loop through each role and assign capabilities
 foreach($roles as $the_role) { 
 
      $role = get_role($the_role);
 
              $role->add_cap( 'read_private_aas' );
     
              $role->add_cap( 'edit_private_aas' );
              $role->add_cap( 'create_aa' );
              $role->add_cap( 'read_private_aas' );
              $role->add_cap( 'delete_private_posts' );
              $role->add_cap('upload_files');
              if($the_role == "administrator")
              {
                    $role->add_cap( 'read_aas' );
                                  $role->add_cap( 'publish_aas');

              }
 
 }
}

function posts_for_current_author($query) {
  global $user_level;

  if($query->is_admin && $user_level <= 2) {
    global $user_ID;
  
    $query->set('author', $user_ID);
    unset($user_ID);
  }
  unset($user_level);

  return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');