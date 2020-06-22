<?php
/** Git hook handler
 * @author Phil Morris
 */

if (write_log()) {
  header("HTTP/1.1 200 OK");
  echo 'OK';
} else {
  header("HTTP/1.1 500 INTERNAL SERVER ERROR");
  echo 'ERROR';
}

$payload = file_get_contents('php://input');
process_payload(json_decode($payload));

function process_payload($payload) {
  if (!is_object($payload)) {
    return;
  }

  $deploy_branch = $_GET['deploy_branch'];
  $change = $payload->push->changes[0]->new;;
  if ($change->type == 'branch' && $change->name == $deploy_branch) {
    do_pull();
  }
 
  file_put_contents('debug', print_r($change,1));
     
}

function do_pull() {
  $filename = 'do_pull';
  $content = 'master branch change: ' . date('Y-m-d H:i:s') . "\r\n";
  file_put_contents($filename, $content, FILE_APPEND);
}

function write_log() {
  $filename = 'webhook.log';
  $content = date('Y-m-d H:i:s') . "\r\n";

  //$json = file_get_contents('php://input');
  //$json = json_decode($json);
  //$content .= $json . "\r\n--------------\r\n";
  
  //$content .= print_r($json,1) . "\r\n-------------\r\n";
  return file_put_contents($filename, $content, FILE_APPEND);
}
