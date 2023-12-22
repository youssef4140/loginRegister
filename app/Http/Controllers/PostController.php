<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        try{
            $request = $request->all();
            $id = Auth::user()->id;

            $request['user_id'] = $id;

            $post = Post::create($request);
            return response()->json([
                $post
            ]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to create the Post', 'error' => $e->getMessage()], 500);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
        
    }

    public function posts(): JsonResponse
    {
        try{

            $posts = Post::with('user')->get();

            if (count($posts) == 0) {
                return response()->json(['message' => 'No Posts added'], 404);
            }
            return response()->json([
                $posts
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function postById($id): JsonResponse
    {
        try {
            $post = Post::with('user')->find($id);
    
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }
    
            return response()->json([$post]);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function userPostsById($id): JsonResponse
    {
        try{
            $posts = Post::all()->where('user_id',$id);
            $user = User::find($id);

            if(!$user){
                return response()->json(["message'=>'This user doesn't exist"],404);
            }
            if(count($posts) == 0){
                return response()->json(['message'=>'No Posts By This User'],404);
            }

            return response()->json([
                "user" => $user,
                "post"=> $posts]);
        } catch (\Exception $e){
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);

        }
    }

    public function delete($id): JsonResponse
    {
    try{

        $user_id = Auth::user()->id;

        $post = Post::where(['user_id' => $user_id])->find($id);

        // return response()->json([$post]);
        if(!$post){
            return response()->json(["message"=>"This post doesn't exist"],404);
        }
        $deletion = $post->forceDelete();
        if($deletion){
            return response()->json([
                "message"=>"post with id = (".$id.") deleted successfully",
                "id"=>$id,
        ],200);

        } else {
        return response()->json(['message' => 'Deletion unsuccesfull'], 500);

        }
    } catch (\Exception $e){
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);

    }
    }

    public function update($id,Request $request): JsonResponse
    {
        try{
            $request = $request->all();

        $user_id = Auth::user()->id;

        $post = Post::where(['user_id' => $user_id])->find($id);

        if(!$post){
            return response()->json(["message"=>"This post doesn't exist"],404);
        }

        $post->update($request);

        return response()->json([$post],200);
    } catch (\Exception $e){
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);

    }


    }
}
