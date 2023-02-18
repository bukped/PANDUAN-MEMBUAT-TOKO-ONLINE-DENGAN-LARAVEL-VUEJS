<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::all();

        return view('pages.categories.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Category::all();
        return view('pages.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['category_name'] = $request->category_name;

        Category::create($data);

        Alert::alert('Create', 'Berhasil Menambahkan Category', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Category::findOrFail($id);

        return view('pages.categories.edit')->with([
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_name' => 'required'
            ]);

        $item = Category::findOrFail($id);
        $item->update($data);

        Alert::alert('Update', 'Berhasil Mengubah Data Category', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Category::findorfail($id);
            $item->delete();

            Alert::alert('Success', 'Berhasil Menghapus Category', 'success');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Alert::alert('Failed', 'Gagal Menghapus Category. hapus terlebih dahulu data product yang bersangkutan!', 'error');
            return redirect()->route('categories.index');
        }
    }
}
