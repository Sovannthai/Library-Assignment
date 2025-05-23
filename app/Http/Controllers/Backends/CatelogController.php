<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Carbon\Carbon;
use App\Models\Catelog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class CatelogController extends Controller
{
    public function updateStatus(Request $request)
    {
        try {
            $status = $request->input('status') === 'true' ? '1' : '0';
            $catelog = Catelog::findOrFail($request->input('id'));
            $catelog->update(['status' => $status]);
            $output = [
                'success' => 1,
                'msg' =>trans('Status update successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return response()->json($output);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.catelog')) {
            abort(403, 'Unauthorized action.');
        }
        $catelogs = Catelog::when($request->status !== null, function ($query) use ($request) {
            $query->where('status', $request->status);
        })->latest()->paginate(10);
        if ($request->ajax()) {
            $view = view('backends.catelog_and_book.catelog._table', compact('catelogs'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.catelog_and_book.catelog.index',compact('catelogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }
    public function uploadImage($image)
    {
        $extension = $image->getClientOriginalExtension();
        $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $extension;
        $image->move(public_path('uploads/all_photo'), $imageName);
        return $imageName;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $catelog = new Catelog();
            $catelog->cate_code = $request->cate_code;
            $catelog->cate_name = $request->cate_name;
            $catelog->isbn = $request->isbn;
            $catelog->author_name = $request->author_name;
            $catelog->publisher = $request->publisher;
            $catelog->publishyear = $request->publishyear;
            $catelog->publish_edition = $request->publish_edition;
            if ($request->hasFile('photo')) {
                $catelog->photo = $this->uploadImage($request->file('photo'));
            }
            $catelog->save();
            $output = [
                'success'=>1,
                'msg'=>('Create successfully')
            ];
        }catch(\Exception $e){
            dd($e);
            $output = [
                'error'=>0,
                'msg'=>('Something went wrong')
            ];
        }
        return redirect()->route('catelog.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $catelog = Catelog::find($id);
            $catelog->cate_code = $request->cate_code;
            $catelog->cate_name = $request->cate_name;
            $catelog->isbn = $request->isbn;
            $catelog->author_name = $request->author_name;
            $catelog->publisher = $request->publisher;
            $catelog->publishyear = $request->publishyear;
            $catelog->publish_edition = $request->publish_edition;
            if ($request->hasFile('photo')) {
                $catelog->photo = $this->uploadImage($request->file('photo'));
            }
            $catelog->save();
            $output = [
                'success'=>1,
                'msg'=>('Update successfully')
            ];
        }catch(\Exception $e){
            dd($e);
            $output = [
                'error'=>0,
                'msg'=>('Something went wrong')
            ];
        }
        return redirect()->route('catelog.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $catelog = Catelog::find($id);
            $catelog->delete();
            $photoPath = public_path('uploads/all_photo/' . $catelog->photo);
            if (!empty($catelog->photo) && file_exists($photoPath)) {
                unlink($photoPath);
            }
            DB::commit();
            $output = [
                'success' => 1,
                'msg' =>('Deleted successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return redirect()->route('catelog.index')->with($output);
    }
}
