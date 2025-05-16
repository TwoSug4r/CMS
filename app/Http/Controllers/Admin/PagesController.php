<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkWithPage;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdminOrEditor()) {
            $pages = Page::defaultOrder()->paginate(5); 
        }
        else {
            $pages = Auth::user()->pages()->paginate(5);
        }
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create')->with([
            'model' => new Page(),
            'orderPages' => Page::defaultOrder()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkWithPage $request)
    {
        Auth::user()->pages()->save(new Page($request->only([
            'title','url','content'])));

        $this->updatePageOrder($page, $request);

        return redirect()->route('pages.index')->with('status', 'The page has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        if (Auth::user()->cant('update', $page)) {
            return redirect()->route('pages.index');
        } 

        return view('admin.pages.edit', [
            'model' => $page,
            'orderPages' => Page::defaultOrder()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkWithPage $request, Page $page)
    {
        if (Auth::user()->cant('update', $page)) {
            return redirect()->route('pages.index');
        } 

        if ($response = $this->updatePageOrder($page, $request)){
            return $response;
        }

        $page->fill($request->only(['title','url','content']));

        $page->save();
        return redirect()->route('pages.index')->with('status', 'The page has been updated.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if (Auth::user()->cant('delete', $page)) {
            return redirect()->route('pages.index');
        } 

        $page->delete();

        return redirect()->route('pages.index')->with('status', 'The page was deleted.');
    }

    protected function updatePageOrder(Page $page, Request $request){
        if ($request->has('order')){
            if($page->id == $request->orderPage){
                return redirect()->route('pages.edit', ['page'=>$page->id])
                ->withInput()->withErrors(['error'=>'Cannot order page against it self.']);
            }

            $page->updateOrder($request->order, $request->orderPage);
        }
    }
}
