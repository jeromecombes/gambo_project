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
        //Initialize Laravel session with old session

        $admin = $_SESSION['vwpp']['category'] == 'admin';
        $request->session()->put('admin', $admin);

        $student = !empty($_SESSION['vwpp']['student']) ? $_SESSION['vwpp']['student'] : null;

        if (!empty($request->student)) {
            $student = $request->student;
            $_SESSION['vwpp']['std-id'] = $student;
        }

        $_SESSION['vwpp']['student'] = $student;

        $request->session()->put('access', $_SESSION['vwpp']['access']);
        $request->session()->put('login_name', $_SESSION['vwpp']['login_name']);
        $request->session()->put('semester', $_SESSION['vwpp']['semestre']);
        $request->session()->put('student', $student);

        if ($student) {
            $std = Student::find($student);
            $request->session()->put('student_name', $std->full_name);
        }

        if (!empty($_SESSION["vwpp"]["studentsList"])) {
            $students_list = $_SESSION["vwpp"]["studentsList"];
            $request->session()->put('students_list', $students_list);

            $key = array_search($student, $students_list);
            $student_previous = array_key_exists($key-1, $students_list) ? $students_list[$key-1] : null;
            $student_next = array_key_exists($key+1, $students_list) ? $students_list[$key+1] : null;
            $request->session()->put('student_previous', $student_previous);
            $request->session()->put('student_next', $student_next);
        }

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
                $semester = session('semester');
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
     * Convert old documents
     *
     */
    public function convert()
    {
//         echo $this->convert_files();
//  TODO : before converting the DB, comment all lines in Document's Model
//         $this->convert_db();
    }
 
    /**
     * Convert old documents
     *
     */
    public function convert_db()
    {
        $doc=Document::all();
        
        echo "count : ".$doc->count();
        echo "<br><br>";

        foreach ($doc as $d) {
        
            $name = $this->old_decrypt($d->name, $d->student);
            $size = $this->old_decrypt($d->size, $d->student);
            $type = $this->old_decrypt($d->type, $d->student);
            $realname = $this->old_decrypt($d->realname, $d->student);
            $type2 = $this->old_decrypt($d->type2, $d->student);
            
            echo "$name / $size / $type <br/>";
            if (empty($name)) {
                echo "Error : Empty name<br/>";
                continue;
            }

            $d->name = encrypt($name);
            $d->size = encrypt($size);
            $d->type = encrypt($type);
            $d->realname = encrypt($realname);
            $d->type2 = encrypt($type2);
            $d->save();
 
        }
        
    }

    /**
     * Convert old documents
     *
     */
    public function convert_files()
    {
        $start = 2012;
        $end = 2019;

        ini_set('max_execution_time', 300);

        $i = 0;

        for ($year=$start; $year<=$end; $year++) {

            $folder_year = app_path().'/../documents/'.$year;

            if (!is_dir($folder_year) or $folder_year == '.' or $folder_year == '..') {
                continue;
            }

            echo "Scanning $folder_year<br/><br/>";
            $folders_months = scandir($folder_year);
//             print_r($folders_months);
//             echo "<br/><br/>";

            foreach ($folders_months as $folder) {
                $folder_month = $folder_year.'/'.$folder;

                if (!is_dir($folder_month) or $folder == '.' or $folder == '..') {
                    continue;
                }

                echo "Scanning $folder_month<br/><br/>";
                $files = scandir($folder_month);
//                 print_r($files);
//                 echo "<br/><br/>";

                foreach ($files as $file) {
                    $original_file = $folder_month.'/'.$file;

                    if (!is_file($original_file)) {
                        continue;
                    }

                    echo "Decrypt $original_file<br/><br/>";

                    $doc=Document::find($file);
                    if (!$doc) {
                        echo "$file not found in DB<br/><br/>";
                        continue;
                    }

                    if (file_exists(storage_path('app/').$doc->path)) {
//                         echo storage_path('app/').$doc->path." Already exists<br/><br/>";
                        continue;
                    }

                    $content = $this->old_decrypt(file_get_contents($original_file), $doc->student);

                    // Original checksum
                    $checksum1 = md5($content);

                    // If checksum error, keep the file in the tmp folder without encryption
                    if (empty($checksum1)) {
                        echo "Can't check the file \"$original_file\" !<br/><br/>";
                        continue;
                    }

                    // Encrypt the file
                    $document = encrypt($content);

                    // Store the encrypted file
                    Storage::put($doc->path, $document);

                    // Test / compare checksums
                    $test = decrypt(Storage::get($doc->path));
                    $checksum2 = md5($test);

                    if ($checksum1 != $checksum2) {
                        echo "Can't encrypt the file \"$original_file\" !<br/><br/>";
                        continue;
                    }

                    $i++;
                    if ($i >= 100) {
                        return "100 files converted";
                    }
                }
            }         
        }

        return "done";
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
