<?php

namespace App\Http\Controllers;

use App\Lib\PusherFactory;
use App\Message;
use App\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * getLoadLatestMessages
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getLoadLatestMessages(Request $request)
    {

        if (!$request->user_id) {
            return response()->json(['state' => 0, 'messages' => 'failed']);
        }

        $messages = Message::where(function ($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->limit(100)->get();

        if ($request->kind == 'full') {
            $html = view('chat.chat-content')->with('messages', $messages)->render();

            return response()->json(['state' => 1, 'html' => $html]);
        } else {
            $msgs = [];

            foreach ($messages as $message) {
                $msgs[] = view('chat.message-line')->with('message', $message)->render();
            }
            return response()->json(['state' => 1, 'messages' => $msgs]);
        }


    }

    /**
     * postSendMessage
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSendMessage(Request $request)
    {

        if(!$request->to_user || !$request->message) {
            return response()->json(['state' => 0, 'data' => 'failed']);
        }

        $message = new Message();
        $message->from_user = Auth::user()->id;
        $message->to_user = $request->to_user;
        $message->content = $request->message;
        $message->product_id = $request->product_id;
        $message->save();

        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
        $message->dateHumanReadable = $message->created_at->diffForHumans();
        $message->fromUserName = $message->fromUser->name;
        $message->from_user_id = Auth::user()->id;
        $message->from_user_avatar = $message->fromUser->avatar;
        $message->toUserName = $message->toUser->name;
        $message->to_user_id = $request->to_user;
        $message->to_user_avatar = $message->toUser->avatar;
        $message->product_id = $request->product_id;

        PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);

        return response()->json(['state' => 1, 'data' => $message]);


    }

    /**
     * getOldMessages
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getOldMessages(Request $request)
    {
        if (!$request->old_message_id || !$request->to_user)
            return response()->json(['state' => 0, 'data' => 'failed']);

        $message = Message::find($request->old_message_id);

        $lastMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'ASC')->limit(10)->get();

        $return = [];

        if ($lastMessages->count() > 0) {

            foreach ($lastMessages as $message) {

                $return[] = view('chat.message-line')->with('message', $message)->render();
            }

            PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }

        return response()->json(['state' => 1, 'data' => $return]);
    }
    public function delete(Request $request){

//          Message::where(function ($query) use ($request) {
//            $query->where('from_user', Auth::user()->id)->where('to_user', $request->id);
//        })->orWhere(function ($query) use ($request) {
//            $query->where('from_user', $request->id)->where('to_user', Auth::user()->id);
//        })->delete();
//        $update =[
//            'status'=>3,
//        ];
//       Bid::where(function ($query) use ($request) {
//            $query->where('seller_id', Auth::user()->id)->where('buyer_id', $request->id);
//        })->orWhere(function ($query) use ($request) {
//            $query->where('seller_id', $request->id)->where('buyer_id', Auth::user()->id);
//        })->update($update);
        Bid::where('seller_id',$request->id)->where('buyer_id',Auth::user()->id)->where('status','<>',0)->update(['buyer_status'=>1]);
        Bid::where('buyer_id',$request->id)->where('seller_id',Auth::user()->id)->where('status','<>',0)->update(['seller_status'=>1]);
//         dd($messages);

         return redirect()->back();
    }

}
