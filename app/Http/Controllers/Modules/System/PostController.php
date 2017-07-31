<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\GroupPostRequest;
use App\Modules\System\Post\Post;
use App\Modules\System\Post\Repository\PostRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use function factory;
use function response_ajax_error;

class PostController extends Controller
{

    /** @var PostRepository */
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    }

    public function listPostByGroup($groupCode)
    {
        return $this->postRepo->getPaginatedFromGroup($groupCode);
    }

    public function seedPosts()
    {
        factory(Post::class, 50)->create();
        return "made 50 new posts";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupPostRequest  $request
     * @return Response
     */
    public function store(GroupPostRequest $request)
    {
        try {
            $post = $request->getRequestModel();
            $post->setAuthor(Auth::user());

            $this->postRepo->create($post);

            return $post;
        } catch ( Exception $ex ) {
            return response_ajax_error($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
