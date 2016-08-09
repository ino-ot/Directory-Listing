<?php
/*
Directory Listing by ino_ot for Dracos Linux
Site : merahputih.info
Email : ino_ot@dracos-linux.org | info@merahputih.info
Thx to : DracOs Linux, Indonesian Backtrack Team, eztech.co.id, ECHO, Devilzc0de, And All Friends
OPEN SOURCE DIRECTORY LISTING
*/
class DirListingDracos
{
     
        //StackOverFlowSources Account Teffi
        function UkuranFile($bytes)
        {
            $Satuan = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
            for( $a = 0; $bytes >= 1024 && $a < ( count( $Satuan ) -1 ); $bytes /= 1024, $a++ );
            return( round( $bytes, 2 ) . " " . $Satuan[$a] );
        }
 
        //php.net by Gizmo http://php.net/manual/kr/function.is-file.php
        function Directorynya($path){
        exec('[ -f "'.$path.'" ]', $tmp, $ret);
        return $ret == 0;
        }
     	 //ca dot redwood at gmail dot com //http://php.net/manual/kr/function.is-file.php#90468
        function FileOrDirectory($file){
		    return preg_match('/^[^.^:^?^\-][^:^?]*\.(?i)' . $this->ExtensiValid() . '$/',$file);
		}
		//ca dot redwood at gmail dot com //http://php.net/manual/kr/function.is-file.php#90468
		function ExtensiValid(){
		    //list acceptable file extensions here
		    return '(iso|html|avi|pdf|mp3|jpg|jpeg)';
		} 

		function BannedFile($file){
			return preg_match('/^[^.^:^?^\-][^:^?]*\.(?i)' . $this->fileBanned() . '$/',$file);
		}

		function fileBanned()
		{
		    //list banned file extensions here
		    return '(html|aspx|php)';
		}


        //http://www.web-development-blog.com
        function DownloadFile()
        {
        $GetDIRname=(isset($_GET['DirOpen']) ? $_GET['DirOpen'] : null);
        
        $getcwd = getcwd();
        if($GetDIRname=='')
        {
        $dir = $getcwd;
        }
        else
        {
        $dir = $GetDIRname; 
        }
        if (!file_exists('log')) {
			touch('log', 0777, true);
		}

        echo "<script>alert('$dir')</script>";
 
        ignore_user_abort(true);
        set_time_limit(0); // disable the time limit for this script
          
        $path = $dir."/"; // change the path to fit your websites document structure
          
        $dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['FileDownload']); // simple file name validation
        $dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
        $fullPath = $path.$dl_file;
          
        if ($fd = fopen ($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                break;
                // add more headers for other content types here
                default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                break;
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        // http://stackoverflow.com/questions/7005267/host-file-log-download-and-host-stats-via-php
        $hellofile = file_get_contents('log');
        $infofile = json_decode($hellofile,true);
        if(isset($infofile[$fullPath])){
            $infofile[$fullPath]++;
        }else{
            $infofile[$fullPath]=1;
        }
        $hellofile=json_encode($infofile);
        $h=fopen('log','c');// If $h is false, you couldn't open the file
        flock($h,LOCK_EX);// lock the file
        $b=fwrite($h,$hellofile);// if $b is not greater than 0, nothing was written
        flock($h,LOCK_UN);
        fclose($h);
            /*$hellofile ="log";
            $current = file_get_contents($hellofile);
            $current .= $dir."/".$dl_file."\n";
            $f=fopen($hellofile, 'w+');
            fwrite($f, $current + 1);
            file_put_contents($hellofile, $current);
        fclose ($fd);*/
        exit;
        }
     
    function indexFile()
    {
        $GetDIRname=(isset($_GET['DirOpen']) ? $_GET['DirOpen'] : null);
        
        $getcwd = getcwd();
        if($GetDIRname=='')
        {
        $dir = $getcwd;
        }
        else
        {
        $dir = $GetDIRname; 
        }

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>DracOs Linux Directory Listing - <?php echo $dir; ?></title>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
        	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>
        	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#TabelNya').DataTable({
                    "paging":   false,
                    "info":     false,
                    "searching": false
                } );
            } );
            </script>
            <style type="text/css">
                #header {
                background: #363636 none repeat scroll 0% 0%;
                height: 5em;
                padding: 10px 0px 0px;
                min-height: 5.3em;
                margin: -10px -10px 10px -10px;
                padding: 4px 8px 20px 6px;
                position: relative;
               }

               #footer{
               	font-family: arial;
               	text-align: center;
              	margin: 30px;
              	}

              	a{
              		color: #000;
              		text-decoration: none;	
              	}
              	a:hover{
              		color: #02005A;
              		text-decoration: underline;
              		font-weight: bold;
              	}
            </style>
        </head>
        <body style="background:#FFF;">
        <div id="header">
            <img src="http://dracos-linux.org/images/logo.png" style="margin-top: 25px; margin-left: 25px;">
        </div>
        <table id="TabelNya" style="font-family: arial; font-size: 12px;" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>File</th><th>Size</th><th>MD5</th><th>Hits Download</th><th>Last Modified</th><th>Download</th>
                </tr>
            </thead>
            <?php
            // Open a directory, and read its contents
            if (is_dir($dir)){
              if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    $FileorNo = $this->Directorynya($file);

                        //if ($file != $this->BannedFile($file)) {
                    	if ($file == $this->BannedFile($file) && $file != "checksum" && $file != "log"){
                         ?>
                         <tr>
                            <td><?php echo $file; ?></td>
                            <td><?php echo $this->UkuranFile(filesize($dir."/".$file)); ?></td>
                            <td><?php
		                            if (!file_exists('checksum')) {
										touch('checksum', 0777, true);
									}
									if (!file_exists('log')) {
										touch('log', 0777, true);
									}
									$string = file_get_contents("checksum");
									$md5 = '';
									if(!empty($string)) {
										$jsonIterator = new RecursiveIteratorIterator(
										    new RecursiveArrayIterator(json_decode($string, TRUE)),
										    RecursiveIteratorIterator::SELF_FIRST);
										$dirFile = getcwd()."/".$file;
										
										foreach ($jsonIterator as $key => $val) {
											if($key == $dirFile) {
										        $md5 = $val;
										        break;
										    }
										}
									}

									if(empty($md5)) {
										$getcwd = getcwd();
								        if($GetDIRname=='')
								        {
								        $dir = $getcwd;
								        }
								        else
								        {
								        $dir = $GetDIRname; 
								        }
								 
								        ignore_user_abort(true);
								        set_time_limit(0); // disable the time limit for this script
								          
								        $path = $dir."/"; // change the path to fit your websites document structure
								        
								        $fullPath = $path.$file;
										$md5 = sha1_file($file);
										$hellofile = file_get_contents('checksum');
								        $infofile = json_decode($hellofile,true);
								        if(isset($infofile[$fullPath])){
								            $infofile[$fullPath] = $md5;
								        }else{
								            $infofile[$fullPath]= $md5;
								        }
								        $hellofile=json_encode($infofile);
								        $h=fopen('checksum','c');// If $h is false, you couldn't open the file
								        flock($h,LOCK_EX);// lock the file
								        $b=fwrite($h,$hellofile);// if $b is not greater than 0, nothing was written
								        flock($h,LOCK_UN);
								        fclose($h);
									}
									echo $md5;
								?></td>
                            <td style="text-align:center">
                            <?php
							$string = file_get_contents("log");
							$hit = '';
							if(!empty($string)) {
								$jsonIterator = new RecursiveIteratorIterator(
								    new RecursiveArrayIterator(json_decode($string, TRUE)),
								    RecursiveIteratorIterator::SELF_FIRST);
								$dirFile = getcwd()."/".$file;
								foreach ($jsonIterator as $key => $val) {
									if($key == $dirFile) {
								        $hit = $val;
								        break;
								    }
								}
							}
							if(empty($hit)) {
								echo "-";
							} else {
								echo $hit;
							}
						?>
						</td>
                            <td><?php echo date("Y-m-d H:i:s", filemtime($dir."/".$file)); ?></td>
                            <td><?php 
                            if($FileorNo=='1')
                                { 
                                    echo "<a href='?hello=Download&DirOpen=$GetDIRname&FileDownload=$file'><img src='http://icons.iconarchive.com/icons/dtafalonso/android-lollipop/512/Downloads-icon.png' alt='$file' width='32px' height='32px'></a>";
                                }
                            else
                                { 
                                    echo "<a href='?hello=OpenDIR&DirOpen=$file'><img src='https://cdn3.iconfinder.com/data/icons/3d-printing-icon-set/512/Open_file.png' alt='$file' width='32px' height='32px'></a>";
                                } 
                            ?>
                            </td>
                          </tr>
                          <?php
                        }

                    }
                    /*if ($file != "." && $file != "..") {
                    if (is_dir($file)) {
                        $arr = $file;
                        foreach ($arr as $value) {
                            $arrfiles[] = $dir."/".$value;
                        }
                    } else {
                        $arrfiles[] = $dir."/".$file;
                    }
                	}
              }*/
                closedir($dh);
              }
            }
             
            ?>
        </table>
        <div id="footer">
        	&copy <a href="http://dracos-linux.org" target="_blank">Dev Dracos Linux</a>. All Right Reserved.
        </div>
        </body>
        </html>
    <?php
    }
}
 
$DracosDir=new DirListingDracos;
$GetURL=(isset($_GET['hello']) ? $_GET['hello'] : null);
 
if($GetURL==''){$DracosDir->indexFile();}
elseif($GetURL=='Download'){$DracosDir->DownloadFile();}
elseif($GetURL=='OpenDIR'){$DracosDir->indexFile();}
 
?>
