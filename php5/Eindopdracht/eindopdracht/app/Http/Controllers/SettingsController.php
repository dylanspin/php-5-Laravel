<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
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

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $user = auth()->user();

            // $req->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            $socialLinksArray = [$req['Instagram'], $req['Twitter'], $req['Facebook'], $req['Linkedin'], $req['Youtube'], $req['Custom']];
            $compresSocial = serialize($socialLinksArray);

            $this->UploadImage($req);
            $settings = new \App\profile;
            $settings -> where('id', $user->id)->update(['about' => $req['about'],'social' => $compresSocial]);
            return back();

        }else{
            return back();
        }
    }

    private function UploadImage(Request $req)
    {
        $settings = new \App\profile;
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);

        $destinationPath = '/images/Profile/';
        // $files = $req->file('profileImage'); // will get all files
        // $file = $req->photo;
        $file = $req->file('profileImage');
        // if ($files as $file) {//this statement will loop through all files.
            // $file_name = $file->getClientOriginalName(); //Get file original name
        $file_name = $file->getClientOriginalName();
            // $file->move($destinationPath , $file_name); // move files to destination folder
        // }
        // $req->validate([
        //     'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        // setcookie("myCookie", "tes122", time() + 3600);
        // $imageName = time().'.'.$req['profileImage']->extension();

        // $request->image->move('/images/Profile/', $req['profileImage']);
        // if(!empty($req['profileImage']))
        // {
        //     $nameUser = $information->user;
        //     $bestand = $req['profileImage'];
        //     $nameImage = $nameUser.$bestand;
        //     $target_dir = "/images/Profile/";//locatie image
        //
        //     $target_file = $target_dir . basename($bestand);
        //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //     setcookie("myCookie", "test", time() + 3600);
        //     if (!file_exists($target_file))
        //     {
        //         setcookie("myCookie", "test0 ", time() + 3600);
        //         if ($imageFileType == "jpg" | $imageFileType == "png" | $imageFileType == "jpeg" | $imageFileType == "gif")
        //         {
        //             setcookie("myCookie", "test1", time() + 3600);
        //             // if($req['profileImage']->getSize() < 2000000) {
        //                 setcookie("myCookie", "test2", time() + 3600);
        //                 $bestand->move('/images/Profile/', $req['profileImage']);
        //                 // if (move_uploaded_file($bestand, $target_file))
        //                 // {
        //                 //     // if(strlen($settings->image) > 0)
        //                 //     // {
        //                 //     //     unlink('/images/Profile/'.$settings->image);
        //                 //     // }
        //                 //     setcookie("myCookie", "test3", time() + 3600);
        //                 //     $settings -> where('id', $id)->update(['image' => $nameImage]);
        //                 // }
        //             // }
        //         }
        //     }
        // }
    }

    public function formSubmitStyle(Request $req)
    {
        if($req)
        {
            $user = auth()->user();

            $gradientArray = [$req['gradient1'], $req['gradient2']];
            $compresGradient = serialize($gradientArray);

            $hoverArray = [$req['hover1'], $req['hover2']];
            $compresHover = serialize($hoverArray);
            if($req['font'])
            {
                $font = $req['font'];
            }else{
                $font = 0;
            }

            $settings = new \App\profile;
            $settings -> where('id', $user->id)->update(['gradient' => $compresGradient, 'hover' => $compresHover, 'font' => $font]);

            return back();
        }else{
            return back();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function getSocial()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->social) < 1){
            $socialLinks = ["","","","","",""];
        }else{
            $socialLinks = unserialize($information->social);
        }

        return $socialLinks;
    }


    private function getGradient()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->gradient) < 1){
            $gradient = ["#780206","#061161"];
        }else{
            $gradient = unserialize($information->gradient);
        }
        return $gradient;
    }

    private function getHover()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->hover) < 1){
            $hover = ["#340B3C","#230b3c"];
        }else{
            $hover = unserialize($information->hover);
        }
        return $hover;
    }

    public function index()//task bar load
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        $about = $information->about;
        return view('settings')->with('social',$this->getSocial())->with('about',$about)->with('gradient',$this->getGradient())
        ->with('hover',$this->getHover());
    }
}
