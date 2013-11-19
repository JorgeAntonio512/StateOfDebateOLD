<?php
if (!isset($_SESSION['phplogin'])
        || $_SESSION['phplogin'] !== true) {
    header('Location: ../administrator/index.php'); //Replace that if login.php is somewhere else
    exit;
}

class param extends FC_admin{

    public function __construct() {

    parent::__construct();
    $this->themeray = $this->langray = array();
    }

//--------------------------------------------------------------------------------------------

    public function create_config() {
        $parameters = array();
        $parameters["plugins"]["chatroom"]["location"] = $_POST['location'];
        $parameters["plugins"]["chatroom"]["autoclose"] = $_POST['autoclose'];
        $parameters["plugins"]["chatroom"]["offset"] = $_POST['offset'];
        $parameters["plugins"]["chatroom"]["label_offset"] = $_POST['label_offset'];

        return $parameters;
    }
}

$param = new param();
if (isset($_POST['location']) == true) {
    $configs = $param->create_config();
    $param->update_config($configs);
}
$param->build_vars();
?>

<script>

</script>
<div class="parameters">

    <div id="tabs">
        <ul>
            <li><a href="#client">Chatrooms customization</a></li>
            <li><a href="#more">Additional options</a></li>

        </ul>
        <!-- First TAB -->
        <div id="client">




            <ol>
                <li><b>Chat rooms list</b><br/>
                    <table class=tablex>
                        <?php
                        
                        $cr = new FC_admin();
                        
                        $result = $cr->db->query("SELECT * FROM frei_rooms");

                        echo "<th>Name</th>
<th>Order</th>
<th>Rename</th>
<th>Delete</th>
";


                        $i = 0;
                        foreach ($result as $res) {
                            echo "<tr>";

                            echo "<td id='rname$i'>" . $res['room_name']. "</td>";

                            echo "<td id='rorder$i'>" . $res['room_order'] . "</td>";

                            echo "<td><input onmousedown='editroom(" . $res['id'] . ",\"rname" . $i . "\",\"rorder" . $i . "\")' type='button' value='Edit' /></td>";

                            echo "<td><input onmousedown='confirm_delete(" . $res['id'] . ")' type='button' value='Delete' /></td>";

                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </table>
                </li>

                <br/><br/>
                <li>
                    <b>Create a new chat room</b><br/><br/>
                    <form action="admin.php?freiload=chatrooms&do=create" method="post">
                        <div style="display:inline-block"> Name:<input type="text" name="room_name" value="ChatRoomName" /></div> 
                        <div style="display:inline-block;">Order:<input style="width:150px;" type="text" name="room_order" value="1"/> </div>
                        <input id="paramsubmit2" type="submit" value="Create Room" />
                    </form>
                </li>

            </ol>


        </div>




<br/>

<div id="editroom">
    <form action="admin.php?freiload=chatrooms&do=edit" method="post">
        Name:<input type="text" name="room_name" id='eroom_name'/> 
        Order:<input type="text" name="room_order" id='eroom_order'/>
        <input type="hidden" name="room_id" id="eroom_id"/>
        <input id="paramsubmit3" type="submit" value="Save Room" />
    </form>
</div>




<div id="more">
<form name="params" action='admin.php?freiload=chatrooms' method="POST">

                <ol>
                    <li>
                        <p>Location of the chat room that will be displayed on the webpage</p>
                        <select name='location'>
                            <option value='left' <?php $param->default_param(array("plugins", "chatroom","location"), 'left'); ?>>Left</option>
                            <option value='right'  <?php $param->default_param(array("plugins", "chatroom","location"), 'right'); ?>>Right</option>
                            <option value='top'  <?php $param->default_param(array("plugins", "chatroom","location"), 'top'); ?>>Top</option>
                            <option value='bottom'  <?php $param->default_param(array("plugins", "chatroom","location"), 'bottom'); ?>>Bottom</option>

                        </select>
                        <br/><br/><hr/>
                    </li>
                    
                    <li>
                        <p>Chat room should auto close itself when mouse is clicked anywhere on the page <b>not</b> on the chatroom</p>
                        <select name='autoclose'>
                            <option value='true' <?php $param->default_param(array("plugins", "chatroom","autoclose"), 'true'); ?>>Yes</option>
                            <option value='false'  <?php $param->default_param(array("plugins", "chatroom","autoclose"), 'false'); ?>>No</option>

                        </select>
                        <br/><br/><hr/>
        
                    </li>

                    <li>
                        <p>Offset from original position of chatroom</p>
                         <input name="offset" type="text" value="<?php echo $param->default_value(array("plugins", "chatroom", "offset"), 3); ?>"/>
                        <br/><br/><hr/>
        
                    </li>

                    <li>
                        <p>Position of chatroom label along the chatroom</p>
                         <input name="label_offset" type="text" value="<?php echo $param->default_value(array("plugins", "chatroom", "label_offset"), 3); ?>"/>
                        <br/><br/><hr/>
        
                    </li>

                    
                </ol>

    <input id="paramsubmit2" type="submit" value="SUBMIT">

</from>
</div>

    </div>

</div>
