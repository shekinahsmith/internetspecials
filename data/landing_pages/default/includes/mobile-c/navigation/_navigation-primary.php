<nav class="navigation-primary" role="navigation">

    <ul class="navigation-primary__list">

    <?
        // loop through nav links and create list
        foreach ($site_settings['navigation']['primary'] as $submenus) {
            
            // submenu
            foreach ($submenus as $key => $val) {
                
                // top level
                if (!is_array($val)) {
                    
                    echo "<li class=\"navigation-primary__header\"><span>{$val}</span>";
                }
                
                    // submenu
                    if (is_array($val)) {
                            
                        echo "<ul class=\"navigation-primary__submenu\">";
                        
                            foreach ($val as $link) { 

								// create variables to use in html below
                                foreach ($link as $key => $val) {
                                    
                                    switch ($key) {
                                        case 'text':
                                            $text = $val;
                                            break;
                                        case 'url':
                                            $href = $val;
                                            break;
                                        case 'tracking':
                                            $tracking = $val;
                                            $trackingClass = ' js-track'; // space is intentional. do not remove.
                                            break;
                                    }
                                }

                                if( $text == 'Check Availability') {

                                    echo "<li class=\"navigation-primary__submenu-list-item js-modal-show" . $trackingClass . "\" data-modal=\"address-check\" " . $tracking . "><a href=\"{$href}\" class=\"navigation-primary__submenu-link\">{$text}</a></li>";
                                } 
                                else {
                                                                        
                                    echo "<li class=\"navigation-primary__submenu-list-item\"><a href=\"{$href}\" class=\"navigation-primary__submenu-link" . $trackingClass . "\"" . $tracking . ">{$text}</a></li>";
                                }	
                                
                            }
                            
                        echo "</ul>"; // ends submenu
                    
                    echo "</li>"; // ends top level
                }
            }
        }
    ?>
    </ul><!-- /.navigation__list -->

</nav><!-- /.navigation-pimary -->