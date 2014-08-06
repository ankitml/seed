<?php
/***************************************************************/
/*                                                             */
/*   Add support for Featured Image option                     */
/*   add_image_size( '71-width-71-height', 71 , 71, true)      */
/*   add_image_size('300-width-unlimited-height', 300, 9999)   */
/*                                                             */
/***************************************************************/
add_image_size('single', 832, 999999, false);
add_image_size('single-full', 1170, 999999, false);
add_image_size('grid', 370, 999999, false);
add_image_size('quote-link', 728, 232, true);

//Advertising
add_image_size('widget-advert', 250, 250, true);
add_image_size('widget-advert-small', 125, 125, true);

?>