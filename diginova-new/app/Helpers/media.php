<?php

use App\Models\Media;

function deleteMedia($media_id, $user_id)
{
  $media = Media::find($media_id);
  if (($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id)) {
    unlink(public_path("$media->path/") . $media->name);
    $media->delete();
  }
}
