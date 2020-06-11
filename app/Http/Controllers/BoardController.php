<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/

    public function __construct(){
        $this->middleware('auth');
    }
        // a

	public function index(){
		$data = Auth::user()->boards;
        return response()->json($data);
	}

	public function show($id){
		$board = Board::where('id',$id)->first();
        
        if(Auth::user()->id !== $board->user_id){
            return response()->json(['status'=>'error','message'=>'unauthorized'],401);
        }

        return $board;
	}

	public function store(Request $request){
		$this->validate($request, [
            'name' => 'required'
        ]);

        $board=Auth::user()->boards()->create([
            'name' => $request->name,
        ]);

        return response()->json(['message'=>'success'], 201);
	}

    public function update(Request $request,$id){
        $board = Board::find($id);

        if(Auth::user()->id !== $board->user_id){
            return response()->json(['status'=>'error','message'=>'unauthorized'],401);
        }
        
        $board->update($request->all());

        return response()->json(['message'=>'success','board'=>$board], 200);
    }

    public function delete($id){
        $board = Board::where('id',$id)->first();

        if(Auth::user()->id !== $board->user_id){
            return response()->json(['status'=>'error','message'=>'unauthorized'],401);
        }

        if(Board::destroy($id)){
            return response()->json(['status' => 'error' , 'message' => 'Board Deleted Successfully']);
        }

        return response()->json(['status'=>'error','message'=>'Something went wrong']);

    }
}