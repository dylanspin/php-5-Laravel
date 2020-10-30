@extends('layouts.app')

  @section('content')
    <div class="jumbotron first" style="margin-bottom:-60px;">
        <div class="row">
            <div class="col">
                <div class="settings">
                 <h1 class="p-3 font-weight-bolder">Settings</h1>
                 <div class="list-group list-group-flush pl-3" style="height:100%;">
                     <div onclick="openSettings(1)" class="backgroundColor setting">Profile</div>
                     <div onclick="openSettings(2)" class="backgroundColor setting">Safety</div>
                     <div onclick="openSettings(3)" class="backgroundColor setting">Style Options</div>
                     <div onclick="openSettings(4)" class="backgroundColor setting">Privacy</div>
                     <div onclick="openSettings(5)" class="backgroundColor setting">Products/services</div>
                 </div>
               </div>
            </div>
            <div class="col col-lg-7">
                <div class="OptionPage" id='O1' style="display:block;">
                    <h1 class="p-3 font-weight-bolder">Profile Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="pt-3 font-weight-bolder mb-4">Profile Picture </h3>
                        <div class="row">
                            <div class="col col-lg-2">
                                <input type="file" name="profileImage" class="mb-5 imgInput" value="" accept="image/*">
                            </div>
                            <div class="col ml-5 ">
                                <div class="currentImg rounded">
                                    <img src="publicImages/images/Profile/{{$info->image}}" alt="evenements" class="imgFull rounded">
                                </div>
                            </div>
                        </div>

                        <h3 class="pt-3 font-weight-bolder mb-4">About </h3>
                        <textarea name="about" rows="8" cols="80">{{$about ?? ' '}}</textarea>

                        <h3 class="pt-3 mt-5 font-weight-bolder mb-5">Other social media Links</h3>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-instagram settingIcon"></div>
                        </div>
                        <input type="text" name="Instagram" value="{{$social[0] ?? ''}}" placeholder="Instagram" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-twitter settingIcon"></div>
                        </div>
                        <input type="text" name="Twitter" value="{{$social[1] ?? ''}}" placeholder="Twitter" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-facebook settingIcon"></div>
                        </div>
                        <input type="text" name="Facebook" value="{{$social[2] ?? ''}}" placeholder="Facebook" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-linkedin settingIcon"></div>
                        </div>
                        <input type="text" name="Linkedin" value="{{$social[3] ?? ''}}" placeholder="Linkedin" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-youtube-play settingIcon"></div>
                        </div>
                        <input type="text" name="Youtube" value="{{$social[4] ?? ''}}" placeholder="Youtube" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-music settingIcon"></div>
                        </div>
                        <input type="text" name="Custom" value="" placeholder="Custom" class="settingInput"><br>
                        <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">

                    </form>
                </div>
                <div class="OptionPage" id='O2'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Safety Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit2" method="GET">
                        @csrf
                        <h3 class="mt-2 mb-5 font-weight-bolder">Profile protection : </h3>
                        <h5 class="pb-2">
                            Change password :
                        </h5>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            Old
                        </div>
                        <input type="password" name="password" value="" placeholder="..." class="settingInput"><br>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            New
                        </div>
                        <input type="password" name="password2" value="" placeholder="..." class="settingInput"><br>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            Repeat
                        </div>
                        <input type="password" name="password3" value="" placeholder="..." class="settingInput"><br>
                        <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                    </form>
                </div>
                <div class="OptionPage" id='O3'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Style Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit3" method="GET">
                      @csrf
                      <h3 class="pt-3 font-weight-bolder mb-3">Profile gradient colors :</h3>
                      <div class="colorPick" onclick="activateInput(1)" style="background:{{$gradient[0] ?? ''}}">
                          <input type="color" id="G1" name="gradient1" class="ColorPicker" value="{{$gradient[0] ?? ''}}" onchange="setGradient(true)">
                      </div>
                      <div class="colorPick" onclick="activateInput(2)" style="background:{{$gradient[1] ?? ''}}">
                        <input type="color" id="G2" name="gradient2" class="ColorPicker" value="{{$gradient[1] ?? ''}}" onchange="setGradient(true)">
                      </div>
                      <div class="gradientBar gradient"id="gradientBar" style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>

                      <h3 class="pt-3 font-weight-bolder mb-3">Profile hover gradient colors :</h3>
                      <div class="colorPick" onclick="activateInput(3)" style="background:{{$hover[0] ?? ''}}">
                          <input type="color" id='G3' name="hover1" class="ColorPicker" value="{{$hover[0] ?? ''}}" onchange="setGradient(false)">
                      </div>
                      <div class="colorPick" onclick="activateInput(4)" style="background:{{$hover[1] ?? ''}}">
                          <input type="color" id='G4' name="hover2" class="ColorPicker" value="{{$hover[1] ?? ''}}" onchange="setGradient(false)">
                      </div>
                      <div class="gradientBar gradient" id="HoverBar" style="background:linear-gradient(118deg, {{$hover[0] ?? ''}} 0%, {{$hover[1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>

                      <h3 class="pt-3 mt-5 font-weight-bolder mb-3">Profile font</h3>
                      <select name='font' class="fontOptions">
                        <option value='' class="fontOptions">hier moet die er nu is</option>
                        <option value='0' class="fontOptions">Nunito</option>
                      </select>

                      <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                    </form>
                </div>
                <div class="OptionPage" id='O4'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Privacy Options</h1>
                </div>
                <div class="OptionPage" id='O5' style="width:125%;">
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Products/services Options</h1>
                    <div class="productCard gradient">
                        <div class="addProduct" onclick="addProduct()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                    @for ($i = 0; $i < Count($products); $i++)
                        @if(strlen($products[$i]->imgName) > 2)
                            <div class="productCard productGradient">
                                <div class="productImage rounded">
                                    <img src="publicImages/images/Products/{{$products[$i]->imgName}}" alt="Product" class="imgFull">
                                    <div class="productName text-uppercase" onclick="">
                                        {{$products[$i]->productName}}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="productCard productGradient">
                                <div class="productName text-uppercase" onclick="">
                                    {{$products[$i]->productName}}
                                </div>
                            </div>
                        @endguest
                    @endfor
                    <div class="productInputList" id='list'>
                        <div id='holder'class="holder">
                            <div class="close fa fa-times" onclick="closeAdd()"></div>
                            <form class="inputs" action="/settings/product" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="Label2 pb-2" style="width:25%">
                                    <h3>Product Name</h3>
                                </div>
                                <input type="text" name="productName" value="" placeholder="Product Name" class="productInput mb-5" maxlength="40" required><br>
                                <div class="Label2 pb-2" style="width:25%" id='setValue' >
                                    <h3>Hour Price</h3>
                                </div>
                                <div class="">
                                    <div class="selectSetting gradient" id='1' onclick="setSelect(1)">

                                    </div>
                                    <div class="selectSetting setSlot" id='2' onclick="setSelect(2)">

                                    </div>
                                    <div class="selectSetting setSlot" id='3' onclick="setSelect(3)">

                                    </div>
                                </div><br>
                                <input type="hidden" name="selected" value="1" id='select'>
                                <div id='hour'>
                                    <div class="Label2 pb-2" style="width:25%" id='hour1'>
                                        <h3>Hour Price</h3>
                                    </div>
                                    <input type="number" name="basePrice" value="" placeholder="Base Price" class="productInput"><br>
                                </div>
                                <div class="Label2 pb-2" style="width:25%">
                                    <h3>Base Price</h3>
                                </div>
                                <input type="number" name="hourPrice" value="" placeholder="Base Price" class="productInput mb-5" required><br>
                                <div class="" style="width:45%">
                                    <h3>Product Information</h3>
                                </div>
                                <textarea class="productAbout" name="productAbout" rows="8" cols="80" required></textarea><br>

                                <div class="Spacer"></div>

                                <div class="Label2 pb-2">
                                    <div class="fa fa-music input Icon"></div>
                                </div>
                                <input type="text" name="Custom" value="" placeholder="Custom" class="productInput"><br>

                                <div class="Label2 pb-2">
                                    <div class="fa fa-youtube-play input Icon"></div>
                                </div>
                                <input type="text" name="youtubeProduct" value="" placeholder="youtube link" class="productInput"><br>

                                <div class="Label2 pb-2">
                                    <div class="fa fa-picture-o input Icon"></div>
                                </div>
                                <input type="file" name="productImage" value="" placeholder="Custom" class="productInput" accept="image/*"><br>

                                <div class="row">
                                  <div class="col col-lg-7">

                                  </div>
                                    <div class="col">
                                        <button type="submit" name="button" class="uploadProduct">
                                            <h3>Upload</h3>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div><!--Spacer-->
        </div>
    </div>
  @include('layouts.footer')
  @endsection
