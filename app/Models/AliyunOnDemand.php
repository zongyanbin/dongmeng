<?php
namespace App\Models;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Vod\Vod;
use OSS\OssClient;

class AliyunOnDemand
{
  private $accessKeyId = '';
  private $accessKeySecret = '';
  private $callback = '';
  private $client = '';

  /**
   * 配置
   */
  public function __construct()
  {
    $this->accessKeyId = config('aliyun.oss.accessKeyId');
    $this->accessKeySecret = config('aliyun.oss.accessKeySecret');
    $this->callback = config('aliyun.onDemand.callback');
    $this->initVodClient();
  }

  public function initVodClient()
  {
    $regionId = 'cn-shanghai';
    $this->client = AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessKeySecret)
    ->regionId($regionId)
    ->connectTimeout(1)
    ->timeout(3)
    ->asDefaultClient();
  }

  /**
   * 刷新播放凭证
   *
   * @param [type] $videoId
   * @return voids
   */
  public function refreshUploadVideo($videoId)
  {
      $onDemand = new AliyunOnDemand();
      $result = Vod::v20170321()
          ->refreshUploadVideo()
          ->withVideoId($videoId)
          ->request();
          var_dump($result); exit;
      //return $result['VideoId'];
      return $result->toArray();
  }

  /**
     * 获取视频上传地址和凭证
     *
     * @return string
     * @throws ServerException
     * @throws ClientException
     */
    public function createUploadVideo($data)
    {
              
      // $request = new vod\CreateUploadVideoRequest();
      // $request->setTitle("Sample Title");        
      // $request->setFileName("videoFile.mov"); 
      // $request->setDescription("Video Description");
      // $request->setCoverURL("http://192.168.0.0/16/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png"); 
      // $request->setTags("tag1,tag2");
  
      // $request->setAcceptFormat('JSON');
      
      // return $data->getAcsResponse($request);

        $result = Vod::v20170321()
                     ->createUploadVideo()
                     ->withTitle($data['title']) //标题， UTF8, 128大小
                     ->withFileName($data['fileName']) //视频源文件
                     ->withDescription(isset($data['description']) ? $data['description'] : '') //描述
                     ->withCoverURL(isset($data['coverURL']) ? $data['coverURL'] : '') //封面url
                     ->withCateId(isset($data['cateId']) ? $data['cateId'] : '1000222224') //分类ID
                     ->withTags(isset($data['tags']) ? $data['tags'] : '')  //标签, 隔开
                     ->withTemplateGroupId(isset($data['templateGroupId']) ? $data['templateGroupId'] :'b84c3d9410d96aad1f8e5178ed64ac8d') //转码模板组ID
                     ->withStorageLocation(isset($data['storageLocation']) ? $data['storageLocation'] : '') //存储地址
                     ->connectTimeout(60)
                     ->timeout(65)
                     ->request();
       // return $result['VideoId'];
    
       return $result->toArray();
    }  

    /**
     * 获取播放地址
     */
    public function getPlayInfo($videoId)
    {
   
      try
      {
        $request = Vod::v20170321()->getPlayInfo()
        ->withVideoId($videoId)
        ->format('JSON')
        ->request();
        $$request->toArray();
        return array("status" => 1, "data" => $request);
      }
      catch(Exception $e)
      {
        return array("status" => 0, "data" => $e->getMessage());
      }
    }

    /**
     * 初始化点播
     * @param $uploadAuth
     * @param $uploadAddress
     */
    public function initOssClient($uploadAuth, $uploadAddress)
    {
        $ossClient = new OssClient($uploadAuth['AccessKeyId'], $uploadAuth['AccessKeySecret'], $uploadAddress['Endpoint'],
            false, $uploadAuth['SecurityToken']);
        $ossClient->setTimeout(86400 * 7);    // 设置请求超时时间，单位秒，默认是5184000秒, 建议不要设置太小，如果上传文件很大，消耗的时间会比较长
        $ossClient->setConnectTimeout(10);  // 设置连接超时时间，单位秒，默认是10秒
        return $ossClient;
    }


}
?>