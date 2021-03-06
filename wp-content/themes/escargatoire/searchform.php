<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <ul>
    <li>
      <label for="" class="screen-reader-text"><?php echo _x( 'Search:', 'label', 'escargatoire' ); ?></label>
      <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search for stuff &hellip;', 'placeholder', 'escargatoire' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
      <button type="submit" class="search-submit icon-btn"><span class="screen-reader-text" alt="Submit Search"><?php echo _x( '', 'submit button', 'escargatoire' ); ?></span></button></span>
    </li>
  </ul>

</form>
