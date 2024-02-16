<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptDecrypt;
use App\Models\Hotspot;
use App\Models\HotspotMedia;

class HomeController extends Controller
{
    public function home_page(Request $request){
        // if (!Session::has('user')) {  
        //     return redirect()->back();
        // }
        $teamResponse = ApiHelper::apicall("home/our-team","GET",array());
        // dd($teamResponse);
        if($teamResponse->code == '200'){
            $team = $teamResponse->data;
        }else{
            $team = [];
        }
        $classesResponse = ApiHelper::apicall("home/our-classes","GET",array());
        if($classesResponse->code == '200'){
            $classes = $classesResponse->data;
        }else{
            $classes = [];
        }
        return view('website.home.home_page',compact('team','classes'));
    }  

    public function about_us(Request $request){
        $teamResponse = ApiHelper::apicall("home/our-team","GET",array());
        if($teamResponse->code == '200'){
            $team = $teamResponse->data;
        }else{
            $team = [];
        }
        $aboutUs_Response = ApiHelper::apicall("home/about-us","GET",array());
        if($aboutUs_Response){
            $about_us = $aboutUs_Response->data[0];
        }else{
            $about_us = [];
        }
        return view('website.home.about_us',compact('team','about_us'));
    }
    public function class_details(Request $request){
        return view('website.home.class_details');
    }
    public function services(Request $request){
        $response = ApiHelper::apicall("home/services","GET",array());
        if($response->code == '200'){
            $services = $response->data;
            return view('website.home.services',compact('services'));
        }else{
            return view('website.home.services');
        }
    }
    public function our_team(Request $request){
        $response = ApiHelper::apicall("home/our-team","GET",array());
        if($response->code == '200'){
            $data = $response->data;
            // dd($data);
            return view('website.home.team',compact('data'));
        }else{
            $data = [];
            return view('website.home.team',compact('data'));
        }
    }
    public function team_details(Request $request,$id){
        $id = base64_decode($id);
        $data = [
            "team_id" => $id
        ];
        $response = ApiHelper::apicall("home/team-details","GET",$data);
        if($response->code == '200'){
            $data = $response->data[0];
        }else{
            $data = [];
        }
        return view('website.home.team_details',compact('data'));
    }
    public function contact_us(Request $request){
        return view('website.home.contact');
    }
    public function contact_post(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'comment' => 'required'
        ]); 
        $postdata = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "comment" => $request->comment
        ];
        $response = ApiHelper::apicall("home/contact-us","POST",$postdata);
        if($response->code == 200){
            \Session::flash('success',$response->message);
            // dd(session('success'));
        }else{
            \Session::flash('error',$response->message);
        }
        return redirect(route('website.contact-us'));
    }
    public function class_timetable(Request $request){
        return view('website.home.class_timetable');
    }
    public function bmi_calculator(Request $request){
        return view('website.home.bmi_calculator');
    }
    public function bmi_calculator_post(Request $request){
        $this->validate($request,[
            'height' => 'required|numeric|min:15',
            'weight' => 'required|numeric|min:2',
            'age' => 'required|numeric|max:120',
            'gender' => 'required'
        ]); 
        $postdata = [
            'height' => $request->height,
            'weight' => $request->weight,
            'age' => $request->age,
            'gender' => $request->gender
        ];
        $response = ApiHelper::apicall("home/bmi-calculator","POST",$postdata);
        if($response->code == 200){
            \Session::flash('success',$response->data);
            // session()->flash('success', $response->data);
            $data = $postdata;
            \Session::flash('data',$data);
        }else{
            $data = [];
            // session()->flash('error', $response->message);
            \Session::flash('error',$response->message);
        }
 
        return redirect(route('website.bmi-calculator'))->with('data', $data);

        // return view('website.home.bmi_calculator',compact('data'));
    }
    public function gallery(Request $request){
        return view('website.home.gallery');
    }
    public function blog(Request $request){
        return view('website.home.blog');
    }
    public function hotspot(Request $request){
        // $hotspot = HotspotMedia::where('tbl_hotspot_media.id', 1)
        //     ->selectRaw('tbl_hotspot_media.*,tbl_hotspots.order_id,tbl_hotspots.x_axis,tbl_hotspots.y_axis,tbl_hotspots.message')
        //     ->join('tbl_hotspots', 'tbl_hotspot_media.id', '=', 'tbl_hotspots.image_id')
        //     ->get();
        $hotspot = HotspotMedia::select('tbl_hotspot_media.*')
            // ->where('id', 1)
            ->with([
                'hotspots' => function ($query) {
                    $query->selectRaw('id,image_id, order_id, x_axis, y_axis, message, is_active')
                    ->where("is_active","=","1");
                }
            ])
            ->where("tbl_hotspot_media.is_active","=","1")
            ->orderBy('id', 'desc') 
            ->first();
            // ->get();
        //     DD($hotspot);
        // $hotspot = $hotspot[0];
        return view('website.home.hotspot',compact('hotspot'));
    }
    public function add_hotspot(Request $request){
        $imageName = '';
        if ($request->has('hotspot_image')) {
            $postData = $request->all();
            $hotspots = json_decode($request->hotspots, true);
            $imageName = time() . '.' . $request->hotspot_image->getClientOriginalExtension();
            $request->hotspot_image->move(public_path('uploads/hotspot_image'), $imageName);
            $data = [
                "media" => $imageName
            ];
            $HotspotMedia = HotspotMedia::create($data);
            if($HotspotMedia){
                $insertedId = $HotspotMedia->id;
                $hotspots = json_decode($request->hotspots, true); // true to convert to an associative array

                if (is_array($hotspots) && count($hotspots) > 0) {
                    foreach ($hotspots as $item) {
                        // Your logic here
                        $data = [
                            "image_id" => $insertedId,
                            "order_id" => $item['id'],
                            "x_axis" => $item['x'],
                            "y_axis" => $item['y'],
                            "message" => $item['text'],
                        ];
                        $Hotspot = Hotspot::create($data);
                    }
                    if($Hotspot){
                        return true;
                    }
                }else{
                    return true;
                }
            }
        }
        return false;
    }
    public function calendarEvents(Request $request)
    {
        // dd($request);
        // return $request->type;
        switch ($request->type) {
           case 'create':
            // dd("ji");
              $data = [
                  'event_id' => $request->event_id,
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ];
              $response = ApiHelper::apicall("home/add-event-calendar","POST",$data);
            //   $event = CrudEvents::create([
            //       'event_name' => $request->event_name,
            //       'event_start' => $request->event_start,
            //       'event_end' => $request->event_end,
            //   ]);
              return response()->json($response);
              break;
  
           case 'edit':
             $data = [
                  'event_id' => $request->id,
                  'event_name' => $request->title,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ];
            $response = ApiHelper::apicall("home/edit-event-calendar","POST",$data);
            
            return response()->json($response);
            //   $event = CrudEvents::find($request->id)->update([
            //       'event_name' => $request->event_name,
            //       'event_start' => $request->event_start,
            //       'event_end' => $request->event_end,
            //   ]);
             break;
  
           case 'delete':
            $data = [
                  'id' => $request->id
              ];
            $response = ApiHelper::apicall("home/delete-event-calendar","POST",$data);
            //   $event = CrudEvents::find($request->id)->delete();
            //   return response()->json($event);
            return response()->json($response);
             break;

           case 'listing':
            $data = [];
            $response = ApiHelper::apicall("home/list-event-calendar","POST",$data);
            //   $event = CrudEvents::find($request->id)->delete();
            //   return response()->json($event);
            return response()->json($response);
             break;
             
           default:
             # ...
             break;
        }
    }
}
