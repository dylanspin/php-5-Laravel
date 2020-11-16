<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function DeclineInvite(Request $req)
    {
        if($req)
        {
            $messageId = $req['idMessage'];
            $id = auth()->user()->id;
            $messages = \App\message::where('recieve',$id)->get();
            $mId = $messages[$messageId]->id;

            \App\message::where('id', $mId)->delete();
        }
    }

    public function Acceptinvite(Request $req)
    {
        if($req)
        {
            $messageId = $req['idMessage'];
            $id = auth()->user()->id;

            $messages = \App\message::where('recieve',$id)->get();
            $information = \App\profile::findOrFail($id);

            $mId = $messages[$messageId]->id;
            $bandId = $messages[$messageId]->bandId;
            $band = \App\band::where('id',$bandId)->get();
            $bandList = unserialize($band[0]->members);
            $bandPerms = unserialize($band[0]->memberPer);
            if (!in_array($id, $bandList)) {
                if(strlen($information->bands) > 0)
                {
                    $myList = unserialize($information->bands);
                    array_push($myList,$bandId);
                }else{
                    $myList = [$bandId];
                }
                array_push($bandList,$id);
                array_push($bandPerms,0);

                $compressedPerms = serialize($bandPerms);
                $compressedBandList = serialize($bandList);
                $compressedmyList = serialize($myList);

                $profile = new \App\profile;
                $profile -> where('id', $id)->update(['bands' => $compressedmyList]);
                $bands = new \App\band;
                $bands -> where('id', $bandId)->update(['members' => $compressedBandList,'memberPer' => $compressedPerms]);
            }

            \App\message::where('id', $mId)->delete();
        }
        return back();
    }

    public function getBandNames($message)
    {
        $names = array();

        for($i=0; $i<Count($message); $i++)
        {
            if($message[$i]->type == 0)
            {
                $band = \App\band::where('id',$message[$i]->bandId)->get();
                $bandName = $band[0]->bandName;
                array_push($names,$bandName);
            }else{
                array_push($names,null);
            }
        }

        return $names;

    }

    public function index()
    {
        $id = auth()->user()->id;
        $message = \App\message::where('recieve',$id)->get();
        return view('message')->with('messages',$message)->with('names',$this->getBandNames($message));
    }
}
