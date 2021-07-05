<?php

namespace Nrz\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Comment\Http\Requests\CommentRequest;
use Nrz\Comment\Repo\CommentRepo;

class CommentController extends Controller
{

    public function index(CommentRepo $commentRepo)
    {
        $comments = $commentRepo->paginate();
        return view("Comment::index", compact("comments"));
    }


    public function create()
    {
        //
    }


    public function store(CommentRequest $request,CommentRepo $commentRepo)
    {
        $commetable = $request->commentable_type::findOrFail($request->commentable_id);

        $commentRepo->store($request->all());

        return redirect($commetable->path());

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
