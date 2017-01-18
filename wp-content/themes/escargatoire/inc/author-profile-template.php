<?php 



  class author_profile {
    var $public_email;
    function set_public_email($new_public_email){
      $this->public_email = $new_public_email;
    }
    function get_public_email() {
      return $this->public_email;
    }

    var $twitter;
    function set_twitter($new_twitter){
      $this->twitter = $new_twitter;
    }
    function get_twitter() {
      return $this->twitter;
    }
}


function create_author_profile($args) {
    $the_profile = new author_profile();
    $the_profile->set_public_email(the_field('public_email', $args));

}

function fetch_author_profile($args) {
   $fields = get_fields($args); 
   echo '<ul>';
      foreach( $fields as $field_name => $value ) {
        if ($value == false) {
          echo "";
        }
        else {
          echo ("<li class='profile-label'>");
          echo $field_name;
          echo (": ");
          echo $value;
          echo ("</li>");
        }
      }
   echo '</ul>';
}



    // print ('<div class="social-nav link-list">
    //                    <ul id="author-social-links" class="inline-ul social-links-menu link-list">

    //                      <li class="menu-item social-icon twitter-icon social-navigation"><a href="https://twitter.com/saltyrunning"></a></li>
    //                      <li class="menu-item social-icon facebook-icon social-navigation"><a href="https://instagram.com/saltyrunning"></a></li>
    //                      <li class="menu-item social-icon instagram-icon social-navigation"><a href="http://facebook.com/saltyrunning"></a></li>
    // </ul></div>');




   

















// function escargatoire_get_the_archive_title() {
//   if ( is_category() ) {
//     /* translators: Category archive title. 1: Category name */
//     $title = sprintf( __( 'Category: %s' ), single_cat_title( '', false ) );
//   } elseif ( is_tag() ) {
//     /* translators: Tag archive title. 1: Tag name */
//     $title = sprintf( __( 'Topic: %s' ), single_tag_title( '', false ) );
//   } elseif ( is_author() ) {
//     /* translators: Author archive title. 1: Author name */
//     $title = sprintf( __( '%s' ), '<span class="vcard">' . get_the_author() . '</span>' );
//   } elseif ( is_year() ) {
//     /* translators: Yearly archive title. 1: Year */
//     $title = sprintf( __( 'Year: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
//   } elseif ( is_month() ) {
//     /* translators: Monthly archive title. 1: Month name and year */
//     $title = sprintf( __( 'Month: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
//   } elseif ( is_day() ) {
//     /* translators: Daily archive title. 1: Date */
//     $title = sprintf( __( 'Day: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
//   } elseif ( is_tax( 'post_format' ) ) {
//     if ( is_tax( 'post_format', 'post-format-aside' ) ) {
//       $title = _x( 'Asides', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
//       $title = _x( 'Galleries', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
//       $title = _x( 'Images', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
//       $title = _x( 'Videos', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
//       $title = _x( 'Quotes', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
//       $title = _x( 'Links', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
//       $title = _x( 'Statuses', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
//       $title = _x( 'Audio', 'post format archive title' );
//     } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
//       $title = _x( 'Chats', 'post format archive title' );
//     }
//   } elseif ( is_post_type_archive() ) {
//     /* translators: Post type archive title. 1: Post type name */
//     $title = sprintf( __( 'Archives: %s' ), post_type_archive_title( '', false ) );
//   } elseif ( is_tax() ) {
//     $tax = get_taxonomy( get_queried_object()->taxonomy );
//     /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
//     $title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
//   } else {
//     $title = __( 'Archives' );
//   }

//   function escargatoire_the_archive_title( $before = '', $after = '' ) {
//   $title = get_the_archive_title();

//   if ( ! empty( $title ) ) {
//     echo $before . $title . $after;
//   }
// }

// endif;




// $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
//   $user_id = sprintf("user_$curauth->id"); 

// if(get_field('public_email'))
// {
//   echo '<p>' . get_field('public_email', $user_id) . '</p>';
// }

?>