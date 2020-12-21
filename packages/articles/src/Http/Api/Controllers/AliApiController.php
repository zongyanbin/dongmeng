<?php

namespace App\Articles\Http\Api\Controllers;
use Illuminate\Routing\Controller as BaseController;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Vod\Vod;
use App\Models\AliyunOnDemand;
use OSS\OssClient;
use Illuminate\Http\Request;

class AliApiController extends BaseController
{

  public function __construct()
  {
    $this->AliyunOnDemand = new AliyunOnDemand();
  }

  public function createUploadVideo(Request $request)
  {
    // $data = $request->input();
    // if($data['title']){
    //   $data['title'] = current(explode('.',$data['title']));
    // }

    $data = array();
    $data['title']='testvod1';
    $data['fileName']='testvod1.mp4';
 
    return $this->AliyunOnDemand->createUploadVideo($data);
  }
  
  /**
   *刷新视频凭证
   *
   * @return void
   */
  public function refreshUploadVideo(Request $request)
  {
    $videoId = $request->input('VideoId');
   // return $this->AliyunOnDemand->getPlayInfo($videoId);
    return $this->AliyunOnDemand->refreshUploadVideo($videoId);
  }
}











