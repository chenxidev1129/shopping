<?
$url = 'https://www.youtube.com/watch?v=GY2yZlEh49I'; 
$id = str_replace('https://www.youtube.com/watch?v=', '', $url); 
$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
parse_str($content, $data);
echo "���� : " . $data['title'];
echo '<br>';
echo "��ȸ�� : " . $data['view_count'];
?>