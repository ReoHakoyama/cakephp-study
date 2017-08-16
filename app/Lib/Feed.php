<?php

/**
 * RSS for PHP - small and easy-to-use library for consuming an RSS Feed
 *
 * @copyright  Copyright (c) 2008 David Grudl
 * @license    New BSD License
 * @version    1.2
 */
class Feed
{
  /** @var int */
  public static $cacheExpire = '1 day';

  /** @var string */
  public static $cacheDir;

  /** @var SimpleXMLElement */
  protected $xml;

  public static $useProxy = false;
  public static $proxy_host;
  public static $proxy_port;
  public static $proxy_user;
  public static $proxy_auth;
  public static $userAgent = 'Mozilla/5.0 (Windows NT 6.1) ';
  /**
   * Loads RSS or Atom feed.
   * @param  string
   * @param  string
   * @param  string
   * @return Feed
   * @throws FeedException
   */
  public static function load($url, $useProxy = false, $proxyArr = [])
  {
    self::$useProxy = $useProxy;
    if($useProxy){
      self::$proxy_host = $proxyArr['host'];
      self::$proxy_port = $proxyArr['port'];
      self::$proxy_auth = base64_encode("{$proxyArr['user']}:{$proxyArr['pass']}");
    }
    $xml = self::loadXml($url);
    if ($xml->channel) {
      return self::fromRss($xml);
    } else {
      return self::fromAtom($xml);
    }
  }


  /**
   * Loads RSS feed.
   * @param  string  RSS feed URL
   * @param  string  optional user name
   * @param  string  optional password
   * @return Feed
   * @throws FeedException
   */
  public static function loadRss($url)
  {
    return self::fromRss(self::loadXml($url));
  }


  /**
   * Loads Atom feed.
   * @param  string  Atom feed URL
   * @param  string  optional user name
   * @param  string  optional password
   * @return Feed
   * @throws FeedException
   */
  public static function loadAtom($url)
  {
    return self::fromAtom(self::loadXml($url));
  }


  private static function fromRss(SimpleXMLElement $xml)
  {
    if (!$xml->channel) {
      throw new FeedException('Invalid feed.');
    }
    $xmlArr = json_decode(json_encode($xml), true);//配列
    if(!empty($xml->channel->item)){
      foreach($xml->channel->item as $item){//dengeki用
          $itemAr[] = [
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => self::getDescriptionFromObj($item),
            'content' => self::getContentFromObj($item),
            'thumbnail_url' => self::getThumbnailFromObj($item),
            'pub_date' => (string)$item->pubDate,
            'category' => (string)$item->category
          ];
      }
    }
    if(!empty($xml->item)){
      foreach($xml->item as $item){
          $itemAr[] = [
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => self::getDescriptionFromObj($item),
            'id' => (string)$item->id,
            'content' => self::getContentFromObj($item),
          ];
      }
    }
    if(isset($xmlArr['channel']['title'])){
      $title = $xmlArr['channel']['title'];
    }else{
      $title = $xmlArr['title'];
    }
    $newXmlArr['channel'] = [
      'title' => $title,
      'description' => self::getDescriptionFromArr($xmlArr),
      'item' => @$itemAr,
    ];
    return $newXmlArr;

  }

  private static function getDescriptionFromObj($obj){
    if(!empty($obj->description)){
      $description = (string)$obj->description;
    }elseif(!empty($obj->subtitle)){
      $description = (string)$obj->subtitle;
    }elseif(!empty($obj->summary)){
      $description = (string)$obj->summary;
    }else{
      $description = null;
    }
    return $description;
  }

  private static function getContentFromObj($obj){//Dengeki用
    if(!empty($obj->children('http://purl.org/rss/1.0/modules/content/'))){
      $content = (string)$obj->children('http://purl.org/rss/1.0/modules/content/');
    }else{
      $content = (string)$obj->content;
    }
    return $content;
  }

  private static function getThumbnailFromObj($obj){
    return (string)$obj->link->attributes()->href;
  }
  private static function getThumbnailCap($obj){
    return (string)$obj->link->attributes()->title;
  }


  private static function getDescriptionFromArr($arr){
    if(!empty($arr['channel'])){
      $target = $arr['channel'];
    }else{
      $target = $arr;
    }
    if(!empty($target['description'])){
      $description = $target['description'];
    }elseif(!empty($target['subtitle'])){
      $description = $target['subtitle'];
    }elseif(!empty($target['summary'])){
      $description = $target['summary'];
    }else{
      $description = null;
    }
    return $description;
  }


  private static function fromAtom(SimpleXMLElement $xml)
  {
    if (!in_array('http://www.w3.org/2005/Atom', $xml->getDocNamespaces(), TRUE)
      && !in_array('http://purl.org/atom/ns#', $xml->getDocNamespaces(), TRUE)
    ) {
      throw new FeedException('Invalid feed.');
    }
    $xmlArr = json_decode(json_encode($xml), true);
    // generate 'timestamp' tag
    foreach($xml->entry as $item){
      $itemAr[] = [
        'title' => (string)$item->title,
        'link' => (string)$item->link,
        'description' => self::getDescriptionFromObj($item),
        'id' => (string)$item->id,
        'content' => self::getContentFromObj($item),
        'thumbnail_url' => self::getThumbnailFromObj($item),
        'thumbnail_caption' => self::getThumbnailCap($item),
        'pub_date' => (string)$item->updated,
      ];
    }
    if(!empty($xmlArr['subtitle'])){
      $description = $xmlArr['subtitle'];
    }elseif(!empty($xmlArr['summary'])){
      $description = $xmlArr['summary'];
    }else{
      $description = null;
    }
    $newXmlArr['channel'] = [
      'title' => $xmlArr['title'],
      'description' => $description,
      'item' => $itemAr
    ];
    return $newXmlArr;
  }


  /**
   * Returns property value. Do not call directly.
   * @param  string  tag name
   * @return SimpleXMLElement
   */
  public function __get($name)
  {
    return $this->xml->{$name};
  }


  /**
   * Sets value of a property. Do not call directly.
   * @param  string  property name
   * @param  mixed   property value
   * @return void
   */
  public function __set($name, $value)
  {
    throw new Exception("Cannot assign to a read-only property '$name'.");
  }


  /**
   * Converts a SimpleXMLElement into an array.
   * @param  SimpleXMLElement
   * @return array
   */
  public function toArray(SimpleXMLElement $xml = NULL)
  {
    if ($xml === NULL) {
      $xml = $this->xml;
    }

    if (!$xml->children()) {
      return (string) $xml;
    }

    $arr = array();
    foreach ($xml->children() as $tag => $child) {
      if (count($xml->$tag) === 1) {
        $arr[$tag] = $this->toArray($child);
      } else {
        $arr[$tag][] = $this->toArray($child);
      }
    }

    return $arr;
  }


  /**
   * Load XML from cache or HTTP.
   * @param  string
   * @param  string
   * @param  string
   * @return SimpleXMLElement
   * @throws FeedException
   */
  private static function loadXml($url)
  {
    if(self::$useProxy){
      $opt = [
        'http' => [
            'proxy' => 'tcp://'.self::$proxy_host.':'.self::$proxy_port,
            'header' => 'Proxy-Authorization: Basic '.self::$proxy_auth."\r\n".'User-Agent: '.self::$userAgent. "\r\n",
            'request_fulluri' => true,
            'timeout' => 10
        ],
      ];
      $context = stream_context_create($opt);
    }else{
      $opt = [
        'http' => [
          'header' => 'User-Agent: '.self::$userAgent. "\r\n",
        ],
      ];
      $context = stream_context_create($opt);
    }
    $e = self::$cacheExpire;
    $cacheFile = self::$cacheDir . '/feed.' . md5(serialize(func_get_args())) . '.xml';

    if ($data = file_get_contents($url, false, $context)) {
      // ok
    } else {
      throw new FeedException('Cannot load feed.');
    }
    return simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
  }

  /**
   * Generates better accessible namespaced tags.
   * @param  SimpleXMLElement
   * @return void
   */
  private static function adjustNamespaces($el)
  {
    foreach ($el->getNamespaces(TRUE) as $prefix => $ns) {
      $children = $el->children($ns);
      foreach ($children as $tag => $content) {
        $el->{$prefix . ':' . $tag} = $content;
      }
    }
  }

}



/**
 * An exception generated by Feed.
 */
class FeedException extends Exception
{
}
