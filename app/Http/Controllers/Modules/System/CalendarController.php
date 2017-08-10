<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Modules\System\Post\Repository\PostRepository;
use App\Modules\System\Post\Transformers\CalendarEventTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function collect;

class CalendarController extends Controller
{

    /** @var PostRepository */
    protected $postRepo;

    /** @var CalendarEventTransformer */
    protected $transformer;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo    = $postRepo;
        $this->transformer = new CalendarEventTransformer();
    }

    public function getPostsByDateRange(Request $request)
    {
        $groupCode = $request->group_code || null;
        return collect($this->postRepo->getPostsByDateRange(Auth::user(), $request->start, $request->end, $groupCode))
                ->transform(function($post) {
                    return $this->transformer->transform($post);
                });
    }

}
