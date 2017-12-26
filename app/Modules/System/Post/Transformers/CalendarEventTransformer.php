<?php

namespace App\Modules\System\Post\Transformers;

use App\Modules\System\Post\Post;
use Illuminate\Support\Str;

/**
 * Description of CalendarEventTransformer
 *
 * @author ervinne
 */
class CalendarEventTransformer
{

    public function transform(Post $post)
    {
        return [
            "title" => Str::limit($post->content, 10),
            "start" => $post->getDateTimeFrom()->format("m/d/Y h:i:s A"),
            "end"   => $post->getDateTimeTo()->format("m/d/Y h:i:s A"),
            "color" => $post->getGroup()->getColor(),
            "post"  => $post->toArray()
        ];
    }

}
