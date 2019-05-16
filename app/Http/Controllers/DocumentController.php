<?php

namespace App\Http\Controllers;

use App\Document;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{

    public $error = 0;
    public $msg = '';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = $this->get();
        return view('documents.index', compact('documents'));
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
        // New uploads
        $files = array();

        for ($i=0; $i<5; $i++) {
            $file = $request->file('file'.$i);
            if ($file) {

                // Store file in tmp directory
                $filename = Str::random(32);
                $file->storeAs('tmp',$filename);
                
                // Store temporary information in database
                $doc = new Document;
                $doc->name = $filename;
                $doc->realname = $filename;
                $doc->student = $request->student;
                $doc->rel = $request->post('rel'.$i) ? $request->post('rel'.$i) : 'Other';
                $doc->save();
                
                $files[] = $filename;
            }
        }

        // If no file selected
        if (empty($files)) {
            $this->error = 1;
            $error = "No file selected";
            $this->msg[] = $error;
            Log::error($error);

        // If files selected, store information in DB, encrypt files and move them to the permanent directory
        } else {
            // Get files information
            $this->get_files_information($files);

            // Encrypt files
            $this->encrypt($files);
        }

        // Retrieve student documents to return index view
//         $documents = $this->get();

        // Messages
        if ($this->error) {
            $msgType = "warning";
            $message = implode("<br/>", $this->msg);
        } else {
            $msgType = "success";
            $message = "Documents have been successfully uploaded";
        }

        return redirect('documents')->with($msgType, $message);
    }

    /**
     * Get information on files stored in tmp folder
     *
     * @param  Array $files
     */
    public function get_files_information($files)
    {
        foreach($files as $file) {

            // Get information from DB
            $doc = Document::where('name', $file)->first();

            // If the file is not in the tmp dir, delete it from DB and continue
            if ( !is_file(storage_path('app/tmp').'/'.$file)) {
                if (!empty($doc)) {
                    $doc->delete();
                }
                continue;
            }

            // Get file information
            $type = Storage::mimeType('tmp/'.$file);
            $size = Storage::size('tmp/'.$file);
            $timestamp = Storage::lastModified('tmp/'.$file);

            // If the file is not in the database, deleting
            if (empty($doc)) {
                Storage::delete('tmp/'.$file);
                continue;
            }

            $doc_id = $doc->id;
            $rel = $doc->rel;
            $student_id = $doc->student;

            $student = Student::find($student_id);
            $student_name = $student->lastname.'_'.$student->firstname;

            // Rename file with relation and student name
            if (empty($rel)) {
                $rel = "Other";
            }

            $count = '_'.(Document::where('student',$student_id)->where('rel', $rel)->count() +1);
            if ($count == '_1') {
                $count = null;
            }

            $name = $rel."_".$student_name.$count;

            $doc->name = encrypt($name);
            $doc->size = encrypt($size);
            $doc->timestamp = $timestamp;
            $doc->type = encrypt($type);
            $doc->save();
        }
    }

    /**
     * Encrypt files and save them in the right folder
     *
     * @param  Array $files
     */

    public function encrypt($files)
    {
        foreach($files as $filename) {

            $doc = Document::where('realname', $filename)->first();

            $file = storage_path('app/tmp').'/'.$filename;

            // If the file is not in the tmp dir : continue
            if ( !is_file($file)) {
                continue;
            }

            // Original checksum
            $checksum1 = md5_file($file);

            // If checksum error, keep the file in the tmp folder without encryption
            if (empty($checksum1)) {
                $this->error = 1;
                $error = "Can't check the file \"$filename\". It won't be saved !";
                $this->msg[] = $error;
                Log::error($error);

                Storage::delete('tmp/'.$filename);
                $doc->delete();

                continue;
            }

            // Encrypt the file
            $document = encrypt(Storage::get('tmp/'.$filename));

            // Store the encrypted file
            Storage::put(date('Y/m/', $doc->timestamp).$doc->id, $document);

            // Test / compare checksums
            $test = decrypt(Storage::get(date('Y/m/', $doc->timestamp).$doc->id));
            $checksum2 = md5($test);

            if ($checksum1 != $checksum2) {
                $this->error = 1;
                $error = "Can't encrypt the file \"$filename\" ! It won't be saved !";
                $this->msg[] = $error;
                Log::error($error);

                Storage::delete('tmp/'.$filename);
                $doc->delete();

                continue;

            } else {
                Storage::delete('tmp/'.$filename);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $documents = $this->get();
        
        $document_types = array_merge(array(''), explode(',', getenv('DOCUMENT_TYPES')));
        sort($document_types);

        $student = !empty($_SESSION['vwpp']['student']) ? $_SESSION['vwpp']['student'] : 0;

        return view('documents.edit', compact('documents', 'document_types', 'student'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    /**
     * Retrieve documents for logged in or selected student
     *
     * @param  int $student (optional student ID)
     * @return \App\Document
     */
    private function get(int $student = 0)
    {
        $admin = $_SESSION['vwpp']['category'] == 'admin';

        if (!$admin) {
            $student = $_SESSION['vwpp']['student'];
        }

        // Retrieving documents
        if ($admin) {
            $documents = Document::where('student',$student)->where('timestamp', '>', 1557927192)->get();
        } else {
            $documents = Document::where('student',$student)->where('timestamp', '>', 1557927192)->where('adminOnly', 0)->get();
        }
        
        return $documents;
    }

    /**
     * Show a document
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $doc = $this->get()->find($request->id);

        if (empty($doc)) {
            return view('documents.access_denied');
        }

        $folder = date('Y/m/', $doc->timestamp);
        $file = $folder.$doc->id;
        $content = decrypt(Storage::get($file));

        header('Content-Disposition: inline; filename='.$doc->name);
        header('Content-type:'.$doc->type);
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        echo $content;
    }

}