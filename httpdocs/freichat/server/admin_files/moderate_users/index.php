<?php

$users_per_page = 5;
$search_users_string = 'NULLED';
$s = '';

if(isset($_POST['users_per_page']) && $_POST['users_per_page']!= '') {
    $users_per_page = (int)$_POST['users_per_page'];
}
if(isset($_POST['user_search']) && $_POST['user_search'] != '') {
    $s = $_POST['user_search'];
    $search_users_string = $_POST['user_search']; 
}

require_once '../arg.php';
require_once 'admin_files/moderate_users/drivers/' . $driver . '.php';

$conn = new FreiChat();
$conn->init_vars();
$mod = new $driver();
$mod->db_prefix = $db_prefix;
$mod->host = $host;
$mod->client_db_name = $client_db_name;
$mod->username = $username;
$mod->password = $password;
$mod->row_username = $row_username;
$mod->row_userid = $row_userid;
$mod->usertable = $usertable;
$mod->db = $conn->db;
$mod->set_db_data();


$url = $conn->url;

$no_of_users = $mod->get_no_of_users($s);
$users = $mod->get_users(0,$users_per_page,$s); //initial load
$no_of_ret_users = $mod->no_of_ret_users;
$usernames = array();
$no_of_messages = array();
$ids = array();
$banned_ids = array();

foreach ($users as $user) {
    $user['username'] = str_replace("'","",$user['username']);
    $usernames[] = $user['username'];
    $ids[] = $user['id'];
    $banned_ids[] = $user['user_id'];
    $no_of_messages[] = $user['no_of_messages'];
}
$usernames = json_encode($usernames);
$no_of_messages = json_encode($no_of_messages);
$ids = json_encode($ids);
$banned_ids = json_encode($banned_ids);
?>


<link rel="stylesheet" type="text/css" href="admin_files/moderate_users/table_style.css" />
<link rel="stylesheet" type="text/css" href="admin_files/moderate_users/paginator.css" />

<script type='text/javascript' src='admin_files/moderate_users/jquery.jqpagination.min.js'></script>



<script type='text/javascript'>
    typingtimer = [];
    users_per_page = '<?php echo $users_per_page; ?>';
    //-------------------------------------------------------------------------------    
    function create_td(username,id,no_of_messages,banned) { 
        
console.log(no_of_messages);        
        if(no_of_messages == null) {
            no_of_messages = 0;
        }
        
        return '<tr><td>'+id+'</td><td>'+username+'</td><td>'+no_of_messages+'</td><td style="text-align:center"><span id="options_'+id+'"><span id="ban_'+id+'">ban</span><span style="color:red" id="banstatus_'+id+'">'+banned+'</span></td></tr>';
    }
    
    //-------------------------------------------------------------------------------    
    function todo_user(id) {
        
        var todo = $('#ban_'+id).data("todo");
        
        if(todo == "ban") ban_user(id);
        else unban_user(id);
    }
    //-------------------------------------------------------------------------------    
    function ban_user(id){
        var url = "<?php echo $url; ?>";
        url = url.replace('admin.php','');
        
        //url: ~server/ 
        
        var opt = confirm('Do you really want to ban this user ?');      
        if(opt != true)return;
        
        $.ajax({
            type: "POST",
            url: "admin_files/moderate_users/user_mod.php?mode=ban",
            data: { id:id },
            success: function(data) {  
                $('#ban_'+id+" span").text('unban')//.button();
                $('#ban_'+id).data("todo","unban");
                if(typeof typingtimer != "undefined")clearInterval(typingtimer[id]);
                $('#banstatus_'+id).teletype({
                    animDelay: 150,  // the bigger the number the slower the typing
                    text: '  banned',
                    id:id
                });
            }
           
            
        });
    }
    //-------------------------------------------------------------------------------    
    function unban_user(id){
        var url = "<?php echo $url; ?>";
        url = url.replace('admin.php','');
        
        //url: ~server/ 
        
        $.ajax({
            type: "POST",
            url: "admin_files/moderate_users/user_mod.php?mode=unban",
            data: { id:id },
            success: function(data) {  
                
                $('#ban_'+id+" span").text('ban')//.button();
                $('#ban_'+id).data("todo","ban");
                
                if(typeof typingtimer != "undefined")clearInterval(typingtimer[id]);
                $('#banstatus_'+id).revdel({
                    animDelay: 150,  // the bigger the number the slower the typing
                    text: ' banned',
                    id:id
                });
            }
            
        });
    }
    
    //-------------------------------------------------------------------------------      
    Array.prototype.chunk = function ( n ) {
        if ( !this.length ) {
            return [];
        }
        return [ this.slice( 0, n ) ].concat( this.slice(n).chunk(n) );
    };
    //-------------------------------------------------------------------------------        
    $.fn.teletype = function(opts){
        var $this = this,
        defaults = {
            animDelay: 150
        },
        settings = $.extend(defaults, opts);
        var str = settings.text;var progress=0;var id = settings.id;
        typingtimer[id] = setInterval(function() {
            $this.text(str.substring(0, progress++));
            if (progress > str.length) clearInterval(typingtimer[id]);
        }, 100);
        
    };
    //-------------------------------------------------------------------------------    
    $.fn.revdel = function(opts){
        var $this = this,
        defaults = {
            animDelay: 150
        },
        settings = $.extend(defaults, opts);
        var str = settings.text;
        var length=str.length;
        var progress = 1;
        var id = settings.id;
        typingtimer[id] = setInterval(function() {
            $this.text(str.substring(0, length-progress));progress++;
            if (progress > length) clearInterval(typingtimer[id]);
        }, 100);
        
    };
    
    
    //-------------------------------------------------------------------------------    
    function paginate_records(page) {
        var i=0;
              
        var users_per_page = <?php echo $users_per_page; ?>;
        var lim_from = page*users_per_page;
        var lim_records = users_per_page;
        // get next set of records
        $.ajax({
            type: "POST",
            url: "admin_files/moderate_users/user_mod.php?mode=get_data",
            dataType: 'json',
            data: {
                lim_from : lim_from,
                lim_records : lim_records,
                search_string : '<?php echo $s; ?>'
            },
            success: function(data) {  
                var i;                      
                var users = [];
                var no_of_messages = [];
                var ids = [];
                var banned_ids = [];
                        
                FC.no_of_ret_users = data.length;
                
                for(i=0;i<FC.no_of_ret_users;i++){
                    users[i] = data[i].username;
                    ids[i] = data[i].id;
                    no_of_messages[i] = data[i].no_of_messages;
                    banned_ids[i] = data[i].user_id;
                }                  

                FC.users = users;
                FC.no_of_messages = no_of_messages;
                FC.ids = ids;
                FC.banned_ids = banned_ids;
                        search_records(page);

            }
        });
    }  
    //-------------------------------------------------------------------------------    
    function populate_page(page,users,no_of_messages,ids,banned_ids,no_of_ret_users) {
        

        

        if(typeof users == "undefined")
            var users = FC.users;
        if(typeof no_of_messages == "undefined")
            var no_of_messages = FC.no_of_messages;
        if(typeof ids == "undefined")
            var ids = FC.ids;
        if(typeof banned_ids == "undefined")
            var banned_ids = FC.banned_ids;
        if(typeof page == "undefined")
            var page = 0;
        
        var no_of_ret_users = FC.no_of_ret_users;
                
        var no_of_users=<?php echo $no_of_users; ?>;//users.chunk(FC.records);
        var users_per_page = <?php echo $users_per_page; ?>;

        

        var pages = Math.ceil(no_of_users/users_per_page);
        var records = users_per_page; // no of users that will be displayed
        if(no_of_ret_users < users_per_page)records = no_of_ret_users;
        
        //console.log(users)

        $('#table_cl').html('').html(FC.m_str);
        var str='';
        var j=0;
        var banned = ' ';
        var lenx;
        
        if(pages == 0) {
            $('#table_cl').html('<span class="no_records">No records to display</span>');
            $('#page_nav_input').attr('data-max-page',pages).val('Page '+(pages)+' of '+pages);
            $('#pagination').find('input').data('max-page',pages);
            var ele = $('#pagination').find('.first, .previous');
            if(!ele.hasClass('disabled')){
                ele.addClass('disabled');
            }
            return 'EXIT';
        }
        
        /*if(typeof user_pages[page].length != "undefined"){
            lenx = user_pages[page].length;
        }*/
        
        for(i=0;i<records;i++){      
            if(ids[i] == banned_ids[i]) banned = ' banned';
   
            str+= create_td(users[i],ids[i],no_of_messages[i],banned);
            banned = ' ';   
        }

        FC.max_page = pages;
        FC.currpage = page+1;

        
        $('#page_nav_input').attr('data-max-page',pages).val('Page '+(page+1)+' of '+FC.max_page);
        $('#pagination').find('input').data('max-page',pages);
        if((page+1) == FC.max_page){
            $('#pagination').find('.next, .last').addClass('disabled');
        }else{
            var ele = $('#pagination').find('.next, .last');
            if(ele.hasClass('disabled')){
                ele.removeClass('disabled');
            }
        }
        
        if((page+1) == 1){
            var ele = $('#pagination').find('.first, .previous');
            if(!ele.hasClass('disabled')){
                ele.addClass('disabled');
            }
        }
        // $('#pagination .next')
        
        

        
        $('#table_cl').append(str);
        var id;
        for(i=0;i<records;i++) {
            id = ids[i];         
            if(ids[i] == banned_ids[i]){
                $('#ban_'+id).data("todo","unban");
                $('#ban_'+id).html('unban').button().mousedown((function(i){
                    return function() { todo_user(i);   }
                })(id));
            }else{
                $('#ban_'+id).data("todo","ban");
                $('#ban_'+id).button().mousedown((function(i){
                    return function() {  todo_user(i);   }
                })(id));
            }
        }
        
    }
    //-------------------------------------------------------------------------------
    function search_records(page) {

        //if(search == "NULLED"){
            populate_page(page);
          //  return;
        //}
        /*        
        var len = FC.users.length;
        var i=0;var u=0;
        var users = [];
        var no_of_messages = [];
        var ids = [];
        var banned_ids = [];
                
        for(i=0;i<len;i++) {
            if(FC.users[i].indexOf(search) != -1) {
                users[u] = FC.users[i];//alert(userdata[i])
                no_of_messages[u] = FC.no_of_messages[i];
                ids[u] = FC.ids[i];
                banned_ids[u] = FC.banned_ids[i];
                u++;
            }
        }
        //console.log(users); 
        populate_page(page,users,no_of_messages,ids,banned_ids);       
        */

    }
    //-------------------------------------------------------------------------------    
    $(document).ready(function(){


        
        
        var users = <?php echo $usernames; ?>;
        var no_of_messages = <?php echo $no_of_messages; ?>;
        var ids = <?php echo $ids; ?>;
        var banned_ids = <?php echo $banned_ids; ?>;

        var records = users_per_page;
        var m_str = '<tr><th>id</th><th>username</th><th>no. of messages</th><th>options</th></tr>';

        
        FC = {
            no_of_messages:no_of_messages,
            ids:ids,
            banned_ids:banned_ids,
            records:records,
            m_str:m_str,
            users:users,
            no_of_ret_users: '<?php echo $no_of_ret_users; ?>'
        };
            
        var ret = populate_page(0);
        
        if(ret == "EXIT")return;
        
        $('#user_search').val('<?php echo $s; ?>');
        $('#users_per_page').val("<?php echo $users_per_page; ?>");
        
        $('#pagination').jqPagination({
            paged: function(page) {
                page--; //array starts from 0
                paginate_records(page);
            }
            
        });
        
    });
    
    


</script>

<table class="table_cls" id="table_cl" cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
</table>

<div id="pag">
    <div style="margin-bottom: 14px" id="pagination" class="pagination" >
        <a href="#" class="first" data-action="first">&laquo;</a>
        <a href="#" class="previous" data-action="previous">&lsaquo;</a>
        <input id="page_nav_input" type="text" readonly="readonly" data-max-page="'+max_page+'" />
        <a href="#" class="next" data-action="next">&rsaquo;</a>
        <a href="#" class="last" data-action="last">&raquo;</a></div>
</div>


<div class="form_div" style="float:left">
<form action="admin.php?freiload=moderate_users" method="POST">

    <table>
        <tr>
            <td><span>search: </span></td>
            <td><img id="searchimg" src="admin_files/moderate_users/images/search.jpg" />
            <input name="user_search" type="search" id="user_search" placeholder="search users"/></td>                
        </tr>
        
        <tr>
            <td><span>no of users per page: </span></td>
            <td><input name="users_per_page" type="text" id="users_per_page" placeholder="5"/></td>
        </tr>
        
    </table>


<input style="float:right" type="submit" value="submit" />
</form>
</div>