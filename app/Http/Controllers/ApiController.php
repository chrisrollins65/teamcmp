<?php

namespace App\Http\Controllers;

use App\Domain\Services\Chat;
use App\Repositories\FriendRepository;
use App\Repositories\ProfileRepository;

class ApiController extends Controller
{
    public function getProfile(ProfileRepository $repo)
    {
        return json_encode($repo->getProfile(1));
    }

    public function getIsFriend(FriendRepository $repo)
    {
        $isFriend = $repo->isFriend(1);

        return (bool)$isFriend;
    }

    public function postFriend(FriendRepository $repo)
    {
        $repo->addFriend(1);
    }

    public function deleteFriend(FriendRepository $repo)
    {
        $repo->deleteFriend(1);
    }

    public function getChat(Chat $chat)
    {
        return json_encode($chat->getChat());
    }

    public function postChatMessage(Chat $chat)
    {
        if (!array_key_exists('message', $_POST) || $_POST['message'] === '') {
            return response()->json(['error'=>'Message is required.'], 422);
        }
        if (empty($_POST['sentBy'])) {
            return response()->json(['error'=>'SentBy is required'], 422);
        }

        $chat->addMessage($_POST['message'], $_POST['sentBy']);
    }

    public function getAvatars(ProfileRepository $repo)
    {
        return json_encode($repo->getAvatars());
    }
}
