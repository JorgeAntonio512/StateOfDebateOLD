<link rel="stylesheet" type="text/css" href="../client/jquery/freichat_themes/freichatcss.php?do=theme" />
<link rel="stylesheet" type="text/css" href="../server/admin_files/theme_maker/style.css" />
<link rel="stylesheet" type="text/css" href="../server/admin_files/theme_maker/lib/css/switches.css" />


<script type="text/javascript">
<?php
//session_start();
//error_reporting(-1);

$path = '../';


//require $path . 'arg.php';
//$_SESSION[$uid . 'new_project'] = $chk->chk_project();


$thm = new FreiChat();
$thm->init_vars();
$thm->get_js_config();
$uid = $thm->uid;
$valid_exts = $thm->valid_exts;
$_SESSION[$uid . 'curr_theme'] = $_GET['theme_name'];
require $path . 'client/themes/' . $_SESSION[$uid . 'curr_theme'] . '/argument.php';
//require $path . 'client/jquery/js/jquery.1.7.1.js';
//require $path . 'client/jquery/js/jquery-ui.js';
require $path . 'server/admin_files/theme_maker/definitions.js';
require $path . 'server/admin_files/theme_maker/plugins.js';
require $path . 'server/admin_files/theme_maker/functions.js';
require $path . 'server/admin_files/theme_maker/lib/js/md5.js';
require $path . 'client/plugins.js';
//require $path . 'client/chatroom.js';

require $path . 'server/admin_files/theme_maker/theme_builder.js';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</script>

        <div id='notification'></div>
        <div id="current_theme" class="current_theme">
            
           editing theme: <span id="current_theme_name"></span>
        </div>
        <div class="current_theme">
            Hint: <span id="theme_hint"></span>
        </div>
        <div class='upload_div' title="upload image to be replaced" id='upload_div'> 
            <!--<div id='close_upload_div' class='close_upload_div'>
                <a>
                    <em>X</em>
                </a>
            </div> -->
            <div>
            <!--<div class='saveas_theme_font'>Upload image to replace:</div>-->
            <form action='' name='upload' method='post' enctype='multipart/form-data'>
                <input id='file-upload-status' disabled='disabled' class='saveas_theme_input'/>
                
                <div class='theme_button upload_submit_button' onclick='return FreiChat.file_upload();'>UPLOAD</div>
                <div class='file-upload'>
                    <div>SELECT</div>
                    <input id='file_input_upload' accept='jpeg,jpg,png,gif,zip' type='file' name='file' /> 
                </div>

            </form>
            </div>
            
        </div>  

        <div id='style_rules' title="edit css styles on fly" class='style_rules' id='parameters'>
            <div id='style_header'>
                <div class='theme_button add_new_style' id='add_new_style'>add new style</div>
                <!--<div id='close_style_rules_div' class='close_upload_div'>
                    <a>
                        <em>X</em>
                    </a>
                </div>-->
            </div>
            <div id='style_rules_content'></div>
            
        </div>

        <div id='theme_menu' class='theme_menu'>
                <div class="switch candy blue menu_switch">
                        <input id="parameters" name="view" type="radio">
                        <label for="css" onclick="FreiChat.switch_button('theme_mode','parameters')">Edit CSS</label>

                        <input id="image" name="view" type="radio">	
                        <label for="images" onclick="FreiChat.switch_button('theme_mode','image')">Edit images</label>

                        <span class="slide-button"></span>
                </div>
                <div class="switch candy blue menu_switch">
                        <input id="chat" name="view2" type="radio">
                        <label for="chat" onclick="FreiChat.switch_button('freichat_switch','chat')">Edit chat</label>

                        <input id="chatroom" name="view2" type="radio">	
                        <label for="chatroom" onclick="FreiChat.switch_button('freichat_switch','chatroom')">Edit chatroom</label>

                        <span class="slide-button"></span>
                </div>

            <div class='theme_button' id='help'>help</div>
            <div id='save_theme'  class='theme_button' id='save'>save</div>
            <div class='theme_button' id='restore'>undo</div>

            
        </div>
