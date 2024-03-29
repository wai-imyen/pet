<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->page : 1;
        $limit = $request->has('limit') ? $request->limit : 10;

        $query = Pet::query();

        // filters
        if($request->has('gender')){
            $query->where('gender', '=', $request->gender);
        }
        if($request->has('area')){
            $query->where('area', '=', $request->area);
        }
        if($request->has('fix')){
            $query->where('fix', '=', $request->fix);
        }

        // sorts
        $sorts = ['name', 'gender', 'fix'];
        $order = $request->has('order') && ($request->order == 'asc' || $request->order == 'desc') ? $request->order : 'asc'; 
        $sort = $request->has('sort') && in_array($request->sort, $sorts) ? $request->sort : 'id'; 

        $pets = $query->orderBy($sort, $order)
        ->skip(($page-1) * $limit)
        ->take($limit)
        ->get();
        // ->pagination($limit);

        return $this->out(Response::HTTP_OK, $pets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Set user_id
        $request->request->add(['user_id' => Auth::user()->id]);

        // validate
        $validaion = $request->validate([
            'name' => 'required|max:32',
            'gender' => 'required|integer',
            'area' => 'nullable:max:32',
            'description' => 'required|max:255',
            'age' => 'required',
            'fix' => 'required',
        ]);

        $pet = Pet::create($request->all());
        return $this->out(Response::HTTP_OK, $pet, '新增成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return $this->out(Response::HTTP_OK, $pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        // check user permission
        $this->authorize('update', $pet);

        // validate
        $validaion = $request->validate([
            'name' => 'required|max:32',
            'gender' => 'required|integer',
            'area' => 'nullable:max:32',
            'description' => 'required|max:255',
            'age' => 'required',
            'fix' => 'required',
        ]);

        $pet->update($request->all());
        return $this->out(Response::HTTP_OK, $pet, '更新成功！');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        // check user permission
        $this->authorize('delete', $pet);

        $pet->delete();

        return $this->out(Response::HTTP_OK, null, '刪除成功！');
        
    }

    /**
     * 加入或刪除收藏
     */
    public function wishlist(Pet $pet)
    {
        $pet->wishlist()->toggle(Auth::user()->id);

        return $this->out(Response::HTTP_OK);
    }
}
