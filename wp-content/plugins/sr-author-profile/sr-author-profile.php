<!--     $months   = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
    $default  = array( 'day' => 1, 'month' => 'Jnuary', 'year' => 1950, );
    $birth_date = wp_parse_args( get_the_author_meta( 'birth_date', $user->ID ), $default ); -->

<?php

/**
 * Add new fields above 'Update' button.
 *
 * @param WP_User $user User object.
 */
function tm_additional_profile_fields( $user ) {

    <h3>Extra profile information</h3>

    <table class="form-table">
     <tr>
       <th><label for="5k-pr-min">5k</label></th>
       <td>
         <select id="5k-pr-min" name="5k-pr[min]"><?php
           for ( $i = 1; $i <= 59; $i++ ) {
             printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $fivek['min'], $i, false ) );
           }
         ?></select>
         <select id="5k-pr-sec" name="5k-pr[sec]"><?php
            for ( $i = 1; $i <= 59; $i++ ) {
             printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $fivek['min'], $i, false ) );
           }
         ?></select>
       </td>
     </tr>
    </table>
    <?php
}

add_action( 'show_user_profile', 'tm_additional_profile_fields' );
add_action( 'edit_user_profile', 'tm_additional_profile_fields' );


/**
 * Save additional profile fields.
 *
 * @param  int $user_id Current user ID.
 */
function tm_save_profile_fields( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
     return false;
    }

    if ( empty( $_POST['birth_date'] ) ) {
     return false;
    }

    update_usermeta( $user_id, 'birth_date', $_POST['birth_date'] );
}

add_action( 'personal_options_update', 'tm_save_profile_fields' );
add_action( 'edit_user_profile_update', 'tm_save_profile_fields' );

?>