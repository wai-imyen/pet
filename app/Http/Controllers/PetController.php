<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
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
        
        $pet->delete();

        return $this->out(Response::HTTP_OK, null, '刪除成功！');
        
    }
}
