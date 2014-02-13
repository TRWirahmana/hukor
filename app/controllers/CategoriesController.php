<?php

class CategoriesController extends BaseController {

	protected $layout = "layouts.admin";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return datatable data on ajax request
		if(Request::ajax())
			return Datatables::of(Category::select("id", "nama_kategori", "created_at"))->make(true);

        $this->layout->content = View::make('categories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->layout->content = View::make('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				"nama_kategori" => "required"
			),
			array(
				"nama_kategori.required" => "Nama kategori tidak boleh kosong"
			)
		);

		if($validator->fails()) 
		{
			return Redirect::route("admin.categories.create")->withErrors($validator);
		} 
		else 
		{
			$category = new Category;
			$category->nama_kategori = Input::get("nama_kategori");
			$category->created_at = new DateTime("now");
			$category->updated_at = new DateTime("now");
			if($category->save()) {
				return Redirect::route("admin.categories.index")
					->with("success", "Kategori berita berhasil ditambahkan");
			}
			else
			{
				return Redirect::route("admin.categories.index")
					->with("error", "Kategori berita gagal ditambahkan");
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('categories.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::find($id);
		if(null == $category) {
			return Redirect::route("admin.categories.index")
				->with('error', 'Kategori tidak ditemukan');
		}

        $this->layout->content = View::make('categories.edit')
        	->with('category', $category);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(
			Input::all(),
			array(
				"nama_kategori" => "required"
			),
			array(
				"nama_kategori.required" => "Nama kategori tidak boleh kosong"
			)
		);

		if($validator->fails()) 
		{
			return Redirect::route("admin.categories.edit")->withErrors($validator);
		} 
		else 
		{
			$category = Category::find($id);
			$category->nama_kategori = Input::get("nama_kategori");
			$category->updated_at = new DateTime("now");
			if($category->save()) {
				return Redirect::route("admin.categories.index")
					->with("success", "Kategori berita berhasil diubah");
			}
			else
			{
				return Redirect::route("admin.categories.index")
					->with("error", "Kategori berita gagal ditambahkan");
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		if(null != $category)
			$category->delete();
		echo 1;
	}

}
