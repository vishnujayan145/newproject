<?php
require 'Aws/aws-autoloader.php';
class S3Client {
public function connect()
 {
$config['version']='latest'; //DO  NOT CHANGE
$config['region']='sgp1'; //YOUR SERVER Digitalocean Spaces LOCATION Eg: 'sgp1' (singapore)
$config['endpoint']='https://sgp1.digitaloceanspaces.com'; //My domain: 
$config['credentials']['key']='226JVTUKECN4L7KDJ5PH';
$config['credentials']['secret']='C68dfQypG7sctaY0ZRL273cIgfqxlqxVxPUrj76CQ6w';
return $client = new Aws\S3\S3Client($config);
}
}
