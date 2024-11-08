<?php

/**
 * return full src for product main image.
 *
 * @param $product
 * @return string|null
 */
function g_product_image_main_src($product){
  if (count($product->media) && $product->media()->wherePivot('is_main', 1)->count())
    return g_image_src($product->media()->wherePivot('is_main', 1)->first());

  if (count($product->media))
    return g_image_src($product->media()->first());

  return null;
}

/**
 * return full image src
 *
 * @param $media
 * @return string|null
 */
function g_image_src($media) {
  if (!is_null($media))
      return asset($media->path . "\/" . $media->name);

  return null;
}

/**
 * @param $product
 * @return string|void
 */
function getProductVariantType($product) {
  if(isset($product->category()->first()->variantGroup()->first()->type)){
    if ($product->category()->first()->variantGroup()->first()->type !== 0) {
        return 'color';
    }
    return 'not-color';
  }
}

function getMainCategory($category){
  while (isset($category->parent)) {
    $category = $category->parent;
  }
  return $category;
}


