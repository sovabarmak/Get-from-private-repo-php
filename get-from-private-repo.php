<?php

$token =''; 
// get file from repo

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/{owner}/{repo}/contents/style.css?ref={branch}');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);



$headers = array();
$headers[] = 'Accept: application/vnd.github+json';
$headers[] = 'Authorization: token '.$token;
$headers[] = 'User-Agent: Awesome-Octocat-App';
$headers[] = 'X-Github-Api-Version: 2022-11-28';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$r=json_decode($result);
$data = file_get_contents($r->download_url);
file_put_contents('style.css',$data);


// get repo zip
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/{owner}/{repo}/zipball/{branch}');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);



$headers = array();
$headers[] = 'Accept: application/vnd.github+json';
$headers[] = 'Authorization: token '.$token;
$headers[] = 'User-Agent: Awesome-Octocat-App';
$headers[] = 'X-Github-Api-Version: 2022-11-28';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
file_put_contents('repo.zip',$result);

?>