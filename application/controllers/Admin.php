<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private static $data = array();

	function __construct() {
		parent::__construct();
		$this->load->helper(array('helperssl'));

		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->common->is_logged_admin();

		self::$data['settings']						    =	$this->database->getSettingsData();
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'listing'));
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'option'));
        self::$data['plugins']                          =   $this->database->_get_row_data('tbl_platforms','');
		self::$data['languages']						=	$this->database->load_all_languages();
		self::$data['default_currency']					=	$this->common->getCurrency('USD','symbol');
		self::$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
        self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
        self::$data['disputes']                         =   $this->database->_get_disputes_data(0);
        self::$data['imagesData']                       =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
        self::$data['ads']                              =   $this->database->_get_row_data('tbl_ads',array('id'=>1));
        self::$data['email_settings']                   =   $this->database->_get_row_data('tbl_email_settings',array('id'=>1));
        self::$data['token']                            =   $this->security->get_csrf_hash();

        if(self::$data['settings'][0]['ssl_enable'] === '1'){
            force_ssl();
        }
    }

    public function index(){
    	$data = self::$data;
    	$data['TU']				= $this->database->_results_count('tbl_users',array('user_level'=>1),true);
    	$data['TE']				= $this->get_totalearnings();
    	$data['ME']				= $this->get_totalearnings();
    	$data['OC']				= $this->database->_multiple_results_count('tbl_opens','status',array(0,1,2,5,6,8,9),true);
    	$data['TL']				= $this->database->_results_count('tbl_listings',array('status'=>1),true);
        $data['contracts']      = $this->database->_get_recent_contract();
        $data = html_escape($this->security->xss_clean($data));
		$this->load->view('admin/dashboard',$data);
		return;
	}

	/*pending to mark as complete*/
	public function pending_completes(){
		$data = self::$data;
		$data['pendings']		=	$this->database->_markAsCompletedAuto();
        $data = html_escape($this->security->xss_clean($data));
		$this->load->view('admin/pending_complete',$data);
		return;
	}

    /*User Control*/
    public function user_control(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/user-control',$data);
        return;
    }

    /*Ads Control*/
    public function ads_manager(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/ads-manager',$data);
        return;
    }

	/*pages manager*/
	public function pages_manager(){
		$data = self::$data;
		$data['pages']		=	$this->database->_get_row_data('tbl_pages',array('page_visibility_status'=>1),'');
        $data = html_escape($this->security->xss_clean($data));
		$this->load->view('admin/pages_manager',$data);
		return;
	}

    /*Cron Jobs Manager*/
    public function cron_jobs(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/cron-jobs',$data);
        return;
    }

    /*About Developers*/
    public function about_developers(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/about-developers',$data);
        return;
    }

    /*Reported Listings*/
    public function reported_listings(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/reported-listings',$data);
        return;
    }

    /*Announcement Manager*/
    public function announcement_control(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/announcement-control',$data);
        return;
    }

    /*Category Manager*/
    public function category_control(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/category-manager',$data);
        return;
    }

    /*Listing Manager*/
    public function listing_control(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/listing-manager',$data);
        return;
    }

    /*Sponsored & Regular Listings*/
    public function listings_types(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/any-listings',$data);
        return;
    }

    /*Listing Manager*/
    public function language_setup(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/language-setup',$data);
        return;
    }

    /*Payments Data*/
    public function payments_data(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/payments-data',$data);
        return;
    }

    /*Withdrawal Settings*/
    public function withdrawal_settings(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/withdrawal-settings',$data);
        return;
    }

    /*Platform Control*/
    public function plugins_manager(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/plugins-manager',$data);
        return;
    }

    /*Payments Setup*/
    public function payments_setup(){
        $data = self::$data;
        $data['payments']  =   $this->database->_get_row_data('tbl_payment_settings','');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/payments-setup',$data);
        return;
    }

    /*Manage Disputes*/
    public function manage_disputes($id){
        $data = self::$data;
        if(!empty($id)){
            $data['contract']  =   $this->database->_get_contract($id);

            if(isset($data['contract'][0]['bid_id'])){
                $data['dispute']            =   $this->database->_get_disputes_data('',$data['contract'][0]['id']);
                $data['seller']             =   $this->database->getUserData($data['contract'][0]['owner_id']);
                $data['buyer']              =   $this->database->getUserData($data['contract'][0]['customer_id']);
                $data['userprofile']        =   $this->database->getUserData($data['contract'][0]['owner_id']);
                $data['reviewRatings']      =   $this->database->get_reviews($data['contract'][0]['owner_id'],$this->session->userdata('user_id'));
                $data['contractsHistory']   =   $this->database->_load_history($data['contract'][0]['id']);
            
                if($data['contract'][0]['type'] === 'bid'){
                    $data['biddata']        =   $this->database->_get_bid($data['contract'][0]['bid_id']);
                }

                if($data['contract'][0]['type'] === 'offer'){
                    $data['biddata']        =   $this->database->_get_offer($data['contract'][0]['bid_id']);
                }

                $data['contractamount']     =   $this->database->_get_single_data('tbl_contracts',array('contract_id'=>$data['contract'][0]['id']),'amount');
                $data['listing_data']       =   $this->database->_get_row_data('tbl_listings',array('id'=>$data['contract'][0]['listing_id']));
            }
            $data = html_escape($this->security->xss_clean($data)); 
            $this->load->view('admin/manage-disputes',$data);
            return;
        }

        $this->pageNotFound();
    }

    /*admin Profile Settings*/
    public function user_settings(){
        $data = self::$data;
        $data['metaData']                       =   $this->database->getSettingsData();
        $data['withdraw_meths']                 =   $this->database->_get_row_data('tbl_withdrawal_methods',array('status'=>1));
        $data['profileid']                      =   $this->session->userdata('user_id');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/admin-settings',$data);
    }


    /*admin Profile Settings*/
    public function images_manager(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/images-manager',$data);
    }

    /*Email Settings*/
    public function email_settings(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/email-settings',$data);
    }

    /*Change Admin Password*/
    public function change_password(){
        $data = self::$data;
        $data['metaData']                       =   $this->database->getSettingsData();
        $data['profileid']                      =   $this->session->userdata('user_id');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/change-password',$data);
    }

    /*pages manager*/
    public function general_settings(){
        $data = self::$data;
        $data['settings']   =   $this->database->getSettingsData();
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/general-settings',$data);
        return;
    }

    /*current listings*/
    public function current_listings(){
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/current-listings',$data);
        return;
    }

    /*blog manager*/
    public function blog_manager(){
        $data = self::$data;
        $data['posts']      =   $this->database->_get_row_data('tbl_blog',array('status'=>1),'');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/blog_manager',$data);
        return;
    }

    /*Admin logout*/
    public function logout(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_level');
        redirect($this->session->userdata('url'));
        return;
    }
    
    /*Get Total Earnings*/
    public function get_totalearnings(){
    	$arr = $this->database->_get_statics('tbl_payments','SUM(AMOUNT) as total',array('ACK'=>'Success'),array('ACK'=>'SuccessWithWarning'),'PAYMENTINFO_0_TRANSACTIONID');
    	if(isset($arr[0]['total'])){
            return $arr[0]['total'];
        }
        return;
    }

    /*Get Total Earnings*/
    public function get_monthlyearnings(){
    	$arr = $this->database->_get_statics('tbl_payments','SUM(AMOUNT) as total',array('ACK'=>'Success'),array('ACK'=>'SuccessWithWarning'),'PAYMENTINFO_0_TRANSACTIONID',array('TIMESTAMP'=>date('Y-m')));
    	if(isset($arr[0]['total'])){
            return $arr[0]['total'];
        }
        return;
    }

    /*Get Total Listings*/
    public function get_monthlywisetotallistings($year='',$previousYear=''){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if(empty($year)){
            $year = date('Y');
            
        }

        if(empty($previousYear)){
            $previousYear = date("Y") - 1;
        }

        $finalArr = array();
        $arr    = $this->database->_get_monthlywisetotallistings($year);
        $arrPrv = $this->database->_get_monthlywisetotallistings($previousYear);
        if(!empty($arr)){
            for($i=0;$i<12;$i++) {
                $finalArr[0][$i] =  $arr[$i]['total'];
            }
        }

        if(!empty($arrPrv)){
            for($i=0;$i<12;$i++) {
                $finalArr[1][$i] =  $arrPrv[$i]['total'];
            }
        }

        $output['response']         = $finalArr;
        exit(json_encode($output));
    }

    /*Get Monthlwise Total Earnings*/
    public function get_monthlywisetotalearnings($year=''){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        
    	if(empty($year)){
    		$year = date('Y');
    	}

    	$finalArr = array();
    	$arr = $this->database->_get_monthlywisetotalearnings($year);
    	if(!empty($arr)){
    		for($i=0;$i<12;$i++) {
    			$finalArr[$i] =  $arr[$i]['total'];
    		}
    	}

        $output['response']         = $finalArr;
        exit(json_encode($output));
    }

    /*upload_key*/
    public function upload_key(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if (!empty($_FILES['uploadGoogleKey']['name'])) {
            if ($this->security->xss_clean($_FILES['uploadGoogleKey']['name'], TRUE) === TRUE) {
                $key = $this->upload__files('uploadGoogleKey',KEY_UPLOAD,true);
                $output['response']   = $this->database->_update_to_table('tbl_settings',array('json_key_file'=>$key),array('id'=>1));
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save page data*/
    public function save_page_data(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'txt_page_title'=>$this->input->post('txt_page_title'),
        'txt_page_meta_description' =>$this->input->post('txt_page_meta_description'),
        'txt_page_meta_keywords' =>$this->input->post('txt_page_meta_keywords'),
        'txt_page_url_slug' =>$this->input->post('txt_page_url_slug'),
        'txt_page_description' =>$this->input->post('txt_page_description'),
        'page_visibility_group' =>$this->input->post('page_visibility_group'),
        'page_visibility_status' =>$this->input->post('page_visibility_status'),
        'date'=>date('Y-m-d H:i:s')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('txt_page_title', 'Page Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_meta_description', 'Page Meta', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_meta_keywords', 'Page Keywrords', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_url_slug', 'Page Slug', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_description', 'Description', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);

            if(!empty($data['txt_page_meta_keywords'])){
                $data['txt_page_meta_keywords'] = json_encode(explode(",", $data['txt_page_meta_keywords']));
            }
            
            if(!empty($this->input->post('txt_page_id'))){
                $output['response']     = $this->database->_update_to_table('tbl_pages',$data,array('page_id'=>$this->input->post('txt_page_id')));
                exit(json_encode($output));
            }
            else
            {
                $output['response']     = $this->database->_insert_to_table('tbl_pages',$data);
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Language data*/
    public function save_language_data(){
        $data = array(
        'language'=>$this->input->post('language_name'),
        'language_code' =>$this->input->post('language_code'),
        'status' =>$this->input->post('language_active')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('language', 'Language', 'required|trim|xss_clean');
        $this->form_validation->set_rules('language_code', 'Language Code', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            if(empty($this->input->post("language_id"))  && empty($this->database->_get_single_data('tbl_languages',array('language_code'=>$this->input->post('language_code')),'language'))){
                $this->copy_language_file('application/language/english','application/language/'.$this->security->sanitize_filename($this->input->post('language_name')));
                $output['response']     = $this->database->_insert_to_table('tbl_languages',$data);
                exit(json_encode($output));
            }
            else
            {
                $this->rename_language_directory('application/language/'.($this->database->_get_single_data('tbl_languages',array('language_code'=>$this->input->post('language_code')),'language'))[0]['language'],'application/language/'.$this->security->sanitize_filename($this->input->post('language_name')));
                $output['response']     = $this->database->_update_to_table('tbl_languages',$data,array('id'=>$this->input->post('language_id')));
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Copy Language File according to the created language*/
    public function copy_language_file($src,$dst) { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    }

    /*Rename Language Directory accordingly*/
    public function rename_language_directory($src,$dst) { 
        rename($src,$dst);
    }

    /*Save Blog data*/
    public function save_blog_data(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $icon = '';
        if (!empty($_FILES['uploadListingImage']['name'])) {
            if($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === FALSE) {
                $icon = '';
            }
            else
            {
                $icon = $this->upload__image('uploadListingImage',BLOG_UPLOAD);
            }
        }

        $data = array(
        'title'=>$this->input->post('txt_blogpost_title'),
        'metadescription' =>$this->input->post('txt_blogpost_meta_description'),
        'metakeywords' =>json_encode(explode(",", $this->input->post('txt_blogpost_meta_keywords'))),
        'slug' =>$this->input->post('txt_blogpost_url_slug'),
        'blog_post' =>$this->input->post('txt_blogpost_description'),
        'blog_tags' =>json_encode(explode(",", $this->input->post('txt_blogpost_tags'))),
        'status' =>$this->input->post('blogpostvisibility_status'),
        'date'=>date('Y-m-d H:i:s'),
        'views'=>0
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('title', 'Blog Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('metadescription', 'Meta Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('metakeywords', 'Keywords', 'required|trim|xss_clean');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|xss_clean');
        $this->form_validation->set_rules('blog_post', 'Blog Post', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            if(!empty($this->input->post('txt_blogpost_id'))){
                if(!empty($icon)){
                    $data['thumbnail']  = $icon;
                }
                $output['response']     = $this->database->_update_to_table('tbl_blog',$data,array('id'=>$this->input->post('txt_blogpost_id')));
                exit(json_encode($output));
            }
            else
            {
                if(!empty($data['title'])){   
                    $data['thumbnail']      = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_blog',$data);
                    exit(json_encode($output));
                }
            }
        }
        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Image data*/
    public function save_images_data(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($_FILES['sitelogo']['name'])) {
            if($this->security->xss_clean($_FILES['sitelogo']['name'], TRUE) === TRUE) {
                $sitelogo = $this->upload__image('sitelogo',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['invoice_logo']['name'])) {
            if($this->security->xss_clean($_FILES['invoice_logo']['name'], TRUE) === TRUE) {
                $invoice_logo = $this->upload__image('invoice_logo',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['favicons']['name'])) {
            if($this->security->xss_clean($_FILES['favicons']['name'], TRUE) === TRUE) {
                $favicon = $this->upload__image('favicons',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['mainback']['name'])) {
            if($this->security->xss_clean($_FILES['mainback']['name'], TRUE) === TRUE) {
                $mainback = $this->upload__image('mainback',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['homepage']['name'])) {
            if($this->security->xss_clean($_FILES['homepage']['name'], TRUE) === TRUE) {
                $homepage = $this->upload__image('homepage',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['loader']['name'])) {
            if($this->security->xss_clean($_FILES['loader']['name'], TRUE) === TRUE) {
                $loader = $this->upload__image('loader',ADMIN_IMAGES,true);
            }
        }

        if (!empty($_FILES['backgrounds']['name'])) {
            if($this->security->xss_clean($_FILES['backgrounds']['name'], TRUE) === TRUE) {
                $backgrounds = $this->upload__image('backgrounds',ADMIN_IMAGES,true);
            }
        }

        $data = array();

        if(!empty($sitelogo)){
            $data['sitelogo'] = $sitelogo;
        }

        if(!empty($invoice_logo)){
            $data['invoice_logo'] = $invoice_logo;
        }

        if(!empty($favicon)){
            $data['favicon'] = $favicon;
        }

        if(!empty($mainback)){
            $data['mainback'] = $mainback;
        }

        if(!empty($homepage)){
            $data['homepage'] = $homepage;
        }

        if(!empty($loader)){
            $data['loader'] = $loader;
        }

        if(!empty($backgrounds)){
            $data['backgrounds'] = $backgrounds;
        }

        if(!empty($data)) {
            $output['response']    = $this->database->_update_to_table('tbl_siteimages',$data,array('id'=>1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }


     /*Save Announcement data*/
    public function save_announcement(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'announcement_heading'=>$this->input->post('txt_announcement_heading'),
        'announcement' =>$this->input->post('txt_announcement'),
        'announcement_type' =>$this->input->post('announcement_type'),
        'group_id' =>$this->input->post('visibility_group'),
        'status' =>$this->input->post('visibility_status'),
        'date'=>date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('announcement_heading', 'Announcement Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('announcement', 'Announcement', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            if(!empty($this->input->post('txt_announcement_id'))){
                $output['response']     = $this->database->_update_to_table('tbl_announcement',$data,array('id'=>$this->input->post('txt_announcement_id')));
                exit(json_encode($output));
            }
            else
            {
                $output['response']     = $this->database->_insert_to_table('tbl_announcement',$data);
                exit(json_encode($output));
            }
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Blog data*/
    public function save_general_settings(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'activate_one_listing_per_domain'=>$this->input->post('activate_one_listing_per_domain'),
        'show_expired_records'=>$this->input->post('show_expired_records'),
        'default_currency' =>$this->input->post('default_currency'),
        'auction_period' =>$this->input->post('auction_period'),
        'bid_value_gap' =>$this->input->post('bid_value_gap'),
        'sale_commission' =>$this->input->post('sale_commission'),
        'hold_bidding_until_approval' =>$this->input->post('hold_bidding_until_approval'),
        'allow_multiple_bidding' =>$this->input->post('allow_multiple_bidding'),
        'allow_approvedbidder_tobid' =>$this->input->post('allow_approvedbidder_tobid'),
        'processing_fee' =>$this->input->post('processing_fee'),
        'image_thumbnails' =>$this->input->post('image_thumbnails'),
        'email_notifications' =>$this->input->post('email_notifications'),
        'office_add1' =>$this->input->post('office_add1'),
        'office_add2' =>$this->input->post('office_add2'),
        'office_tel' =>$this->input->post('office_tel'),
        'office_email' =>$this->input->post('office_email'),
        'user_facebook' =>$this->input->post('user_facebook'),
        'user_twitter' =>$this->input->post('user_twitter'),
        'user_Instagram' =>$this->input->post('user_Instagram'),
        'user_github' =>$this->input->post('user_github'),
        'user_google' =>$this->input->post('user_google'),
        'user_youtube' =>$this->input->post('user_youtube'),
        'google_analytics' =>$this->input->post('google_analytics'),
        'ssl_enable' =>$this->input->post('ssl_enable'),
        'active_domain_verification' =>$this->input->post('active_domain_verification'),
        'blacklisted_domains' =>json_encode(explode(",", $this->input->post('blacklisted_domains')))
        );

        $data = $this->security->xss_clean($data);
        if(!empty($data)) {
            $output['response']    = $this->database->_update_to_table('tbl_settings',$data,array('id'=>1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Payment Gateway Settings*/
    public function paypal_data_Save($id){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'status' => $this->input->post('paypal_status'),
        'username' => $this->input->post('paypal_username'),
        'password' => $this->input->post('paypal_password'),
        'signature' => $this->input->post('paypal_signature'),
        'icon_url' => $this->input->post('icon_url'),
        'sandbox' => $this->input->post('paypal_sandbox')
        );

        if(!empty($id)){
            $this->form_validation->set_data($data);
            switch ($id) {
                case '1':
                    $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                case '2':              
                    $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                case '3':              
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                default:
                    return ;
            }

            if ($this->form_validation->run()){
                $data = $this->security->xss_clean($data);
                $output['response']     = $this->database->_update_to_table('tbl_payment_settings',$data,array('id'=>$id));
                exit(json_encode($output));
            }
            else
            {
                $output['response']     = false;
                exit(json_encode($output));
            }
        }
        else
        {
            $output['response']     = false;
            exit(json_encode($output));
        }
    }


    /*Save Withdrawal Setup */
    public function withdrawals_setup(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'threshold' => $this->input->post('withdrawal_threshold'),
        'fee' => $this->input->post('fee_amount'),
        'cal_meth' => $this->input->post('fee_method'),
        'status' => $this->input->post('withdrawal_status')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('threshold', 'Threshold', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('fee', 'Fee', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('cal_meth', 'Method', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            $output['response']     = $this->database->_update_to_table('tbl_withdrawal_methods',$data,array('id'=>$this->input->post('withdrawal_methods')));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Withdrawal Setup */
    public function save_email_settings(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'site_email' => $this->input->post('site_email'),
        'site_email_name' => $this->input->post('site_email_name'),
        'mail_sending_option' => $this->input->post('mail_sending_option'),
        'mail_smtp_server' => $this->input->post('mail_smtp_server'),
        'mail_smtp_user' => $this->input->post('mail_smtp_user'),
        'mail_smtp_password' => $this->input->post('mail_smtp_password'),
        'mail_smtp_port' => $this->input->post('mail_smtp_port'),
        'mail_smtp_encryption' => $this->input->post('mail_smtp_encryption')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('site_email', 'Site Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('site_email_name', 'Email Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_server', 'Mail Server', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_user', 'User', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_port', 'Port', 'required|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            $output['response']     = $this->database->_update_to_table('tbl_email_settings',$data,array('id'=>1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Category data*/
    public function save_category_data(){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
       
        if(!empty($this->input->post('category_name'))){
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage',CATEGORY_IMAGES);
                }
            }

            $data = array(
            'c_name'=>$this->input->post('category_name'),
            'c_description' =>$this->input->post('category_meta_description'),
            'c_keywords' =>json_encode(explode(",", $this->input->post('category_meta_keywords'))),
            'c_level' =>$this->input->post('category_level'),
            'url_slug' =>$this->input->post('category_url_slug'),
            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('c_name', 'Category Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_description', 'Category Description', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_keywords', 'Category Keywords', 'required|trim|xss_clean');
            $this->form_validation->set_rules('url_slug', 'Slug', 'required|trim|xss_clean');

            if ($this->form_validation->run()){
                $data = $this->security->xss_clean($data);
                if(!empty($this->input->post('category_id'))){
                    if(!empty($icon)){
                        $data['c_thumb']    = $icon;
                    }

                    $output['response']     = $this->database->_update_to_table('tbl_categories',$data,array('id'=>$this->input->post('category_id')));
                    exit(json_encode($output));
                }
                else
                {
                    $data['c_thumb']        = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_categories',$data);
                    exit(json_encode($output));
                }   
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save Listing Header data*/
    public function save_listing_header_data(){
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $icon = '';
        if (!empty($_FILES['uploadListingImage']['name'])) {
            if($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                $icon = $this->upload__image('uploadListingImage',ICON_UPLOAD);
            }
        }

        $data = array(
        'listing_name'=>$this->input->post('listing_name'),
        'listing_description' =>$this->input->post('listing_description'),
        'listing_price' =>$this->input->post('listing_price'),
        'listing_duration' =>$this->input->post('listing_duration'),
        'listing_type' =>$this->input->post('listing_type'),
        'status' =>$this->input->post('listing_status')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('listing_name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('listing_description', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('listing_price', 'Price', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('listing_duration', 'Duration', 'required|numeric|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
            if(!empty($this->input->post('listing_id'))){
                if(!empty($icon)){
                    $data['listing_icon']   = $icon;
                }
                $output['response']         = $this->database->_update_to_table('tbl_listing_header',$data,array('listing_id'=>$this->input->post('listing_id')));
                exit(json_encode($output));
            }
            else
            {
                $data['listing_icon']       = $icon;
                $output['response']         = $this->database->_insert_to_table('tbl_listing_header',$data);
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Ads*/
    public function save_ads(){
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'homepage_banner_720x90'=>$this->input->post('homepage_banner_720x90'),
        'webpage_banner_720x90'=>$this->input->post('webpage_banner_720x90'),
        'blog_page_720x90'=>$this->input->post('blog_page_720x90'),
        'blog_300x250'=>$this->input->post('blog_300x250'),
        'blog__post_page_720x90'=>$this->input->post('blog__post_page_720x90'),
        'blog__post_page_300x250'=>$this->input->post('blog__post_page_300x250')
        );

        if(!GOOGLE_ADSENSE){
            $data = $this->security->xss_clean($data, TRUE);
        }
        
        $output['response']  = $this->database->_update_to_table('tbl_ads',$data,array('id'=>1));
        exit(json_encode($output));
    }

    /*Upload Images */
    public function upload__image($nameBox,$path=IMAGES_UPLOAD,$overwrite=false){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg|gif|svg';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = $overwrite;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if(isset($error['error'])){
                return 'N/A';
            }
        }
        else
        {
            $image_data = $this->upload->data();
            $upload_image_name = $image_data['file_name'];
            $full_path = $image_data['full_path'];
            if(isset($full_path)){
                return $upload_image_name;
            }
        } 
    }

    /*Upload Files */
    public function upload__files($nameBox,$path=FILES_UPLOAD,$overwrite=false){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = $overwrite;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if(isset($error['error'])){
                return 'N/A';
            }
        }
        else
        {
            $image_data = $this->upload->data();
            $upload_image_name = $image_data['file_name'];
            $full_path = $image_data['full_path'];
            if(isset($full_path)){
                return $upload_image_name;
            }
        } 
    }
}