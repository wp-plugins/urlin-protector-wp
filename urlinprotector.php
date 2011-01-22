<?php
/*     
Plugin Name: Urlin Protector WP  
Plugin URI: http://urlinsoftware.com/  
Description: The Urlin Protector WP plugin is intended for the protection of Your site's content from unauthorized copying by the visitors and automatic grabbers. Urlin Protector reliably protects Your site from the plagiarists' attacks. Unlike the other products designed for the site content protection, Urlin Protector not only restricts the user's ability to select a part of the text in the page and block the mouse's right button and some function keys but also encodes the content in the page's source code. It provides a reliable protection for the content against the automatic grabbers. For <strong><a href="http://urlinsoftware.com/urlin-software-products/wordpress/urlin-protector-wp-gold">Urlin Protector WP GOLD</a> additional capabilities</strong> will be available: <strong>1.</strong> ALT tag addition to the source code of the page in order to encode the article content which will contain the beginning of the article. It significantly improves the site indexing by the search engines; <strong>2.</strong> Urlin Software logo below the protected content of the article will be removed. See also: <a href="http://urlinsoftware.com/urlin-software-products/wordpress/urlin-protector-wp-gold">Urlin Protector WP GOLD</a>. 
Version: 1.0.2       
Author: Urlin Software  
Author URI: http://urlinsoftware.com/ 
*/


           $check_zend = check_zend_optimizer();
           if (check_zend_optimizer()<>1)      
           {
              exit ('Zend Optimizer 3.3+ is required!<br><a href="http://kb.zend.com/index.php?View=entry&EntryID=424" target="_blank">How to install Zend Optimizer manually?</a>'); 
           }
include ("protector.php");       
           
    add_action('admin_notices', 'urlinprotector_warning'); 
    remove_action('wp_head', 'protect_header_block');   
    remove_filter('the_content', 'protect_content_block');
    remove_filter('body_class', 'protect_body_block'); 
    add_action('wp_head', 'protect_header_block'); 
    add_filter('the_content', 'protect_content_block');
    add_filter('body_class', 'protect_body_block');       
    
        function urlinprotector_warning() {
           echo "<div id='akismet-warning' class='updated fade'><p><strong>".__('Urlin Protector WP: ')."</strong>Your Site Content is protected. For <a href=\"http://urlinsoftware.com/urlin-software-products/wordpress/urlin-protector-wp-gold\" target=\"_blank\">Urlin Protector WP GOLD</a> additional capabilities are available.</p></div>";
            
        }    
    
        function check_zend_optimizer()
        {
              $is_apache = (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false || strpos($_SERVER['SERVER_SOFTWARE'], 'LiteSpeed') !== false);
              $is_IIS = (strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false || strpos($_SERVER['SERVER_SOFTWARE'], 'ExpressionDevServer') !== false);  
              $is_iis7 = (strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS/7.') !== false);  
              $dir_separator ='/';
              if ($is_IIS) { $dir_separator ='\\'; }  
              if ($is_IIS7) { $dir_separator ='\\'; }           
              $protector_dir = __FILE__; 
              $curr_str_pos = strrpos($protector_dir,$dir_separator);  
              $protector_dir = substr($protector_dir,0,$curr_str_pos); 
              $protector_dir_real = $protector_dir;
              $curr_str_pos = strrpos($protector_dir,$dir_separator);  
              $protector_dir = substr($protector_dir,0,$curr_str_pos);
              $curr_str_pos = strrpos($protector_dir,$dir_separator);  
              $protector_dir = substr($protector_dir,0,$curr_str_pos);
              $curr_str_pos = strrpos($protector_dir,$dir_separator);  
              $protector_dir = substr($protector_dir,0,$curr_str_pos);
              $protector_dir_real = substr($protector_dir_real,$curr_str_pos);
              if ($protector_dir_real[0]<>$dir_separator) { $protector_dir_real = $dir_separator.$protector_dir_real; }   
              $protector_dir_real = str_replace('\\','/',$protector_dir_real);
              $check_url = get_bloginfo('url').$protector_dir_real.'/checkzend.php'; 
              $zend_check = file_get_contents("$check_url");       
              if ($zend_check<>'zend_enabled') { return 0; } else { return 1; }                               
        }
?>