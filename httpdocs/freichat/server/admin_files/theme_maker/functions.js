var FreiChat = {
    
    anim_inprogress:false,
    mesg:'',
    anim_notify_progress:false,
    notify_disappear_time:5000,
    allow_upload:false,
    css_array:[],
    disable_doc_click:false,
    unsaved_changes: false
}      
//alert(freidefines.GEN.url);
freidefines.GEN.url = freidefines.GEN.url.replace("server/admin.php","");  

FreiChat.make_url = function(name) {
    
    var url = freidefines.GEN.url;  
    var path  = url+"client/themes/"+freidefines.GEN.curr_theme+"/"+name;
    return  path;
}

//-------------------------------------------------------------------------------------
FreiChat.check_indexes = function(pre,identity,tag_name){ 
    
    var t_index = '';
    var index = '';
    identity = pre+$.trim(identity);
    
    if(identity != ''){
        t_index = identity+" "+tag_name.toLowerCase();
        if(typeof FreiChat.css_array[t_index] != "undefined"){
            index = t_index;
        }else{
            if(typeof FreiChat.css_array[identity] != "undefined"){
                index = identity;
            }
        }
    }
    return index;
}

//-------------------------------------------------------------------------------------
FreiChat.check_parents = function(el){

    var array = [];
    var jq_el = $(el); //for cross-browser compatibility
    var tag_name = jq_el.prop("tagName");
    
    jq_el = jq_el.parent(); //start with its parent element

    var cls,id;

    var index = "";
    do {

        cls = jq_el.attr("class");
        id = jq_el.attr("id");


        //check for id and class with subs with class as first preference with subs
        if(typeof cls != "undefined" && cls != "")
            index = FreiChat.check_indexes(".",cls,tag_name);
        
        if(index == "" && typeof id != "undefined" && id != "")            
            index = FreiChat.check_indexes("#",id,tag_name);
    
        jq_el = jq_el.parent(); //loop through parent

        if(index != "") break;
    
    }while(jq_el.attr("id") != "freichathtml" && jq_el.prop("tagName") != "BODY");
 

    if(index != "") {
        array = FreiChat.css_array[index];
        FreiChat.selected_class = index;
    }
 
    return array;
}
//-------------------------------------------------------------------------------------

FreiChat.edit_css = function(el){

    el.classList.remove("mouseOn");

    var cls = el.className;
    var id = el.id;



    var cls_sel = "."+cls;
    
    /*        if(class_sel == "undefined"){
            alert("class_sel is undefined");
            return;
        }
 */

    if(cls == ''){
        cls = id;
        cls_sel = "#"+id;
    }
                        
    id = cls_sel;
    
    if(cls_sel != '' || cls_sel != null)
        FreiChat.selected_class = cls_sel;
    var arr = FreiChat.css_array;
    var k_arr;

    if(typeof arr[id] != "undefined") {
        k_arr = arr[id];
    }
    else{
        k_arr = FreiChat.check_parents(el);
    }
  
    var property;
    var str='<table id ="table_add_style" >';
    //$('#style_rules_content').html('');
  
  
    for(property in k_arr) {
    
        var index = property.indexOf('_DUPLICATE_');
        var value = k_arr[property]; 
        var __property = property;
            
        if(index != -1){
            __property = property.substring(0,index);
        }      
        //alert();
        //console.log()
        str += '<tr  id="tr_style_'+property+'"><td><span class="font_style_rules" >'+__property+':</span></td><td><input class="input_style_rules" id="input_style_'+property+'" type="text" value="'+value+'" /></td><td border="none"><span id="close_style_'+property+'" class="close_style_rules"><a title="delete style">X</a></span></td></tr>';
    
    }
    $('#style_rules_content').html(str+"</table>");

    for(property in k_arr) {
        //if(k_arr[property].indexOf('<\?php') != -1) continue;          
        (function(ppty){
            var value = k_arr[ppty]; 
            $('#input_style_'+property).bind('textchange', function (event, previousText) {
                FreiChat.apply_css('#input_style_'+ppty,ppty,id,previousText)     
            }).click(function(){
                var el = document.getElementById($(this).attr("id"));
                el.select();
            });
            
            /*if(isNaN(value) === false) {
                value = value+"px";
            }*/
             
            if(value.indexOf("em") != -1 || value.indexOf("%") != -1 || value.indexOf("px") != -1 ){
                //bind keydown events
                $('#input_style_'+property).on("keydown",function(e){
                    
                    if(e.which == 38 || e.which == 40) {
                        var me = $jn(this);
                        me.focus();
                    
                        var vs = me.val().split(" ");
                        var el = document.getElementById(me.attr("id"));
                    
                        var start = el.selectionStart;
                        var len = 0;
                        var el_no=0;
                        for(var i =0; i<vs.length; i++) {
                            len = len+vs[i].length+1;
                            //console.log(len);
                            if(start<len) {
                                len--;
                                el_no = i;
                                break;
                            }
                        }
                    
                    
                        //highlight the text that will be inc/dec
                        ///console.log(len);
                        //console.log(vs[el_no]);
                        var end_highlight = len,
                        start_highlight = len-vs[el_no].length;
                    

                    
                    
                        var unit;
                        var number = me.val().substring(start_highlight, end_highlight);
                        if(number.indexOf("em") != -1) {
                            unit = "em";
                        }else if(number.indexOf("%") != -1){
                            unit = "%";
                        }else{
                            unit = "px";
                        }
                        
                        
                        number = parseInt(number);
                        var step = 1;
                        
                        if (e.shiftKey === false) step = 1;
                        else step = 10;

                        if (e.which === 38) number += step;
                        else if (e.which === 40) number -= step;
                    
                        //replace text -> inc/dec value
                        me.val(me.val().substring(0, start_highlight) + number+unit + me.val().substring(end_highlight, me.val().length));
                        e.preventDefault();
                                            
                        el.selectionStart = start_highlight;
                        //console.log(start_highlight);
                        el.selectionEnd = el.value.indexOf(unit,start_highlight) + unit.length;
                    }
                    
                //check if selection is in input
                
                });
            }
            $('#tr_style_'+property).mouseover(function(){
                $('#close_style_'+ppty).show();
            }).mouseout(function(){
                $('#close_style_'+ppty).hide();
            });
    
            $('#close_style_'+property).click(function(){
                FreiChat.delete_style(ppty);
            });
    
        })(property);
    }    
  
  
    $('#style_rules').dialog('open');
    if(FreiChat.is_obj_empty(k_arr) == true) {
        $('#table_add_style').html("No styles to display!");
    }
 
}
//-------------------------------------------------------------------------------------
FreiChat.is_obj_empty = function(object) {
    var i;
    for(i in object) {
        if (object.hasOwnProperty(i))
            return false;
    }
    return true;
}
//-------------------------------------------------------------------------------------
FreiChat.delete_style = function(property) {
    $('#tr_style_'+property).css('display','none');
    delete FreiChat.css_array[FreiChat.selected_class][property];//alert(property);
    $(FreiChat.selected_class).css(property,'inherit');
}
//-------------------------------------------------------------------------------------
FreiChat.add_new_style = function() {
    
    var property =     $.trim($('#property_add_style').val());
    var value    =     $.trim($('#value_add_style').val());
       
    if(typeof FreiChat.css_array[FreiChat.selected_class] == "undefined"){
        FreiChat.css_array[FreiChat.selected_class] = {}
    }   
       
    if(property == '' || value == ''){
        FreiChat.notify('you cannot leave the fields empty');
        return;
    }
    else if(typeof FreiChat.css_array[FreiChat.selected_class][property] != "undefined"){        
        FreiChat.notify('property already exists');
        return;
    }


    var str = '<tr id="tr_style_'+property+'"><td><span class="font_style_rules" >'+property+':</span></td><td><input class="input_style_rules" id="input_style_'+property+'" type="text" value="'+value+'" /></td><td border="none"><span id="close_style_'+property+'" class="close_style_rules"><a title="delete style">X</a></span></td></tr>';

    if($("#table_add_style").html() == "No styles to display!"){
        //first style
        $("#table_add_style").html(str);
    }else{    
        $('#table_add_style  tr:last').after(str);
    }
    
    $('#input_style_'+property).bind('textchange', function (event, previousText) {
        FreiChat.apply_css('#input_style_'+property,property,FreiChat.selected_class,previousText)     
    });
    $('#tr_style_'+property).mouseover(function(){
        $('#close_style_'+property).show();
    }).mouseout(function(){
        $('#close_style_'+property).hide();
    });
    
    $('#close_style_'+property).click(function(){
        FreiChat.delete_style(property);
    });
    
    
    
    FreiChat.unsaved_changes = true;
    FreiChat.css_array[FreiChat.selected_class][property] = value;
    $('#add_new_style_content').hide();
    $(FreiChat.selected_class).css(property,value);
}
//-------------------------------------------------------------------------------------
FreiChat.apply_css = function(div,ppty,css_div,oldval) {
    var val = $(div).val();
    if(oldval == $.trim(val))return;
    
    if(val == ''){
        val = 'none';
    }
    
    $(css_div).css(ppty,val);
    FreiChat.unsaved_changes = true;
    FreiChat.css_array[FreiChat.selected_class][ppty] = val;
}
//-------------------------------------------------------------------------------------
FreiChat.replace_image = function(config){
    
    $('#upload_div').dialog('open').data("data",{
        "fullname":config.name+"."+config.ext,
        "name": config.name,
        "id":config.id,
        "type":config.type
    });

    FreiChat.disable_doc_click = true;

}

FreiChat.file_upload = function(){
             
    if(FreiChat.allow_upload == false){
        FreiChat.notify('Please select a file to upload!');
        return;
    }         
             
    var fileInput = document.getElementById('file_input_upload');
    var file = fileInput.files[0];        
    
    // $('#progress_upload_file').html('<div>'+file.name+'&nbsp;<progress id="rep_prg" value=0 max=100></progress><span id="rep_upload_status"></span></div>');
        
    //var progress=$('#rep_prg');
    //var status = $("#rep_upload_status");
    var xhr = new XMLHttpRequest();
    /* xhr.upload.addEventListener('progress', function(evt){

        var percent = evt.loaded/evt.total*100;
        $(progress.selector).val(percent);

    }, false);*/
        
    var config = $('#upload_div').data("data");



    xhr.open('POST', 'admin_files/theme_maker/upload.php', true);                       
    xhr.setRequestHeader("Cache-Control", "no-cache");  
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");  
    xhr.setRequestHeader("X-File-Name", file.name);  
    xhr.setRequestHeader("X-File-Size", file.size);  
    xhr.setRequestHeader("X-File-Type", file.type);  
    xhr.setRequestHeader("X-ORIGINAL-FILE-NAME", config.fullname);
    xhr.setRequestHeader("X-TYPE",config.type);
    xhr.setRequestHeader("X-VARIABLE-PHP",config.name);
    xhr.setRequestHeader("Content-Type", "application/octet-stream");  
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4)  {
            return;
        }
        
        if(xhr.responseText == 'exceed') {
            FreiChat.notify('file size has exceeded the allowed limit');
        }else if (xhr.responseText == 'type') {
            FreiChat.notify('invalid file type');
        }
        else{
        
            var imgid = config.id;
            
            var type = config.type;
            var path = freidefines.GEN.url;
            path = path+"client/themes/";
            
            var theme = freidefines.GEN.curr_theme;
            path = path+theme+"/";
            
            //var newimg = xhr.responseText; remains static
            //freidefines[data.variable_js] = newimg;
            //  alert(data.js_variable + "  " + freidefines[data.js_variable]  + " = " + newimg);
            
            
            FreiChat.unsaved_changes = true;
            if(type == 'img'){
                FreiChat.unsaved_changes = true;
                $('#'+imgid).attr('src',path+"images/"+xhr.responseText);
            /*if(imgid != imgid2) {
                    $('#'+imgid2).attr('src',path+newimg);
                }*/
            }
        /*else{ no bg-images allowed '1=1;--
                $('#'+imgid).css('background-image',"url("+path+newimg+")");
                if(imgid != imgid2) {
                    $('#'+imgid2).css('background-image',"url("+path+newimg+")");           
                }
            }*/
        }   
        //$('#upload_div').hide();
        $('#file-upload-status').val('no image selected yet!');
        FreiChat.allow_upload = false;
      
    };
    xhr.send(file);

}
//-------------------------------------------------------------------------------------
/*FreiChat.switch_visibility = function(current) {
    var ids = ['themelist_div','new_theme_div','rename_theme'];
    var i=0;
    $('#'+current).slideToggle(); 
    
    for(i=0;i<ids.length;i++){
        if(ids[i]  != current){
            $('#'+ids[i]).hide();
        }
    }    
}*/
//-------------------------------------------------------------------------------------

FreiChat.notify = function(mesg) {
    if(FreiChat.anim_notify_progress == true && FreiChat.mesg == mesg)return;
    
    if(FreiChat.anim_notify_progress == true && FreiChat.mesg != mesg){
        $('#notification').html(mesg);
        FreiChat.mesg = mesg;
        FreiChat.notify_disappear_time = FreiChat.notify_disappear_time + 3000;
        return;
    }  
    
    FreiChat.anim_notify_progress = true;
    $('#notification').html(mesg).center().slideDown().css('top','0px').click(function(){
        $('#notification').slideUp();
    }).delay(FreiChat.notify_disappear_time).fadeOut(function(){
        FreiChat.anim_notify_progress=false;
    });   
    FreiChat.mesg = mesg;
}
//-------------------------------------------------------------------------------------

FreiChat.restore_defaults = function() {
    var value = confirm('This will undo all your work to your last save , \nAre you sure ?');
    if(value == true){
        //        $.get("admin_files/theme_maker/theme_maker.php?action=restore",function(data){
        FreiChat.unsaved_changes = false; //to prevent popup
        window.location.reload(true);
    //      });
        
    }
}
//-------------------------------------------------------------------------------------

FreiChat.save_theme = function() {
    
    var value = confirm('Once saved , your changes will become permanent , \nAre you sure ?'); 
    
    FreiChat.save_style_changes();
    
    if(value == true){
        $.getJSON("admin_files/theme_maker/theme_maker.php?action=save",function(data) {
            if(data === 'success') {
                FreiChat.unsaved_changes = false;
                FreiChat.notify('Current changes have been saved');
            }else{
                FreiChat.notify('Could not save changes...');
            }
           
        },'json');    
    }
}
//-------------------------------------------------------------------------------------
FreiChat.switch_button = function(mode_key,mode_value,first) {
    
    
    if(sessionStorage[mode_key] == mode_value && typeof first == "undefined"){
        return;
    }
    
    sessionStorage[mode_key] = mode_value;
    $('#'+mode_value).prop('checked', true);     


    if(mode_value == "parameters") {
        FreiChat.get_css_array();
        $('#upload_div').dialog('close');
    }else if(mode_value == 'image') {
        $( "#style_rules" ).dialog('close');
    }else if(mode_value == 'chat'){
        $('#chat_switch_div').show('slow');
        $('#chatroom_switch_div').hide();
        $('#upload_div').dialog('close');
        $( "#style_rules" ).dialog('close');
    }else if(mode_value == 'chatroom') {
        $('#chat_switch_div').hide();
        $('#chatroom_switch_div').show('slow');
        $('#upload_div').dialog('close');
        $( "#style_rules" ).dialog('close');
    }
     
//FreiChat.get_css_array(); //update css Array 
    
}
//-------------------------------------------------------------------------------------
/*FreiChat.roll_button = function(mode,mode1,mode2,div) {
    
    if(sessionStorage[mode] == undefined) {
        sessionStorage[mode] = mode1[0];
    }

    if(sessionStorage[mode] == mode1[0]){
        if(div[1] != false)
            $('#'+div[1]).hide();         
        $('#'+div[2]).html(mode2[1]);
    }else{
        if(div[0] != false)
            $('#'+div[0]).hide()
        $('#'+div[2]).html(mode1[1]);
    }
   

    $('#'+div[2]).click(function(){
        if(FreiChat.anim_inprogress == false || div[1] == false){           
            if(div[1] !=false)
                FreiChat.anim_inprogress = true; 
            if(sessionStorage[mode] == mode1[0]){
                sessionStorage[mode] = mode2[0];           
                if(div[1] != false){   
                    $('#'+div[0]).hide();
                    $('#'+div[1]).show('slow',function(){
                        FreiChat.anim_inprogress = false;
                    }); 
                    FreiChat.get_css_array();
                }else{
                    $('#save_style_changes').show();
                }
                $('#'+div[2]).html(mode1[1]);        
            }else{
                sessionStorage[mode] = mode1[0];    
                if(div[1] != false) {   
                    $('#'+div[1]).hide();             
                    $('#'+div[0]).show('slow',function(){
                        FreiChat.anim_inprogress = false;
                    });
                    FreiChat.get_css_array();
                }else{
                    $('#save_style_changes').hide();
                }
                $('#'+div[2]).html(mode2[1]);               
            }
        }
    }); 

}*/
//-------------------------------------------------------------------------------------
FreiChat.get_css_array = function(){
    //alert("k");
    var filename;
    if(sessionStorage.freichat_switch == 'chat') {
        filename = 'styles.css';
    }else
    {
        filename = 'styles.css';
    }
    
    $.getJSON("admin_files/theme_maker/theme_maker.php?action=get_css_array",
    {
        file:filename
    },function(data){
        console.log(data);
        FreiChat.css_array = data;
    },'json');
  
}
//-------------------------------------------------------------------------------------
FreiChat.save_style_changes = function(){

    var filename;
    if(sessionStorage.freichat_switch == 'chat') {
        filename = 'styles.css';
    }else
    {
        filename = 'styles.css';
    }


    $.post('admin_files/theme_maker/theme_maker.php?action=save_style_changes',
    {
        css_array : FreiChat.css_array,
        file:filename  
    },function(data){
        //console.log(data);
        });
}
/*------------------------------------------------------------------------------------*/
FreiChat.show_tab_content = function(el) {
    
    var el_o,el_li,el_li_o;
    
    if(el == 'rooms'){
        el = $jn('#frei_roompanel');
        el_o = $jn('#frei_userpanel');
        el_li = $jn('#frei_roompanel_li');
        el_li_o = $jn('#frei_userpanel_li');
    }else{
        el = $jn('#frei_userpanel');
        el_o = $jn('#frei_roompanel');
        el_li = $jn('#frei_userpanel_li');
        el_li_o = $jn('#frei_roompanel_li');
    }
    
    
    if(el.is(":visible")){}else{
        el_o.hide();
        el.show('clip');
        el_li.addClass('frei_chatroom_tabs_selected');
        el_li_o.removeClass('frei_chatroom_tabs_selected');
    }
    
};
/*------------------------------------------------------------------------------------*/
FreiChat.add_users = function() {
        
    var names = ["Sharon Davis","Celestine Vega","Lawrence Sebring","Beatrice Vanmeter","Corey Fox","Ruth Struck"];
    var str = "";
        
    var i=0;
    for(i=0;i<names.length;i++)        
        str += "<div id='freichat_user_"+i+"' title='I am available' class='freichat_userlist'>\n\
                        <span>\n\
                            <span style='display:block' class='freichat_userscontentavatar'>\n\
                        <img src='http://www.gravatar.com/avatar/"+md5(names[i])+"?s=24&amp;d=wavatar' class='freichat_userscontentavatarimage' alt='avatar'></span>\n\
                        </span>\n\
                        <span class='freichat_userscontentname'>"+names[i]+"</span>\n\
                        <span>&nbsp;<img class='freichat_userscontentstatus'  src='http://localhost/j3/freichat/client/themes/basic/images/onlineimg.png' height='12' width='12' alt='status'></span>\n\
                    </div>"


          
    var height;           
    $('#frei').html(str);
    height = parseInt($('#freichat_user_0').height()+1)*(i);                       
    $("#frei").css("height",height); 
    $('#frei_user_count').html(i);

}

/*------------------------------------------------------------------------------------*/
FreiChat.show_hints = function() {
    
    var hints = 
    [
    "change the theme under general settings for your changes to reflect in your website",
    "press &uarr; , &darr; to increment or decrement values by 1",
    "press shift+&uarr; , shift+&darr; to increment or decrement values by 10",
    "all your themes are stored in freichat/client/themes directory",
    "you can directly edit .LESS files under theme directory and compile them",
    "if changes do not reflect check permissions of freichat/client/themes directory",
    "you can press esc to close dialogs",
    "all icons are stored in freichat/client/themes/"+freidefines.GEN.curr_theme+"/icons directory"
    ]
    
    var max=hints.length-1,min=0;
    var theme_hint = $("#theme_hint");
    
    theme_hint.html("WYSIWYG theme maker V2.5");
    
    setInterval(function(){
        random_no = Math.floor(Math.random() * (max - min + 1)) + min;
        hint = hints[random_no];
        theme_hint.html(hint);
        
    },7000);
};