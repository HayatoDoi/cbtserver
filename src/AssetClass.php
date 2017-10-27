<?php
/**
 * 静的ファイルのリンクを返すClass
 */
class AssetClass
{

  public static function path($type, $filename)
  {
    if($type === 'css')
    {
      return "<link rel=\"stylesheet\" href=\"/assets.php?file=css/$filename\">";
    }
    if($type === 'js')
    {
      return "<script src=\"/assets.php?file=js/$filename\"></script>";
    }
  }
}