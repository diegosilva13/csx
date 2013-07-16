<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ccm_css_js{
	public function _css_(){
		$css = array(
                        'layout.css',
                        'bootstrap-datetimepicker.min.css',
                        'bootstrap.css',
                        'bootstrap-responsive.css',
                        'reset.css',
                        'main.css','style.css','board-min.css',
                        'mystyle.css'
                    );
		$string_css_location = '';
		foreach ($css as $key => $value) {
			//$string_css_location.=link_tag(base_url().'assets/design/css/'.$css[$key],'stylesheet','text/css',' ','screen,projection');
                        $string_css_location.= '<link rel="stylesheet" media="screen,projection" type="text/css" href="'.  base_url().'assets/design/css/'.$css[$key].'"'.' />';
                }
		return $string_css_location;
	}
	public function _script_js(){
	$js = array(
                'bootstrap-datetimepicker.min.js',
                'jquery-1.10.1.min.js',
                'scripts.js','jquery.js',
                'switcher.js','toggle.js',
                'ui.core.js','ui.tabs.js',
                'scripts.js','pgnyui.js','pgnviewer.js'
            );
		$string_js_location = '';
		foreach ($js as $key => $value) {
			$string_js_location.='<script src="'.base_url().'assets/design/js/'.$js[$key].'" '.'type="text/javascript"></script>';
		}
		return $string_js_location;
	}
        public function constroi_editor(){
             $data['ckeditor_texto1'] = array
        (
            'id'   => 'texto1',
            'path' => 'assets/design/ckeditor',
            'config' => array
            (
                'toolbar' => "Full",
                'width'   => "100%",
                'height'  => "300px",
                'filebrowserBrowseUrl'      => base_url().'assets/design/ckeditor/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => base_url().'assets/design/ckeditor/ckfinder/ckfinder.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'assets/design/ckeditor/ckfinder/ckfinder.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'assets/design/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'assets/design/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'assets/design/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            )
        );
                
                return $data;
        }
}
