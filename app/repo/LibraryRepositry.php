<?php

namespace App\repo;

use App\Http\Traits\attachfiletrait;
use App\Models\grades\grades;
use App\Models\library;

class LibraryRepositry implements LibraryRepositryInterface
{
    use attachfiletrait;
    public function index()
    {
        $books = library::all();
        return view('library.index', compact('books'));
    }
    public function create()
    {
        $grades = grades::all();
        return view('library.create', compact('grades'));
    }
    public function store($request)
    {
        // 27:00 video 43


        $books = new library();
        $books->title = $request->title;
        $books->file_name =  $request->file('file_name')->getClientOriginalName();
        $books->grade_id = $request->Grade_id;
        $books->classroom_id = $request->Classroom_id;
        $books->section_id = $request->section_id;
        $books->teacher_id = 3;
        $books->save();
        // 34:26 video 43
        $this->uploadFile($request, 'file_name','library');

        return redirect()->route('library.index');
    }
    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' . $filename));
    }
    public function edit($id)
    {
        $grades = grades::all();
        $book = library::find($id);

        return view('library.edit', compact('grades', 'book'));
    }

    public function update($request)
    {
        // 42:00 video 43



            $book = library::findOrFail($request->id);
            $book->title = $request->title;

            if ($request->hasfile('file_name')) {

                $this->deleteFile($book->file_name,'library');

                $this->uploadFile($request, 'file_name','library');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 3;
            $book->save();
            return redirect()->route('library.index');



    }
    public function destroy($request)
    {
        $this->deleteFile($request->file_name ,'library');
        library::destroy($request->id);
        return redirect()->back();
    }
}
