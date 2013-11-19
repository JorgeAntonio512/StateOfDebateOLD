<?php
if (!isset($_GET['id']) || !isset($_GET['xhash']))
    exit;

require '../arg.php';

$FC = new FreiChat();

$FC->init_vars();
$frei_trans = $FC->frei_trans;
$url = $FC->url;

if (isset($_SERVER['HTTP_REFERER'])) {
    $referer_url = $_SERVER['HTTP_REFERER'];
} else {
    $referer_url = $url;
}


if (strpos($referer_url, 'www.') == TRUE) {
    $url = str_replace('http://', 'http://www.', $url);
    $url = str_replace('https://', 'https://www.', $url);
} else {

    $url = str_replace('http://www.', 'http://', $url);
    $url = str_replace('https://www.', 'https://', $url);
}

if (strpos($url, 'www.www.') == TRUE) {
    $url = str_replace('http://www.www.', 'http://www.', $url);
    $url = str_replace('https://www.www.', 'https://www.', $url);
}


$id = $_GET['id'];
$xhash = $_GET['xhash'];

$url = str_replace("chat.php", "", $url);
?>


<!DOCTYPE html> 
<html> 
    <head> 
        <title>Chat</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 


        <link rel="stylesheet" href="<?php echo $url; ?>jquery/freichat_themes/freichatcss.php" type="text/css" />
        <script src="<?php echo $url; ?>main.php?id=<?php echo $id; ?>&xhash=<?php echo $xhash; ?>&mobile=1" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo $url; ?>plugins/mobile/jquerymobile.css" />
        <link rel="stylesheet" href="<?php echo $url; ?>plugins/mobile/simpledialog2.css" />
        <script src="<?php echo $url; ?>plugins/mobile/jquerymobile.js"></script>
        <script src="<?php echo $url; ?>plugins/mobile/simpledialog2.js"></script>
        <script src="<?php echo $url; ?>plugins/mobile/iscroll.js"></script>


        <script>
            FreiChat.init();
        </script>
        <style type="text/css">
            body {
                overflow-x:hidden;
            }
            .users_li {
                cursor:pointer;
                padding: 10px;
                background-image: -webkit-gradient(linear,left top,left bottom,from( #fff ),to( #f1f1f1 ));
                background-image: -webkit-linear-gradient( #fff,#f1f1f1 );
                background-image: -moz-linear-gradient( #fff,#f1f1f1 );
                background-image: -ms-linear-gradient( #fff,#f1f1f1 );
                background-image: -o-linear-gradient( #fff,#f1f1f1 );
                background-image: linear-gradient( #fff,#f1f1f1 );
                border-radius: 0 !important;
            }

            .users_li:hover{
                background: #eee;
            }
            .users_ul{
                padding:12px;
            }

            .freichat_userscontentavatarimage {
                height: 32px;
                width: 32px;
                margin-top: -8px;
            }

            .freichat_userscontentname{
                color: black;
                font-size: 14px;
                font-family: Helvetica,Arial,sans-serif;
                padding-top: 0;
                padding-left:20px;
            }

            .scroller ul {
                list-style:none;
                padding:0;
                margin:0;
                width:100%;
                text-align:left;
                position: relative;
                top: -14px;
            }
            .scroller {
                position:relative;
            }

            #message_content {
                /*position:absolute; z-index:1;
                top:45px; bottom:48px; left:0;
                width:97.6%;
                */

                top: 44px;
                bottom: 56px;


                position:fixed;
                top: 45px;
                bottom: 56px;
                left:0px;   
                font-family: Arial, sans-serif;
                font-size: 13px;
                overflow:hidden;


                padding-top: 15px;
                width:100%;
                line-height: 1.32em;
                word-wrap: break-word;
                /*background: white;*/
            }


            .bubble_me 
            {
                position: relative;

                padding: 10px 18px;
                background: #F2F2F2;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                max-width: 90%;
                vertical-align: top;
                box-shadow: 2px 2px 2px 0px rgba( 178, 178, 178, .4 );

                float: left;   
                margin: 5px 45px 5px 20px;         
                padding-bottom:14px;
            }

            .bubble_me:after 
            {
                content: "";
                position: absolute;
                bottom: 4px;
                left: -12px;
                border-style: solid;
                border-width: 5px 12px 5px 0;
                border-color: transparent #F2F2F2;
                display: block;
                width: 0;
                z-index: 1;
            }




            .bubble_you 
            {
                position: relative;

                padding: 10px 18px;
                background: #F2F2F2;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                max-width: 90%;
                vertical-align: top;
                box-shadow: 2px 2px 2px 0px rgba( 178, 178, 178, .4 );

                float: right;    
                margin: 5px 20px 5px 45px;
                padding-bottom:14px;
            }

            .bubble_you:after 
            {
                content: "";
                position: absolute;
                bottom: 4px;
                right: -12px;
                border-style: solid;
                border-width: 5px 0 5px 12px;
                border-color: transparent #F2F2F2;
                display: block;
                width: 0;
                z-index: 1;
            }



            .freichat_time{
                visibility:visible;
                color: #333;
                display: inline-block;
                position: absolute;
                bottom: -1px;
                right: 4px;
            }

            .u_scroller {
                position:relative;
            }

            .u_scroller ul {
                position: relative;
            }


            .new_messages_no{
                color: #333;
                border: 1px solid #999;
                text-align: center;
                position: absolute;
                right: 40px;
                top: 27%;
                border-radius: 7px;
                font-weight: bold;
                font-size: 12px;
                padding: 2px 5px;
            }

            .widgets {
                width: 28px;
                height: 100%;
                display: block;
                position: absolute;
                top: 0%;
                cursor: pointer;
                background-position: center center;
                background-repeat: no-repeat;
                right: 0%;
                background-size: 28px 28px;
                padding-left: 14px;
                border-left: 1px solid #4e4e4e;
            }

            .smiley_widget {
                background-image: url("plugins/mobile/images/smileyimg.png");
                margin-right: 4px; /*offset from right*/
            }



            .attachment_widget {
                background-image: url("plugins/mobile/images/attachment.png");
                margin-right: 50px; /*offset from right */
            }

            #frei_smileys_mobile {
                position: absolute;
                right  : 1.4%;
                top: 90%;
                cursor: pointer;
                z-index: 999;
                box-shadow: 1px 2px 3px black;




                color: white;
                background: white;
                display: none;
                width: 130px;
                height: 115px;
                bottom: 86px;
                border: 1px solid gray;
                padding: 6px;
                border-radius: 5px;
            }


            #frei_smileys_mobile:after{
                content: ' ';
                height: 0;
                position: absolute;
                width: 0;
                border: 10px solid transparent;
                border-bottom-color: #fff;
                top: -18px;
                left: 112px;

            }

            #frei_smileys_mobile img{
                cursor:pointer;
                border:1px solid white;
            }

            #frei_smileys_mobile img:hover{
                border:1px solid gray;
                border-radius:5px;
            }


            .option_bar{
                height: 43px;
                -moz-opacity: 0.5;
                -khtml-opacity: 0.5;
                opacity: 0.7;
                filter: alpha(opacity=50);
                background: black;
                color: black;
                position: relative;
                z-index: 1;
            }


            .option_bar_widgets {
                width: 28px;
                height: 28px;
                display: block;
                position: absolute;
                top: 15%;
                cursor: pointer; 
                background-size: contain;
                background-position: center center;
                background-repeat: no-repeat;
                right: 0%;
            }

            .clear_messages_widget {
                background-image: url("plugins/mobile/images/deleteimg.png");
                margin-right: 18px; /*offset from right*/                
            }
            .save_messages_widget {
                background-image: url("plugins/mobile/images/saveimg.png");
                margin-right: 68px; /*offset from right*/                
            }
            .mail_messages_widget {
                background-image: url("plugins/mobile/images/mailimg.png");
                margin-right: 118px; /*offset from right*/                
            }


            #chat{
                background: white;
            }

            .chatboxmessagecontent a {
                color: #bc2328;
                text-decoration: underline;
                outline: none;
                background: none;
            }

            .chatboxmessagecontent a:hover {
                color: #bc2328;
                text-decoration: none;
                background: none;
            }

            #jqm_m_loader{
                position: relative;
                bottom: -18px;
                left: 24px;
            }
        </style>

    </head> 
    <body> 


        <!-- first page: online users -->
        <div id="users" data-role="page">

            <div data-role="header">
                <h1><?php echo $frei_trans["mobile_list_title"]; ?></h1>
            </div><!-- /header -->

            <div data-role="content">
                <div class="frei_mobile_users" id="frei_mobile_users">
                    <div id="users_scroller" class="u_scroller">
                        <ul class="users_ul" id="users_ul" data-role="listview" data-inset="true" data-filter="true">

                        </ul>
                    </div>
                </div>


            </div><!-- /content -->

            <!-- <div data-role="footer" data-id="foo1" data-position="fixed">
                 <div style="text-align:center;margin:0px auto" data-role="button">(c) Codologic Inc.</div>
             </div>
            -->

        </div>
        <!-- end of first page -->


        <!-- second page: one-one chat -->
        <div id="chat" data-role="page">

            <div id="chat_to_header" data-role="header">
                <a data-role="button" data-icon="back" onclick="mobile.go_back();"><?php echo $frei_trans["mobile_back"]; ?></a>
                <span style="display:none" id="chat_my_avatar" style='display:block' class='freichat_userscontentavatar'></span>
                <h1 id="chat_to_header_text"><?php echo $frei_trans["mobile_private_def_head"]; ?></h1>

                <!--smileys container -->
                <span id='freismileboxchatroom'>
                    <span id='frei_smileys_mobile' class=' none'>

                    </span> 
                </span>

                <!--smileys container -->


                <span id="smiley_widget" class="widgets smiley_widget"></span>
                <span id="attachment_widget" class="widgets attachment_widget"></span>

            </div>
            <div id="option_bar" class="option_bar">
                <span id="clear_messages_widget" class="option_bar_widgets clear_messages_widget"></span>
                <span id="mail_messages_widget" class="option_bar_widgets mail_messages_widget"></span>
                <a  data-rel="dialog" data-transition="pop" id="save_messages_widget_a" href="javascript:void"><span id="save_messages_widget" class="option_bar_widgets save_messages_widget"></span></a>

            </div>

            <div id="message_content"> 

                <div id="messages_scroller" class="scroller">
                    <ul id="messages_list"></ul>
                </div>
            </div>

            <div data-role="footer" data-id="foo1" data-position="fixed">
                <form id="send_message" data-ajax="false" onsubmit="return false">
                <!--<textarea placeholder="type your message " cols="40" rows="8" name="textarea" id="message_textarea"></textarea>-->
                    <input id="chat_message" type="text" name="chat_message" placeholder="<?php echo $frei_trans["mobile_private_enter_text"]; ?>">
                </form>
            </div>

        </div>


        <!-- end of second page -->



        <!-- popups here -->

        <!-- upload/ send file -->


        <!-- index.php could be any script server-side for receive uploads. -->


        <div data-overlay-theme="b" data-theme="a" data-role="dialog" id="attachment_widget_popup">
            <div data-role="header" data-theme="a">
                <h1><?php echo $frei_trans["mobile_file_title"]; ?> </h1>
            </div>
            <div data-role="content" data-theme="d">
                <form id="jqm_u_form" data-ajax="false" name="upload" action="" method="post" enctype="multipart/form-data">

                    <input id="jqm_u_fromid" type="hidden" name="fromid"/>
                    <input id="jqm_u_fromname" type="hidden" name="fromname"/>
                    <input id="jqm_u_toid" type="hidden" name="toid"/>
                    <input id="jqm_u_toname" type="hidden" name="toname"/>

                    <input data-role="button" data-theme="b" type="file" name="file" id="attachment_widget_file" /><br/>
                    <input id="jqm_u_form_submit" data-inline="true" data-role="button" data-theme="a" class ="frei_upload_button" type="button" value="<?php echo $frei_trans["mobile_send"]; ?>" />
                    <a data-inline="true" data-rel="back" data-role="button" data-theme="b" ><?php echo $frei_trans["mobile_cancel"]; ?></a>
                    <!--  <div id="upload_status"></div>
                       <div id="file_upload_status_error"></div>
                    -->         </form>
                <div style="display:none" id="on_upload_complete">
                    <p><span id="file_upload_status"></span></p>
                    <a onclick="mobile.reset_upload_dialog()" id="go_back" data-role="button" data-theme="a" href="#" data-rel="back" ><?php echo $frei_trans["mobile_back"]; ?></a>
                </div>
            </div>
        </div>




        <!-- upload / send file-->


        <!-- send mail -->



        <div data-overlay-theme="b" data-theme="a" data-role="dialog" id="mail_widget_popup">
            <div data-role="header" data-theme="a">
                <h1><?php echo $frei_trans["mobile_mail_title"]; ?></h1>
            </div>
            <div data-role="content" data-theme="d">
                <form id="jqm_m_form" data-ajax="false" name="upload" action="" method="post" enctype="multipart/form-data">

                    <label for="subject"><?php echo $frei_trans["mobile_mail_subject"]; ?>:</label>
                    <input type="text" id="jqm_m_subject" name="subject" value=""/>

                    <label for="mailto"><?php echo $frei_trans["mobile_mail_rec_email"]; ?>:</label>
                    <input type="text" id="jqm_m_mailto" name="mailto" value=""/>


                    <input id="jqm_m_form_submit" data-inline="true" data-role="button" data-theme="a" class ="frei_mail_button" type="button" value="<?php echo $frei_trans["mobile_send"]; ?>" />
                    <a data-inline="true" data-rel="back" data-role="button" data-theme="b" ><?php echo $frei_trans["mobile_cancel"]; ?></a>
                    <span style="text-align:center;display:none" id="jqm_m_loader" ><img src="plugins/mobile/images/ajax-loader.gif"/></span>

                    <!--  <div id="upload_status"></div>
                       <div id="file_upload_status_error"></div>
                    -->         </form>
                <div style="display:none" id="on_mail_complete">
                    <p><span id="file_mail_status"></span></p>
                    <a onclick="mobile.reset_mail_dialog()" id="go_back" data-role="button" data-theme="a" href="#" data-rel="back" ><?php echo $frei_trans["mobile_back"]; ?></a>
                </div>
            </div>
        </div>




        <!-- send mail-->


        <!-- popups here -->

    </body>
</html>
