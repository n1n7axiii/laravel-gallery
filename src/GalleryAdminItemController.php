<?php namespace N1n7aXIII\Gallery;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use N1n7aXIII\Gallery\Model\GalleryItem;
use N1n7aXIII\Gallery\Model\GalleryCategory;
use N1n7aXIII\Gallery\Requests\GalleryItemRequest;

use Illuminate\Http\Request;

class GalleryAdminItemController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
     * @param GalleryCategory $category
	 * @return Response
	 */
	public function create(GalleryCategory $category)
	{
		return view('gallery::admin.item.create', compact('category'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param GalleryCategory $category
     * @param GalleryItemRequest $request
	 * @return Response
	 */
	public function store(GalleryCategory $category, GalleryItemRequest $request)
	{
		$item = new GalleryItem;
        $item->category()->associate($category);
        $this->storeOrUpdateItem($category, $item, $request);
        return redirect()->route('admin.gallery.category.show', $category->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
     * @param GalleryCategory $category
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(GalleryCategory $category, $id)
	{
        $item = GalleryItem::find($id);
		return view('gallery::admin.item.edit', compact('category', 'item'));
	}

	/**
	 * Update the specified resource in storage.
	 *
     * @param GalleryCategory $category
	 * @param  int  $id
     * @param GalleryItemRequest $request
	 * @return Response
	 */
	public function update(GalleryCategory $category, $id, GalleryItemRequest $request)
	{
        $item = GalleryItem::find($id);
        $this->storeOrUpdateItem($category, $item, $request);
        return redirect()->route('admin.gallery.category.show', $category->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
     * @param GalleryCategory $category
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(GalleryCategory $category, $id)
	{
        $item = GalleryItem::find($id);
        $this->deleteOldImageSet(config('gallery.gallery_path').'/'.$category->id.'/', $item);
        $item->delete();
        if (\Request::ajax())
            return '';
        return redirect()->route('admin.gallery.category.show', $category->id);
	}

    protected function storeOrUpdateItem($category, $item, Request $request)
    {
        $item->title = $request->get('title');
        $item->description = $request->get('description');
        if (!$item->position)
            $item->position = $category->items()->count() + 1;
        $item->highlight = ($request->has('highlight')) ? 1 : 0;

        $img_dir = config('gallery.gallery_path').'/'.$category->id.'/';
        $image = $request->file('image');
        if ($image && $image->isValid())
        {
            if ($item->image)
                $this->deleteOldImageSet($img_dir, $item);
            $img_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $img_thumb = \Image::make($image)->fit(config('gallery.item_thumb_width'), config('gallery.item_thumb_height'));
            $img = \Image::make($image)->fit(config('gallery.item_max_width'), config('gallery.item_max_height'), function($constraint) {
                $constraint->upsize();
            });
            if (file_exists($img_dir.$img_name.'.'.$image->getClientOriginalExtension()))
                $img_name = $img_name.'-'.str_random(10);
            $img_thumb->save($img_dir.$img_name.'-thumb.'.$image->getClientOriginalExtension(), 80);
            $img->save($img_dir.$img_name.'.'.$image->getClientOriginalExtension(), 80);
            $item->image = $img_name.'.'.$image->getClientOriginalExtension();
        }

        $item->save();
    }

    protected function deleteOldImageSet($path, $item)
    {
        if (!preg_match('/\/$/', $path))
            $path .= '/';
        if (file_exists($path.$item->image))
            unlink($path.$item->image);
        if (file_exists($path.$item->thumbnail()))
            unlink($path.$item->thumbnail());
    }

}
