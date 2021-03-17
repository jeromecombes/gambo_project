<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{

    public $error = 0;
    public $msg = '';


    /**
     * Show the form for adding the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $document_types = array_merge(array(''), explode(',', getenv('DOCUMENT_TYPES')));
        sort($document_types);

        return view('documents.add', compact('document_types'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                $doc->adminOnly = !empty($request->post('admin'.$i)) ? 1 : 0;
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
     * Get student photo
     *
     * @param  Int $student
     * @return String $img
     */

    public function get_photo(int $student)
    {
        $doc=Document::where('student', $student)
            ->where('rel', 'Photo')->first();

        if (!$doc) {
            return null;
        }

        if (!is_file(storage_path().'/app/'.$doc->path)) {
            return null;
        }

        $content = base64_encode(decrypt(Storage::get($doc->path)));
        $src = 'data: '.$doc->type.';base64,'.$content;

        return "<img src='$src' alt='Photo' style='width:200px;'/>\n";
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
            Storage::put($doc->path, $document);

            // Test / compare checksums
            $test = decrypt(Storage::get($doc->path));
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $doc = $this->get()->find($request->id);

        if (empty($doc)) {
            return view('documents.access_denied');
        }

        $content = decrypt(Storage::get($doc->path));

        header('Content-Disposition: inline; filename='.$doc->name);
        header('Content-type:'.$doc->type);
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        echo $content;
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

        $tmp = array();
        foreach ($document_types as $elem) {
            $tmp[$elem] = $elem;
        }

        $document_types = $tmp;

        return view('documents.edit', compact('documents', 'document_types'));
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

        foreach ($request->id as $id) {
            $doc = Document::findOrFail($id);
            $doc->name = encrypt($request->name[$id]);
            $doc->rel = $request->rel[$id];
            $doc->adminOnly = !empty($request->adminOnly[$id]) ? 1 : 0;
            $doc->save();
        }

        $msgType = "success";
        $message = "Documents have been successfully updated";

        return redirect('documents')->with($msgType, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $doc = Document::findOrFail($request->id);

        Storage::delete($doc->path);

        $doc->delete();

        $msgType = "success";
        $message = "Document have been successfully deleted";

        return redirect('documents')->with($msgType, $message);
    }

    /**
     * Retrieve documents for logged in or selected student
     *
     * @return \App\Document
     */
    private function get()
    {
        $student = session('student');

        // Retrieving documents
        if (session('admin')) {
            if ($student) {
                $documents = Document::where('student',$student)->get();
            } else {
                $semester = str_replace(' ', '_', session('semester'));
                $students = Student::where('semestre', $semester)->pluck('id')->toArray();
                $documents = Document::whereIn('student', $students)
                    ->select('documents.id', 'documents.name', 'documents.type', 'documents.type2', 'documents.size', 'documents.timestamp', 'documents.adminOnly')
                    ->withStudents()->get();
            }
        } else {
            $documents = Document::where('student',$student)->where('adminOnly', 0)->get();
        }

        return $documents;
    }

    /**
     * Old decrypt function
     *
     * @param  String $crypted_token
     * @param  String $key
     * @return String $decrypted_token
     */
    public function old_decrypt(String $crypted_token, String $key=null)
    {
        if($crypted_token === null){
            return null;
        }

        $decrypted_token = false;

        if(preg_match("/^(.*)::(.*)$/", $crypted_token, $regs)) {
            // decrypt encrypted string
            list(, $crypted_token, $enc_iv) = $regs;
            $enc_method = 'AES-128-CTR';
            $enc_key = openssl_digest($key.'1A30FA887BF404DA8B8477B1', 'SHA256', TRUE);
            $decrypted_token = openssl_decrypt($crypted_token, $enc_method, $enc_key, 0, hex2bin($enc_iv));
            unset($crypted_token, $enc_method, $enc_key, $enc_iv, $regs);
        }
        return $decrypted_token;
    }

    /**
     * Export all files for selected semester
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export_all(Request $request)
    {
        ini_set('max_execution_time', 300);

        $semester = $request->semester;

        $doc = Document::where('students.semesters', 'like', "%$semester%")
            ->select('documents.id', 'documents.name', 'documents.type', 'documents.type2', 'documents.size', 'documents.timestamp', 'documents.adminOnly')
            ->withStudents()
            ->orderBy('students.lastname', 'asc', 'students.firstname', 'asc')
            ->get();

        echo "<table>\n";
        foreach ($doc as $d) {
            echo "<tr><td>".$d->lastname.'</td><td>'.$d->firstname.'</td><td>'.$d->name.'</td><td>'.$d->rel.'</td><td>'.$d->type.'</td><td>'.$d->path.'</td>';

            if (!is_file(storage_path().'/app/'.$d->path)) {
                echo "<td>File doesn't exist !</td></tr>\n";

                if ($request->delete) {
                    Storage::delete($d->path);
                    $d->delete();
                    echo "<td>File removed from database</td>";
                }

                continue;
            }

            switch ($d->type) {
                case 'application/pdf'          : $ext = '.pdf';   break;
                case 'application/download'     : $ext = '.ods';   break;
                case 'image/jpeg'               : $ext = '.jpeg';   break;
                default                         : $ext = null;      break;
            }

            $semester = str_replace(' ', '_', $semester);
            $path = "export/".$semester.'/'.$d->lastname.'_'.$d->firstname.'/'.$d->name.'_'.$d->id.$ext;

            $content = decrypt(Storage::get($d->path));
            Storage::put($path, $content);

            echo "<td>Exported in $path</td>";

            if ($request->delete) {
                Storage::delete($d->path);
                $d->delete();
                echo "<td>Originl file destroyed</td>";
            }

            echo "</tr>\n";
        }
        echo "<table>\n";
    }

}
