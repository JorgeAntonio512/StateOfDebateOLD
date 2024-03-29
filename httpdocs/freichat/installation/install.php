<?php
session_start();


//security check
if (!isset($_SESSION['FREIX']) || $_SESSION['FREIX'] != 'authenticated' || !isset($_POST['host'])) {
    header("Location:index.php");
    exit;
}

if (!is_writable("../hardcode.php")) {
//die("arg.php is not writable!<br/>Go back and change ~/freichat/arg.php permisssions");
    $_SESSION['error'] = 'hardcode.php is not writable!<br/>Go back and change ~/freichat/arg.php permisssions';
    header('Location: error.php');
}

class Install {

    public function __construct() {
        $this->installed = 'true';
        $this->path_host = str_replace("installation/install.php", "", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
        
        if($_POST['port'] == '' || $_POST['port'] == null){
            $this->port = '';
        }else{
            $this->port = 'port='.$_POST['port'].';';
        }
    }

    public function argument() {
        $filepath = "../hardcode.php";


        file_put_contents("../cache/perm/request.001", "0");


        $data = '<?php
/* Data base details */
$con = \'mysql\'; // MySQL , Oracle , SQLite , PostgreSQL
$username=\'' . $_POST["muser"] . '\'; // Database username
$password=\'' . $_POST["mpass"] . '\'; //Database password
$client_db_name=\'' . $_POST["dbname"] . '\'; //Database name
$host=\'' . $_POST["host"] . '\'; //host
$port=\''.$this->port.'\'; //optional port for some servers using different port
$driver=\'' . $_POST["driver"] . '\'; //Integration driver
$db_prefix=\'' . $_POST["dbprefix"] . '\'; //prefix used for tables in database
$uid=\'' . uniqid() . '\'; //Any random unique number

$PATH = \'' . $_POST["freichat_to_path"] . '/\'; // Use this only if you have placed the freichat folder somewhere else
$installed=' . $this->installed . '; //make it false if you want to reinstall freichat
$admin_pswd=\'' . $_POST["adminpass"] . '\'; //backend password 

$debug = false;

/* email plugin */
$smtp_username = \'\';
$smtp_password = \'\';

$force_load_jquery = \'NO\';

/* Custom driver */
$usertable=\'login\'; //specifies the name of the table in which your user information is stored.
$row_username=\'root\'; //specifies the name of the field in which the user\'s name/display name is stored.
$row_userid=\'loginid\'; //specifies the name of the field in which the user\'s id is stored (usually id or userid)
$avatar_field_name = \'avatar\';';

        file_put_contents($filepath, $data);
    }

    public function connectDB() {
        try {
            $this->db = new PDO('mysql:host=' . $_POST["host"] . ';'.$this->port.'dbname=' . $_POST["dbname"], $_POST["muser"], $_POST["mpass"]);
        } catch (PDOException $e) {
            $this->installed = 'false';
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function dropTables() {
        $this->db->query("DROP TABLE IF EXISTS `frei_chat`");
        $this->db->query("DROP TABLE IF EXISTS `frei_session`");
       // $this->db->query("DROP TABLE IF EXISTS `frei_rooms`");
        $this->db->query("DROP TABLE IF EXISTS `frei_config`"); //only for 8.0
        $this->db->query("DROP TABLE IF EXISTS `frei_video_session`");
    }

    public function createTables() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `from_name` varchar(30) NOT NULL,
  `to` int(11) NOT NULL,
  `to_name` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `time` double(15,4) NOT NULL,
  `GMT_time` bigint(20) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0',
  `room_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");


        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_session` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `time` int(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `permanent_id` int(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_mesg` varchar(100) NOT NULL,
  `guest` tinyint(3) NOT NULL,
  `in_room` int(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permanent_id` (`permanent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` text NOT NULL,
  `room_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;");

        $this->db->query("INSERT INTO `frei_rooms` (`id`, `room_name`, `room_order`) VALUES
(1, 'Innovative Talk', 3),
(2, 'Fun Talk', 1),
(3, 'Boring Talk', 0),
(4, 'General Talk', 2),
(5, 'Supreme talk', -4);");

        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_banned_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");



        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_video_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `label` int(2) NOT NULL,
  `data` varchar(3000) NOT NULL,
  `time` decimal(15,4) NOT NULL,
  `uniqueid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");


        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_smileys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;");

        $this->db->query("INSERT INTO `frei_smileys` (`id`, `symbol`, `image_name`) VALUES
(1, ':)', 'smile.png'),
(2, ':(', 'sad43501.png'),
(3, ':B', 'cool43528.png'),
(4, ':'')', 'cry43550.jpeg'),
(5, ':laugh:', 'laughing43578.png'),
(6, ':cheer:', 'cheerful43597.png'),
(7, ';)', 'wink43617.png'),
(8, ':P', 'tongue43638.png'),
(9, ':angry:', 'angry43660.png'),
(10, ':unsure:', 'unsure43683.png'),
(11, ':ohmy:', 'shocked43703.png'),
(12, ':huh:', 'wassat43723.png'),
(13, ':o', 'shocked43751.png'),
(14, ':0', 'shocked43765.png'),
(15, ':dry:', 'ermm43788.png'),
(16, ':lol:', 'grin43809.png'),
(17, ':D', 'grin43826.png'),
(18, ':silly:', 'silly43845.png'),
(19, ':woohoo:', 'w00t43867.png');");



        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) DEFAULT 'NULL',
  `cat` varchar(20) DEFAULT 'NULL',
  `subcat` varchar(20) DEFAULT 'NULL',
  `val` varchar(500) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;");


        $this->db->query("INSERT IGNORE INTO `frei_config` (`id`, `key`, `cat`, `subcat`, `val`) VALUES
(1, 'PATH', 'NULL', 'NULL', 'freichat/'),
(2, 'show_name', 'NULL', 'NULL', 'guest'),
(3, 'displayname', 'NULL', 'NULL', 'username'),
(4, 'chatspeed', 'NULL', 'NULL', '5000'),
(5, 'fxval', 'NULL', 'NULL', 'true'),
(6, 'draggable', 'NULL', 'NULL', 'enable'),
(7, 'conflict', 'NULL', 'NULL', ''),
(8, 'msgSendSpeed', 'NULL', 'NULL', '1000'),
(9, 'show_avatar', 'NULL', 'NULL', 'block'),
(10, 'debug', 'NULL', 'NULL', 'false'),
(11, 'freichat_theme', 'NULL', 'NULL', 'basic'),
(12, 'lang', 'NULL', 'NULL', 'english'),
(13, 'load', 'NULL', 'NULL', 'show'),
(14, 'time', 'NULL', 'NULL', '7'),
(15, 'JSdebug', 'NULL', 'NULL', 'false'),
(16, 'busy_timeOut', 'NULL', 'NULL', '500'),
(17, 'offline_timeOut', 'NULL', 'NULL', '1000'),
(18, 'cache', 'NULL', 'NULL', 'disabled'),
(19, 'GZIP_handler', 'NULL', 'NULL', 'ON'),
(20, 'plugins', 'file_sender', 'show', 'true'),
(21, 'plugins', 'file_sender', 'file_size', '2000'),
(22, 'plugins', 'file_sender', 'expiry', '300'),
(23, 'plugins', 'file_sender', 'valid_exts', 'jpeg,jpg,png,gif,zip'),
(24, 'plugins', 'send_conv', 'show', 'true'),
(25, 'plugins', 'send_conv', 'mailtype', 'smtp'),
(26, 'plugins', 'send_conv', 'smtp_server', 'smtp.gmail.com'),
(27, 'plugins', 'send_conv', 'smtp_port', '465'),
(28, 'plugins', 'send_conv', 'smtp_protocol', 'ssl'),
(29, 'plugins', 'send_conv', 'from_address', 'admin@codologic.com'),
(30, 'plugins', 'send_conv', 'from_name', 'FreiChat'),
(31, 'playsound', 'NULL', 'NULL', 'true'),
(32, 'ACL', 'filesend', 'user', 'allow'),
(33, 'ACL', 'filesend', 'guest', 'noallow'),
(34, 'ACL', 'chatroom', 'user', 'allow'),
(35, 'ACL', 'chatroom', 'guest', 'allow'),
(36, 'ACL', 'mail', 'user', 'allow'),
(37, 'ACL', 'mail', 'guest', 'allow'),
(38, 'ACL', 'save', 'user', 'allow'),
(39, 'ACL', 'save', 'guest', 'allow'),
(40, 'ACL', 'smiley', 'user', 'allow'),
(41, 'ACL', 'smiley', 'guest', 'allow'),
(42, 'polling', 'NULL', 'NULL', 'disabled'),
(43, 'polling_time', 'NULL', 'NULL', '30'),
(44, 'link_profile', 'NULL', 'NULL', 'disabled'),
(45, 'cache', 'NULL', 'NULL', 'enabled'),
(46, 'sef_link_profile', 'NULL', 'NULL', 'disabled'),
(47, 'plugins', 'chatroom', 'location', 'left'),
(48, 'plugins', 'chatroom', 'autoclose', 'true'),
(49, 'content_height', 'NULL', 'NULL', '200px'),
(50, 'chatbox_status', 'NULL', 'NULL', 'false'),
(51, 'BOOT', 'NULL', 'NULL', 'yes'),
(52, 'exit_for_guests', 'NULL', 'NULL', 'no'),
(53, 'plugins', 'chatroom', 'offset', '50px'),
(54, 'plugins', 'chatroom', 'label_offset', '0.8%'),
(55, 'addedoptions_visibility', 'NULL', 'NULL', 'HIDDEN'),
(56, 'ug_ids', 'NULL', 'NULL', ''),
(57, 'ACL', 'chat', 'user', 'allow'),
(58, 'ACL', 'chat', 'guest', 'allow');");        
        }

    public function init() {

        $this->connectDB();
        $this->dropTables();
        $this->createTables();
        $this->argument();

        $cname = $_POST['driver'];
        require 'integ/' . $cname . '.php';
        $cls = new $cname();
        $cls->path_host = $this->path_host;
        $output = $cls->info($this->path_host);
        $output['auto_install'] = $cls->self_install();

        return $output;
    }

}

$install = new Install();
$info = $install->init();
?>
<?php
require("header.php");
?>

<script>
    $(document).ready(function(){
        $('#content_manual').dialog({ autoOpen: false, minWidth: 800 ,title:"Manual Installation" });
    });

    function maximize()
    {
        $('#content_manual').dialog('open');
    }


</script>


<?php
$submit_url = $_SERVER['SERVER_NAME'];
?>
<!---COMMERCIAL_CODE--->




<div style="text-align: center"> 
    <span  style="font-family: 'Sonsie One', cursive;font-size: 18pt;text-align: center">
        Last step:
        <?php
        if ($info['auto_install'] == true) {
            echo '<br/><br/>' . $_SESSION['cms'] . " has been auto installed";
        } else {
            ?>
        </span>    

        <span  style="font-family: 'Sonsie One', cursive;font-size: 18pt;text-align: center">

            <?php
            if ($info['integ_url'] != '') {
                echo "Download and install the following module</span>";
                echo '<br/><br/><a href="' . $info["integ_url"] . '" class="acceptbutton" target="_blank">Download</a>';
                ?>


                <span  style="font-family: 'Sonsie One', cursive;font-size: 25pt;text-align: right">
                    <br/><br/> OR
                </span>
                <br/>
                <?php
            }
            ?>             
            <br/>


            <br/>
            <span id ="manual">
                <a style="text-align:center"class="nextbutton" href="javascript:void(0)"onmousedown="maximize()">Manual installation</a>
                <span id ="content_manual">
                    <span  style="font-family: 'Sonsie One', cursive;font-size: 8pt;text-align: center">
                        <?php
                        echo $info['addn_info'];
                        ?>
                        <br/><br/>
                        Add the following lines in your <br/>
                        <?php
                        echo $info['jsloc'];
                        echo $info['js_where'];
                        ?>
                    </span>

                    <textarea style="font-size:12pt"rows="8" cols="95" readonly="readonly"><?php echo $info['phpcode']; ?>
                        <?php echo $info['jscode']; ?>
                        <?php echo $info['csscode']; ?>
                    </textarea>

                    <br/><br/>

                </span>
            </span>

    </div>  

<?php } ?><br/><br/><div align='center'>
    <a class="adminbutton" href='../server/params.php' target="_blank">Administer</a>
</div><br/><br/>
<?php
require("footer.php");
//session_destroy();
?>