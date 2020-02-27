<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Gate;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-books'))return $next($request);

            abort(403, 'Anda tidak memiliki hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $status = $req->status;
        $kw = $req->keyword ? $req->keyword:'';

        if(isset($status)){
            $books = Book::with('categories')->where('title', "LIKE", "%$kw%")->where('status', strtoupper($status))->paginate(10);
        }else{
            $books = Book::with('categories')->where('title', "LIKE", "%$kw%")->paginate(10);
        }

        
        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // simpan data
        // var_dump($_POST);
        // var_dump($_FILES);
        // exit();

        $new_book = new Book;
        $new_book->title = $request->title;
        $new_book->description = $request->description;
        $new_book->author = $request->author;
        $new_book->publisher = $request->publisher;
        $new_book->price = $request->price;
        $new_book->stock = $request->stock;

        $new_book->status = $request->save_action;

        // $cover_book = $request->file('cover');
        // if($cover_book){
        //     $cover_path = $cover_book->store('book-covers', 'public');
        //     $new_book->cover = $cover_book;
        // }

        if($request->file('cover')){
            $path = $request->file('cover')
                            ->store('book_covers', 'public');
            $new_book->cover = $path;
        }

        $new_book->slug = \Str::slug($request->get('title'));
        $new_book->created_by = \Auth::user()->id;

        
        $new_book->save();
        $new_book->categories()->attach($request->categories);

        if($request->get('save_action') == 'PUBLISH'){
            return redirect()
                ->route('books.index')
                ->with('status', 'Book succesfully save and published');
        }else{
            return redirect()
                ->route('books.index')
                ->with('status', 'Book saved as draft');
        }
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
        // return "edit dengan id" . $id;
        $book = Book::findOrFail($id);
        return view('books.edit', ['book' => $book]);
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
        $book = Book::findOrFail($id);

        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->stock = $request->stock;
        $book->price = $request->price;
        
        if($request->hasFile('cover')){
            if($book->cover && file_exists(storage_path('app/public/' . $book->cover))){
                \Storage::delete('public/' . $book->cover);
            }
            $path = $request->cover->store('book-covers', 'public');
            $book->cover = $path;
        }

        $book->updated_by = \Auth::user()->id;
        $book->status = $request->status;
        $book->save();

        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('status', 'Book succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('status', 'Book has been moving to trash');
    }

    public function trash(){
        
        // return "ini sampah";
        
        $books = Book::onlyTrashed()->paginate(10);
        return view('books.trash', ['books' => $books]);
    }

    public function restore($id){
        $book = Book::withTrashed()->findOrFail($id);

        if($book->trashed()){
            $book->restore();
            return redirect()->route('books.index')->with('status', 'Book successfullt restored');
        }else{
            return redirect()->route('books.trash')->with('status', 'book isnt in trash');
        }
    }

    public function deletePermanent($id){
        $book = Book::withTrashed()->findOrFail($id);

        if(!$book->trashed()){
            return redirect()->route('books.trash')->with('status', 'Book is not in trash')->with('status_type', 'alert');
        }else{
            $book->categories()->detach();
            $book->forceDelete();

            return redirect()->route('books.index')->with('status', 'Book Permanently deleted!');
        }
    }
}
