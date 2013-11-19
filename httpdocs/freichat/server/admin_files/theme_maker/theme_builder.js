                 
$('document').ready(function(){
    
    
    //FreiChat.new_copy();
    
    //------------------------------------------------------------------------------------------------      
    //menu     
    var str_new_theme,str_contain,str_container,str_opt1,str_opt2,str_options,str_head,str_frei,str_off,main_str;  


    //------------------------------------------------------------------------------------------------

    //chat_switch

    str_container = "<div class='freicontain freicontain0' id='freicontain0'></div><div class='freicontain freicontain1' id='freicontain1'></div>";
  
    str_opt1 = "<span class='label status_options_label'>status options</span><div id='frei_options' class='frei_options'><br/><span class='frei_status_options'> <span id='status_online' class='status_available'> <img id='online_img'  src="+FreiChat.make_url(freidefines.onlineimg)+" alt='on'/><a onmousedown='' href='javascript:void(0)'> online </a></span>        <span id='status_busy' class='status_busy'> <img id='busy_img' src="+FreiChat.make_url(freidefines.busyimg)+" alt='by'/><a  onmousedown=''>busy</a> </span>   <br/>  <span id='status_invisible' class='status_invisible'> <img id='invisible_img' src="+FreiChat.make_url(freidefines.invisibleimg)+"  alt='in'/> <a onmousedown=''>invisible</a>   </span><span id='status_offline' class='status_offline'>            <img id='offline_img' src="+FreiChat.make_url(freidefines.offlineimg)+" alt='of'/><a>offline</a></span>\n\
<div class='custom_mesg' id='custom_mesg'><input type=text  id='custom_message_id'  /> <div class='frei_custom_mesg_update_btn'>update</div><br/>\n\
 <br/></div></span></span></div>";
    
    str_opt2 = "<span class='label additional_options_label'>additional options</span>\n\
<div class='frei_option_bar' id='frei_option_bar'><div class='frei_option_bar_status' id='frei_option_bar_status'><div class='frei_option_bar_arrow'></div>\n\
<div class='frei_option_bar_status_txt' id='frei_option_bar_status_txt'>i am available</div></div>\n\
<div class='frei_chatbox_options'><div class='frei_option_bar_reset'><div class='frei_option_bar_reset_bg'></div></div><div id='frei_option_bar_rtl' class='frei_option_bar_rtl'><div class='frei_option_bar_rtl_bg'></div></div><div class='frei_option_bar_sound'><div class='frei_option_bar_sound_bg frei_option_bar_sound_bg_on'></div></div><div class='frei_option_bar_sound'><div class='frei_option_bar_sound_bg frei_option_bar_sound_bg_off'></div></div></div></div>"  


    str_options=str_opt1+str_opt2;
    //------------------------------------------------------------------------------------------------------
    // Contains FreiChatX head DIV
    str_head="<div class='freichathead' id='freichathead' > \n\
<span class='user_freichat_head_content'><span id='frei_user_count' class='frei_user_count'>1</span> User</span>\n\
<span class='min_freichathead'>  \n\
<img id='frei_img' src="+FreiChat.make_url(freidefines.minimg)+" alt='max' height=12 width=12/> </span></div>"; 

    str_frei="<div id='frei_user_brand' class='frei_user_brand'><div id='frei' class='frei'>\n\
</div></div></div>";
    // Contains the DIV that appears when offline
    str_off="<div class='onoffline' id='onfreioffline'><a href='javascript:void(0)'  onmousedown=''><img onmouseover= id='offlineimg' src="+FreiChat.make_url(freidefines.offline)+" alt='offline'/></a></div>";
    //-------------------------------------------------------------------------------------------------------
    // Contains the main DIV that combines the others!



    main_str="<div id='chat_switch_div'>"+str_container+"<span class='freichat'><div id='freichat' class='freichat' style='z-index: 99999;'><span class='label chatbox_label'>chatbox</span><span class='label offline_label'>offline image</span><span class='label chatwindow_label_min'>chat window [minimized]</span><span class='label chatwindow_label_max'>chat window  [maximized]</span>"+str_options+str_off+str_head+str_frei+"</div></span></div>";    
    
    
    
    main_str+="<div id='chatroom_switch_div'><div class='frei_chatroom' id='frei_chatroom'>\n\
	<div id='frei_roomtitle' class='frei_roomtitle'>\n\
	test chatroom title\n\
	</div>\n\
\n\
\n\
<div id='frei_chatroompanel' class='frei_chatroompanel'>\n\
\n\
<div id='frei_chatroomrightpanel' class='frei_chatroomrightpanel'>\n\
    <div id='frei_chatroom_tabs' class='frei_chatroom_tabs'>\n\
        \n\
        <ul>\n\
            <li id='frei_userpanel_li' ><a>USERS</a></li>\n\
            <li id='frei_roompanel_li' ><a>ROOMS</a></li>\n\
        </ul>\n\
        \n\
    \n\
\n\
    <div id='frei_userpanel' class='frei_userpanel'><div id='frei_userlist' class='frei_userlist'><span class='freichat_userscontentname'>test user1</span></div>\n\
    </div>\n\
\n\
    <div id='frei_roompanel' class='frei_roompanel'><div class='frei_lobby_room' >\n\
                    <span class='frei_lobby_room_1'>test room 1</span><span class='frei_lobby_room_2'>0 online</span><span class='frei_lobby_room_3'></span>\n\
                    <span class='frei_lobby_room_4'></span>\n\
                    <div style='clear:both'></div></div>\n\
   <div id='frei_selected_room' class='frei_selected_room' >\n\
                    <span class='frei_lobby_room_1'>test room 1</span><span class='frei_lobby_room_2'>0 online</span><span class='frei_lobby_room_3'></span>\n\
                    <span class='frei_lobby_room_4'></span>\n\
                    <div style='clear:both'></div></div>\n\
\n\
    </div>\n\
\n\
 </div>\n\
</div>\n\
    <div id='frei_chatroomleftpanel frei_chatroom_tabscontent' class='frei_chatroomleftpanel'>\n\
\n\
\n\
\n\
\n\
         <div id='frei_chatroommsgcnt' class='frei_chatroommsgcnt'>\n\
             <div id='1_chatroom_message' class='frei_chatroom_message'><span style='display:none' id='1_message_type'>LEFT</span>\n\
                <div class='chatroom_messagefrom_left'><span>Me</span><span class='freichat_time' style='visibility:visible;padding-right:15px'>15:36 </span></div>\n\
                <div id='room_msg_0' class='frei_chatroom_msgcontent'>hi</div>\n\
             </div>\n\
         </div>\n\
\n\
\n\
 <div id='chatroom_branding'></div>\n\
\n\
        <div id='frei_chatroomtextarea' class='frei_chatroomtextarea'>\n\
<span id='freismileboxchatroom'> </span>\n\
        <div id='frei_chatroom_add_smiley' class='frei_chatroom_add_smiley'>   <a href='javascript:void(0)' ><img id='frei_smiley_chatroom_select'  src='"+FreiChat.make_url(freidefines.smiley_chatroomimg)+"' /> </a></div>\n\
       <textarea id='chatroommessagearea' class='chatroommessagearea' ></textarea> </div>\n\
    </div>\n\
\n\
</div>\n\
</div></div>";


    
    
    var freichathtml = document.createElement("div");
    freichathtml.id = "freichathtml";
    freichathtml.innerHTML = main_str;
    document.body.appendChild(freichathtml);
    FreiChat.show_tab_content('rooms');
    /* <span id="addedoptions_'+id+'" class="added_options"> '+FreiChat.show_plugins(user,id)+'</span>*/
    var id =1;
    var str='<div onmousedown="" id="frei_'+id+'" class="frei_box">        <div id="chatboxhead_'+id+'">   <div class="chatboxhead" id="chatboxhead'+id+'">                <div class="chatboxtitle">test user 1&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">         <a href="javascript:void(0)" ><img id="xtools'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" ><img id="minimgid'+id+'" src="'+FreiChat.make_url(freidefines.minimg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown="">                        <img id="closeimg" src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" />                    </a>                </div>                <br clear="all"/>            </div>        </div>        <div class="freicontent_'+id+'" id="freicontent_'+id+'">        \n\
\n\
    <div class="chatboxcontent" id="chatboxcontent_'+id+'">\n\
            <div id="msg_2" class="chatboxmessage "><span class="freichat_time" id="freichat_time_2">13:16 </span><span class="chatboxmessagefrom">Guest-1mcl:&nbsp;</span><span class="chatboxmessagecontent">test message click me to edit my properties</span></div>\n\
            <div id="msg_2" class="chatboxmessage "><span class="freichat_time" id="freichat_time_2">13:16 </span><span class="chatboxmessagefrom">Me:&nbsp;</span><span class="chatboxmessagecontent">test link:<a class="chatboxmessagecontent a" onclick="return false" href=http://google.com>click me to edit link properties</a></span></div>\n\
    </div>         \n\
\n\
   <div class="chatboxinput">  <span class="frei_chat_status" id="frei_chat_status_'+id+'"></span><textarea id="chatboxtextarea'+id+'" class="chatboxtextarea" onkeydown="$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return;}"></textarea>                </div>       </div>    </div>';
    var str2 = '<div class="chatboxhead_max" id="chatboxhead_'+id+'">  <div class="chatboxhead" id="chatboxhead_max'+id+'">   <div class="chatboxtitle">test user 1&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">   <a href="javascript:void(0)" ><img id="xtools_max'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" ><img id="maximgid'+id+'" src="'+FreiChat.make_url(freidefines.maximg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown=""> <img id="closeimg_max" src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" /> </a>    </div>  <br clear="all"/>    </div></div>';
    $('#freicontain0').html(str+str2);
 
    $("#frei_option_bar_rtl").hide();
    var pluginhtml;
    pluginhtml = '<span id="freifilesend"><a href="javascript:void(0)" ><img id="upload" src="'+FreiChat.make_url(freidefines.uploadimg)+'"  alt="upload" /> </a></span>';
    pluginhtml+= '<a href="javascript:void(0)" >  <img id="clrcht" src="'+FreiChat.make_url(freidefines.deleteimg)+'" alt="-" /> </a>';
    pluginhtml += '<a href="javascript:void(0)" >                <img id="smile" src="'+FreiChat.make_url(freidefines.smileyimg)+'" alt="-" />                </a>   ';
    pluginhtml += '<span id="savespan"><a href="javascript:void(0)"><img id="save" src="'+FreiChat.make_url(freidefines.saveimg)+'" alt="save" /> </a></span>';
    pluginhtml += '<span id="mailsend"><a href="javascript:void(0)"><img id="mail" src="'+FreiChat.make_url(freidefines.mailimg)+'" alt="upload" /> </a></span>';
    // pluginhtml += '<span id="videosend"><a href="javascript:void(0)"><img id="video" src="'+FreiChat.make_url(freidefines.videoimg)+'" alt="upload" /> </a></span>';

    var tools = '<span class="label added_options_label">plugins</span><span class=X_tools><span class="added_options">'+pluginhtml+'</span></span>';
    
    
    //str = '<span class="label smiley_list_label">smileys</span><span id="frei_smileys" class="frei_smileys">'+FreiChat.smileylist(1)+'</span>';
    
    $('#freicontain1').html(tools);
    //------------------------------------------------------------------------------------------------

    //chatroom

    $( "#upload_div" ).dialog({
        autoOpen: false,
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        },
        zIndex: 9999999,
        resizable: false,
        height: 220,
        width:400
    });

    $( "#style_rules" ).dialog({
        autoOpen: false,
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        },
        zIndex: 9999999,
        resizable: false,
        height: 350,
        width:420
    });
    
    if($.browser.msie) {        
        alert("The theme maker may not work properly in MSIE.\nPlease use chrome or firefox for best experience");
    }



    if(typeof sessionStorage['freichat_switch'] == "undefined"){
        sessionStorage['freichat_switch'] = 'chat';
        sessionStorage['theme_mode'] = 'image';
    }
     

    // for (var i=0, len = sessionStorage.length; i  <  len; i++){
    //   var key = sessionStorage.key(i);
    // var value = sessionStorage.getItem(key);
        
    FreiChat.switch_button("freichat_switch",sessionStorage['freichat_switch'],true);
    FreiChat.switch_button("theme_mode",sessionStorage['theme_mode'],true);
    //} 


    $('#current_theme_name').html(freidefines.GEN.curr_theme);


    FreiChat.divfrei = $('#frei');   
    FreiChat.height = 1*25; //1 user
    FreiChat.divfrei.css("height",FreiChat.height);
    
    $('#file-upload-status').val('no image selected yet!');

    $('#file_input_upload').change(function(){
        var filename = $(this).val();
        filename = filename.replace(/^.*(\\|\/|\:)/, '');
        $('#file-upload-status').val(filename).show();
        FreiChat.allow_upload = true;
    });
    
    $('#file-upload').click(function(){
        $('#file_input_upload').click();
    })
    
    $('#help').click(function(){
        window.open("http://www.youtube.com/watch?v=wPCbg3ZYcCQ");
        return false;
    });



    /*if(sessionStorage.theme_mode != 'image') {
    //$('#save_style_changes').show();
    }else{
        $('#save_style_changes').hide();
    }*/
    
    $('#save_style_changes').click(function(){
        FreiChat.save_style_changes();
    });
    
    $('#add_new_style').click(function(){
        $('#property_add_style').val('');
        $('#value_add_style').val('');
        $('#add_new_style_content').show();
    });
    
    
    $('#style_rules').append('<div id="add_new_style_content" class="add_new_style_content"><span class="saveas_theme_font style_theme_font">property:</span><input class="input_add_style" id="property_add_style" type="text"/> <br/><span class="saveas_theme_font style_theme_font"> value:</span><input class="input_add_style" id="value_add_style" type="text"/> <div><span id="add_style_button">add style</span><span id="cancel_style_button">cancel</span></div></div>');
    $('#add_style_button').button().click(function(){
        FreiChat.add_new_style();
    });
    $('#cancel_style_button').button().click(function(){
        $('#add_new_style_content').hide();
    });
    $('.ui-button-text').css('font-size','10px');
    $('#add_new_style_content').hide();
    
    FreiChat.get_css_array(); //Build the css array by parsing css.php
        
    $('#notification').hide();
    //FreiChat.notify('Click image to replace ');

    //--------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------
    $('#save_theme').click(function(){
        FreiChat.save_theme();
    });
    //--------------------------------------------------------------------------------
    $('#restore').click(function(){
        FreiChat.restore_defaults(); 
    });

    
    FreiChat.add_users();
    FreiChat.show_hints();


    $("#freichathtml").click(function(event){
        
        var el = event.target;


        //if(FreiChat.disable_doc_click == true) {
        //   return;
        //}

        if(sessionStorage.theme_mode == 'image') {
            //replace image
            var config = get_config(el);

            if(config != false)
                FreiChat.replace_image(config);
            
        }else{
            
            FreiChat.edit_css(el);
        //edit styles
        //$('#save_style_changes').show();
        }
    })

    document.addEventListener('mousemove',
        function()
        {
            if(sessionStorage.theme_mode != 'image') {
            if (prevElement!= null) {
                prevElement.classList.remove("mouseOn");
            }
            }
        },true);


    prevElement = null;
    document.getElementById("freichathtml").addEventListener('mousemove',
        function(e){
            
            if(sessionStorage.theme_mode != 'image') {
            var elem = e.target || e.srcElement;
            if(elem.classList.contains("label")) return;

            if (prevElement!= null) {
                prevElement.classList.remove("mouseOn");
            }
            elem.classList.add("mouseOn");
        
            if(elem != null)
                prevElement = elem;
            }
        },true);


    function get_config(el) {
        
        //parameters: variable(definitions.js) , id(to select img) , type , [ php variable(argument.php) , js variable(defintions.js) ]

        var src = el.src;
        var cls = el.className;
        var id = el.id;

        var id_c = id;
        if(id_c == ''){
            id_c = cls;
        }

        if(!$('#'+id_c).is("img")) {
            FreiChat.notify('the clicked element is not an image');
            return false;
        }



        var img = src.substring(src.lastIndexOf('/')+ 1);
        var arr = img.split(".");
        
        var img_name = arr[0]; //1st 
        var img_ext  = arr[1];
        
        
        return {
            name: img_name,
            id: id,
            cls: cls,
            type: 'img',
            ext: img_ext
        }
    }
    
});     


window.onbeforeunload = function() {
    
    
    if(FreiChat.unsaved_changes == true) {
        return 'you will loose any unsaved changes'
    }else
       
        return;
    
}