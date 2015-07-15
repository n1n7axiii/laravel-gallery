<?php namespace N1n7aXIII\Gallery;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use N1n7aXIII\Gallery\Model\GalleryCategory;
use N1n7aXIII\Gallery\Requests\GalleryCategoryRequest;

use Illuminate\Http\Request;

class GalleryAdminCategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = GalleryCategory::all();
		return view('gallery::admin.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gallery::admin.category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param GalleryCategoryRequest $request
	 * @return Response
	 */
	public function store(GalleryCategoryRequest $request)
	{
		$category = new GalleryCategory;
        $this->storeOrUpdateCategory($category, $request);
        return redirect()->route('admin.gallery.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $category = GalleryCategory::find($id);
        return view('gallery::admin.category.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $category = GalleryCategory::find($id);
        return view('gallery::admin.category.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
     * @param GalleryCategoryRequest $request
	 * @return Response
	 */
	public function update($id, GalleryCategoryRequest $request)
	{
        $category = GalleryCategory::find($id);
        $this->storeOrUpdateCategory($category, $request);
        return redirect()->route('admin.gallery.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $category = GalleryCategory::find($id);
        \File::deleteDirectory(config('gallery.gallery_path').'/'.$category->id.'/');
        $category->delete();
        if (\Request::ajax())
            return '';
        return redirect()->route('admin.gallery.index');
	}

    protected function storeOrUpdateCategory(GalleryCategory $category, $request)
    {
        $category->name = $request->get('name');
        $category->alias = (str_replace(' ', '-', strtolower($request->get('alias')))) ?: str_replace(' ', '-', strtolower($request->get('name')));
        if (!$category->position)
            $category->position = (GalleryCategory::all()->count()) + 1;
        $category->save();

        $img_dir = config('gallery.gallery_path').'/'.$category->id.'/';
        if (!file_exists($img_dir))
            mkdir($img_dir, 0777, true);

        if ($request->hasFile('thumbnail'))
        {
            $thumb = $request->file('thumbnail');
            if ($thumb->isValid())
            {
                $img_name = 'cat-thumb.'.$thumb->getExtension();
                $img = \Image::make($thumb)->fit(config('gallery.category_thumb_width'), config('gallery.category_thumb_height'));
                if (file_exists($img_dir.$category->thumbnail))
                    unlink($img_dir.$category->thumbnail);
                $category->thumbnail = $img_name;
                $img->save($img_dir.$img_name, 80);
            }
        }
        if ($request->has('description'))
            $category->description = $request->get('description');
        $category->save();
        return true;
    }

}
