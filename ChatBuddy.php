<?php

/*
__Pocketmine Plugin__
name=ChatBuddy
description=Adds many new features to enhance your chat!
version=1.3
author=mclover152
class=ChatBuddy
apiversion=10,11,12
*/
/*
_Version Change Log_
1.0 - 
*Innitial Release.

1.1 -
*Added new /message command.
*Minor bug fixes.

1.2 -
*Added _Version Change Log_.
*Added /msg alias to /message.

1.3 -
*Added /afkon, /afkoff, and /announcements (/a)
*Organized code more.
*Now you can manage announcements with the new $a variable.

*/

class ChatBuddy implements Plugin{
private $api;

public function __construct(ServerAPI $api, $server = false){
$this->api = $api;
}

public function init(){
$this->api->console->register("message", "<message> Sends a raw message through the chat.", array($this, "message"));
$this->api->console->register("warn", "<username> <message> Warn a player if she or he is breaking the rules. NOTE - When your sending that player a message, put underscores beetween words or it will only display the first word you typed!", array($this, "warn"));
$this->api->console->register("afkon", "Tells everybody that you're afk.", array($this, "afkon"));
$this->api->console->register("afkoff", "Tells everybody that you're no longer afk.", array($this, "afkoff"));
$this->api->console->register("announcements", "Gives a list of server announcements.", array($this, "announcements"));
$this->api->ban->cmdwhitelist("afkon");
$this->api->ban->cmdwhitelist("afkoff");
$this->api->ban->cmdwhitelist("announcements");
$this->api->console->alias("msg", "message");
$this->api->console->alias("a", "announcements");
}

public function message($cmd, $args, $issuer){
$message = implode(' ', $args);
$this->api->chat->broadcast($message);
}

public function afkon($cmd, $args, $issuer){
$username = $issuer->username;
$this->api->chat->broadcast("$username is now AFK.");
}

public function afkoff($cmd, $args, $issuer){
$username = $issuer->username;
$a = "" //Put your announcements in the quotes.
$this->api->chat->sendTo(false, "$a", "$username");
}

public function warn($cmd, $args, $issuer){
$userwarn = $args[0];
$warnmessage = $args[1];
$username = $issuer->username;
$this->api->chat->sendTo(false, "You have been warned by $username : $warnmessage", "$userwarn");
}

public function __destruct(){
}
}
?>
