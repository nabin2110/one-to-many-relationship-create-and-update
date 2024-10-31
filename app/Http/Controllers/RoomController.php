<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(){
        $records = Room::with('roomFacilities')->paginate(10);
        return view('rooms.index',compact('records'));
    }
    public function create(){
        return view('rooms.create');
    }
    public function store(Request $request){
        DB::beginTransaction();
       try{
        $room_created = Room::create($request->all());
        if($room_created){
            $names = $request->name ?? [];
            // dd($names);
            if(isset($names) && count($names) >0){
                foreach($names as $name){
                    if($name){
                        RoomFacility::create(
                            [
                                'room_id'=>$room_created->id,
                                'name'=>$name
                            ]
                            );
                    }
                }
            }
        }
        DB::commit();
        return redirect()->route('rooms.index');
       }
       catch(\Exception $exception){
        DB::rollBack();
            return redirect()->back();
       }
    }
    public function edit($id){
        $data['record'] = Room::with('roomFacilities')->findOrfail($id);
        return view('rooms.edit',compact('data'));
    }
    public function roomFacilityDelete(Request $request){
        $id = $request->id;
        $facility = RoomFacility::findOrFail($id);
        $facility->delete();
    }
    public function update(Request $request,$id){
        DB::beginTransaction();
        // dd($request->name_ids,$request->name);
        try{
            $names = $request->name ?? [];
            $names_ids = $request->name_ids ?? [];
            $data['record'] = Room::with('roomFacilities')->findOrFail($id);
            $data_updated = $data['record']->update($request->all());
            if($data_updated){
                foreach($names as $key => $name){
                    if(isset($names_ids[$key]) && $names_ids[$key]){
                        $facility = $data['record']->roomFacilities()->findOrFail($names_ids[$key]);
                        if($facility)
                            $facility->update(['name'=>$name]);
                    }else{
                        if($name){
                            $data['record']->roomFacilities()->create(['name'=>$name]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('rooms.index');
        }
        catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
