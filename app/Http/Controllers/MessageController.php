<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\user;
use App\Events\Chat\SendMessage;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{

    public function listMessages($uuid)
    {
        $userFrom = auth()->user();
        $userTo = $uuid;

        $messages = Message::where(

            function ($query) use ($userFrom, $userTo) {
                $query->where([
                    ['from', '=', $userFrom->uuid],
                    ['to', '=', $userTo],
                ]);
            }

        )->orWhere(

            function ($query) use ($userFrom, $userTo) {
                $query->where([
                    ['from', '=', $userTo],
                    ['to', '=', $userFrom->uuid],
                ]);
            }

        )->orderBy('created_at', 'asc')->get();

        foreach ($messages as $message) {
            $message->content = Crypt::decryptString($message->content);
        }

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {

        $content = Crypt::encryptString($request->message);

        $message = Message::create([
            'from' => auth()->user()->uuid,
            'to' => $request->to,
            'content' => $content,
        ]);



        event(new SendMessage($message, $request->to));

        $message->content = Crypt::decryptString($message->content);
        
        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
