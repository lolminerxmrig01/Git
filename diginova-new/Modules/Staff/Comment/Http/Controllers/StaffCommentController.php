<?php

namespace Modules\Staff\Comment\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Staff\Comment\Models\Comment;

class StaffCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('staffcomment::index', compact('comments'));
    }

    public function searchComment(Request $request, Comment $comments)
    {
        $request->paginatorNum = $request->paginatorNum ?? 10;

        $comments = $this->Commentfilter($request, $comments);

        return view('staffcomment::searchResult', compact('comments'));
    }

    public function Commentfilter($request, $comments)
    {
        $comments = $comments->newQuery();

        if (isset($request->sortType)) {
            if ($request->sortType == 'not_checked') {
                $comments->where('publish_status', 'not_checked');
            }

            if ($request->sortType == 'rejected') {
                $comments->where('publish_status', 'rejected');
            }

            if ($request->sortType == 'accepted') {
                $comments->where('publish_status', 'accepted');
            }
        }

        return $comments->orderBy('created_at', 'desc')
            ->paginate($request->paginatorNum);
    }

    public function delete(Request $request, Comment $comments)
    {
        Comment::findOrFail($request->id)
            ->delete();

        $request->paginatorNum = $request->paginatorNum ?? 10;

        $comments = $this->Commentfilter($request, $comments);

        return view('staffcomment::searchResult', compact('comments'));
    }

    public function update(Request $request, Comment $comments)
    {

        $messages = [
            'text.required' => 'وارد کردن متن دیدگاه اجباری است',
        ];

        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'advantages' => 'nullable',
            'disadvantages' => 'nullable',
            'title' => 'nullable',
            'recommend_status' => 'nullable',
            'publish_status' => 'required'
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => $errors,
                ]
            ], 400);
        }

        Comment::whereId($request->comment_id)->update([
            'text' => $request->text,
            'advantages' => $request->advantages,
            'disadvantages' => $request->disadvantages,
            'title' => $request->title,
            'publish_status' => $request->publish_status,
            'recommend_status' => $request->recommend_status,
        ]);

        $request->paginatorNum = $request->paginatorNum ?? 10;

        $comments = $this->Commentfilter($request, $comments);

        return view('staffcomment::searchResult', compact('comments'));

    }
}
