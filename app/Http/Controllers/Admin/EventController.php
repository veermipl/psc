<?php

namespace App\Http\Controllers\Admin;

use App\Models\PSCEvent;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class EventController extends Controller
{
    use ImageTraits;
    public function create(){
        return view('admin.event.create');
    }
    public function store(Request $request){

        $this->authorize('resource_edit');
        $this->validate($request,[
            'title'  => 'required',
            'status' => 'required',
            'image'  => 'required|mimes:jpeg,jpg,png',
            'files*'  => 'required|mimes:jpeg,jpg,png',
        ]);
       
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $images = $file->store('/image/event', 'public');
        }

        $allFiles = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $filesKey => $fileValue) {
                $path = $fileValue->store('image/event', 'public');
                array_push($allFiles, $path);
            }
        }
        $files = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

            PSCEvent::create([
                'title' => $request->title,
                'image' => $images,
                'files' => $files,
                'date_time' => $request->date_time,
                'location' => $request->location,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.event.list')->with('success', 'Event Create');
            // dd('submit');

    }

    public function list(Request $request){
        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
        ];

        $list = PSCEvent::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('title'), function (Builder $q) use ($filterValues) {
                    $q->where('title', 'like', '%' . $filterValues['title'] . '%');
                })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        return view('admin.event.list', $data);

    }

    public function edit($id){
      $data =  PSCEvent::where('id', $id)->first();
         return view('admin.event.edit', compact('data'));
    }

    public function status(Request $request){
        $this->authorize('resource_status_edit');
            $user = PSCEvent::find($request->lid);
            $status = $request->lstatus == 1 ? '0' : '1';
            DB::transaction(function () use ($user, $status) {
                $user->update([
                    'status' => $status
                ]);
            });
            $data['error'] = false;
            $data['msg'] = 'Event status updated';
            return response()->json($data, 200);
    }

    public function delete($id){
        $this->authorize('membership_delete');
        $psc_delete = PSCEvent::find($id);
            $psc_delete->delete(); 

        $data['error'] = false;
        $data['msg'] = 'Event Deleted';

        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
    
            $this->authorize('member_edit');
             $this->validate($request,[
            'title'  => 'required',
            'status' => 'required',
            'image'  => 'nullable|mimes:jpeg,jpg,png',
            'files*'  => 'nullable|mimes:jpeg,jpg,png',
        ]);

               $allFiles = $request->old_files ?? [];
                if ($request->hasFile('files')) {
                    $files = $request->file('files');
                    foreach ($files as $fileKey => $fileValue) {
                        $path = $fileValue->store('image/event', 'public');
                        array_push($allFiles, $path);
                    }
           
                }

            $filess = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

            $event = PSCEvent::find($id);

            // dd( $event );
        
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $images  = $file->store('/media/press_release', 'public');
                }else{

                    $images = $event->image ;
                }
                $event->update([
                    'title' => $request->title,
                    'date_time' => $request->date_time,
                   'location' => $request->location,
                    'files' => $filess,
                    'status' => $request->status,
                    'image' => $images,
                ]);
           

            return redirect()->route('admin.event.list')->with('success', 'Event Updated');
        

    }


    public function deleteFile(Request $request)
    {
        $this->authorize('media_delete');

        $press_release = PSCEvent::findOrFail($request->id);
        $press_release_files = explode(',', $press_release->files);

        foreach ($press_release_files as $key => $value) {
            if ($value === $request['file_url']) {
                $this->deleteFromStorage('public', $request['file_url'], $isArray = false);
                unset($press_release_files[$key]);
            }
        }

        $press_release_files_new = (count($press_release_files) > 0) ? implode(',', $press_release_files) : '';

        DB::transaction(function () use ($press_release, $press_release_files_new) {
            $press_release->update([
                'files' => $press_release_files_new
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'File Deleted';

        return response()->json($data, 200);
    }


}
